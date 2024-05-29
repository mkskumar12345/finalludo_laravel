<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\ChallangeType;
use App\ReferUsers;
use App\GameChallange;
use App\DepositTransactions;
use App\Transaction;
use App\ChallangeResult;
use App\Income;
use App\SiteSetting;
use App\KycDocument;
use App\Helper\Helper;
use App\Helper\ResponseBuilder;
use Auth;
use Hash;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:10', // Validate phone number format
        ]);

        $mobile = $request->phone;

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first() ?? '', 'data' => null]);
        }

        // Check if the user exists based on the provided phone number
        $user = User::where('phone', $mobile)->first();

        // Generate a random OTP
        $otp = mt_rand(100000, 999999); // Change the OTP generation method if needed

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not registerd', 'data' => null]);
            // If user doesn't exist, create a new user
            // $user = User::create([
            //     'phone' => $mobile,
            //     'is_play' => false,
            //     'refer_code' => Helper::generateReferCode(), // Assuming generateReferCode() is a valid method in Helper class
            // ]);
        }

        // Save the OTP to the user record
        $user->otp = $otp;
        $user->save();

        // Send OTP to user (implementation not shown here)

        $client = new Client();
        $url = 'https://www.fast2sms.com/dev/bulkV2';

        $headers = [
            'Authorization' => env('SMS_KEY',''),
            'Content-Type' => 'application/json',
        ];

        $body = [
            'route' => 'otp',
            'variables_values' => $otp,
            'numbers' => $mobile,
        ];

        try {
            $response = $client->post($url, [
                'headers' => $headers,
                'json' => $body,
            ]);

            // Handle response from the third-party API if needed
            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            // You can return the response or do further processing here
            return [
                'status' => true,
                'message' => 'OTP sent successfully'
                // 'statusCode' => $statusCode,
                // 'responseBody' => $responseBody
            ];
        } catch (\Exception $e) {
            // Handle exceptions, such as connection errors
            return [
                'status' => false,
                'message' => 'OTP not sent'
                // 'message' => $e->getMessage()
            ];
        }

        return response()->json(['status' => true, 'message' => 'OTP sent successfully', 'data' => null]);
    }
    public function testCron(Request $request)
    {
        $gameChallange = GameChallange::where('status', 'in_review')->get();
        if (count($gameChallange)) {
            foreach ($gameChallange as $item) {
                $ChallangeResult = ChallangeResult::where('challange_id', $item->id)->first();
                if ($ChallangeResult) {
                    $transaction = new Transaction;
                    $transaction->amount = $item->winning_amount;
                    $transaction->transaction_type = 'win_battle';
                    $transaction->addition_status = 'approve';
                    $transaction->title     = 'Win a challange';
                    $transaction->transactions_id =  Helper::generateTransactionID();
                    $transaction->status = 'success';

                    //lost transction 

                    $transactionLost = new Transaction;
                    $transactionLost->amount = $item->amount;
                    $transactionLost->transaction_type = 'lost_battel';
                    $transactionLost->addition_status = 'approve';
                    $transactionLost->title     = 'Lost a challange';
                    $transactionLost->transactions_id =  Helper::generateTransactionID();
                    $transactionLost->status = 'success';
                    $transactionLost->type = 'debit';

                    $admin_income = ((2 * $item->amount) - $this->winningAmount($item->amount));
                    $income = [
                        'challange_id' => $item->id,
                        'challange_amount' => $item->amount,
                        'income'            => $admin_income,
                    ];

                    if (!empty($ChallangeResult->creator_action) && empty($ChallangeResult->acceptor_action) && $ChallangeResult->creator_action == 'winner') {
                        $current_time = Carbon::now()->toDateTimeString();
                        $xx =  date('Y-m-d H:i:s', strtotime($current_time));
                        $xx2 =  date('Y-m-d H:i:s', strtotime($ChallangeResult->creator_time));
                        $start = Carbon::parse($xx2);
                        $end = Carbon::parse($xx);
                        $total = $start->diffInSeconds($end);
                        if ($total > '600') {
                            $item->who_win = $item->challenge_created_by;
                            $item->status = 'complete';
                            $item->save();
                            $useraccount = User::where('id', $item->challenge_created_by)->increment('wallet', $item->winning_amount);
                            Income::create($income);
                            $cloneBall = User::where('id', $item->challenge_created_by)->first();
                            $transaction->user_id = $item->challenge_created_by;
                            $transaction->type = 'credit';
                            $transaction->closing_balance = ($cloneBall->wallet ?? 0) + ($cloneBall->deposit_amount ?? 0);
                            $transaction->save();

                            $transactionLost->closing_balance = ($item->acceptedBy->wallet ?? 0) + ($item->acceptedBy->deposit_amount ?? 0);
                            $transactionLost->user_id = $item->acceptedBy->id;
                            $transactionLost->save();
                        }
                    } elseif (!empty($ChallangeResult->acceptor_action) && empty($ChallangeResult->creator_action) && $ChallangeResult->acceptor_action == 'winner') {
                        $current_time = Carbon::now()->toDateTimeString();
                        $xx =  date('Y-m-d H:i:s', strtotime($current_time));
                        $xx2 =  date('Y-m-d H:i:s', strtotime($ChallangeResult->acceptor_time));
                        $start = Carbon::parse($xx2);
                        $end = Carbon::parse($xx);
                        $total = $start->diffInSeconds($end);
                        if ($total > '600') {
                            $item->who_win = $item->challenge_accepted_by;
                            $item->status = 'complete';
                            $item->save();
                            $useraccount = User::where('id', $item->challenge_accepted_by)
                                ->increment('wallet', $item->winning_amount);
                            Income::create($income);
                            $cloneBall = User::where('id', $item->challenge_accepted_by)->first();
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
    public function applyReferCode(Request $request)
    {

        $user =  User::where('name', $request->save_user_name_input)->where('id', '!=', Auth::user()->id)->first();
        if ($user) {
            return response()->json(['status' => false, 'message' => 'Name already taken', 'data' => null]);
        }

        $authUser = Auth::user();
        // $authUser->name = $request->save_user_name_input;
        $authUser->save();
        return response()->json(['status' => true, 'message' => 'Profile update successfully', 'name' => $authUser->name]);
    }
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:10',
            'otp' => 'required|digits:6', // Assuming OTP is a 4-digit code, adjust if necessary
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()->first() ?? '', 'data' => null]);
        }

        $user =  User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not registered', 'data' => null]);
        }

        // Retrieve the stored OTP from the user record
        $storedOTP = $user->otp;

        // Compare the provided OTP with the stored OTP
        if ($request->otp !== $storedOTP) {
            return response()->json(['status' => false, 'message' => 'Invalid OTP', 'data' => null]);
        }

        // Clear the OTP from user record after successful verification
        $user->otp = null;
        $user->save();

        // Login the user
        Auth::login($user);

        return response()->json(['status' => true, 'message' => 'User logged in successfully', 'data' => null]);
    }
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()->first() ?? '', 'data' => null]);
        }


        $auth = Auth::user();
        if (!Hash::check($request->old_password, $auth->password)) {
            return response()->json(['status' => false, 'message' => 'Current Password is Invalid', 'data' => null]);
        }

        if (strcmp($request->old_password, $request->new_password) == 0) {
            return response()->json(['status' => false, 'message' => 'New Password cannot be same as your current password.', 'data' => null]);
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return response()->json(['status' => true, 'message' => 'Password changed successfully', 'data' => null]);

        return response()->json(['status' => false, 'message' => 'Something went wrong', 'data' => null]);
    }
    public function login(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            return redirect('home');
        }

        return view('frontend.login');
    }
    
    
    public function loginpost(Request $request)
    {
        $users = User::where('is_admin', '1')->take(5)->get();

        return response()->json($users);
    }

    public function kyc()
    {
        //
        $kycDocument = KYCDocument::where('user_id', auth()->id())->orderBy('id','DESC')->first();
        return view('frontend.kyc', ['kycStatus' => $kycDocument ? $kycDocument->status : null]);
    }

    public function uploadKycDoc(Request $request)
    {
		try{
			

			// Set maximum upload file size to 64MB for this specific action
			ini_set('upload_max_filesize', '16M');

			// Set maximum POST data size to 64MB (should be equal to or greater than upload_max_filesize)
			ini_set('post_max_size', '16M');
			// Validate the form data
			$validatedData = $request->validate([
				'name' => 'required|string',
				'aadhar_no' => 'required|string|unique:kyc_documents|min:12|max:12',
				'email' => 'required|email',
				'dob' => 'required|date|before_or_equal:today', // Allowing DOB from past days
				'front_image' => 'required|image|mimes:jpg,png,jpeg|max:16384', // Max 2 MB and only specified image formats
				'back_image' => 'required|image|mimes:jpg,png,jpeg|max:16384', // Max 2 MB and only specified image formats
			]);


			// Store the uploaded files
			// $frontImage = $request->file('front_image')->store('kyc');
			// $backImage = $request->file('back_image')->store('kyc');

			$front_image = null;
			$back_image = null;
			if ($request->hasFile('front_image')) {
				$frontImage = Helper::uploadDocuments($request->file('front_image'), public_path('images/kyc/'));
			}
			if ($request->hasFile('back_image')) {
				$backImage = Helper::uploadDocuments($request->file('back_image'), public_path('images/kyc/'));
			}

			// Create a new KYC document record
			KYCDocument::create([
				'name' => $request->name,
				'aadhar_no' => $request->aadhar_no,
				'email' => $request->email,
				'dob' => $request->dob,
				'user_id' => Auth::user()->id,
				'front_image' => $frontImage,
				'back_image' => $backImage,
			]);

			if ($validatedData) {
				// If validation passes, redirect back with success message
				return redirect()->back()->with('success', 'KYC document uploaded successfully.');
			} else {
				// If validation fails, redirect back with errors and old input data
				return redirect()->back()->withErrors($request->validator)->withInput();
			}
		}catch(\Exception $e) {
			echo $e->getMessage();die;
		}
    }

    public function profile(Request $request)
    {
        // return $jsonData = ;
        $gameChallange =  GameChallange::where('challenge_accepted_by', Auth::user()->id)->orWhere('challenge_created_by', Auth::user()->id)->count();
        $referAmout = ReferUsers::where('refer_by', Auth::user()->id)->sum('amount');
        $user_id = Auth::user()->id;


        $amount = GameChallange::where('who_win', Auth::user()->id)->sum('winning_amount');

        return view('frontend.profile', compact('gameChallange', 'referAmout', 'amount'));
    }
    public function wallet(Request $request)
    {

        return view('frontend.wallet');
    }
    public function transactionHistory(Request $request)
    {
        $transaction = Transaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(30);
        return view('frontend.transaction-history', compact('transaction'));
    }
    public function manualTransactionHistory(Request $request)
    {
        $transaction = Transaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(30);
        return view('frontend.manual-transaction-history', compact('transaction'));
    }
    public function transactionHistoryNew(Request $request)
    {
        $transaction = DepositTransactions::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(30);
        return view('frontend.deposit-transaction-history', compact('transaction'));
    }
    public function addFund(Request $request)
    {
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

    public function addFundManual(Request $request){
        return view('frontend.add-fund-manual');
    }
     
    public function addMoajaxAddFundManualney(Request $request)
    {
        // echo "test";
        // print_r($request->all());die;
        $user_id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'amount'            => 'required|numeric|min:10',
            'transactions_id'   => 'required',
            'screen_shot'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // 'status'            => 'required',
            // 'transaction_type'  => 'required',
            // 'payment_gatway'    => 'required'
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
             $transaction->status  = "Pending";
             $transaction->addition_status = 'Pending';
             $transaction->transaction_type  = 'add_money';
             $transaction->payment_gatway  = 'Manual';
             $transaction->save();
          
             DB::commit();
             return ResponseBuilder::successMessage('Transaction data saved successfully',$this->success);
         } catch (Exception $e) {
            DB::rollBack();
            return ResponseBuilder::error($e->getMessage(), $this->serverError);
         }

    }
    public function withdrawFunds(Request $request)
    {

        $totalWithdrawal = Transaction::where('transaction_type', 'withdrawal_money')->where('user_id', Auth::user()->id)->where('addition_status', 'pending')->first();
        return view('frontend.withdraw-funds', compact('totalWithdrawal'));
    }
    public function withdrawFundsLive(Request $request)
    {

        $totalWithdrawal = Transaction::where('transaction_type', 'withdrawal_money')->where('user_id', Auth::user()->id)->where('addition_status', 'pending')->first();
        return view('frontend.withdraw-funds-live', compact('totalWithdrawal'));
    }

    public function updatePrfileImg(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'image'             => 'required|mimes:jgp,png,jpeg'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'data' => null]);
        }
        $user = Auth::user();
        if ($request->file('image')) {
            $file = $request->file('image');
            $imageName = $this->UpdateImage($file, 'assets/users/' . $user->id);
            $user->profile_image = 'assets/users/' . $user->id . '/' . $imageName;
            $user->save();
        }
        return response()->json(['status' => true, 'message' => 'Profile Update succussfully', 'data' => null]);
    }
    public function showGame(Request $request, $id)
    {
        $gameChallange =  GameChallange::where('slug', $id)->first();
        if (!isset($gameChallange) || $gameChallange->challenge_created_by != Auth::user()->id && $gameChallange->challenge_accepted_by != Auth::user()->id) {
            return redirect()->to('home');
        }
        if ($gameChallange->status != 'running' && $gameChallange->status != 'in_review') {
            return redirect()->to('home');
        }
        $playersFirst = User::where('id', $gameChallange->challenge_accepted_by)->first();
        $playersSecond = User::where('id', $gameChallange->challenge_created_by)->first();

        return view('frontend.show-game', compact('gameChallange', 'playersFirst', 'playersSecond'));
    }
    public function referEarn(Request $request)
    {
        $refer = ReferUsers::where('refer_by', Auth::user()->id)->count();
        $referAmout = ReferUsers::where('refer_by', Auth::user()->id)->sum('amount');

        return view('frontend.refer-earn', compact('refer', 'referAmout'));
    }
    public function gameHistory(Request $request)
    {
        return view('frontend.game-history');
    }
    
    public function pusher(Request $request)
    {

        return view('frontend.pusher');
    }
    public function notification(Request $request)
    {

        return view('frontend.notification');
    }
    public function support(Request $request)
    {

        return view('frontend.support');
    }
    public function aboutUs(Request $request)
    {

        return view('frontend.about-us');
    }
    public function termsAndConditions(Request $request)
    {

        return view('frontend.terms-and-conditions');
    }
    public function privacyPolicy(Request $request)
    {

        return view('frontend.privacy-policy');
    }
    public function refund(Request $request)
    {

        return view('frontend.refund-and-cancellation-policy');
    }
    public function responsibleGaming(Request $request)
    {

        return view('frontend.responsible-gaming');
    }
    public function home(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('login');
        }
        $challangeType = ChallangeType::all();
        return view('frontend.home', compact('challangeType'));
    }
    public function register(Request $request)
    {
        return view('frontend.register');
    }
    public function registerPOST(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'mobile_number' => 'required|Integer'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()->first() ?? '', 'data' => null]);
        }
        $ExitUser = User::where('phone', $request->mobile_number)->first();
        $ExitUser2 = User::where('name', $request->full_name)->first();
        // $ExitUser3 = User::where('email', $request->email)->first();
        if (!empty($ExitUser)) {
            return response()->json(['status' => false, 'message' => 'User already register with this mobile number', 'data' => null]);
        }
        if (!empty($ExitUser2)) {
            return response()->json(['status' => false, 'message' => 'Name already taken', 'data' => null]);
        }
        // if (!empty($ExitUser3)) {
        //     return response()->json(['status' => false, 'message' => 'Email address already taken', 'data' => null]);
        // }
        if ($request->refer_code) {
            $userRefer = User::where('refer_code', $request->refer_code)->first();
            if (!$userRefer) {
                return response()->json(['status' => false, 'message' => 'Invalid refer code', 'data' => null]);
            }
        }


        $newUser = User::create([
            'phone' => $request->mobile_number,
            'name' => $request->full_name,
            'refer_code' => Helper::generateReferCode(),
            'is_play' => false, //true when kyc approved by admin
            // 'password' => Hash::make($request->password),
            // 'email' => $request->email,
        ]);

        if ($request->refer_code) {
            ReferUsers::create([
                'user_id' => $newUser->id,
                'refer_by' => $userRefer->id,
            ]);
        }
        return response()->json(['status' => true, 'message' => 'Register successfully', 'data' => null]);
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
            return response()->json(['status' => false, 'message' => $validator->messages() ?? '', 'data' => null]);
        }
        $AdminSettings = SiteSetting::where('name', 'min_withdrawl_amount')->first();
        if (!isset($AdminSettings->value) || empty($AdminSettings->value)) {
            $minAmount = 100;
        } else {
            $minAmount = $AdminSettings->value;
        }
        if ($minAmount > $request->amount) {
            return response()->json(['status' => false, 'message' => "Minimum withdrawal in limit is Rs $minAmount", 'data' => null]);
        }
        $transaction = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'withdrawal_money')->where('addition_status', 'pending')->first();
        if ($transaction) {
            return response()->json(['status' => false, 'message' => "Your previous withdrawal is already in pending", 'data' => null]);
        }

        $user = Auth::user();
        if ($request->amount > $user->wallet) {
            return response()->json(['status' => false, 'message' => "Withdrawal amount cannot be greater then winning balance", 'data' => null]);
        }

        //$user->wallet  = $user->wallet - $request->amount;
        //$user->save();
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


        return response()->json(['status' => true, 'message' => 'Withdrawal added', 'data' => null]);
    }

    public function addWithdrawalLive(Request $request)
    {

       $validator = Validator::make($request->all(), [
            'method' => 'required|in:upi,bank',
            // 'upi' => 'required_if:method,upi',
            // 'confirm_upi' => 'required_if:method,upi|same:upi',
            'accountNumber' => 'required_if:method,bank',
            'confirm_accountNumber' => 'required_if:method,bank|same:accountNumber',
            'ifscCode' => 'required_if:method,bank',
            'mobileNo' => 'required_if:method,bank',
            'payeeName' => 'required',
            'amount' => 'required|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages() ?? '', 'data' => null]);
        }
        // Test
        // if(Auth::user()->id != 111){
        //     return response()->json(['status' => false, 'message' => 'Please try after sometime. Your money is safe.', 'data' => null]);
        // }

        // Check if the user has made a withdrawal within the last 90 minutes
        $lastWithdrawalTime = Transaction::where('user_id', Auth::user()->id)
            ->where('transaction_type', 'withdrawal_money')
            ->where('created_at', '>', now()->subMinutes(90))
            ->exists();

        if ($lastWithdrawalTime) {
            return response()->json(['status' => false, 'message' => 'You can only make a withdrawal once every 90 minutes', 'data' => null]);
        }

        $is_withdrawal = SiteSetting::where('name', 'is_withdrawal')->first();
        if (!isset($is_withdrawal->value) || empty($is_withdrawal->value)) {
            return response()->json(['status' => false, 'message' => 'Withdrawal is paused by admin. Your money is safe.', 'data' => null]);
        } else if ($is_withdrawal->value == 0) {
            return response()->json(['status' => false, 'message' => 'Withdrawal is paused for sometime. Your money is safe.', 'data' => null]);
        }


        $AdminSettings = SiteSetting::where('name', 'min_withdrawl_amount')->first();
        if (!isset($AdminSettings->value) || empty($AdminSettings->value)) {
            $minAmount = 100;
        } else {
            $minAmount = $AdminSettings->value;
        }

        if ($minAmount > $request->amount) {
            return response()->json(['status' => false, 'message' => "Minimum withdrawal in limit is Rs $minAmount", 'data' => null]);
        }
        $transaction = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'withdrawal_money')->where('addition_status', 'pending')->first();
        if ($transaction) {
            return response()->json(['status' => false, 'message' => "Your previous withdrawal is already in pending", 'data' => null]);
        }

        $user = Auth::user();
        if ($request->amount > $user->wallet) {
            return response()->json(['status' => false, 'message' => "Withdrawal amount cannot be greater then winning balance", 'data' => null]);
        }

        DB::beginTransaction();
        $user->wallet  = $user->wallet - $request->amount;
        $user->save();
        //   tranasction id
        $tid = Helper::generateTransactionID();
        $amount = $request->amount;

        $newTransaction = Transaction::create([
            'user_id' => $user->id,
            'type' => 'debit',
            'transfermode' => 'IMPS', 
            'transactions_id' => $tid,
            'amount' => $amount,
            'status' => 'Pending',
            'addition_status' => 'Requested',
            'withdrawal_upi_id' => '',
            'mobileNo' => $request->mobileNo,
            'payeeName' => $request->payeeName,
            'account_number' => $request->accountNumber,
            'ifsc_code' => $request->ifscCode,
            'withdrawal_method' => $request->method,
            'title' => 'Withdrawal Money',
            'transaction_type' => 'withdrawal_money',
            'closing_balance'  => ($user->wallet ?? 0) + ($user->deposit_amount ?? 0),
        ]);

        $myPayResponse = $this->MyPay_DoPayout($newTransaction);
        $decodedResponse = json_decode($myPayResponse, true);
        \Log::info("-decodedResponse >> ".json_encode($decodedResponse));
        // echo "====".$type = gettype($myPayResponse);
        // print_r($decodedResponse);die;

        if (isset($decodedResponse['clientReferenceId'])) {
             
            // Update the record with additional information
            $newTransaction->update([
                'ClientReferenceId' => $decodedResponse['clientReferenceId'],
                'PaymentReferenceId' => $decodedResponse['paymentReferenceId'],
                'status' => $decodedResponse['status'],
                'Message' => $decodedResponse['message'], 
                'BankUTRNO' => $decodedResponse['bankUTRNO'], 
                'TransactionTime' => $decodedResponse['transactiontime'], 
                'UpdatedTime' => $decodedResponse['updatedtime'], 
                'paymentResponse' => $myPayResponse
            ]);
             
            // Check the status and return the appropriate response
            if (isset($decodedResponse['status']) && $decodedResponse['status'] == "PENDING") {
                DB::commit();
                return response()->json(['status' => true, 'message' => 'Withdrawal request done please wait for sometime', 'data' => null]);
            } else {
                
                DB::rollBack();
                return response()->json(['status' => false, 'message' => 'Withdrawal failed', 'data' => null]);
            }
        } else {
            
            DB::rollBack();
            // Handle the case when 'data' or 'externalId' is not present in the response
            return response()->json(['status' => false, 'message' => 'Withdrawal failed', 'data' => null]);
        }
    }

    function KvmPayToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-live.kvmpay.com/payouts/OAuth/get-token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'X-Api-Key: ' . env('KvmpXApiKey'),
                'X-Secret-key: ' . env('KvmpXApiKeySecret'),
                'Content-Length: 0'
            ),
        ));

        $response = curl_exec($curl);
        $Access_token = json_decode($response);
        // print_r($Access_token->Access_token);die;
        if (isset($Access_token) && $Access_token->Access_token) {
            return $Access_token->Access_token;
        }
        curl_close($curl);
    }
     

    function MyPay_DoPayout($newTransaction)
    {
        $s = '{
             "accountNumber": "' . $newTransaction->account_number . '",
             "ifscCode": "' . $newTransaction->ifsc_code . '",
             "payeeName": "' . $newTransaction->payeeName . '",
             "amount": ' . $newTransaction->amount . ',
             "mobileNo": "' . $newTransaction->mobileNo . '",
             "vpa": "",
             "remarks": "test payout",
             "clientReferenceId": "' . $newTransaction->transactions_id . '",
             "email": "mkskumar1234@gmail.com",
             "transfermode": "IMPS"
            }';
        
        // echo "<pre>";
        // print_r($s);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-live.kvmpay.com/payouts/v1/Payments/initiate-payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $s,//json_encode($requestData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->KvmPayToken(),
            ),
        ));

        $response = curl_exec($curl);
        // print_r($response);die;
        // curl_close($curl);
        if ($response === false) {
            // Handle cURL error
            // echo 'cURL error: ' . curl_error($curl);
            return json_encode(['status' => false]);
        } else {
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($httpCode != 200) {
                // Handle API response error
                // echo 'API error: ' . $response;
                return json_encode(['status' => false]);
            } else {
                // echo "===";
                // print_r($response);die;
                return $response;
            }
        } 
    }

    function MyPay_DoPayoutOld($amount, $tid, $name, $upi)
    {
        $mobile = Auth::user()->phone;

        $s = '{
            "payer": "' . $name . '",
             "payerAccountNumber": "' . $mobile . '",
             "payeeAccountNumber": "' . $upi . '",
             "payeeName": "' . $name . '",
             "amount": ' . $amount . ',
             "mobileNo": "' . $mobile . '",
             "paymentMode": "UPI",
             "remark": "string",
             "externalId": "' . $tid . '",
             "latitude": "string",
             "longitude": "string",
             "purpose": "Payout",
             "otp": "string",
             "optional1": "string",
             "optional2": "string",
             "optional3": "string",
             "optional4": "string"
            }';


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv1.mypay.zone/api/v1/Payout/domestic-payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $s, //json_encode($requestData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->MyPay_AccessToken(),
            ),
        ));

        $response = curl_exec($curl);
        // print_r($response);
        curl_close($curl);
        if ($response === false) {
            // Handle cURL error
            // echo 'cURL error: ' . curl_error($curl);
            return json_encode(['status' => false]);
        } else {
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($httpCode != 200) {
                // Handle API response error
                // echo 'API error: ' . $response;
                return json_encode(['status' => false]);
            } else {
                // echo "===";
                // print_r($response);die;
                return $response;
            }
        }



        // $resp = json_decode($response);
        // echo "<pre>";
        // print_r($resp);die;
    }

    function MyPay_AccessToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv1.mypay.zone/api/Auth/access-token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'X-MyPay-Clientid: 704843',
                'X-MyPay-ClientSecret: 029468fb-a79f-4658-8d7c-8e8e214af4e3',
                'X-MyPay-Endpoint-lp: 154.41.233.61',
                'Content-Length: 0'
            ),
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            // Handle cURL error
            echo 'cURL error: ' . curl_error($curl);
        } else {
            $res = json_decode($response);
            if ($res) {
                return $res->access_token;
            } else {
                // Handle API response error
                echo 'API error: ' . $response;
            }
        }

        curl_close($curl);

        return null; // Handle error or return default value
    }

    function MyPayQrGanarate($amount, $tid)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv1.mypay.zone/api/v1/DynamicQrCode/generate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
          "amount": ' . $amount . ',
          "externalId": "' . $tid . '"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . MyPay_AccessToken()
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res =  json_decode($response);

        if (isset($res) && $res->statusCode == 'TXN') {
            $history = new My_Transaction_history;
            $history->status = 'under_review';
            $history->amount = $amount;
            $history->gameid = 'MyPayPayIN';
            $history->slug = $res->data->externalId;
            $history->transaction_res = $res->data->qrstring;
            $history->userid = Auth::id();
            $history->save();
            return $tid;
        }
    }

    function MyPayPayourStatus($slug)
    {
        //$slug Mena  Trasation ID
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv1.mypay.zone/api/v1/TransStatus/payment-details?ExternalId=' . $slug . '&ServiceType=Payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . MyPay_AccessToken()
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public function callBackMyPay(Request $request)
    {
        // Handle callback logic here
        // You can access request parameters using $request object

        // Example:
        $data = $request->all(); // Retrieve all request data
        echo "echo == <pre>";
        print_r($data);
        die;
        // Process the callback data as needed

        // Return a response if required
        return response()->json(['message' => 'Callback received'], 200);
    }

    
    public function logout()
    {
        if (Auth::user()->id) {
            Auth::logout();
        }
        return redirect()->to('login');
    }

}
