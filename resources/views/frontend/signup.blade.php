@extends('layouts.frontend-auth')
@section('content')
<div class="headerContainer">
   
      <a href="{{url('/')}}">
         <div class="ml-2 navLogo d-flex"><img src="{{url('assets/front/images/logo.png')}}" alt=""></div>
      </a>
      <div class="menu-items"><a type="button" class="login-btn" href="{{url('login')}}">LOGIN</a></div>
      <span class="mx-5"></span>
   </div> 
   <div class="leftContainer splash-bg" style="background-image:url({{url('assets/front/images/splash-bg.png')}});">
 
      <div class="main-area " >
         <div class=" w-100 center-xy mx-auto sign-otp">
            <form>
            <div class="sign-up-screen">
            <div class="sign-up-title text-white mb-4">Sign up</div>
            <div class="bg-white cxy flex-column">
               <div class="input-group">
                  <div class="input-group-prepend">
                  <div class="input-group-text">+91</div>
               </div>
               <input class="form-control mobile" name="mobile" type="tel" placeholder="Mobile number" value="">
               
            </div>
           
            <div class="input-group pt-2">
               <div class="input-group-prepend">
                  <div class="input-group-text">OTP</div>
               </div>
               <input class="form-control" name="otp" type="tel" placeholder="Enter OTP" autocomplete="off" value="">
               </div></div>
               <input type="submit" value="Submit" class="submit-signup send_otp"></div>
            </div>
         </form>
   </div>
   <div class="divider-y"></div>
   <div class="rightContainer">
      <div class="rcBanner flex-center">
         <div class="rcBanner-img-container"><img src="{{url('assets/front/images/logo.png')}}" alt=""></div>
         <div class="rcBanner-text">Khel Bhai <span class="rcBanner-text-bold">Win Real Cash!</span></div>
      </div>
   </div>
                  @endsection