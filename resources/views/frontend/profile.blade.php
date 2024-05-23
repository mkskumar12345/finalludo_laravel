@extends('layouts.frontend')
@section('content')
<!-- <div class="p-3" style="background: rgb(250, 250, 250);">
   <div class="center-xy py-2">
      <div><img class="border-50" height="80px" width="80px" src="{{url('assets/front/images/author.svg')}}" alt=""></div>
      <div class="text-bold my-3">+91{{Auth::user()->phone}} <small data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><img class="ml-2" width="20px" src="images/icon-edit.jpg"
               alt=""></small></div>
   
      
       <div class="collapse mb-3" id="collapseExample">
         <div class="card card-body p-0">
            <input type="text" class="form-control">
         </div>
       </div>
      <a class="d-flex align-items-center profile-wallet w-100" href="{{url('wallet')}}">
         <div class="ml-4"><img width="32px" src="{{url('assets/front/images/sidebar-wallet.png')}}" alt=""></div>
         <div class="ml-5 mytext text-muted ">My Wallet</div>
      </a>
   </div>
   </div>
   <div class="divider-x"></div>
   <div class="p-3">
   <div class="text-bold">Complete Profile</div>
   <div class="kyc-complete">
   
   
      <div class="react-swipeable-view-container ">
         <div>
            <a class="d-flex align-items-center profile-wallet bg-light mx-1 mt-3 py-3" href="#">
               <div class="ml-4"><img width="32px" src="{{url('assets/front/images/kyc-icon-new.png')}}" alt=""></div>
               <div class="ml-5 mytext text-muted ">Complete KYC</div>
            </a>
         </div>
         <div>
            <a class="d-flex align-items-center profile-wallet bg-light mx-1 my-3 py-3" href="#">
               <div class="ml-4"><img width="32px" src="{{url('assets/front/images/mail.png')}}" alt=""></div>
               <div class="ml-5 mytext text-muted ">Update Email ID</div>
            </a>
         </div>
      </div>
   
   
   </div>
   </div>
   <div class="divider-x"></div>
   <div class="px-3 py-1">
   <div class="d-flex align-items-center position-relative" style="height: 84px;">
      <picture><img height="32px" width="32px" src="{{url('assets/front/images/sidebar-referEarn.png')}}" alt=""></picture>
      @if(Auth::user()->refer_by)
      <div class="pl-4">
         
         <div>
            <div class="MuiFormControl-root MuiTextField-root" style="vertical-align: bottom;">
               <div
                  class="MuiInputBase-root MuiInput-root MuiInput-underline MuiInputBase-formControl MuiInput-formControl">
                  <span>{{Auth::user()->refer_by ?? ''}}</span>
               </div>
            </div>
         </div>
      </div>
      @else
      <div class="pl-4">
         <div class="text-uppercase moneyBox-header" style="font-size: 0.8em;">Use Refer Code</div>
         <div>
            <div class="MuiFormControl-root MuiTextField-root" style="vertical-align: bottom;">
               <div
                  class="MuiInputBase-root MuiInput-root MuiInput-underline MuiInputBase-formControl MuiInput-formControl">
                  <input  type="text" class="MuiInputBase-input MuiInput-input refer_code_class" value="">
               </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class='refer_code_ie' style="cursor: pointer;" viewBox="0 0 24 24" width="24" height="24"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11.0026 16L18.0737 8.92893L16.6595 7.51472L11.0026 13.1716L8.17421 10.3431L6.75999 11.7574L11.0026 16Z" fill="rgba(47,234,10,1)"></path></svg>
         </div>
      </div>
      @endif
     
   </div>
   </div>
   <div class="px-3 py-1">
   <div class="d-flex align-items-center position-relative" style="height: 84px;">
      <picture><img height="32px" width="32px" src="{{url('assets/front/images/global-cash-won-green-circular.png')}}" alt="">
      </picture>
      <div class="pl-4">
         <div class="text-uppercase moneyBox-header" style="font-size: 0.8em;">Cash Won</div>
         <div>
            <picture class="mr-1"><img height="auto" width="21px" src="{{url('assets/front/images/global-rupeeIcon.png')}}" alt="">
            </picture>
            <span class="moneyBox-text" style="font-size: 1em; bottom: -1px;">₹{{number_format(Auth::user()->wallet,2)}}</span>
         </div>
         <span class="thin-divider-x"></span>
      </div>
   </div>
   </div>
   <div class="px-3 py-1">
   <div class="d-flex align-items-center position-relative" style="height: 84px;">
      <picture><img height="32px" width="32px" src="{{url('assets/front/images/award-logo.png')}}" alt=""></picture>
      <div class="pl-4">
         <div class="text-uppercase moneyBox-header" style="font-size: 0.8em;">Battle Played</div>
         <div><span class="moneyBox-text" style="font-size: 1em; bottom: -1px;">{{$gameChallange ?? '0'}}</span></div>
      </div>
   </div>
   </div>
   <div class="divider-x"></div>
   <div class="p-3"><a href="#!" class="center-xy text-muted text-uppercase py-4 font-weight-bolder">Log Out</a>
   </div> -->
