<?php

namespace App\Helper;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Helper\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\User;
use App\Transaction;
use App\SiteSetting;
use Auth;
use stdClass;
class Helper
{

    public static function generateOtp(): int
    {
        $otp = rand(1000, 9999);
        return $otp;
    }
    public static function winningAmount($amount)
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
    public static function addMoney($amount,$client_txn_id)
    {
        try{
            $key = "30f7fe4f-f2a8-402c-a84c-cb37c62dde51";
            $post_data = new stdClass();
            $post_data->key = $key;
            $redirectURL = url('/add-fund');
            $post_data->client_txn_id = $client_txn_id;
            $post_data->amount = $amount;
            $post_data->p_info = "Add money";
            $post_data->customer_name = Auth::user()->name ?? 'Guest User';
            $post_data->customer_email = Auth::user()->email ?? '';
            $post_data->customer_mobile = Auth::user()->phone;
            $post_data->redirect_url = $redirectURL;
            $post_data->udf1 = "";
            $post_data->udf2 = "";
            $post_data->udf3 = "";
            //echo "sdsd";die;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://merchant.upigateway.com/api/create_order',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($post_data),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            //  print_r($response);die;
            return $result = $response;
        }catch (Exception $e) {
            // echo 'Caught exception: ',  $e->getMessage(), "\n";die;
        }
        
    }
    
    public static function addMoney2($amount,$client_txn_id)
    {
        try{
            $key = "30f7fe4f-f2a8-402c-a84c-cb37c62dde51";
            $post_data = new stdClass();
            $post_data->key = $key;
            $redirectURL = url('/add-fund');
            $post_data->client_txn_id = $client_txn_id;
            $post_data->amount = $amount;
            $post_data->p_info = "Add money";
            $post_data->customer_name = Auth::user()->name ?? 'Guest User';
            $post_data->customer_email = Auth::user()->email ?? '';
            $post_data->customer_mobile = Auth::user()->phone;
            $post_data->redirect_url = $redirectURL;
            $post_data->udf1 = "";
            $post_data->udf2 = "";
            $post_data->udf3 = "";
            //echo "sdsd";die;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://merchant.upigateway.com/api/create_order',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($post_data),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            //  print_r($response);die;
            return $result = $response;
        }catch (Exception $e) {
            // echo 'Caught exception: ',  $e->getMessage(), "\n";die;
        }
        
    }
    
