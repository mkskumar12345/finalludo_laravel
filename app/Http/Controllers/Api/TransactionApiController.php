<?php

namespace App\Http\Controllers\Api;

use App\GameChallange;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\TransactionCollection;
use App\Helper\ResponseBuilder;
use App\User;
use App\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use DB;

class TransactionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addMoney(Request $request)
    {
        // code...
        if(!Auth::guard('api')->check()){
            return ResponseBuilder::error("User not found", $this->unauthorized);
        }
        $user_id = Auth::guard('api')->user()->id;
        $validator = Validator::make($request->all(), [
            'amount'            => 'required|numeric|min:10',
            'transactions_id'   => 'required',
            'screen_shot'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status'            => 'required',
            // 'transaction_type'  => 'required',
            'payment_gatway'    => 'required',
        ]);
       
        if ($validator->fails()) {
            return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
        }

         try {
            DB::beginTransaction();
             $transaction = new Transaction();
             $transaction->user_id  = $user_id;
             $transaction->amount  = $request->amount;
             $transaction->transactions_id  = $request->transactions_id;
             if($request->has('screen_shot'))
             {
                $transaction->screen_shot  = $this->transactionScreenShort($request->screen_shot);
             }
             $transaction->status  = $request->status;
             $transaction->addition_status = 'pending';
             $transaction->transaction_type  = 'add_money';
             $transaction->payment_gatway  = $request->payment_gatway;
             $transaction->save();
          
             DB::commit();
             return ResponseBuilder::successMessage('Transaction data saved successfully',$this->success);
         } catch (Exception $e) {
            DB::rollBack();
             return ResponseBuilder::error($e->getMessage(), $this->serverError);
         }

    }

    public function transactionHistory($type)
    {
        // code...
        try {
            if(!Auth::guard('api')->check())
            {
                return ResponseBuilder::error("User not authorized", $this->unauthorized);
            }

            $user_id = Auth::guard('api')->user()->id;
            $transaction = Transaction::join('users','users.id','transactions.user_id')
                            // ->where('transactions.transaction_type',$type)
                            ->where('transactions.user_id',$user_id)
                            ->orderBY('transactions.created_at','desc')
                            ->select('transactions.*','users.name as user_name')
                            ->get();
            if(empty($transaction))
            {
                return ResponseBuilder::successMessage('No data found', $this->success);
            }
            $this->response = new TransactionCollection($transaction);
            return ResponseBuilder::success($this->response,"All transactions history");
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseBuilder::error($th->getMessage(), $this->serverError);
        }
    }

    public function withdrawalMoney(Request $request)
    {
        // code...
        if(!Auth::guard('api')->check()){
            return ResponseBuilder::error("User not found", $this->unauthorized);
        }
        $user_id = Auth::guard('api')->user()->id;
        $validator = Validator::make($request->all(), [
            'amount'            => 'required|numeric|min:10',
            'number'            => 'required',
        ]);
       
        if ($validator->fails()) {
            return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
        }

        $userwallet = $this->userInfo($user_id);
        if($request->amount>$userwallet->wallet)
        return ResponseBuilder::error('No enough money',$this->badRequest);

        User::where('id',$user_id)->decrement('wallet',$request->amount);

         try {
             $transaction = new Transaction();
             $transaction->user_id  = $user_id;
             $transaction->amount  = $request->amount;
             $transaction->transaction_type  = 'withdrawal_money';
             $transaction->payment_gatway  = $request->upi_app;
             $transaction->addition_status  = 'pending';
             $transaction->number  =  $request->number;
             $transaction->save();

             return ResponseBuilder::successMessage('Withdrawal data saved successfully',$this->success);
         } catch (Exception $e) {
             return ResponseBuilder::error($e->getMessage(), $this->serverError);
         }

    }

    public function withdrawalHistory()
    {
        // code...
        if(!Auth::guard('api')->check()){
            return ResponseBuilder::error("User not found", $this->unauthorized);
        }
        $user_id = Auth::guard('api')->user()->id;
        try {
            $withdrawal = Transaction::where('user_id',$user_id)->where('transaction_type','withdrawal_money')->orderBy('id','desc')->get();
            if(empty($withdrawal))
            return ResponseBuilder::error('no data found', $badRequest);

            $data = $withdrawal->map(function($value, $key){
                return [
                    'id'        => $value->id,
                    'amount'   => $value->amount,
                    'status'   => $value->addition_status,
                    'number'   => $value->number,
                    'upi_app'  => $value->payment_gatway,
                    'date'  => Carbon::parse($value->created_at)->format('d M,Y'),
                ];
            });
            return ResponseBuilder::success($data, 'Withdrawal History');
            
        } catch (Exception $e) {
            
        }
    }
}