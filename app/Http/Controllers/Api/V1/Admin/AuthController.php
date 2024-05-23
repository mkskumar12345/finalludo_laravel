<?php

namespace App\Http\Controllers\Api\v1\Admin;

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
                'email'      => 'required|email',
                'password'   => 'required|min:8',
            ]);
            if ($validator->fails()) {   
                return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);  
            }   
            $otpp =Helper::generateOtp();
            $user = User::where('email',$request->email)->first();
            if($user){
                if($user->status == 'approve'){
                    return ResponseBuilder::error("Email already exist", $this->badRequest);
                }
                    $user->name = $request->name;
                    $user->email=$request->email;
                    $user->password= Hash::make($request->password);
                    $user->deleted_at = null;
                    $user->otp = $otpp;
                    $user->otp_created_at = now();
                    $user->email_verified_at = null;
                    $user->update();
            }
            else{
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'otp'      => $otpp,
                    'otp_created_at' => Carbon::now(),
                ]);

            }

            $this->response->email = $user->email;
            $this->response->otp = $user->otp;


            return ResponseBuilder::success($this->response,"Registration successfull, Please varify otp");
            
        }
        catch (exception $e) {
            return ResponseBuilder::error("Something went wrong", $this->serverError);
        }
    }

    public function verifyOtp(Request $request)
    {   
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'email|required|exists:users',
                'otp' => 'required|digits:4'
            ]);
           
            if ($validator->fails()) {   
                return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
            }   

            $user = User::where('email',$request->email)->first();

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
                 'email' => 'required|email',
                 'password' => 'required',
            ]);
            if ($validator->fails()) {
                 return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
            }
            $user = User::where('email', $request->email)->first();

            if(!$user)
            {
                return ResponseBuilder::error( "Email not registed", $this->badRequest);
            }
 
            if($user->status == 'approve'){
                if($user->deleted_at != null){
                    return ResponseBuilder::error("Account deleted" ,$this->badRequest);
                }
                if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
                    $token = auth()->user()->createToken('API Token')->accessToken;
                    $user = Auth::user();
                    $this->setAuthResponse($user);
                    return ResponseBuilder::successWithToken($token, $this->response, "Login successfull");
                }
                else{
                    return ResponseBuilder::error( "Password not matched", $this->badRequest);
                }
            }else{
                return ResponseBuilder::successMessage( "Email not varified, Please regiter again", $this->badRequest);
            }
           
            
        } catch (\Exception $e) {
            return ResponseBuilder::error("Something went wrong", $this->serverError);
        }

    }

    public function testUser()
    {
        if(!Auth::guard('api')->check())
         {
            return ResponseBuilder::error("User not found", $this->unauthorized);
         }
         $user_id = Auth::guard('api')->user();
         dd($user_id);
    }

}