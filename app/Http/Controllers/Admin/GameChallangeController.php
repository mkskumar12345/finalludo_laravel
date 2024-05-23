<?php

namespace App\Http\Controllers\Admin;

use App\GameChallange;
use App\Http\Controllers\Controller;
use App\User;
use App\ChallangeType;
use App\ChallangeResult;
use App\Transaction;
use App\ReferUsers;
use App\SiteSetting;
use App\WalletData;
use App\Income;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Helper\Helper;
use Carbon\Carbon;


class GameChallangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $d['title'] = 'Challanges List';
        $query = GameChallange::join('users as uc','uc.id','game_challenge.challenge_created_by')
                        ->leftjoin('challanges_result','challanges_result.challange_id','game_challenge.id')
                        ->leftjoin('users as ua','ua.id','game_challenge.challenge_accepted_by')
                        ->orderBy('game_challenge.id','desc')
                        ->select('ua.name as a_name','uc.name as c_name','game_challenge.*','challanges_result.acceptor_action','challanges_result.creator_action','challanges_result.cencal_acceptor','challanges_result.cencal_creator');
        if(isset($request->status))
        $query->where('game_challenge.status',$request->status);

        if(isset($request->createdby))
        $query->where('game_challenge.challenge_created_by',$request->createdby);

        if(isset($request->acceptedby))
        $query->where('game_challenge.challenge_accepted_by',$request->acceptedby);

        if(isset($request->user))
        $query->where('game_challenge.challenge_accepted_by',$request->user)->orWhere('game_challenge.challenge_created_by',$request->user);

        $d['data'] = $query->paginate(10)->withQueryString();
        $d['users'] = User::where('id','!=',1)->get();
        return view('admin.challanges.index',$d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $d['type'] = ChallangeType::select('name','id')->get();
        $d['title'] = 'Create challage';
        $d['users'] = User::select('name','id')->where('id','>',1)->get();
        return view('admin.challanges.create',$d);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'amount' => 'required|numeric|min:0|not_in:0',
            'winner_amount' => 'nullable|numeric|min:0|not_in:0',
            'challange_name' => 'required',
            'type'           => 'required',
            'accepted_by'    => 'nullable|exists:users,id',
            'created_by'    =>  'required|exists:users,id',
            // 'screenshort'   => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
       
        DB::beginTransaction();
        try {
            //code...
            $challagne = GameChallange::updateOrCreate([
                'id' => $request->id
            ],[
                'challenge_name' => $request->challange_name,
                'challenge_type'  => $request->type,
                'amount'          => $request->amount,
                'challenge_created_by' => $request->created_by,
                'challenge_accepted_by' => $request->accepted_by,
                // 'screenshort' => $this->WinnerScreenShort($request->file('screenshort')),
                'winning_amount'  => isset($request->winner_amount)?$request->winner_amount:$this->winningAmount($request->amount),
                'status'         => $request->status,
                'room_code'         => $request->room_code
            ]);

            if(!isset($request->id))
            ChallangeResult::create(['challange_id' => $challagne->id]);
        
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('admin.challanges.index')->with('msg', $th->getMessage());
            //throw $th;
        }
        $msg = isset($request->id)?'Challange Updated Successfully':'Challange Created Successfully';
        return redirect()->route('admin.challanges.index')->with('msg', $msg);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $d['title'] = 'Show Details';
        $d['challange'] = GameChallange::with('createBy','acceptedBy','challangeType')
            ->where('id',$id)
            ->first();
        $d['result'] = ChallangeResult::join('game_challenge','game_challenge.id','challanges_result.challange_id')
            ->join('users as uc','uc.id','game_challenge.challenge_created_by')
            ->leftJoin('users as ua','ua.id','game_challenge.challenge_accepted_by')
            ->where('game_challenge.id', $id)
            ->select('ua.name as a_name','uc.name as c_name','game_challenge.*','challanges_result.*')->first(); 

        return view('admin.challanges.show', $d);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $d['type'] = ChallangeType::select('name','id')->get();
        $d['title'] = 'Edit Challage';
        $d['users'] = User::select('name','id')->where('id','>',1)->get();
        $d['challange'] = GameChallange::where('id',$id)->first();
        return view('admin.challanges.create',$d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = GameChallange::find($id);
        $data->delete();
        $msg = 'Challange Deleted Successfully';
        return redirect()->route('admin.challanges.index')->with('msg', $msg);
    }

    public function resultList()
    {
        // code...
        $d['title'] = 'Challanges Result';
        $d['result'] = ChallangeResult::join('game_challenge','game_challenge.id','challanges_result.challange_id')
                    ->leftjoin('challange_type','challange_type.id','game_challenge.challenge_type')
                   ->join('users as uc','uc.id','game_challenge.challenge_created_by')
                        ->leftjoin('users as ua','ua.id','game_challenge.challenge_accepted_by')
                        ->orderBy('challanges_result.id','desc')
                        ->select('ua.name as a_name','uc.name as c_name','game_challenge.*','challanges_result.*','challange_type.name as challange_type')->get(); 
        return view('admin.challanges.result-list',$d);
    }

    public function showReslut($id)
    {
        // code...
        $d['title'] = "Show Result";
        $d['result'] = ChallangeResult::join('game_challenge','game_challenge.id','challanges_result.challange_id')
                    ->leftjoin('challange_type','challange_type.id','game_challenge.challenge_type')
                   ->join('users as uc','uc.id','game_challenge.challenge_created_by')
                        ->leftjoin('users as ua','ua.id','game_challenge.challenge_accepted_by')
                        ->where('challanges_result.id',$id)
                        ->select('ua.name as a_name','uc.name as c_name','game_challenge.*','challanges_result.*','challange_type.name as challange_type')->first(); 
        return view('admin.challanges.show-result',$d);
    }
    public function challangeCancel($id)
    {

        $challagne = GameChallange::where('id',$id)->where('status','!=','cancel')->first();
        if(!$challagne){
            return redirect()->back()->with('message', 'Battel not found');
        }
           $challagne->status = 'cancel';
            $challagne->update();
            if(!empty($challagne->challenge_accepted_by)){



                $user2 = User::where('id',$challagne->challenge_accepted_by)->first();
                
                $WalletData2 = WalletData::where('user_id',$challagne->challenge_accepted_by)->where('challange_id',$challagne->id)->first();

                if(!empty($WalletData2) && ($WalletData2->wallet+ $WalletData2->deposit) == $challagne->amount){
                    $user2->wallet = $user2->wallet + $WalletData2->wallet;
                    $user2->deposit_amount = $user2->deposit_amount + $WalletData2->deposit;
                    $user2->save();
                    $WalletData2->delete();

                }else{
                    User::where('id',$challagne->challenge_accepted_by)->increment('wallet',$challagne->amount);
                }



                $challagneCreatorName = $challagne->createBy->name ?? 'Guest User';
                Transaction::create([
                'user_id'  => $challagne->challenge_accepted_by,
                'amount'  => $challagne->amount,
                'transaction_type'  => 'cancel_refund',
                'addition_status'  => 'approve',
                'title'  => "Cancelled Against $challagneCreatorName",
                'status'  => 'success',
                'type'  => 'credit',
                'transactions_id'  => Helper::generateTransactionID(),
                'closing_balance'  => ($user2->wallet ?? 0) + ($user2->deposit_amount ?? 0),
                ]);
            }
            if(!empty($challagne->challenge_created_by)){
                $challagneAcceptorName = $challagne->acceptedBy->name ?? 'Guest User';
               
                $user3 = User::where('id',$challagne->challenge_created_by)->first();

                $WalletData3 = WalletData::where('user_id',$challagne->challenge_created_by)->where('challange_id',$challagne->id)->first();

                if(!empty($WalletData3) && ($WalletData3->wallet+ $WalletData3->deposit) == $challagne->amount){
                    $user3->wallet = $user3->wallet + $WalletData3->wallet;
                    $user3->deposit_amount = $user3->deposit_amount + $WalletData3->deposit;
                    $user3->save();
                    $WalletData3->delete();

                }else{
                    User::where('id',$challagne->challenge_created_by)->increment('wallet',$challagne->amount);
                }


                Transaction::create([
                'user_id'  => $challagne->challenge_created_by,
                'amount'  => $challagne->amount,
                'transaction_type'  => 'cancel_refund',
                'addition_status'  => 'approve',
                'title'  => "Cancelled Against $challagneAcceptorName",
                'status'  => 'success',
                'type'  => 'credit',
                'closing_balance'  => ($user3->wallet ?? 0) + ($user3->deposit_amount ?? 0),
                'transactions_id'  => Helper::generateTransactionID(),
                ]);
             }
            return redirect()->back()->with('message', 'Challange successfully canceled');
    }

    public function markWinner(Request $request)
    {
        // code...
        $valid = Validator::make($request->all(),[
            'challange_id'       => 'required|exists:game_challenge,id',
            'who_win'            =>  'required|exists:users,id'
        ]);
        if($valid->fails())
        return redirect()->back()->with('message', 'Something went wrong');
        try {
            // DB::beginTransaction();

            $challagne = GameChallange::where('id',$request->challange_id)->where('status','!=','complete')->first();

            $trasn = Transaction::where('user_id',$request->who_win)->where('transaction_type','win_battle')->orderBy('id','desc')->first();
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

            if($total > 30){

                if(!empty($challagne)){

                    if($challagne->challenge_created_by == $request->who_win){
                        $lostUser = $challagne->challenge_accepted_by;
                    }else{
                        $lostUser = $challagne->challenge_created_by;
                    }
                    $admin_income = ((2*$challagne->amount) - $this->winningAmount($challagne->amount));
                    $income = [
                        'challange_id' => $challagne->id,
                        'challange_amount' => $challagne->amount,
                        'income'            => $admin_income,
                    ];
                     Income::create($income);
                    User::where('id',$request->who_win)->increment('wallet',$challagne->winning_amount);
                    $getUserData =   User::where('id',$request->who_win)->first();
                    $lostUserData =   User::where('id',$lostUser)->first();
                    $getUserDataName = $getUserData->name ?? 'Guest User';
                    $lostUserDataName = $lostUserData->name ?? 'Guest User';

                    $challagne->status = 'complete';
                    $challagne->who_win = $request->who_win;
                    $challagne->save();
                    $transaction = new Transaction;
                    $transaction->amount = $challagne->winning_amount;
                    $transaction->transaction_type = 'win_battle';
                    $transaction->addition_status = 'approve';
                    $transaction->title	 = "Won Against $lostUserDataName";
                    $transaction->type	 = 'credit';
                    $transaction->user_id = $request->who_win;
                    $transaction->status = 'success';
                    $transaction->transactions_id =  Helper::generateTransactionID();
                    $transaction->closing_balance = ($getUserData->wallet ?? 0) + ($getUserData->deposit_amount ?? 0);
                    $transaction->save();

                    $transactionLost = new Transaction;
                    $transactionLost->amount = $challagne->amount;
                    $transactionLost->transaction_type = 'lost_battel';
                    $transactionLost->addition_status = 'approve';
                    $transactionLost->title	 = "Lost Against $getUserDataName";
                    
                    $transactionLost->transactions_id =  Helper::generateTransactionID();
                    $transactionLost->status = 'success';
                    $transactionLost->type = 'debit';
                    $transactionLost->closing_balance = ($lostUserData->wallet ?? 0) + ($lostUserData->deposit_amount ?? 0);
                    $transactionLost->user_id = $lostUserData->id;
                    $transactionLost->save();
        
        
                    $ReferUsers = ReferUsers::where('user_id',$transaction->user_id)->first();                       
                    if(!empty($ReferUsers) && !empty($ReferUsers->refer_by)){
                        $refer = SiteSetting::where('name','refer_amount')->pluck('value')->first();
                        if(!$refer){
                            $refer = 2;  
                        }
                        $referAmount = ($challagne->amount*$refer)/100;
                        $referUser = User::where('id',$ReferUsers->refer_by)->first();
                        if(!empty($referUser)){
                            $referUser->increment('wallet',$referAmount);
                            $transaction2 = new Transaction;
                            $transaction2->amount = $referAmount;
                            $transaction2->transaction_type = 'earn_refer';
                            $transaction2->addition_status = 'approve';
                            $transaction2->title	 = 'Earn by refer';
                            $transaction2->user_id = $referUser->id;
                            $transaction2->status = 'success';
                            $transaction2->type	 = 'credit';
                            $transaction2->transactions_id =  Helper::generateTransactionID();
                            $transaction2->save();
                            
                        }
                    }
                    return redirect()->back()->with('message', 'Winner mark Successfully');
                    }
                    return redirect()->back()->with('message', 'Something went wrong');
            }else{
                return redirect()->back()->with('msg', 'Trans. failed try again in 30 seconds');
            }
            return redirect()->back()->with('message', 'Something went wrong');

            // DB::commit();
            
        } catch (Exception $e) {
            // DB::rollback();
            return redirect()->back()->with('message', 'Something went wrong');
        }
    }
}