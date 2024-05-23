<?php
   
namespace App\Console\Commands;
   
use Illuminate\Console\Command;
use App\Models\TimeEntry;
use Carbon\Carbon;
use DateTime;
use App\DepositTransactions;
use App\Transaction;
use App\GameChallange;
use App\User;
use App\Income;
use App\ChallangeResult;
use App\Helper\Helper;

class TimingCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TimingCron:cron';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()

    {
        $dt = new DateTime();
        $laravelCronTime= $dt->format('H:i:s');
        $laravelCronTimeDay= $dt->format('Y-m-d H:i:s');
       
       
//             $DepositTransactions = DepositTransactions::where('is_user_paid',false)->get();

//             if(count($DepositTransactions) > 0){

//             foreach($DepositTransactions as $item){
//                 $data = Helper::checkDepositTranStatus($item->client_txn_id);
//                 $item->deposit_status = $data['data']['status'] ?? 'failed';
//                 $item->save();
//                 if($data['status']){
//                 if($data['data']['status'] == 'success' && !empty($data['data']['upi_txn_id'])){
//                     $getUserData = User::where('id',$item->user_id)->first();
//                     if($getUserData){
//                       $getUserData->deposit_amount = $getUserData->deposit_amount + $data['data']['amount'];
//                       $getUserData->save();
//                       $item->is_user_paid = true;
//                       $item->save();
//                       Transaction::create([
//                         'user_id' => $getUserData->id,
//                         'type' => 'credit',
//                         'transactions_id' => Helper::generateTransactionID(),
//                         'amount' => $data['data']['amount'],
//                         'status' => 'success',
//                         'title' => 'Cash added using UPI',
//                         'transaction_type' => 'add_money',
//                         'type' => 'credit',
//                         'closing_balance'  => ($getUserData->wallet ?? 0) + ($getUserData->deposit_amount ?? 0),
//                     ]);
//                     $deleteData = DepositTransactions::where('id',$item->id)->first();
//                     if(!empty($deleteData)){
//                         $deleteData->delete();
//                     }
//                     }
//                 }
//             }
            
            
//         }
// echo 'success';
//             }
            //Payment transafer done
            
            // $gameChallange = GameChallange::where('status','in_review')->get();
            // if(count($gameChallange)){
            //     foreach($gameChallange as $item){
            //         $ChallangeResult = ChallangeResult::where('challange_id',$item->id)->first();
            //         if($ChallangeResult){
            //             $transaction = new Transaction;
            //             $transaction->amount = $item->winning_amount;
            //             $transaction->transaction_type = 'win_battle';
            //             $transaction->addition_status = 'approve';
            //             $transaction->title	 = 'Win a challange';
            //             $transaction->transactions_id =  Helper::generateTransactionID();
            //             $transaction->status = 'success';
            
            //             //lost transction 
            
            //             $transactionLost = new Transaction;
            //             $transactionLost->amount = $item->amount;
            //             $transactionLost->transaction_type = 'lost_battel';
            //             $transactionLost->addition_status = 'approve';
            //             $transactionLost->title	 = 'Lost a challange';
            //             $transactionLost->transactions_id =  Helper::generateTransactionID();
            //             $transactionLost->status = 'success';
            //             $transactionLost->type = 'debit';
    
            //             $admin_income = ((2*$item->amount) - Helper::winningAmount($item->amount));
            //             $income = [
            //                 'challange_id' => $item->id,
            //                 'challange_amount' => $item->amount,
            //                 'income'            => $admin_income,
            //             ];
    
            //             if(!empty($ChallangeResult->creator_action) && empty($ChallangeResult->acceptor_action) && $ChallangeResult->creator_action=='winner' && empty($ChallangeResult->cencal_creator) && empty($ChallangeResult->cencal_acceptor)){
            //                 $current_time = Carbon::now()->toDateTimeString();
            //                 $xx =  date('Y-m-d H:i:s', strtotime($current_time));
            //                 $xx2 =  date('Y-m-d H:i:s', strtotime($ChallangeResult->creator_time));
            //                 $start = Carbon::parse($xx2);
            //                 $end = Carbon::parse($xx);
            //                 $total = $start->diffInSeconds($end);
            //                 if($total > '600'){
            //                     $item->who_win = $item->challenge_created_by;
            //                     $item->status = 'complete';
            //                     $item->save();
            //                     $useraccount = User::where('id',$item->challenge_created_by)->increment('wallet',$item->winning_amount);
            //                     Income::create($income);
            //                     $cloneBall = User::where('id',$item->challenge_created_by)->first();
            //                     $transaction->user_id = $item->challenge_created_by;
            //                     $transaction->type = 'credit';
            //                     $transaction->closing_balance = ($cloneBall->wallet ?? 0) + ($cloneBall->deposit_amount ?? 0);
            //                     $transaction->save();
    
            //                     $transactionLost->closing_balance = ($item->acceptedBy->wallet ?? 0) + ($item->acceptedBy->deposit_amount ?? 0);
            //                     $transactionLost->user_id = $item->acceptedBy->id;
            //                     $transactionLost->save();
            //                 }
    
            //             }elseif(!empty($ChallangeResult->acceptor_action) && empty($ChallangeResult->creator_action) && $ChallangeResult->acceptor_action =='winner' && empty($ChallangeResult->cencal_acceptor) && empty($ChallangeResult->cencal_creator)){
            //                     $current_time = Carbon::now()->toDateTimeString();
            //                     $xx =  date('Y-m-d H:i:s', strtotime($current_time));
            //                     $xx2 =  date('Y-m-d H:i:s', strtotime($ChallangeResult->acceptor_time));
            //                     $start = Carbon::parse($xx2);
            //                     $end = Carbon::parse($xx);
            //                     $total = $start->diffInSeconds($end);
            //                 if($total > '600'){
            //                     $item->who_win = $item->challenge_accepted_by;
            //                     $item->status = 'complete';
            //                     $item->save();
            //                     $useraccount = User::where('id',$item->challenge_accepted_by)
            //                                     ->increment('wallet',$item->winning_amount);
            //                     Income::create($income);
            //                     $cloneBall = User::where('id',$item->challenge_accepted_by)->first();
            //                     $transaction->type = 'credit';
            //                     $transaction->user_id = $item->challenge_accepted_by;
            //                     $transaction->closing_balance = ($cloneBall->wallet ?? 0) + ($cloneBall->deposit_amount ?? 0);
            //                     $transaction->save();
        
            //                     $transactionLost->closing_balance = ($item->createBy->wallet ?? 0) + ($item->createBy->deposit_amount ?? 0);
            //                     $transactionLost->user_id = $user->id;
            //                     $transactionLost->save();
            //                 }
            //             }
            //         }
            //     }
            // }



    }
}