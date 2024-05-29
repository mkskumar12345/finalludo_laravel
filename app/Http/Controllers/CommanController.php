<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;

use App\SiteSetting;
use App\DepositTransactions;
use App\GameChallange;
use App\Transaction;
use App\Events\SaveRoomCode;
use App\Helper\Helper;
use Auth;
use Carbon\Carbon;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;

class CommanController extends Controller
{
    public function deposit(Request $request)
    {
        return view('frontend.deposit');
    }
    public function depositPOST(Request $request)
    {
        $request->validate([
            'amount' => 'required|Integer',
            'image' => 'required|mimes:png,jgp,jpeg'
        ]);
        if ($request->file('image')) {
            $file = $request->file('image');
            $imageName = $this->UpdateImage($file, 'assets/transaction');
        }
        Transaction::create([
            'user_id' => Auth::user()->id,
            'type' => 'credit',
            'transactions_id' => Helper::generateTransactionID(),
            'amount' => $request->amount,
            'status' => 'success',
            'title' => 'Cash added using UPI',
            'transaction_type' => 'add_money',
            'type' => 'credit',
            'closing_balance'  => '',
            'deposit_status'  => 'Pending',
            'screen_shot'  => $imageName ?? '',
            'isAdmin'  => true,
        ]);
        return redirect()->back()->with('success', "Deposit Request Submitted");
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

    public function MyPay_AccessToken()
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

    public function addMoney(Request $request)
    {
        try {
            
            $validator = Validator::make($request->all(), [
                'amount' => 'required|Integer',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->messages()->first());
            }

             
            $minDeposit = SiteSetting::where('name', 'min_deposit_amount')->first();
            $maxDeposit = SiteSetting::where('name', 'max_deposit_amount')->first();
            $minDeposit = isset($minDeposit) && !empty($minDeposit) ? $minDeposit->value : 10;
            $maxDeposit = isset($maxDeposit) && !empty($maxDeposit) ? $maxDeposit->value : 10000;
            if ($minDeposit > $request->amount) {
                return redirect()->back()->with('error', "Minimum deposit limit is Rs $minDeposit");
            }

            if ($maxDeposit < $request->amount) {
                return redirect()->back()->with('error', "Maximum deposit limit is Rs $maxDeposit");
            }

            $tid = (string) rand(100000, 9999999999999);

            $amount = $request->amount;

            $curl = curl_init();

            $user = Auth::user();

            // Default values if user not found or email/mobile not available
            $email = $user ? (($user['email'] != "") ? $user['email'] : 'testkingstar@yopmail.com') : 'testkingstar@yopmail.com';
            $mobile = $user ? $user['phone'] : null;

            // Construct the JSON payload
            $postfields = json_encode([
                'email' => $email,
                'mobileNo' => $mobile,
                'clientReferenceId' => $tid,
                'amount' => $amount
            ]);
            // print_r($postfields);die;
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-live.kvmpay.com/payouts/v1/Generate-QrCode',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postfields,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $this->KvmPayToken()
                ),
            ));
            $response = curl_exec($curl);
            // print_r($response);die;
            $res =  json_decode($response);
            // print_r($res);die;
            $upiURL = '';
            if ($res->status == 'SUCCESS') {
                $upiURL = $res->qrcodE_STRING;

                $ttt= DepositTransactions::create(
                    [
                        'client_txn_id' => $tid,
                        'user_id' => Auth::user()->id,
                        'amount' => $amount,
                        'order_id' => $res->clientReferenceId ?? '',
                        'payment_url' => $res->qrcodE_STRING ?? '',
                        'upi_id_hash' => '',
                        // 'status' => $res->status,
                    ]
                );

                return view('frontend.payMyPay', compact('upiURL'));
            } else {
                // return error
                // echo "test";
                // die;
                return redirect()->back()->with('error', "Transaction Failed!");
            }

        } catch (\Exception $e) {
            // echo "tesdt".$e->getMessage();
            // die;

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function paymentResponse(Request $request)
    {
        try {
            \Log::info("paymentResponse payment" . json_encode($request->all(), true));
            // print_r($request->all());die;
            $clientReferenceId = $request->query('ClientReferenceId');
            $paymentReferenceId = $request->query('PaymentReferenceId');
            $bankUTRNO = $request->query('BankUTRNO');
            $status = $request->query('Status');
            $message = $request->query('Message');
            $chmod = $request->query('CHMOD');
            $transactionTime = $request->query('TRANSACTIONTIME');
            $optional1 = $request->query('Optional1');
            $optional2 = $request->query('Optional2');
            $optional3 = $request->query('Optional3');
            $optional4 = $request->query('Optional4');

            $AccountNumber = $request->query('AccountNumber');
            $IfscCode = $request->query('IfscCode');
            $Vpa = $request->query('Vpa');
            $PayeeName = $request->query('PayeeName');
            $TransferMode = $request->query('TransferMode');
            $Email = $request->query('Email');
            $MobileNo = $request->query('MobileNo');
            $Remarks = $request->query('Remarks');
            $UpdatedTime = $request->query('UpdatedTime');
            // echo "==test".$chmod;die;
            // PAYOUT functionality
            if($chmod == 'PAYOUT'){
                $depositTransaction = Transaction::where('transactions_id', $clientReferenceId)->where('status', 'PENDING')->first();
                // print_r($depositTransaction);die;
                if ($depositTransaction) {
                    $depositTransaction->PaymentReferenceId = $paymentReferenceId;
                    $depositTransaction->status = $status;
                    $depositTransaction->Message = $message;
                    $depositTransaction->BankUTRNO = $bankUTRNO;
                    $depositTransaction->CHMOD = $chmod;
                    $depositTransaction->TransactionTime = $transactionTime;
                    $depositTransaction->UpdatedTime = $UpdatedTime;
                    // print_r($depositTransaction);die;
					$user = User::where('id',$depositTransaction->user_id)->first();
					if($status != 'SUCCESS'){
						$user->wallet  = $user->wallet + $depositTransaction->amount;
        				$user->save();
					}
                    $success = $depositTransaction->save();
					
                    if ($success) {
                        // Update was successful
                        echo "Update operation was successful.";
                    } else {
                        // Update failed
                        echo "Update operation failed.";
                    }
                }
            }else{
                // Check if a record exists in the DepositTransactions table
                $depositTransaction = DepositTransactions::where('client_txn_id', $clientReferenceId)->where('status', 'Pending')->first();
                // print_r($depositTransaction);die;
                \Log::info("paymentResponse depositTransaction" . json_encode($depositTransaction));
                if ($depositTransaction) {
                    $depositTransaction->PaymentReferenceId = $paymentReferenceId;
                    $depositTransaction->status = $status;
                    $depositTransaction->Message = $message;
                    $depositTransaction->BankUTRNO = $bankUTRNO;
                    $depositTransaction->CHMOD = $chmod;
                    $depositTransaction->TRANSACTIONTIME = $transactionTime;
                    $depositTransaction->Optional1 = $optional1;
                    $depositTransaction->Optional2 = $optional2;
                    $depositTransaction->Optional3 = $optional3;
                    $depositTransaction->Optional4 = $optional4;
                    $depositTransaction->is_user_paid = ($status == 'SUCCESS') ? true : false;
                    $success = $depositTransaction->save();
                    
                    $user = User::where('id',$depositTransaction->user_id)->first();
                    $user->wallet  = $user->wallet + $depositTransaction->amount;
                    $user->save();
                    // print_r($user);
                    // echo "=test=";
                    // print_r($success);die;
                    if ($success) {
                        // Update was successful
                        echo "Update operation was successful.";
                    } else {
                        // Update failed
                        echo "Update operation failed.";
                    }
                } 

            }


            // print_r($depositTransaction);die;
            \Log::info("paymentResponse payment" . json_encode($depositTransaction));
            
        } catch (\Throwable $th) {
            \Log::info("error payment" . json_encode($e->getMessage()));
            return;
        }
    }


    public function saveRoomCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_code' => 'required',
            'challagne_slug' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first() ?? '', 'data' => null]);
        }
        
        $GameChallange = GameChallange::where('slug', $request->challagne_slug)->first();

        if (empty($GameChallange)) {
            return response()->json(['status' => false, 'message' => 'No game with this id please reload and retry']);
        }
        if($GameChallange->status != 'running'){//in_review
			return response()->json(['status' => false, 'message' => 'Challange already ended. Start New Game']);
		}

        $GameChallange->room_code = $request->room_code;
        $GameChallange->room_code_time = Carbon::now();
        $GameChallange->save();

        $createBettelPuser = [
            'code' => $GameChallange->room_code,
            'slug' => $request->challagne_slug,
        ];
        event(new SaveRoomCode($createBettelPuser));
        return response()->json(['status' => true, 'message' => 'success',]);
    }
}
