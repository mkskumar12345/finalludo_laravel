<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helper\ResponseBuilder;
use App\Http\Resources\Admin\UserResource;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use DB;

class PlayerApiController extends Controller
{
   public function updateUser(Request $request)
   {
    # code...
    if(!Auth::guard('api')->check()){
        return ResponseBuilder::error("User not found", $this->unauthorized);
    }
    $user_id = Auth::guard('api')->user()->id;
    // dd($user_id);
    $validator = Validator::make($request->all(), [
        'name'              => 'nullable|string',
        'phone'             => 'nullable|numeric|digits:10|',
        'email'             => 'nullable|email',
        'profile_image'     => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
    ]);
   
    if ($validator->fails()) {
        return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
     }

    DB::beginTransaction();
    try {
        //code...
        $user = User::where('id',$user_id)->first();
        $user->name              = ($request->name)?$request->name:$user->name;
        $user->phone             = ($request->phone)?$request->phone:$user->phone;
        $user->email             = ($request->email)?$request->email:$user->email;
        if($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $imageName = $this->UpdateImage($file, 'assets/users/'.$user->id);
            $user->profile_image = 'assets/users/'.$user->id.'/'.$imageName;
        }
        $user->save(); 
        
        DB::commit();
        return ResponseBuilder::successMessage("Profile updated successfully", $this->success);
    } catch (\Throwable $th) {
        DB::rollback();
        return ResponseBuilder::error($th->getMessage(), $this->serverError);
        //throw $th;
    }
   }

   public function getProfile()
   {
        try {
            if(!Auth::guard('api')->check())
            {
                return ResponseBuilder::error("User not found", $this->unauthorized);
            }
            $user = Auth::guard('api')->user();
            $this->response = new UserResource($user);

            return ResponseBuilder::success($this->response,"User profile",$this->success);

        } catch (\Throwable $th) {
            //throw $th;
            return ResponseBuilder::error("Something went wrong", $this->serverError);
        }
   }

}