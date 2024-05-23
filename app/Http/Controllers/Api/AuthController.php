<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Admin\UserResource;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Helper\ResponseBuilder;
use App\User;
use App\DeviceToken;
use App\SiteSetting;
use Validator;
use Carbon\Carbon;
use Exception;
use DB;

class AuthController extends Controller
{
    //
    public function setAuthResponse($user) {
        return $this->response->user =  new UserResource($user);
    }
    public function signup(Request $request): Response
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email'      => 'nullable|email',
                'password'   => 'required|min:8',
                'phone'      => 'numeric|required|digits:10',
            ]);
            if ($validator->fails()) {   
                return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);  
            }   
            $otp =Helper::generateOtp();
            $user = User::where('phone',$request->phone)->first();
            if($user){
                if($user->status == 'approve'){
                    return ResponseBuilder::error("Phone Number already exist", $this->badRequest);
                }
                    $user->name = $request->name;
                    $user->phone=$request->phone;
                    $user->password= Hash::make($request->password);
                    $user->deleted_at = null;
                    $user->otp = $otp;
                    $user->otp_created_at = now();
                    $user->email_verified_at = null;
                    $user->update();
            }
            else{
            
                $user = new User();
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->password = Hash::make($request->password);
                $user->otp = $otp;
                $user->status = 'pending';
                $user->save();
                $user->roles()->sync(2);
            }

            $this->response->phone = $user->phone;
            $this->response->otp = $user->otp;

            $this->SendOtp($user->phone, $user->otp);

            return ResponseBuilder::success($this->response,"Registration successfully, Please verify phone by OTP");
            
        }
        catch (exception $e) {
            return ResponseBuilder::error("Something went wrong", $this->serverError);
        }
    }

    public function verifyOtp(Request $request)
    {   
        try{
            $validator = Validator::make($request->all(), [
                'phone' => 'numeric|required|exists:users,phone|digits:10',
                'otp' => 'required|digits:4'
            ]);
           
            if ($validator->fails()) {   
                return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
            }   

            $user = User::where('phone', $request->phone)->first();

            if ($user->otp != $request->otp) {
                return ResponseBuilder::error("Wrong Otp", $this->badRequest);
            }

            if($user->otp == $request->otp){
                $user->otp_created_at = $user->otp = null;
                $user->email_verified_at = now();
                $user->status = 'approve';
                $user->save();
                //login user here
                $token = $user->createToken('Token')->accessToken;
                $this->setAuthResponse($user);

                return ResponseBuilder::successWithToken($token, $this->response,"Otp varified");
               
            }
        }catch (\Exception $e) {
            return ResponseBuilder::error("Something went wrong", $this->serverError);
        }   

    }

    public function userLogin(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'phone' => 'numeric|required|exists:users,phone|digits:10',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
            }
            $user = User::where('phone', $request->phone)->first();

            if(!$user)
            {
                return ResponseBuilder::error( "Phone Number not registered", $this->badRequest);
            }
            
            if($user->status == 'block')
            {
                return ResponseBuilder::error("This account is block by admin please contact to support" ,$this->badRequest);
            }

            if($user->status == 'approve'){
                if($user->deleted_at != null){
                    return ResponseBuilder::error("Account deleted" ,$this->badRequest);
                }
                if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){
                    $token = auth()->user()->createToken('API Token')->accessToken;
                    $user = Auth::user();
                    if(isset($request->fcm_token)){
                        DeviceToken::updateOrCreate([
                            'user_id'       => $user->id,
                        ],[
                            'device_token'   => $request->fcm_token,
                        ]);
                    }
                    $this->setAuthResponse($user);
                    return ResponseBuilder::successWithToken($token, $this->response, "Login successfully");
                }
                else{
                    return ResponseBuilder::error( "Password not matched", $this->badRequest);
                }
            }else{
                return ResponseBuilder::successMessage( "Phone number not verified, Please register again", $this->badRequest);
            }
           
            
        } catch (\Exception $e) {
            return ResponseBuilder::error("Something went wrong", $this->serverError);
        }

    }

    public function resetPassword(Request $request)
    {
        // code...
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:10|exists:users,phone',
        ],[
            'phone.exists' => "Phone doesn't registered"
        ]);
        if ($validator->fails()) {
            return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
        }
        try {
            $user = User::where('phone', $request->phone)->first();
            $this->response->id = $user->id;
            $this->response->phone_no = $user->phone;
            return ResponseBuilder::success($this->response, "Verify your id to reset your password");
        } catch (Exception $e) {
            return ResponseBuilder::error($e->getMessage(), $this->serverError);
        }
    }

    public function varifyId(Request $request)
    {
        // code...
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:users,id',
        ]);
        if ($validator->fails()) {
            return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
        }
        try{
            $user = User::where('id',$request->id)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            return ResponseBuilder::successMessage('Password changed successfully',$this->success);
        } catch (Exception $e) {
            return ResponseBuilder::error($e->getMessage(), $this->serverError);
        }
    }

    // site settings
    public function siteSetting()
    {
        // code...
        try {
            $settings = SiteSetting::where('name','!=','logo')->Where('name', '!=','favicon')->get();
            $data = [];
            foreach ($settings as $value) {
                // code...
                $data = $this->customAraay($data, $value->name, $value->value);
            }
            return ResponseBuilder::success($data, 'Site settings');
        } catch (Exception $e) {
            return ResponseBuilder::error(__($e->getMessage()),$this->serverError);
        }
    }

    function customAraay($array, $key, $value){
       $array[$key] = $value;
       return $array;
    }

}