<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\Transaction;
use App\User;
use App\ReferUsers;
use App\Log;
use App\GameChallange;
use App\UserPermisssions;
use Gate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Helper\Helper;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $data = [
            'title' => 'Users List'
        ];

        $data2 = User::query();
        $data2->where('is_admin', 0);
        if($request->search){
            $data2->where('phone',$request->search)->orWhere('email',$request->search)->orWhere('name','like','%'.$request->search.'%');
        }
        if($request->wallet == 1){
            $data2->orderBy('wallet','desc');
        }elseif($request->wallet == 2){
            $data2->orderBy('deposit_amount','desc');
        }else{
            $data2->orderBy('id','desc');
        }
       
        $data['users'] = $data2->paginate(20)->withQueryString();
        return view('admin.users.index', $data);
    }

    public function create()
    {
        // abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = [
            'title' => 'Create User'
        ];
        $data['permissionArray'] = Helper::permissionArray();
        return view('admin.users.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            // 'email' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status,
            'is_play' => (integer)$request->is_play,
        ];
        DB::beginTransaction();
        try {
            //code...
            if(isset($request->password)){
                $data['password'] = $request->password;
            }
            $user = User::updateOrCreate(['id' => $request->id], $data);
            // $user->roles()->sync($request->roles);

            if($request->file('profile_image')) {
                $file = $request->file('profile_image');
                $imageName = $this->UpdateImage($file, 'assets/users/'.$user->id);
                $user->profile_image = 'assets/users/'.$user->id.'/'.$imageName;
                $user->save(); 
            }
            UserPermisssions::where('user_id',$user->id)->delete();

            if(!empty($request->permission)){
                $user->is_admin = 1;
                $user->save();
                foreach($request->permission as $item){
                    UserPermisssions::create([
                        'user_id' => $user->id,
                        'permission' => $item,
                    ]);
                }
            }else{
                $user->is_admin = 0;
                $user->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return redirect()->route('admin.users.index')->with('msg', $th->getMessage());
        }
        $msg = isset($request->id)?'User Updated Successfully':'User Created Successfully';
        return redirect()->route('admin.users.index')->with('msg', $msg);
    }

    public function edit(User $user)
    {
        // abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = [
            'title' => 'Edit User', 
            'user' => $user
        ];
        $data['permissionArray'] = Helper::permissionArray();
        $data['UserPermisssions'] = UserPermisssions::where('user_id',$user->id)->pluck('permission')->toArray();
        // return  $data['UserPermisssions']

        return view('admin.users.create', $data);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        return $user;
        $user->update($request->all());
        UserPermisssions::where('user_id',$user->id)->delete();
        if(!empty($request->permission)){
            $user->is_admin = 1;
            $user->save();
            foreach($request->permission as $item){
                UserPermisssions::create([
                    'user_id' => $user->id,
                    'permission' => $item,
                ]);
            }
        }else{
            $user->is_admin = 0;
            $user->save();
        }
        
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');

    }

    public function show(User $user)
    {
        // abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user_id = $user->id;
        $user->load('roles');
        $ReferUsers = ReferUsers::where('refer_by',$user->id)->paginate(15);
        $ReferUsersTotal = ReferUsers::where('refer_by',$user->id)->sum('amount');
        $query = GameChallange::leftjoin('users as uc','uc.id','game_challenge.challenge_created_by')
                        ->leftjoin('users as ua','ua.id','game_challenge.challenge_accepted_by')
                        ->where(function ($query) use($user_id){
                            $query->where('game_challenge.challenge_created_by',$user_id)
                            ->orwhere('game_challenge.challenge_accepted_by',$user_id);
                        })->orderBy('game_challenge.id','desc')
                        ->select('ua.name as a_name','uc.name as c_name','game_challenge.*')->paginate(5);
        $d['withdrawals']  = Transaction::where('transaction_type','withdrawal_money')
            ->where('user_id',$user_id)
            ->orderBy('id','desc')
            ->paginate(10);
        $d['funds'] = Transaction::where('transaction_type','add_money')
            ->orderBy('id','desc')
            ->where('user_id',$user_id)
            ->paginate(10);

            $d['Transaction'] = Transaction::
            orderBy('id','desc')
            ->where('user_id',$user_id)
            ->paginate(15);
        return view('admin.users.show', compact('user','query','ReferUsers','ReferUsersTotal'),$d);
    }

    public function destroy(User $user)
    {
        // abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($user->is_admin == 1) {
            // You can customize this response or redirect to a specific route for unauthorized deletion
            abort(403, 'Unauthorized to delete admin users');
        }

        $user->delete();

        return back();

    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function moneyMan(Request $request)
    {
        $request->validate([
            'action' => 'required|in:cr,dr',
            'amount' => 'required|min:1',
            'id' => 'required|exists:users,id',
        ],[
            'action.in'  => 'Select transaction type',
            'amount.min'     => 'money should be more than 1'
        ]);
        $desc = ($request->action == 'cr') ? $request->amount.' is credited by admin': $request->amount.' is debited by admin';
        
        $data = [
            'user_id'  => $request->id,
            'action'  => $request->action,
            'amount'  => $request->amount,
            'description'  => $desc,
        ];

        try {

            DB::beginTransaction();
            $userGET = User::where('id',$request->id)->first();
            $trasn = Transaction::where('user_id',$request->id)->where('transaction_type','add_money')->orderBy('id','desc')->first();
            $current_time = Carbon::now()->toDateTimeString();
            if(!empty($trasn)){
                $xx =  date('Y-m-d H:i:s', strtotime($current_time));
                $xx2 =  date('Y-m-d H:i:s', strtotime($trasn->created_at));
                $start = Carbon::parse($xx2);
                $end = Carbon::parse($xx);
                $total = $start->diffInSeconds($end);
            }else{
                $total = 40; 
            }
            // return $total;
            if($total > 30){
                if($request->action == 'cr'){
                    User::where('id',$request->id)->increment('wallet',$request->amount);
                    $userBal = User::where('id',$request->id)->first();
                    $transaction = new Transaction;
                    $transaction->transaction_type = 'add_money';
                    $transaction->type = 'credit';
                    $transaction->user_id = $request->id;
                    $transaction->status = 'SUCCESS';
                    $transaction->addition_status = 'approve';
                    $transaction->amount = $request->amount;
                    $transaction->title = $request->title;
                    $transaction->transactions_id = Helper::generateTransactionID();
                    $close = number_format(($userBal->wallet  + $userBal->deposit_amount));
                
                    $transaction->closing_balance = $close ?? '';
                    $transaction->isAdmin = 1;
                    $transaction->save();
                    DB::commit();
                    return redirect()->route('admin.users.index')->with('msg', 'Money added successfully');
                }
                if($request->action == 'dr'){
                    $user = User::where('id',$request->id)->first();
                    if($user->wallet<$request->amount){
                        return redirect()->route('admin.users.index')->with('msg', 'No enough money');
                    }
                    $user->wallet = $user->wallet - $request->amount;
                    $user->save();
                    // $transaction->transaction_type = 'withdrawal_money';
                    // $transaction->save();
                    // Log::create($data);
                    $transaction = new Transaction;
                    $transaction->transaction_type = 'remove_money';
                    $transaction->type = 'debit';
                    $transaction->user_id = $request->id;
                    $transaction->status = 'SUCCESS';
                    $transaction->addition_status = 'approve';
                    $transaction->amount = $request->amount;
                    $transaction->title = $request->title;
                    $transaction->transactions_id = Helper::generateTransactionID();
                    $close = number_format(($user->wallet  + $user->deposit_amount));
                    $transaction->closing_balance = $close ?? '';
                    $transaction->isAdmin = 1;
                    $transaction->save();

                    DB::commit();
                    return redirect()->route('admin.users.index')->with('msg', 'Money debited successfully');
                }
            }
            return redirect()->back()->with('msg', 'Trans. failed try again in 30 seconds');
            
        } catch (Exception $e) {
            return redirect()->route('admin.users.index')->with('msg', $e->getMessage());
        }
        
    }
}
