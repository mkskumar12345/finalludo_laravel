<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\DeviceToken;
use App\SiteSetting;
use App\User;
use Exception;
use stdClass;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $serverError = 500;
    protected $success = 200;
    protected $badRequest = 400;
    protected $unauthorized = 401;
    protected $notFound = 404;
    protected $forbidden = 403;
    protected $upgradeRequired = 426;

    protected $response;

    public function __construct()
    {
        $this->response = new stdClass();
    }

    public function UpdateImage($file, $path = '')
    {
        # code...    
        $filename = $file->getClientOriginalName();
        $filename = pathinfo($filename, PATHINFO_FILENAME);
        $imageName = time().uniqid().str_replace(' ','-',$filename).'.'.$file->extension();
        // Public Folder
        $file->move(($path), $imageName);
        // $file->storeAs($path, $imageName);
        return $imageName; 
    }

    public function WinnerScreenShort($image)
    {
        # code...    
        $file = $image;
        $name =$file->getClientOriginalName();
        $destinationPath = 'assets/winnershort';
        $file->move($destinationPath, $name);
        return $name;
    }

    public function challangeImage($image)
    {
        # code...    
        $file = $image;
        $name =$file->getClientOriginalName();
        $destinationPath = 'assets/challangeResult';
        $file->move($destinationPath, $name);
        return $name;
    }

    public function transactionScreenShort($file)
    {
        # code...    
        $filename = $file->getClientOriginalName();
        $filename = pathinfo($filename, PATHINFO_FILENAME);
        $imageName = time().uniqid().str_replace(' ','-',$filename).'.'.$file->extension();
        // Public Folder
        $destinationPath = 'assets/transaction';
        $file->move($destinationPath, $imageName);
        // $file->storeAs($path, $imageName);
        return $imageName; 
    }
    public function profileImage($file)
    {
        # code...    
        $filename = $file->getClientOriginalName();
        $filename = pathinfo($filename, PATHINFO_FILENAME);
        $imageName = time().uniqid().str_replace(' ','-',$filename).'.'.$file->extension();
        // Public Folder
        $destinationPath = 'assets/transaction';
        $file->move($destinationPath, $imageName);
        // $file->storeAs($path, $imageName);
        return $imageName; 
    }

    public function notify($firebaseToken = [], $title, $body, $metaData = null, $ids = null)
    {
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title"     => $title,
                "body"      => $body,
                "image"     => "",
                'badge'     => "1",
                'priority'  => '10',
                
            ],
            "priority" => 10,
            "data" => [
                'room_data' => json_decode($metaData, true),
                'payload'   => $firebaseToken,
                "click_action" => "/reload-api"
            ],
            "content_available" => true,
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . config('panel.FIREBASE_SERVER_KEY'),
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

    }

    public function getDeviceToken($user_id)
    {
        // code...
        $token = DeviceToken::where('user_id',$user_id)->pluck('device_token')->first();
        return $token;
    }

    public function userInfo($user_id)
    {
        // code...
        $user = User::where('id',$user_id)->first();
        return $user;
    }

    // Send OTP
    public function SendOtp($phoneNumber, $otp = '1234')
    {
        # code...
        try {
            //code...

            $send_otp = SiteSetting::where('name', 'send_otp')->first();
            
            if($send_otp->value == 'yes') {
                $phoneNumber = str_replace("+91", "", $phoneNumber);
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://2factor.in/API/V1/'.config('panel.two_factor_key').'/SMS/+91'.$phoneNumber.'/'.$otp.'/ludoKhelo',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $response;

                return json_decode($response);
            }
             // ['status'=>true, 'message'=> 'Mail Sent'];
        } catch (Exception $e) {
            // $e
            return ['status'=>false, 'message'=> $e->getMessage()];
        }

    }

    public function winningAmount($amount)
    {
        // code...
        $fee = SiteSetting::where('name','service_fee')->pluck('value')->first();
        $refer = SiteSetting::where('name','refer_amount')->pluck('value')->first();
        if(!$refer){
            $refer = 2;  
        }
        if(!$fee){
            $fee = 3;  
        }
        

        $fee = ($amount*$fee)/100;
        $refer = ($amount*$refer)/100;
        $final = ($amount*2) -  ($fee);
        return $final;
    }
    
}
