<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use View;
use App\SiteSetting;
use App\UserPermisssions;
use App\ChallangeType;
use App\Transaction;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();
        View::composer('*', function($view){
              $minDeposit = SiteSetting::where('name','min_deposit_amount')->first();
              $maxDeposit = SiteSetting::where('name','max_deposit_amount')->first();
              $refer_amount = SiteSetting::where('name','refer_amount')->first();
              $service_fee = SiteSetting::where('name','service_fee')->first();
              $logo = SiteSetting::where('name','logo')->first();
          
              $telegram = SiteSetting::where('name','telegram')->first();
              $whataApp = SiteSetting::where('name','whataApp')->first();
              $support_email = SiteSetting::where('name','support_email')->first();
              $settingData = SiteSetting::pluck('value','name')->toArray();
              $ChallangeType = ChallangeType::all();
              if(!$minDeposit){
                $minDeposit = 10;
              }else{
                $minDeposit = $minDeposit->value;
              }
             if(!$telegram){
                $telegram = 10;
              }else{
                $telegram = $telegram->value;
              }
             if(!$whataApp){
                $whataApp = 10;
              }else{
                $whataApp = $whataApp->value;
              }
              if(!$support_email){
                $support_email = 10;
              }else{
                $support_email = $support_email->value;
              }
              if(!$maxDeposit){
                $maxDeposit = 10000;
              }else{
                $maxDeposit = $maxDeposit->value;
              }
              if(!$refer_amount){
                $refer_amount = 2;
              }else{
                $refer_amount = $refer_amount->value;
              }
              if(!$service_fee){
                $service_fee = 1;
              }else{
                $service_fee = $service_fee->value;
              }
              if(!$logo){
                $logo = '';
              }else{
                $logo = $logo->value;
              }
              $permission = [];
              if(isset(Auth::user()->id)){
                $permission = UserPermisssions::where('user_id',Auth::user()->id)->pluck('permission')->toArray();
              }
              $TransactionData = Transaction::where('transaction_type','withdrawal_money')->where('addition_status','pending')->get();
               $view->with(['ChallangeType' => $ChallangeType,'settingData' => $settingData,'telegram'=> $telegram,'whataApp' => $whataApp,'support_email'=>$support_email,'minDeposit' => $minDeposit , 'maxDeposit' => $maxDeposit , 'refer_amount' => $refer_amount, 'service_fee' => $service_fee,'permission' => $permission , 'TransactionData' => $TransactionData , 'logo' => $logo]);
            
           });

    }
}
