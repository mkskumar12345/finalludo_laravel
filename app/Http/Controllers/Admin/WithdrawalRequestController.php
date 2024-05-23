<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use App\Helper\Helper;
use Illuminate\Http\Request;
use DB;

class WithdrawalRequestController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        $d['title'] = 'Withdrawal Request List';
        $d['data']  = Transaction::join('users','users.id','transactions.user_id')->where('transactions.transaction_type','withdrawal_money')
            ->orderBy('id','desc')
            ->select('users.name as user_name','transactions.*');
            if($request->user){
                $d['data']->where('transactions.user_id',$request->user);
            }
            $d['data'] =  $d['data']->paginate(10);
        $d['users'] = User::all();    
        return view('admin.withdrawalRequest.index',$d);
    }

    public function store(Request $request)
    {
        // code...
        // return $request;
        try {
            DB::beginTransaction();

            $tranction = Transaction::where('id',$request->id)->first();
            $tranction->addition_status = $request->astatus;
            $tranction->status = 'success';
            $tranction->save();
            if($request->astatus == 'reject')
            {
                User::where('id',$tranction->user_id)->increment('wallet',$tranction->amount);
                $user = User::where('id',$tranction->user_id)->first();

                Transaction::create([
                    'user_id' => $tranction->user_id,
                    'type' => 'credit',
                    'transactions_id' => Helper::generateTransactionID(),
                    'amount' => $tranction->amount,
                    'status' => 'success',
                    'addition_status' => 'success',
                    'title' => 'Withdrawal decline refund',
                    'transaction_type' => 'withdraw_refund',
                    'closing_balance'  => ($user->wallet ?? 0) + ($user->deposit_amount ?? 0),
                ]);
            }

            DB::commit();
            $msg = 'Amount '.$request->astatus.' successfully';
            return redirect()->route('admin.wihdrawal-request.index')->with('msg',$msg);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.wihdrawal-request.index')->with('msg',$e->getMessage());
        }
    }

    public function destroy($id)
    {
        # code...
        $tranction = Transaction::where('id',$id)->delete();
        return redirect()->route('admin.wihdrawal-request.index')->with('msg','Delete successfully');
    }
}
