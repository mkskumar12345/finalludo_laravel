<?php
   
namespace App\Console\Commands;
   
use Illuminate\Console\Command;
use App\Models\TimeEntry;
use Carbon\Carbon;
use DateTime;
use App\DepositTransactions;
use App\Transaction;
use App\User;
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
        \Log::info('Omi');
       
       
            $DepositTransactions = DepositTransactions::where('is_user_paid',false)->get();

            if(count($DepositTransactions) > 0){

            foreach($DepositTransactions as $item){
                $data = Helper::checkDepositTranStatus($item->upi_txn_id);
                $item->deposit_status = $data['data']['status'] ?? 'failed';
                $item->save();
                if($data['status']){
                if($data['data']['status'] == 'success'){
                    $getUserData = User::where('id',$item->user_id)->first();
                    if($getUserData){
                       $getUserData->deposit_amount = $getUserData->deposit_amount + $data['data']['amount'];
                       $getUserData->save();
                       $item->is_user_paid = true;
                       $item->save();
                       Transaction::create([
                        'user_id' => $getUserData->id,
                        'type' => 'credit',
                        'transactions_id' => Helper::generateTransactionID(),
                        'amount' => $data['data']['amount'],
                        'status' => 'success',
                        'title' => 'Cash added using UPI',
                        'transaction_type' => 'add_money',
                        'closing_balance' => $getUserData->deposit_amount ?? null,
                    ]);
                    }
                }
            }
        }

            }
            echo 'Om9';
    }
}