
<nav id="menu" role="navigation">
      <div class="sideNav sidenav-custome">
         <div role="navigation" id="menu2" aria-modal="true" class="offcanvas offcanvas-start show" tabindex="-1" style="transition: all 0.2s ease-in 0s; visibility: visible;">
            <!-- <div class="bg-dark offcanvas-header">
            <div class="text-white fw-bold offcanvas-title h5"> !</div>
         </div> -->
         <div class="d-flex flex-column align-items-stretch justify-content-start p-0 offcanvas-body">
            <!-- <div class="d-flex align-items-center justify-content-between p-4">
               <div class="fs-1 fw-bold text-start d-flex align-items-center justify-content-start">
                  <div class="hstack gap-2">
                     <div class="m-0 me-1 d-flex align-items-center justify-content-start"><p class="m-0" style="font-size: 21px;">Hey,</p><p class="text-truncate m-0 me-2" style="max-width: 125px;">&nbsp;</p><img src="{{url('assets/front/images/hand.webp')}}" alt="hello icon" width="36px" class="mr-2">
                        <p class="m-0 " style="font-size: 20px;" > {!! Str::limit(Auth::user()->name ?? '' , 10, '') !!} </p>
                     </div>
                  </div>
               </div>
            </div> -->
            <div class=" d-flex flex-column align-items-stretch justify-content-start">
               @if(isset(Auth::user()->id))
               <a class="text-start text-decoration-none bg-light p-3 text-dark fs-2 text-capitalize d-flex align-items-center justify-content-between" href="{{url('home')}}">
                  <div class="d-flex align-items-center justify-content-start">
                     <div class="hstack gap-3">
                        <img src="{{url('assets/front/images/play.2f22f88bac8acca85f6a.webp')}}"  class="mr-2" height="25px" alt="support icon">
                                           <p class="p-0 m-0 text-capitalize" style="font-size: 20px; ">Play</p>
                     </div>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="m-0 p-0 d-flex align-items-center justify-content-center">
                     <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                  </svg>
               </a>
               @endif
               @if(isset(Auth::user()->id))
               <a class="text-start text-decoration-none bg-light p-3 text-dark fs-2 text-capitalize d-flex align-items-center justify-content-between" href="{{url('kyc')}}">
                  <div class="d-flex align-items-center justify-content-start">
                     <div class="hstack gap-3">
                        <img src="{{url('assets/front/images/play.2f22f88bac8acca85f6a.webp')}}"  class="mr-2" height="25px" alt="support icon">
                                           <p class="p-0 m-0 text-capitalize" style="font-size: 20px; ">KYC Document</p>
                     </div>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="m-0 p-0 d-flex align-items-center justify-content-center">
                     <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                  </svg>
               </a>
               @endif
               @if(isset(Auth::user()->id))
               <a class="text-start text-decoration-none bg-light p-3 text-dark fs-2 text-capitalize d-flex align-items-center justify-content-between" href="{{url('profile')}}">
                  <div class="d-flex align-items-center justify-content-start">
                     <div class="hstack gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"  class="mr-2" height="25px" fill="currentColor"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"></path></svg>
                        <p class="p-0 m-0 text-capitalize" style="font-size: 20px; ">Profile</p>
                     </div>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="m-0 p-0 d-flex align-items-center justify-content-center">
                     <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                  </svg>
               </a>
               @endif
               @if(isset(Auth::user()->id))
               <a class="text-start text-decoration-none bg-light p-3 text-dark fs-2 text-capitalize d-flex align-items-center justify-content-between" href="{{url('wallet')}}">
                  <div class="d-flex align-items-center justify-content-start">
                     <div class="hstack gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 16 16" class="mr-2" height="25px" fill="currentColor"><path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"></path></svg>
                        <p class="p-0 m-0 text-capitalize" style="font-size: 20px;">Wallet</p>
                     </div>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="m-0 p-0 d-flex align-items-center justify-content-center">
                     <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                  </svg>
               </a>
               @endif
               @if(isset(Auth::user()->id))
               <a class="text-start text-decoration-none bg-light p-3 text-dark fs-2 text-capitalize d-flex align-items-center justify-content-between" href="{{url('game-history')}}">
                  <div class="d-flex align-items-center justify-content-start">
                     <div class="hstack gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="mr-2" viewBox="0 0 16 16" class="mr-2" height="25px" fill="currentColor"><path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"></path><path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"></path><path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"></path></svg>
                        <p class="p-0 m-0 text-capitalize" style="font-size: 20px;">Game history</p>
                     </div>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="m-0 p-0 d-flex align-items-center justify-content-center">
                     <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                  </svg>
               </a>
               @endif
               @if(isset(Auth::user()->id))
               <a class="text-start text-decoration-none bg-light p-3 text-dark fs-2 text-capitalize d-flex align-items-center justify-content-between" href="{{url('transaction-history')}}">
                  <div class="d-flex align-items-center justify-content-start">
                     <div class="hstack gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="mr-2" viewBox="0 0 16 16" class="mr-2" height="25px" fill="currentColor"><path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"></path><path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"></path><path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"></path></svg>
                        <p class="p-0 m-0 text-capitalize" style="font-size: 20px;">Transaction history</p>
                     </div>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="m-0 p-0 d-flex align-items-center justify-content-center">
                     <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                  </svg>
               </a>
               <a class="text-start text-decoration-none bg-light p-3 text-dark fs-2 text-capitalize d-flex align-items-center justify-content-between" href="{{url('manual-transaction-history')}}">
                  <div class="d-flex align-items-center justify-content-start">
                     <div class="hstack gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="mr-2" viewBox="0 0 16 16" class="mr-2" height="25px" fill="currentColor"><path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"></path><path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"></path><path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"></path></svg>
                        <p class="p-0 m-0 text-capitalize" style="font-size: 20px;">Manual Depost history</p>
                     </div>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="m-0 p-0 d-flex align-items-center justify-content-center">
                     <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                  </svg>
               </a>
               <a class="text-start text-decoration-none bg-light p-3 text-dark fs-2 text-capitalize d-flex align-items-center justify-content-between" href="{{url('refer-earn')}}">
                  <div class="d-flex align-items-center justify-content-start">
                     <div class="hstack gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 16 16" class="mr-2" height="25px" fill="currentColor"><path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z"></path></svg>
                        <p class="p-0 m-0 text-capitalize" style="font-size: 20px;">Refer &amp; Earn</p>
                     </div>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="m-0 p-0 d-flex align-items-center justify-content-center">
                     <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                  </svg>
               </a>
               @endif
               <a class="text-start text-decoration-none  bg-light  p-3 text-dark fs-2 text-capitalize d-flex align-items-center justify-content-between" href="{{url('support')}}" style="margin: 0px 0px 67px 0px;">
                  <div class="d-flex align-items-center justify-content-start">
                     <div class="hstack gap-3">
                        <img src="{{url('assets/front/images/chat-live.webp')}}"  class="mr-2" height="25px" alt="support icon">
                        <p class="p-0 m-0 text-capitalize" style="font-size: 20px;">Support</p>
                     </div>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="m-0 p-0 d-flex align-items-center justify-content-center">
                     <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                  </svg>
               </a>
            </div>
         </div>
         <!-- <a class="sideNav-options" href="{{url('profile')}}">
            <div class="sideNav-icon"><img src="{{url('assets/front/images/1.png')}}"></div>
            <div class="position-relative ml-3">
               <div class="sideNav-text">My Profile</div>
            </div>
            <div class="sideNav-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="sideNav-divider"></div>
         </a>
       
         <a class="sideNav-options" href="{{url('wallet')}}">
            <div class="sideNav-icon"><img style="width: 19px; height: 19px;" src="{{url('assets/front/images/3.png')}}"></div>
            <div class="position-relative ml-3">
               <div class="sideNav-text">My Wallet</div>
            </div>
            <div class="sideNav-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="sideNav-divider"></div>
         </a>
         <a class="sideNav-options" href="{{url('game-history')}}">
            <div class="sideNav-icon"><img src="{{url('assets/front/images/4.png')}}"></div>
            <div class="position-relative ml-3">
               <div class="sideNav-text">Games History</div>
            </div>
            <div class="sideNav-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="sideNav-divider"></div>
         </a>
         <a class="sideNav-options" href="{{url('transaction-history')}}">
            <div class="sideNav-icon"><img src="{{url('assets/front/images/5.png')}}"></div>
            <div class="position-relative ml-3">
               <div class="sideNav-text">Transaction History</div>
            </div>
            <div class="sideNav-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="sideNav-divider"></div>
         </a>
         <a class="sideNav-options" href="{{url('refer-earn')}}">
            <div class="sideNav-icon"><img src="{{url('assets/front/images/6.png')}}"></div>
            <div class="position-relative ml-3">
               <div class="sideNav-text">Refer &amp; Earn</div>
            </div>
            <div class="sideNav-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="sideNav-divider"></div>
         </a>
         <a class="sideNav-options" href="{{url('notification')}}">
            <div class="sideNav-icon"><img src="{{url('assets/front/images/7.png')}}"></div>
            <div class="position-relative ml-3">
               <div class="sideNav-text">Notification</div>
            </div>
            <div class="sideNav-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="sideNav-divider"></div>
         </a>
         <a class="sideNav-options" href="{{url('support')}}">
            <div class="sideNav-icon"><img src="{{url('assets/front/images/8.png')}}"></div>
            <div class="position-relative ml-3">
               <div class="sideNav-text">Support</div>
            </div>
            <div class="sideNav-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="sideNav-divider"></div>
         </a> -->
      </div>
   </nav>
   <style>
            .offcanvas.show:not(.hiding), .offcanvas.showing {
    /* -webkit-transform: none; */
    transform: none;
}

