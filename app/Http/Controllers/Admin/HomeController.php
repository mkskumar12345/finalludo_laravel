<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\GameChallange;
use App\Income;
use App\Transaction;
use App\DepositTransactions;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class HomeController
{
    public function login(){
        return view('auth.login');
    }
    public function index()
    {

        $startDate = Carbon::createFromFormat('Y-m-d',  date('Y-m-1'));
        $endDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $dateRange = CarbonPeriod::create($startDate, $endDate);
       
        $arrayPositionCount = [];
        $arrayPositionCountDate = [];
       foreach ($dateRange as $date) {
             
         $data = Income::whereDate('created_at',date('Y-m-d',strtotime($date)))->sum('income');
         $arrayPositionCountDate[] = date('M d',strtotime($date));
         $arrayPositionCount[] = $data ?? '0';
       }
    //    return $arrayPositionCount

        $d['users'] = User::select(DB::raw('SUM(wallet) as total_wallet'), DB::raw('COUNT(*) as total_users'))->first();
        $d['incomes'] = Income::sum('income');
        $d['arrayPositionCountDate'] = $arrayPositionCountDate;
        $d['arrayPositionCount'] = $arrayPositionCount ;
        $d['todayIncome'] = Income::whereDate('created_at', Carbon::today())->sum('income');


        $d['totalRefer'] = Transaction::where('transaction_type','earn_refer')->sum('amount');
        $d['todayRefer'] = Transaction::whereDate('created_at', Carbon::today())->where('transaction_type','earn_refer')->sum('amount');

        $d['userDeposit'] = User::select(DB::raw('SUM(deposit_amount) as deposit_amount'))->first();
        $d['userDeposit'] = $d['userDeposit']->deposit_amount;
        $d['userWallat'] = $d['users']->total_wallet;
        
        $d['todayAddFund'] = DepositTransactions::where('status','SUCCESS')->whereDate('created_at', Carbon::today())->sum('amount');
        $d['todayAddFundAdmin'] = DepositTransactions::where('status','SUCCESS')->whereDate('created_at', Carbon::today())->sum('amount');
        $d['todayAddFundPG'] = DepositTransactions::where('status','SUCCESS')->whereDate('created_at', Carbon::today())->sum('amount');

        $d['totalAddFund'] = DepositTransactions::where('status','SUCCESS')->sum('amount');
        $d['totalAddFundAdmin'] = DepositTransactions::where('status','SUCCESS')->sum('amount');
        $d['totalAddFundPG'] = DepositTransactions::where('status','SUCCESS')->sum('amount');


        $d['todayWithdrawal'] = Transaction::where('transaction_type','withdrawal_money')->whereDate('created_at', Carbon::today())->where('status','SUCCESS')->sum('amount');
        $d['totalWithdrawal'] = Transaction::where('transaction_type','withdrawal_money')->where('status','SUCCESS')->sum('amount');

        $d['busers'] = User::where('status','block')->count();
        $d['total_tabel'] = GameChallange::whereDate('created_at', Carbon::today())->where('status','complete')->count();
        $d['open_challange'] = GameChallange::where('status','challange_created')->count();
        $d['with_request']  = Transaction::join('users','users.id','transactions.user_id')->where('transactions.transaction_type','withdrawal_money')
            ->orderBy('id','desc')
            ->select('users.name as user_name','transactions.*')->paginate(5);
        $d['opens'] = GameChallange::join('users','users.id','game_challenge.challenge_created_by')
                        ->where('game_challenge.status','challange_created')
                        ->orderBy('game_challenge.id','desc')
                        ->select('users.name','game_challenge.*')->paginate(5);
        $d['Complete'] = GameChallange::join('users as uc','uc.id','game_challenge.challenge_created_by')
                        ->leftjoin('users as ua','ua.id','game_challenge.challenge_accepted_by')
                        ->leftjoin('users as winner','winner.id','game_challenge.who_win')
                        ->where('game_challenge.status','complete')
                        ->orderBy('game_challenge.id','desc')
                        ->select('ua.name as a_name','uc.name as c_name','game_challenge.*', 'winner.name as winner_name')->paginate(5);
        $d['running'] = GameChallange::join('users as uc','uc.id','game_challenge.challenge_created_by')
                        ->join('users as ua','ua.id','game_challenge.challenge_accepted_by')
                        ->where('game_challenge.status','running')
                        ->orderBy('game_challenge.id','desc')
                        ->select('ua.name as a_name','uc.name as c_name','game_challenge.*')->paginate(5);

                        // return 'df';
        return view('home',$d);
    }
}
