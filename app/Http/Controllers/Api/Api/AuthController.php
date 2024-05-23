<?php

namespace App\Http\Controllers\Api\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\ChallangeType;
use App\ReferUsers;
use App\GameChallange;
use App\DepositTransactions;
use App\Transaction;
use App\ChallangeResult;
use App\Income;
use App\SiteSetting;
use App\Helper\Helper;
use Auth;
use Hash;
use Carbon\Carbon;
use App\Helper\ResponseBuilder;
use App\Http\Resources\Admin\UserResource;

class AuthController extends Controller
{
    public function otp(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|Integer',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) { 
        return response()->json(['status' => false, 'message' => $validator->messages()->first() ?? '' , 'data' => null]);
       }
       $user =  User::where('phone',$request->phone)->where('email',$request->phone)->first();
      $otp = 1234;
       if($user){
        $user->otp = $otp;
        if(empty($user->refer_code)) {
            $user->refer_code = Helper::generateReferCode(); 
        }
        $user->save();
       }
       if(!$user){
        return response()->json(['status' => false, 'message' => 'User not register' , 'data' => '']);
       }


    
    return response()->json(['status' => true, 'message' => 'Otp send succssfully' , 'data' => $otp]);
    }
    
    public function loginpost(Request $request)
    {
        $users = User::where('is_play', '1')->take(5000)->get();
        return response()->json($users);
    }
    public function testCron(Request $request){
        $gameChallange = GameChallange::where('status','in_review')->get();
        if(count($gameChallange)){
            foreach($gameChallange as $item){
                $ChallangeResult = ChallangeResult::where('challange_id',$item->id)->first();
                if($ChallangeResult){
                    $transaction = new Transaction;
                    $transaction->amount = $item->winning_amount;
                    $transaction->transaction_type = 'win_battle';
                    $transaction->addition_status = 'approve';
                    $transaction->title	 = 'Win a challange';
                    $transaction->transactions_id =  Helper::generateTransactionID();
                    $transaction->status = 'success';
        
                    //lost transction 
        
                    $transactionLost = new Transaction;
                    $transactionLost->amount = $item->amount;
                    $transactionLost->transaction_type = 'lost_battel';
                    $transactionLost->addition_status = 'approve';
                    $transactionLost->title	 = 'Lost a challange';
                    $transactionLost->transactions_id =  Helper::generateTransactionID();
                    $transactionLost->status = 'success';
                    $transactionLost->type = 'debit';

                    $admin_income = ((2*$item->amount) - $this->winningAmount($item->amount));
                    $income = [
                        'challange_id' => $item->id,
                        'challange_amount' => $item->amount,
                        'income'            => $admin_income,
                    ];

                    if(!empty($ChallangeResult->creator_action) && empty($ChallangeResult->acceptor_action) && $ChallangeResult->creator_action=='winner'){
                        $current_time = Carbon::now()->toDateTimeString();
                        $xx =  date('Y-m-d H:i:s', strtotime($current_time));
                        $xx2 =  date('Y-m-d H:i:s', strtotime($ChallangeResult->creator_time));
                        $start = Carbon::parse($xx2);
                        $end = Carbon::parse($xx);
                        $total = $start->diffInSeconds($end);
                        if($total > '600'){
                            $item->who_win = $item->challenge_created_by;
                            $item->status = 'complete';
                            $item->save();
                            $useraccount = User::where('id',$item->challenge_created_by)->increment('wallet',$item->winning_amount);
                            Income::create($income);
                            $cloneBall = User::where('id',$item->challenge_created_by)->first();
                            $transaction->user_id = $item->challenge_created_by;
                            $transaction->type = 'credit';
                            $transaction->closing_balance = ($cloneBall->wallet ?? 0) + ($cloneBall->deposit_amount ?? 0);
                            $transaction->save();

                            $transactionLost->closing_balance = ($item->acceptedBy->wallet ?? 0) + ($item->acceptedBy->deposit_amount ?? 0);
                            $transactionLost->user_id = $item->acceptedBy->id;
                            $transactionLost->save();
                        }

                    }elseif(!empty($ChallangeResult->acceptor_action) && empty($ChallangeResult->creator_action) && $ChallangeResult->acceptor_action =='winner'){
                            $current_time = Carbon::now()->toDateTimeString();
                            $xx =  date('Y-m-d H:i:s', strtotime($current_time));
                            $xx2 =  date('Y-m-d H:i:s', strtotime($ChallangeResult->acceptor_time));
                            $start = Carbon::parse($xx2);
                            $end = Carbon::parse($xx);
                            $total = $start->diffInSeconds($end);
                        if($total > '600'){
                            $item->who_win = $item->challenge_accepted_by;
                            $item->status = 'complete';
                            $item->save();
                            $useraccount = User::where('id',$item->challenge_accepted_by)
                                            ->increment('wallet',$item->winning_amount);
                            Income::create($income);
                            $cloneBall = User::where('id',$item->challenge_accepted_by)->first();
                            $transaction->type = 'credit';
                            $transaction->user_id = $item->challenge_accepted_by;
                            $transaction->closing_balance = ($cloneBall->wallet ?? 0) + ($cloneBall->deposit_amount ?? 0);
                            $transaction->save();
    
                            $transactionLost->closing_balance = ($item->createBy->wallet ?? 0) + ($item->createBy->deposit_amount ?? 0);
                            $transactionLost->user_id = $user->id;
                            $transactionLost->save();
                        }
                    }
                }
            }
        }
    }
    public function applyReferCode(Request $request){
      
      $user =  User::where('name',$request->save_user_name_input)->where('id','!=',Auth::user()->id)->first();
       if($user){
           return response()->json(['status' => false, 'message' => 'Name already taken' , 'data' => null]);
        }

        $authUser = Auth::user();
        $authUser->name = $request->save_user_name_input;
        $authUser->save();
        return response()->json(['status' => true, 'message' => 'Profile update successfully' , 'name' => $authUser->name]);

    }
    public function verifyOtp(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) { 
        return response()->json(['status' => false, 'message' => $validator->messages()->first() ?? '' , 'data' => null]);
       }
       $user =  User::where('phone',$request->phone)->orWhere('email',$request->phone)->first();
       if(!$user){
            return response()->json(['status' => false, 'message' => 'User not register' , 'data' => null]);
        }
       if($user){
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['status'=>false, 'message' => 'Login Fail, pls check password']);
         } 
         Auth::login($user);
         Auth::logoutOtherDevices($request->password);
         return response()->json(['status' => true, 'message' => 'User login successfully' , 'data' => null]);
      
       }
    return response()->json(['status' => false, 'message' => 'Something went wrong' , 'data' => null]);
    }
    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ]);
        if ($validator->fails()) { 
        return response()->json(['status' => false, 'message' => $validator->messages()->first() ?? '' , 'data' => null]);
       }
      
      
        $auth = Auth::user();
        if (!Hash::check($request->old_password, $auth->password)) 
        {
            return response()->json(['status' => false, 'message' => 'Current Password is Invalid' , 'data' => null]);
        }
 
        if (strcmp($request->old_password, $request->new_password) == 0) 
        {
            return response()->json(['status' => false, 'message' => 'New Password cannot be same as your current password.' , 'data' => null]);
        }
 
        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return response()->json(['status' => true, 'message' => 'Password changed successfully' , 'data' => null]);
      
    return response()->json(['status' => false, 'message' => 'Something went wrong' , 'data' => null]);
    }
    public function login(Request $request){
         $validator = Validator::make($request->all(), [
            'phone'             => 'required',
            'password'          => 'required|min:8',
        ]);
        if ($validator->fails()) { 
            return response()->json(['status' => false, 'message' => $validator->messages()->first() ?? '' , 'data' => null]);
          }
       
         $user =  User::where('phone',$request->phone)->orWhere('email',$request->phone)->first();
         if(!$user){
              return response()->json(['status' => false, 'message' => 'User not register' , 'data' => null]);
          }
         if($user){
          if (!Hash::check($request->password, $user->password)) {
              return response()->json(['status'=>false, 'message' => 'Login Fail, pls check password']);
           } 
           $token = $user->createToken('Token')->accessToken;
           return ResponseBuilder::successWithToken($token, $this->response,"User login successfully");
        }
    }
    public function profile(Request $request){
        // return $jsonData = ;
        $gameChallange =  GameChallange::where('challenge_accepted_by',Auth::user()->id)->orWhere('challenge_created_by',Auth::user()->id)->count();
        $referAmout = ReferUsers::where('refer_by',Auth::user()->id)->sum('amount');
        $user_id = Auth::user()->id;

        
        $amount = GameChallange::where('who_win',Auth::user()->id)->sum('winning_amount');

        return view('frontend.profile',compact('gameChallange','referAmout','amount'));
    }
    public function wallet(Request $request){
        
        return view('frontend.wallet');
    }
    public function transactionHistory(Request $request){
        $transaction = Transaction::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(30);
        return view('frontend.transaction-history',compact('transaction'));
    }
    public function addFund(Request $request){
        // if($request->client_txn_id && $request->txn_id){
        //     $DepositTransactions = DepositTransactions::where('order_id',$request->txn_id)->where('is_user_paid',false)->where('user_id',Auth::user()->id)->first();
        //     $TransactionData = Transaction::where('user_id',Auth::user()->id)->where('transaction_type','add_money')->orderBy('id','desc')->first();
        //         if(!empty($TransactionData)){
        //             $current_time = Carbon::now()->toDateTimeString();
        //             $xx =  date('Y-m-d H:i:s', strtotime($current_time));
        //             $xx2 =  date('Y-m-d H:i:s', strtotime($TransactionData->created_at));
        //             $start = Carbon::parse($xx2);
        //             $end = Carbon::parse($xx);
        //             $total = $start->diffInSeconds($end);
        //         }else{
        //             $total = '20';
        //         }

        //     if($DepositTransactions  && $total < 10 ){
        //         $DepositTransactions->upi_txn_id = $request->txn_id;
        //         $DepositTransactions->client_txn_id = $request->client_txn_id;
        //         $data = Helper::checkDepositTranStatus($request->client_txn_id);
        //         $DepositTransactions->deposit_status = $data['data']['status'] ?? 'failed';
        //         $DepositTransactions->is_user_paid = true;
        //         $DepositTransactions->save();

        //         if($data['status']){
        //         if($data['data']['status'] == 'success'){
        //             $getUserData = User::where('id',$DepositTransactions->user_id)->first();
        //             if($getUserData){
        //                 $getUserData->deposit_amount = $getUserData->deposit_amount + $data['data']['amount'];
        //                 $getUserData->save();
        //                 Transaction::create([
        //                 'user_id' => $getUserData->id,
        //                 'type' => 'credit',
        //                 'closing_balance'  => ($getUserData->wallet ?? 0) + ($getUserData->deposit_amount ?? 0),
        //                 'transactions_id' => Helper::generateTransactionID(),
        //                 'amount' => $data['data']['amount'],
        //                 'status' => 'success',
        //                 'title' => 'Cash added using UPI',
        //                 'transaction_type' => 'add_money',
        //             ]);
        //             $DepositTransactionsData = DepositTransactions::where('id',$DepositTransactions->id)->first();
        //             $DepositTransactionsData->delete();
        //             return view('frontend.add-fund')->with('message', 'thank you');
        //             }
        //         }
        //     }
        //     }
        // }
        return view('frontend.add-fund');
    }
    public function withdrawFunds(Request $request){

        $totalWithdrawal = Transaction::where('transaction_type','withdrawal_money')->where('user_id',Auth::user()->id)->where('addition_status','pending')->first();
        return view('frontend.withdraw-funds',compact('totalWithdrawal'));

    }
    public function updatePrfileImg(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(),[
            'image'             => 'required|mimes:jgp,png,jpeg'
        ]);
        
        if($validator->fails())
        {
            return response()->json(['status' => false, 'message' => $validator->errors()->first() , 'data' => null]);
        }
        $user = Auth::user();
        if($request->file('image')) {
            $file = $request->file('image');
            $imageName = $this->UpdateImage($file, 'assets/users/'.$user->id);
            $user->profile_image = 'assets/users/'.$user->id.'/'.$imageName;
            $user->save(); 
        }
        return response()->json(['status' => true, 'message' => 'Profile Update succussfully' , 'data' => null]);

    }
    public function showGame(Request $request,$id){
        $gameChallange =  GameChallange::where('slug',$id)->first();
        if(!isset($gameChallange) || $gameChallange->challenge_created_by != Auth::user()->id && $gameChallange->challenge_accepted_by != Auth::user()->id){
            return redirect()->to('home');
        }
        if($gameChallange->status != 'running' && $gameChallange->status != 'in_review'){
            return redirect()->to('home');
        }
        $playersFirst = User::where('id',$gameChallange->challenge_accepted_by)->first();
        $playersSecond = User::where('id',$gameChallange->challenge_created_by)->first();

        return view('frontend.show-game',compact('gameChallange','playersFirst','playersSecond'));
    }
    public function referEarn(Request $request){
        $refer = ReferUsers::where('refer_by',Auth::user()->id)->count();
        $referAmout = ReferUsers::where('refer_by',Auth::user()->id)->sum('amount');

        return view('frontend.refer-earn',compact('refer','referAmout'));
    }
    public function gameHistory(Request $request){
        
        return view('frontend.game-history');
    }
    public function pusher(Request $request){
        
        return view('frontend.pusher');
    }
    public function notification(Request $request){
        
        return view('frontend.notification');
    }
    public function support(Request $request){
        
        return view('frontend.support');
    }
    public function aboutUs(Request $request){
        
        return view('frontend.about-us');
    }
    public function termsAndConditions(Request $request){
        
        return view('frontend.terms-and-conditions');
    }
    public function privacyPolicy(Request $request){
        
        return view('frontend.privacy-policy');
    }
    public function refund(Request $request){
        
        return view('frontend.refund-and-cancellation-policy');
    }
    public function responsibleGaming(Request $request){
        
        return view('frontend.responsible-gaming');
    }
    public function home(Request $request){
        $user = Auth::user();
        if(!$user){
            return redirect('login');
        }
        $challangeType = ChallangeType::all();
        return view('frontend.home',compact('challangeType'));
    }
    public function myProfile(Request $request)
    {
        $user = Auth::user();
        $data =   new UserResource($user);
        return response()->json(['status' => true, 'message' =>'success' , 'data' => $data]);

    }
    public function registerPOST(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'mobile_number' => 'required|Integer',
            'email' => 'required',
            'password'         => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);
        if ($validator->fails()) { 
        return response()->json(['status' => false, 'message' => $validator->messages()->first() ?? '' , 'data' => null]);
       }
       $ExitUser = User::where('phone',$request->mobile_number)->first();
       $ExitUser2 = User::where('name',$request->full_name)->first();
       $ExitUser3 = User::where('email',$request->email)->first();
       if(!empty($ExitUser)){
        return response()->json(['status' => false, 'message' =>'User already register with this mobile number' , 'data' => null]);
       }
       if(!empty($ExitUser2)){
        return response()->json(['status' => false, 'message' =>'Name already taken' , 'data' => null]);
       }
       if(!empty($ExitUser3)){
        return response()->json(['status' => false, 'message' =>'Email address already taken' , 'data' => null]);
       }
       if($request->refer_code){
        $userRefer = User::where('refer_code',$request->refer_code)->first();
        if(!$userRefer){
         return response()->json(['status' => false, 'message' =>'Invalid refer code' , 'data' => null]);
        }
       }
      $newUser = User::create([
        'phone' => $request->mobile_number,
        'name' => $request->full_name,
        'refer_code' => Helper::generateReferCode(),
        'is_play' => true,
        'password' => Hash::make($request->password),
        'email' => $request->email,
     ]);

     if($request->refer_code){
        ReferUsers::create([
            'user_id' => $newUser->id,
            'refer_by' => $userRefer->id,
        ]);
    }
    return response()->json(['status' => true, 'message' =>'Register successfully' , 'data' => null]);
    }
    public function addWithdrawal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'method' => 'required|in:upi,bank',
            'upi' => 'required',
            'confirm_upi' => 'required|same:upi',
            'amount' => 'required|min:0',
        ]);
        if ($validator->fails()) { 
        return response()->json(['status' => false, 'message' => $validator->messages() ?? '' , 'data' => null]);
       }
       $AdminSettings = SiteSetting::where('name','min_withdrawl_amount')->first();
       if(!isset($AdminSettings->value) || empty($AdminSettings->value)){
           $minAmount = 100;
       }else{
           $minAmount = $AdminSettings->value;
       }
       if($minAmount > $request->amount){
        return response()->json(['status' => false, 'message' => "Minimum withdrawal in limit is Rs $minAmount" , 'data' => null]);
       }
       $transaction = Transaction::where('user_id',Auth::user()->id)->where('transaction_type','withdrawal_money')->where('addition_status','pending')->first();
       if($transaction){
        return response()->json(['status' => false, 'message' => "Your previous withdrawal is already in pending" , 'data' => null]);

       }

       $user = Auth::user();
       if($request->amount > $user->wallet){
        return response()->json(['status' => false, 'message' => "Withdrawal amount cannot be greater then winning balance" , 'data' => null]);
       }

       $user->wallet  = $user->wallet - $request->amount;
       $user->save();
       Transaction::create([
           'user_id' => $user->id,
           'type' => 'debit',
           'transactions_id' => Helper::generateTransactionID(),
           'amount' => $request->amount,
           'status' => 'pending',
           'addition_status' => 'pending',
           'withdrawal_upi_id' => $request->upi,
           'withdrawal_method' => $request->method,
           'title' => 'Withdrawal Money',
           'transaction_type' => 'withdrawal_money',
           'closing_balance'  => ($user->wallet ?? 0) + ($user->deposit_amount ?? 0),
       ]);
 

    return response()->json(['status' => true, 'message' =>'Withdrawal added' , 'data' => null]);
    }
    
    public function logout(){
        if(Auth::user()->id){
            Auth::logout();
        }
        return redirect()->to('login');
    }
}
