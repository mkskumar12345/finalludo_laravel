@extends('layouts.frontend')
@section('content')
<!-- <div class="center-xy">
   <div class="mt-1"><img width="226px" src="{{url('assets/front/images/referral-user-welcome.png')}}" alt=""></div>
   <div class="mb-1">
      <div class="font-15">Earn now unlimited <span role="img" aria-label="party-face">🥳</span></div>
      <div class="d-flex justify-content-center">Refer your friends now!</div>
      <div class="text-bold mt-3 text-center">Your Refer Code: {{Auth::user()->refer_code ?? ''}}</div>
      <div class="d-flex justify-content-center">Total Refers:&nbsp;<b>{{$refer ?? '0'}}</b></div>
   </div>
   </div>
   <div class="divider-x"></div>
   <div class="mx-3 my-3">
   <div class="font-11">Refer &amp; Earn Rules</div>
   <div class="d-flex align-items-center m-3">
      <div><img width="82px" src="{{url('assets/front/images/refer-friend.webp')}}" alt=""></div>
      <div class="font-9 mx-3" style="width: 63%;">
         <div>When your friend signs up on KhelBro from your referral link,</div>
         <div class="font-8 c-green mt-2">You get <strong>1% Commission</strong> on your <strong>referral's winnings.</strong></div>
      </div>
   </div>
   <div class="d-flex align-items-center m-3">
      <div><img width="82px" src="{{url('assets/front/images/cash.webp')}}" alt=""></div>
      <div class="font-9 mx-3" style="width: 63%;">
         <div>Suppose your referral plays a battle for ₹10000 Cash,</div>
         <div class="font-8 c-green mt-2">You get <strong>₹100 Cash</strong> <strong></strong></div>
      </div>
   </div>
   </div>
   <div style="padding-bottom: 80px;"></div>
   <div class="refer-footer">
   <button class="bg-green refer-button cxy w-100">Share in Whatsapp</button>
   <button class="refer-button-copy ml-2 d-flex">
      <div><a class="copy-btn" href="#"><i class="fa fa-clone" aria-hidden="true"></i></a></div>
   </button>
   </div> -->
<div class=" col-12 mx-auto p-3 g-0">
   <div>
      <div class="mb-3 card">
         <div class="bg-light text-dark card-header" style="text-align: center;">Your Referral Earnings</div>
         <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
               <div class="d-flex flex-column border-end flex-grow-1 align-items-center justify-content-center"><span class="text-capitalize fw-bold" style="font-size: 0.8rem;"><b>referred players</b></span><span>{{$refer}}</span></div>
               <div class="d-flex flex-column align-items-center justify-content-center flex-grow-1"><span class="text-capitalize fw-bold" style="font-size: 0.8rem;"><b>Referral Earning</b></span><span>₹{{number_format(($referAmout ?? 0),2)}}</span></div>
            </div>
         </div>
      </div>
      <div class="mb-3 card">
         <div class="bg-light text-dark card-header" style="text-align: center;">Referral Code</div>
         <div class="card-body">
            <div>
               <div><img src="https://ludo-players.s3.ap-south-1.amazonaws.com/cdn/lp/illustrations/refer.webp" alt="refer" class="w-75"></div>
               <div>
                  <div>
                     <div>
                        <div class="input-group"><input type="text" class="form-control p-2" id="refer-code-ccc" disabled="" value="{{Auth::user()->refer_code ?? ''}}"><button class="btn btn-primary text-uppercase ml-2" onclick="copyReferCode()" style="width: 68px !important;">copy</button></div>
                        <div class="input-group d-none"><input type="text" class="form-control p-2" id="refer-code-url" disabled="" value="{{url('register?refer-code='.Auth::user()->refer_code)}}"></div>
                     </div>
                  </div>
                  <p class="text-uppercase fw-bold fs-3  mt-1 mb-2"style="text-align: center;"><b>or</b></p>
                  <div class="d-grid">
                     <a href="https://api.whatsapp.com/send/?text=Play Ludo and earn Rs10000 daily.%0ACommission Charge - 5% Only%0AReferral - 2% On All Games%0A24x7 Live Chat Support%0AInstant Withdrawal Via UPI/Bank%0ARegister Now, My refer code is {{Auth::user()->refer_code}}.%0A👇👇%0A{{url('register?refer-code='.Auth::user()->refer_code)}}">
                        <button class="btn btn-success btn-md w-100"style="font-size: 12px;">
                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="me-2">
                              <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
                           </svg>
                           <span class="text-capitalize">share on whatsapp</span>
                        </button>
                     </a>
                  </div>
                  <div class="d-grid mt-2">
                     <button class="btn btn-secondary btn-md w-100"style="font-size: 12px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="me-2">
                           <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"></path>
                           <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"></path>
                        </svg>
                        <span class="text-capitalize" onclick="copyReferCodeURL()">copy to clipboard</span>
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="mb-3 card">
         <div class="bg-light text-dark card-header">How It Works</div>
         <div class="card-body">
            <ul class="list-group">
               <li class="list-group-item">You can refer and <b>Earn {{$refer_amount}}%</b> of your referral winning, every time</li>
               <li class="list-group-item">Like if your player plays for <b>₹10000</b> and wins, You will get <b>₹ {{10000*$refer_amount/100}}</b> as referral amount.</li>
            </ul>
         </div>
      </div>
   </div>
</div>
@endsection