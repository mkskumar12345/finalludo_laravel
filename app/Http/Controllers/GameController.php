<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Auth;
use App\Helper\Helper;
class GameController extends Controller
{
   public function index($slug){
    return view('frontend.game',compact('slug'));
   }
   public function cancelWithdrawal($id){
      $transaction = Transaction::where('user_id',Auth::user()->id)->where('transaction_type','withdrawal_money')->where('id',$id)->where('addition_status','pending')->first();

      if(!$transaction){
       return  redirect()->back();
      }
      $transaction->addition_status = 'cancel';
      $transaction->save();
      
      $user = Auth::user(); 
      $user->wallet = $user->wallet + $transaction->amount;
      $user->save();

      Transaction::create([
         'user_id' => Auth::user()->id,
         'type' => 'credit',
         'closing_balance'  => (Auth::user()->wallet ?? 0) + (Auth::user()->deposit_amount ?? 0),
         'transactions_id' => Helper::generateTransactionID(),
         'amount' =>  $transaction->amount,
         'status' => 'success',
         'title' => 'Withdrawal request cancel',
         'transaction_type' => 'withdrawal_request_cancel',
     ]);
$transaction->delete();
       return  redirect()->back();
   }
}