<div class=" col-12 mx-auto p-3 g-0">
   <div class="mb-3 shadow card">
      <div class="bg-light text-dark text-capitalize card-header"style="text-align: center;">profile</div>
      <div class="card-body">
         <div class="avatar-upload">
            <div class="avatar-edit">
               <form action="{{url('update-profile-img')}}" method="POST" id="update-profile" enctype="multipart/form-data">
                  @csrf
                <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                <label for="imageUpload"></label>
               </form>
            </div>
            <div class="avatar-preview">
                <div id="imagePreview" style="background-image: url('{{!empty(Auth::user()->profile_image) ? Auth::user()->profile_image : url('/assets/front/images/avatar.png')}}');">
                </div>
            </div>
        </div>
         <!-- <div class="d-flex align-items-center justify-content-center">
            <div style="height: 80px; width: 80px;">
               <div class="bg-success rounded-circle position-relative shadow" style="width: 60px; height: 60px;">
               <img src="" alt="" class="profile_pic">

                            
               </div>
            </div>
            
         </div> -->
         <div class="d-flex flex-column align-items-start justify-content-center mb-3 mt-1">
            <label class="form-label text-capitalize">username</label>
            <div class="align-self-stretch d-flex align-items-center">
               <input type="text" class="form-control me-2 save_user_name_input" maxlength="15" value="{{Auth::user()->name ?? ''}}">
               <button class="btn btn-success text-capitalize btn-sm align-self-stretch ml-2 save_user_name" style="width: 73px;font-size: 15px;" >save</button>
            </div>
         </div>
        
      
         <div class="d-flex flex-column align-items-start justify-content-center mb-3">
            <label class="form-label text-capitalize">mobile number</label>
            <div class="align-self-stretch"><input type="number" class="form-control" readonly="" disabled="" value="{{Auth::user()->phone ?? ''}}"></div>
         </div>

         
      </div>
   </div>
   
   <div class="mb-3 shadow card">
      <div class="bg-light text-dark card-header">Metrics</div>
      <div class="card-body">
         <div class="g-0 gx-2  row">
            <div class="col-xl-6 col-lg-6 col-sm-6 col-12 mt-1 ">
               <div class="d-flex flex-column align-items-stretch justify-content-start h-100 w-100 card">
                  <div class="text-capitalize text-start px-2 card-header" style="font-size: 0.9rem;">
                     <div class="hstack gap-1"><img src="{{url('assets/front/images/sword.9cc91e4925dc62491c20.webp')}}" width="16px"><span class="ml-1">games played</span>
                     </div>
                  </div>
                  <div class="fs-5 fw-semibold text-start py-1 px-2 card-body">{{$gameChallange ?? '0'}}</div>
               </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-sm-6 col-12 mt-1 ">
               <div class="d-flex flex-column align-items-stretch justify-content-start h-100 w-100 card">
                  <div class="text-capitalize text-start px-2 card-header" style="font-size: 0.9rem;">
                     <div class="hstack gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
                           <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"></path>
                           <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                           <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                        <span class="ml-1">Won Amount</span>
                     </div>
                  </div>
                  <div class="fs-5 fw-semibold text-start py-1 px-2 card-body">₹{{number_format($amount,2)}}</div>
               </div>
            </div>
         </div>
         <div class="g-0 gx-2 row">
            <div class="col-xl-6 col-lg-6 col-sm-6 col-12 mt-1 ">
               <div class="d-flex flex-column align-items-stretch justify-content-start h-100 w-100 card">
                  <div class="text-capitalize text-start px-2 card-header" style="font-size: 0.9rem;">
                     <div class="hstack gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
                           <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"></path>
                        </svg>
                        <span class="ml-1">referral earning</span>
                     </div>
                  </div>
                  <div class="fs-5 fw-semibold text-start py-1 px-2 card-body">₹{{number_format($referAmout,2)}}</div>
               </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-sm-6 col-12 mt-1 ">
               <div class="d-flex flex-column align-items-stretch justify-content-start h-100 w-100 card">
                  <div class="text-capitalize text-start px-2 card-header" style="font-size: 0.9rem;">
                     <div class="hstack gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
                           <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                        </svg>
                        <span class="ml-1">Penalty</span>
                     </div>
                  </div>
                  <div class="fs-5 fw-semibold text-start py-1 px-2 card-body">₹0.00</div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="d-grid py-2">
      <a href="{{url('logout')}}"> <button type="button" class="text-capitalize btn btn-outline-danger"style="margin-top: -19px;width:100%;">logout</button></a>
   </div>
</div>
<style>
  
.avatar-upload {
   position: relative;
    max-width: 120px;
    margin: 0px auto;
}
.avatar-upload .avatar-edit {
  position: absolute;
  right: 12px;
  z-index: 1;
  top: 10px;
}
.avatar-upload .avatar-edit input {
  display: none;
}
.avatar-upload .avatar-edit input + label {
  display: inline-block;
  width: 34px;
  height: 34px;
  margin-bottom: 0;
  border-radius: 100%;
  background: #FFFFFF;
  border: 1px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  font-weight: normal;
  transition: all 0.2s ease-in-out;
}
.avatar-upload .avatar-edit input + label:hover {
  background: #f1f1f1;
  border-color: #d6d6d6;
}
.avatar-upload .avatar-edit input + label:after {
  content: "\f040";
  font-family: 'FontAwesome';
  color: #757575;
  position: absolute;
  top: 5px;
  left: 0;
  right: 0;
  text-align: center;
  margin: auto;
}
.avatar-upload .avatar-preview {
  width: 98px;
  height: 98px;
  position: relative;
  border-radius: 100%;
  border: 6px solid #F8F8F8;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
.avatar-upload .avatar-preview > div {
  width: 100%;
  height: 100%;
  border-radius: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}

</style>
@endsection