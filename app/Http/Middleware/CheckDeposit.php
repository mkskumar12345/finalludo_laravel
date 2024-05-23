<?php
   
namespace App\Http\Middleware;
  
use Closure;
use Illuminate\Http\Request;
use App\DepositTransactions;
use App\Helper\Helper;
use App\User;
use App\Transaction;
use Auth;
class CheckDeposit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try { 
        $DepositTransactions = DepositTransactions::where('is_user_paid',false)->where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
            // if(count($DepositTransactions) > 0){
                    // foreach($DepositTransactions as $DepositTransactions){
                        $data = Helper::checkDepositTranStatus($DepositTransactions->client_txn_id);
                        $DepositTransactions->deposit_status = $data['data']['status'] ?? 'failed';
                        $DepositTransactions->save();
                        if($data['status']){
                            if($data['data']['status'] == 'success' && !empty($data['data']['upi_txn_id'])){
                                $getUserData = User::where('id',$DepositTransactions->user_id)->first();
                                    if($getUserData){
                                        $getUserData->deposit_amount = $getUserData->deposit_amount + $data['data']['amount'];
                                        $getUserData->save();
                                        $DepositTransactions->is_user_paid = true;
                                        $DepositTransactions->save();
                                        Transaction::create([
                                            'user_id' => $getUserData->id,
                                            'type' => 'credit',
                                            'transactions_id' => Helper::generateTransactionID(),
                                            'amount' => $data['data']['amount'],
                                            'status' => 'success',
                                            'title' => 'Cash added using UPI',
                                            'transaction_type' => 'add_money',
                                            'type' => 'credit',
                                            'closing_balance'  => ($getUserData->wallet ?? 0) + ($getUserData->deposit_amount ?? 0),
                                        ]);
                                        $deleteData = DepositTransactions::where('id',$DepositTransactions->id)->first();
                                        if(!empty($deleteData)){
                                            $deleteData->delete();
                                            return $next($request);
                                        }
                                    }
                            }
                        }
                    
                
            // }
        } catch (\Throwable $th) {
            // return $th;
          return $next($request);
        }
        return $next($request);
    }
}