    static function MyPay_AccessToken() {
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
    
    public static function MyPayQrGanarate($amount,$tid){ 
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
          CURLOPT_POSTFIELDS =>'{
          "amount": '.$amount.',
          "externalId": "'.$tid.'"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.Helper::MyPay_AccessToken()
          ),
        ));
        
        $response = curl_exec($curl); 
        
        curl_close($curl);
        
        $res =  json_decode($response);
        // echo "echo == <pre>";
        // print_r($res);die;
        $upiURL = $res->data->qrstring;
        return view('frontend.payMyPay',compact('upiURL'));
        // if(isset($res) && $res->statusCode=='TXN'){
        //     $history = new My_Transaction_history;
        //     $history->status = 'under_review';
        //     $history->amount = $amount;
        //     $history->gameid = 'MyPayPayIN';
        //     $history->slug = $res->data->externalId;
        //     $history->transaction_res = $res->data->qrstring;
        //     $history->userid = Auth::id();
        //     $history->save();
        //     return $tid;
        // } 
        
    }
    
    public static function checkDepositTranStatus($client_txn_id)
    {
        

        $key = "30f7fe4f-f2a8-402c-a84c-cb37c62dde51";
        $post_data = new stdClass();
        $post_data->key = $key;
        $post_data->client_txn_id = $client_txn_id; // you will get client_txn_id in GET Method
        $post_data->txn_date = date("d-m-Y"); // date of transaction
    
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://merchant.upigateway.com/api/check_order_status',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($post_data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
    
       return $result = json_decode($response,true);

    
        
    }
    
    public static function generateReferCode($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        if(User::where('refer_code',$randomString)->first()){
          return Helper::generateReferCode();
        }
        
        return $randomString;
    }
    public static function generateTransactionID($length = 12) {
        $characters = rand(1000000,99999999999);
        // $charactersLength = strlen($characters);
        // $randomString = '';
        // for ($i = 0; $i < $length; $i++) {
        //     $randomString .= $characters[random_int(0, $charactersLength - 1)];
        // }
        if(Transaction::where('transactions_id',$characters)->first()){
          return Helper::generateReferCode();
        }
        
        return $characters;
    }
    public static function createRoomCode() {
       return $jsonData = json_decode(file_get_contents('https://www.fojibhailudo.com/classicroomcode'));

    }
    public static function permissionArray() {
       return [
        'dashboard',
        'challanges',
        'pages',
        'withdrwal_request',
        'fund_request',
        'users',
        'settings',
       ];

    }
    public static function generateName(){
        $names = ["Aarav", "Aryan", "Rohan", "Vikram", "Aditya", "Arjun", "Siddharth", "Kiran", "Rahul", "Amit", "Alok", "Ankit", "Deepak", "Gopal", "Harish", "Ishan", "Jatin", "Kunal", "Manish", "Nitin", "Prateek", "Rajesh", "Suresh", "Varun", "Yogesh", "Akhil", "Bhavin", "Chetan", "Dhruv", "Girish", "Hitesh", "Kartik", "Mayank", "Naveen", "Pankaj", "Rakesh", "Sumit", "Vivek", "Akash", "Bharat", "Dinesh", "Hemant", "Jagdish", "Kamal", "Mukesh", "Nikhil", "Parth", "Ravi", "Sunil", "Vishal", "Abhinav", "Bipin", "Chirag", "Divyesh", "Hari", "Jayesh", "Ketan", "Nirav", "Pranav", "Rohit", "Sachin", "Tanmay", "Yash", "Arun", "Dilip", "Indrajeet", "Kishan", "Nishant", "Pramod", "Rajiv", "Sanjay", "Tarun", "Ajay", "Brijesh", "Ganesh", "Jignesh", "Krishna", "Nikhil", "Piyush", "Rajat", "Satish", "Udit", "Amar", "Deepesh", "Himanshu", "Kamlesh", "Mohit", "Pritesh", "Raman", "Shyam", "Varun", "Yashwant", "Anand", "Dipesh", "Ishwar", "Ketan", "Nishit", "Prashant", "Ranjeet", "Siddhant", "Vibhav", "Akhilesh", "Chandrashekhar", "Divyansh", "Hitesh", "Kapil", "Mudit", "Puneet", "Ravindra", "Sourabh", "Vijay", "Yogendra", "Alok", "Dushyant", "Imran", "Karan", "Nitin", "Pankaj", "Rishabh", "Sudhir", "Vikas", "Aman", "Gaurav", "Jayant", "Kartik", "Naveen", "Prashant", "Rohit", "Sumanth", "Vikrant", "Amitabh", "Bhupendra", "Gopal", "Jeetendra", "Kishore", "Neeraj", "Prateek", "Rajesh", "Sunil", "Vinay", "Amol", "Bipin", "Girish", "Jitendra", "Krishna", "Nikhil", "Praveen", "Rajiv", "Suresh", "Vishal", "Ankur", "Chandan", "Harish", "Kamal", "Nilesh", "Puneet", "Rakesh", "Tanmay", "Yash", "Anupam", "Chetan", "Hemant", "Kapil", "Nirav", "Raman", "Tarun", "Arun", "Dhaval", "Himanshu", "Karan", "Piyush", "Ramesh", "Shashank", "Udit", "Ashish", "Dheeraj", "Indrajeet", "Kishan", "Nishant", "Pramod", "Ravi", "Shyam", "Vikram", "Ashok", "Divyesh", "Jagdish", "Kishore", "Nishit", "Prashant", "Rohit", "Siddharth", "Vivek"];
        $randomName = $names[array_rand($names)];
        return $randomName;
    }
    public static function randomPrice(){
        $amountData = rand(50,10000);
        if ($amountData % 50 != 0) {
           return Helper::randomPrice();
        }
        return $amountData;
    }

    public static function uploadDocuments($files, $path)
    {
        $imageName = substr(time(),-5). $files->getClientOriginalName();
        $files->move($path, $imageName);
        return $imageName;
    }
}