.bg-dark {
    --bs-bg-opacity: 1;
    background-color: rgba(33,37,41,var(--bs-bg-opacity))!important;
    background-color: rgba(var(--bs-dark-rgb),var(--bs-bg-opacity))!important;
}
.bg-dark {
    background-color: #343a40!important;
}
.offcanvas-header {
    /* align-items: center; */
    display: flex;
    justify-content: space-between;
    padding: var(--bs-offcanvas-padding-y) var(--bs-offcanvas-padding-x);
}
.offcanvas.show:not(.hiding), .offcanvas.showing {
    /* -webkit-transform: none; */
    transform: none;
}

.offcanvas.hiding, .offcanvas.show, .offcanvas.showing {
    visibility: visible;
}
.offcanvas.offcanvas-start {
    border-right: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
    left: 0;
    top: 0;
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
    width: var(--bs-offcanvas-width);
}
.offcanvas {
    background-clip: padding-box;
    background-color: var(--bs-offcanvas-bg);
    bottom: 0;
    color: var(--bs-offcanvas-color);
    display: flex;
    flex-direction: column;
    max-width: 100%;
    outline: 0;
    position: fixed;
    transition: -webkit-transform .3s ease-in-out;
    transition: transform .3s ease-in-out;
    transition: transform .3s ease-in-out,-webkit-transform .3s ease-in-out;
    visibility: hidden;
    z-index: var(--bs-offcanvas-zindex);
}
.offcanvas, .offcanvas-lg, .offcanvas-md, .offcanvas-sm, .offcanvas-xl, .offcanvas-xxl {
    --bs-offcanvas-zindex: 1045;
    --bs-offcanvas-width: 400px;
    --bs-offcanvas-height: 30vh;
    --bs-offcanvas-padding-x: 1rem;
    --bs-offcanvas-padding-y: 1rem;
    --bs-offcanvas-color: ;
    --bs-offcanvas-bg: #fff;
    --bs-offcanvas-border-width: 1px;
    --bs-offcanvas-border-color: var(--bs-border-color-translucent);
    --bs-offcanvas-box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
}
.offcanvas-header .btn-close {
    margin-bottom: calc(var(--bs-offcanvas-padding-y)*-.5);
    margin-right: calc(var(--bs-offcanvas-padding-x)*-.5);
    margin-top: calc(var(--bs-offcanvas-padding-y)*-.5);
    padding: calc(var(--bs-offcanvas-padding-y).5) calc(var(--bs-offcanvas-padding-x).5);
}
.btn-close {
    
    border: 0;
    border-radius: 0.375rem;
    box-sizing: initial;
    color: #000;
    height: 1em;
    opacity: .5;
    padding: 0.25em;
    width: 1em;
}
.gap-2 {
    gap: 0.5rem!important;
}

.hstack, .vstack {
    align-self: stretch;
    display: flex;
}
.hstack {
    align-items: center;
    flex-direction: row;
}
.me-1 {
    margin-right: 0.25rem!important;
}

.m-0 {
    margin: 0!important;
}
.align-items-center {
    align-items: center!important;
}
.justify-content-start {
    justify-content: flex-start!important;
}
.d-flex {
    display: flex!important;
}
p {
    margin-bottom: 1rem;
    margin-top: 0;
}
   </style>