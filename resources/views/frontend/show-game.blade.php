@extends('layouts.frontend')
@section('content')
<div class="modal modal-bottom fade" id="won_model" tabindex="-1" role="dialog" aria-labelledby="won_model">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="offcanvas-body">
                <div class="pb-3 d-flex flex-column align-items-stretch">
                   <div class="gap-3">
                      <h5 class="text-capitalize">upload result</h5>
                      <form action="" id="post-result" enctype="multipart/form-data">
                        @csrf
                      <input type="file" value="" hidden="">
                      <input type="hidden" value="winner"  name="result" hidden="">
                      <input type="hidden" value="{{$gameChallange->slug}}"  name="challange_id" hidden="">
                      <div class="btn btn-primary btn-lg  fileUpload" style="width: 100%;">
                        <input type="file" class="upload" id="upload_sreenshot" name="image" accept="image/*">
                        <span>Upload Image</span>
                    </div>
                      <button type="submit"  class="btn btn-success btn-lg mt-1 post_btn" style="width: 100%;">Post Result</button>
                    </form>
                   </div>
                </div>
             </div>
        </div>
        <div class="modal-footer modal-footer-fixed d-none">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<div class="modal modal-bottom fade" id="loose_model" tabindex="-1" role="dialog" aria-labelledby="loose_model">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="offcanvas-body">
                <div class="pb-3 d-flex flex-column align-items-stretch">
                   <div class="gap-3">
                      <h5 class="text-capitalize">upload result</h5>
                      <form action="" id="post-result-looser" enctype="multipart/form-data">
                     @csrf
                      <input type="file" value="" hidden="">
                      <input type="hidden" value="looser"  name="result" hidden="">
                      <input type="hidden" value="{{$gameChallange->slug}}"  name="challange_id" hidden="">
                      <h6 class="text-danger"> Are you sure you are looser</h6>
                      <button type="submit"  class="btn btn-success btn-lg mt-1 post_btn_looser" style="width: 100%;">Post Result</button>
                    </form>
                   </div>
                </div>
             </div>
        </div>
        <div class="modal-footer modal-footer-fixed d-none">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<div class="modal modal-bottom fade" id="cancel_model" tabindex="-1" role="dialog" aria-labelledby="cancel_model">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="offcanvas-body">
                <div class="pb-3 d-flex flex-column align-items-stretch">
                   <div class="gap-3">
                      <!-- <h5 class="text-capitalize">upload result</h5> -->
                      <form action="" id="cancel-challange" enctype="multipart/form-data">
                     @csrf
                     <!-- <h5 class="text-capitalize">we would like to know more</h5> -->
                     <h6 class="text-capitalize">select reason for cancelling</h6>

                     <div class="radio-buttons mt-2">
    <label class="custom-radio">
      <input type="radio" name="reason" checked value="Don't want to Play">
      <span class="radio-btn"><i class="las la-check"></i>
        <div class="hobbies-icon">
        
          <h6 class="">Don't want to Play</h6>
        </div>
      </span>
    </label>
    <label class="custom-radio">
      <input type="radio" name="reason" value="Not Playing">
      <span class="radio-btn"><i class="las la-check"></i>
        <div class="hobbies-icon">
                      
          <h6 class="">Not Playing</h6>
        </div>
      </span>
    </label>
    <label class="custom-radio">
      <input type="radio" name="reason" value="Not Joined">
      <span class="radio-btn"><i class="las la-check"></i>
        <div class="hobbies-icon">
         
          <h6 class="">Not Joined</h6>
        </div>
      </span>
    </label>
    <label class="custom-radio">
      <input type="radio" name="reason" value="No Room Code">
      <span class="radio-btn"><i class="las la-check"></i>
        <div class="hobbies-icon">
          
          <h6 class="">No Room Code</h6>
        </div>
      </span>
    </label>
    <label class="custom-radio">
      <input type="radio" name="reason" value="Opponent Abusing">
      <span class="radio-btn"><i class="las la-check"></i>
        <div class="hobbies-icon">
          
          <h6 class="">Opponent Abusing</h6>
        </div>
      </span>
    </label>
    <label class="custom-radio">
      <input type="radio" name="reason" value="Game Not Start">
      <span class="radio-btn"><i class="las la-check"></i>
        <div class="hobbies-icon">
          
          <h6 class="">Game Not Start</h6>
        </div>
      </span>
    </label>
    <label class="custom-radio">
      <input type="radio" name="reason" value="Other">
      <span class="radio-btn"><i class="las la-check"></i>
        <div class="hobbies-icon">
          
          <h6 class="">Other</h6>
        </div>
      </span>
    </label>
    
  </div>

                     <!-- <div class="row row-cols-auto g-2 py-3 container-fluid">
                        <div class="col mt-1"><span class="py-2 px-3 badge rounded-pill bg-secondary">No Room Code</span></div>
                        <div class="col mt-1"><span class="py-2 px-3 badge rounded-pill bg-secondary">Not Joined</span></div>
                        <div class="col mt-1"><span class="py-2 px-3 badge rounded-pill bg-secondary">Not Playing</span></div>
                        <div class="col mt-1"><span class="py-2 px-3 badge rounded-pill bg-secondary">Don't want to Play</span></div>
                        <div class="col mt-1"><span class="py-2 px-3 badge rounded-pill bg-secondary">Opponent Abusing</span></div>
                        <div class="col mt-1"><span class="py-2 px-3 badge rounded-pill bg-secondary">Game Not Start</span></div>
                        <div class="col mt-1"><span class="py-2 px-3 badge rounded-pill bg-secondary">Other</span></div>
                     </div> -->
                      <!-- <input type="hidden" value="looser"  name="result" hidden=""> -->
                      <input type="hidden" value="{{$gameChallange->slug}}"  name="challange_id" hidden="">
                      <button type="submit"  class="btn btn-success btn-lg mt-1" style="width: 100%;">Submit</button>
                    </form>
                   </div>
                </div>
             </div>
        </div>
        <div class="modal-footer modal-footer-fixed d-none">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<div class=" col-12 mx-auto p-3 g-0">
   <div>
      <div class="d-flex alig-items-center justify-content-between mt-1 mb-3">
        <a href="{{url()->previous()}}"> <button type="button" class="text-capitalize btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="me-2">
               <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
            </svg>
            <span class="text-capitalize"style="font-size: 13px;">Back</span>
         </button></a>
         <div class="d-grid" data-toggle="modal" data-target="#rules_modal">
            <button type="button" class="d-flex align-items-center justify-content-center btn btn-outline-danger">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em" fill="red" class="me-1">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
               </svg>
               <span class="text-capitalize"style="font-size: 13px;">rules</span>
            </button>
         </div>
      </div>
      <div class="mb-3 shadow card">
         <div class="text-start card-body">
            <div class=" row">

               <div class="d-flex flex-column vstack gap-2 col-4 pl-5">
                  <div class="avatar-upload">
                    
                     <div class="avatar-preview">
                         <div id="imagePreview" style="background-image: url('@if(!empty($gameChallange->createBy->profile_image))  {{url($gameChallange->createBy->profile_image)}} @else {{url(url('/assets/front/images/avatar.png'))}} @endif');">
                         </div>
                     </div>
                 </div>
                  <!-- <div class=" rounded-circle me-2" style="height: 24px; width: 24px;"> -->
                  <!-- <img style="width: 38px;" src="@if(!empty($gameChallange->createBy->profile_image))  {{url($gameChallange->createBy->profile_image)}} @else {{url(url('/assets/front/images/avatar.png'))}} @endif" ></div> -->
                  <span class="fw-semibold text-truncate text-start" style="width: 100px;">{{$gameChallange->createBy->name ?? 'Guest User'}}</span>
               </div>
               <div class="d-flex flex-column align-items-center vstack gap-2 col-4"><span><em>
                <img src="/assets/front/images/vs.c153e22fa9dc9f58742d.webp" alt="verses-icon" width="24"></em>
            </span><span class="text-success fw-bold text-center"><b>₹{{$gameChallange->amount}}</b></span></div>

               <div class="d-flex flex-column vstack gap-2 col-4 pl-5">
                  <!-- <div class=" rounded-circle" style="height: 24px; width: 24px;">
                  <img style="width: 38px;" src="@if(!empty($gameChallange->acceptedBy->profile_image))  {{url($gameChallange->acceptedBy->profile_image)}} @else {{url(url('/assets/front/images/avatar.png'))}} @endif" >
                  
                </div> -->
                <div class="avatar-upload">
                    
                  <div class="avatar-preview">
                      <div id="imagePreview" style="background-image: url('@if(!empty($gameChallange->acceptedBy->profile_image))  {{url($gameChallange->acceptedBy->profile_image)}} @else {{url(url('/assets/front/images/avatar.png'))}} @endif');">
                      </div>
                  </div>
              </div>
              <span class=" fw-semibold text-truncate text-end" style="width: 100px;">{{$gameChallange->acceptedBy->name ?? 'Guest User'}}</span>
               </div>
            </div>
         </div>
      </div>
      <div class="mb-2 shadow card">
         <div class="card-body" style="font-size: 80%; color: red;font-family: inherit;">Opponent का एक टोकन खुलने के बाद तुरंत यदि आप Game Left करते हो तो Opponent को 30% Win कर दिया जायेगा ! Auto Exit के केस में Admins का निर्णय ही अंतिम होगा जिससे आपको मान न होगा ! लेकिन यदि आप गेम को जान भुजकर Auto Exit में छोड़ देते है तो आपको Loss कर दिया जायेगा ! ध्यान रहे यदि किसी भी केस में Opponent की 2 काटी बहार आ जाती है तो आप पूरा गेम Loss ही होंगे !</div>
      </div>
      <div class="mb-3 shadow card">
         <div class="bg-light text-dark text-capitalize card-header" style="text-align: center;">room code</div>
         @if(!empty($gameChallange->room_code))
         <div class="card-body">
            <h3 class="py-3 fw-bold"style="text-align: center;"><b>{{$gameChallange->room_code}}</b></h3>
            <input type="text" class="d-none"  value="{{$gameChallange->room_code}}" id="copy-room-code">
            <div class="d-grid">
               <button onclick="copyRoomCode()" class="btn btn-primary text-capitalize d-flex align-items-center justify-content-center" style="width: 100%;">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em" fill="white" class="me-1">
                     <path fill-rule="evenodd" d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1Zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5v-1Zm-2 0h1v1A2.5 2.5 0 0 0 6.5 5h3A2.5 2.5 0 0 0 12 2.5v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2Z"></path>
                  </svg>
                  <span class="roomm-code">copy code</span>
               </button>
            </div>
            </div>
         </div>
         @elseif($gameChallange->challenge_created_by == Auth::user()->id)
         <div class="card-body">
            <h3 class="py-3 fw-bold"style="text-align: center;">
                <input type="number" pattern=".{8}" title="Enter exactly 8 characters" id="room_code" class="form-control" placeholder="Enter Room Code">

                <!--<input type="number" min="1" id="room_code" class="form-control" placeholder="Enter Room Code">-->
                </h3>
            <h3 class=""style="text-align: center;"><input type="text" id="challagne_slug" class="d-none" value="{{$gameChallange->slug}}"></h3>
            <div class="d-grid">
               <button class="roomm-code-save btn btn-success text-capitalize d-flex align-items-center justify-content-center" style="width: 100%;">
                  <span class="">Save</span>
               </button>
            </div>
            </div>
         </div>
         @else
         <div class="card-body">
            <h3 class="py-3 fw-bold"style="text-align: center;"><b class="wait-room-code-{{$gameChallange->slug}}"><div class="blink-hard"style="font-size:  21px !important;color: green;">Wait For Room Code</div></b></h3>
            <input type="text" class="d-none copy-room-codess-{{$gameChallange->slug}}"  value="" id="copy-room-codes-copy">
            <div class="d-grid">
               <button onclick="copyRoomCodeq()"  class="btn btn-primary text-capitalize d-flex align-items-center justify-content-center" style="width: 100%;">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em" fill="white" class="me-1">
                     <path fill-rule="evenodd" d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1Zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5v-1Zm-2 0h1v1A2.5 2.5 0 0 0 6.5 5h3A2.5 2.5 0 0 0 12 2.5v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2Z"></path>
                  </svg>
                  <span class="roomm-code">copy code</span>
               </button>
            </div>
            </div>
         </div>
         @endif
      </div>
      @php
       if($gameChallange->challenge_created_by == Auth::user()->id){
         $roleValue = 'creator_action';
        }elseif($gameChallange->challenge_accepted_by == Auth::user()->id){
         $roleValue = 'acceptor_action';

        }
        if($roleValue == 'creator_action'){
            $actionValue = $gameChallange->challangeResult->creator_action ?? '';
           }elseif($roleValue == 'acceptor_action'){
            $actionValue = $gameChallange->challangeResult->acceptor_action ?? '';
           }

       @endphp
       <!-- {{ $gameChallange->challangeResult}} -->
      @if(!isset($actionValue) || empty($actionValue))
      <div class="mb-3 shadow card">
         <div class="bg-light text-dark text-capitalize card-header"style="text-align: center;">game result</div>
         <div class="card-body">
            <p>After completion of your game, select the status of the game and post your screenshot below</p>
            <div class="d-flex flex-column align-content-stretch">
                <button class="btn btn-success btn-lg text-uppercase mb-3" style="width: 100%;" data-toggle="modal" data-target="#won_model"><b>i won</b></button>
                <button class="btn btn-danger btn-lg text-uppercase mb-3" style="width: 100%;" data-toggle="modal" data-target="#loose_model"><b>i lost</b></button>
                <button class="btn btn-outline-dark btn-lg text-uppercase" style="width: 100%;" data-toggle="modal" data-target="#cancel_model"><b>cancel</b></button>
            </div>
         </div>
      </div>
      @else
      <div class="mb-3 shadow card">
        <div class="bg-light text-dark text-capitalize card-header"style="text-align: center;">game result</div>
        <div class="card-body">
            <span>Result:-</span>
            @if($actionValue=='looser')
            <p class="text-danger">Lose</p>
            @endif
            @if($actionValue=='winner')
            <p class="text-green">Winner</p>
            <div>
                <img  style="width: 100%;" src="@if(isset($gameChallange->challangeResult) && !empty($gameChallange->challangeResult->creator_image)) {{url('assets/challangeResult',$gameChallange->challangeResult->creator_image)}} @endif 
                @if(isset($gameChallange->challangeResult) && !empty($gameChallange->challangeResult->acceptor_image)) {{url('assets/challangeResult',$gameChallange->challangeResult->acceptor_image)}} @endif" alt="">
            </div>
            @endif
          
        </div>
     </div>
      @endif
      <div class="card">
         <div class="card-header">Penalty</div>
         <div class="card-body">
            <table class="table table-striped table-bordered table-hover">
               <thead>
                  <tr>
                     <th>Amount</th>
                     <th>Reason</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>₹100</td>
                     <td>Fraud / Fake Screenshot</td>
                  </tr>
                  <tr>
                     <td>₹50</td>
                     <td>Wrong Update</td>
                  </tr>
                  <tr>
                     <td>₹50</td>
                     <td>No Update</td>
                  </tr>
                  <tr>
                     <td>₹25</td>
                     <td>Abusing</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
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
    width: 33px;
    height: 33px;
    position: relative;
    border-radius: 100%;
    /* border: 6px solid #F8F8F8; */
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
      .main-container 
{
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.main-container h2 
{
  margin: 0 0 80px 0;
  color: #555;
  font-size: 30px;
  font-weight: 300;
}

.radio-buttons 
{
  width: 100%;
  margin: 0 auto;
  text-align: center;
}

.custom-radio input 
{
  display: none;
}
.blink-hard {
  animation: blinker 1s step-end infinite;
}
.blink-soft {
  animation: blinker 1.5s linear infinite;
}
@keyframes blinker {
  50% {
    opacity: 0;
  }
}

.radio-btn 
{
   margin: 7px;
    width: 208px;
    height: 26px;
    border: 3px solid transparent;
    display: inline-block;
    border-radius: 10px;
    position: relative;
    text-align: center;
    box-shadow: 0 0 20px #bcb6b667;
    cursor: pointer;
}

.radio-btn > i {
  color:black;
  background-color:black;
  font-size: 20px;
  position: absolute;
  top: -15px;
  left: 50%;
  transform: translateX(-50%) scale(2);
  border-radius: 50px;
  padding: 3px;
  transition: 0.5s;
  pointer-events: none;
  opacity: 0;
  border: 1px solid black;
}

.radio-btn .hobbies-icon 
{
  /* width: 150px;
  height: 150px;
  position: absolute;
  top: 40%;
  left: 50%; */
  /* transform: translate(-50%, -50%); */
}
.radio-btn .hobbies-icon img
{
  display:block;
  width:100%;
  margin-bottom:20px;
  
}
.radio-btn .hobbies-icon i 
{
  color: #FFDAE9;
  line-height: 80px;
  font-size: 60px;
}

.radio-btn .hobbies-icon h3 
{
  color: #555;
  font-size: 18px;
  font-weight: 300;
  text-transform: uppercase;
  letter-spacing:1px;
}

.custom-radio input:checked + .radio-btn 
{
  border: 2px solid #FFDAE9;
}

.custom-radio input:checked + .radio-btn > i 
{
  opacity: 1;
  transform: translateX(-50%) scale(1);
}

     </style>
     <script>
     var pusher = new Pusher('fc9cac60781277a7bee9', {
        cluster: 'ap2',
        encrypted: true
      });
      
       var SaveRoom = pusher.subscribe('SaveRoomCode');
       
        SaveRoom.bind('App\\Events\\SaveRoomCode', function(data) {
        $(".wait-room-code-"+data.data.slug).html(data.data.code);
            $(".copy-room-codess-"+data.data.slug).val(data.data.code);
        });
        
         $(document).on("click", ".roomm-code-save", function () {
        var room_code = $('#room_code').val();
        var challagne_slug = $('#challagne_slug').val();
        var this_val = $(this);
        if(room_code == ''){
            toastr.error('Enter room code');
            return false;
        }
        if(!$.isNumeric(room_code)){
            toastr.error('Room code must be integer');
            return false;
        }
        if (room_code.length != 8) {
            toastr.error('Enter a valid room code with exactly 8 characters');
            return false;
        }
        return;
         $.ajax({
           url: '/save-room-code',
           type: "get",
           data:{
            room_code:room_code,
            challagne_slug:challagne_slug,
            },
           headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content") },
           beforeSend: function () {
             $(".ajax-load").show();
           },
         })
           .done(function (data) {
            if(data.status==false){
                toastr.error(data.message);
            }
            if(data.status==true){
              toastr.success(data.message);
              setTimeout(function() {
                location.reload();
            }, 1000);
            }
            
           })
           .fail(function (jqXHR, ajaxOptions, thrownError) {
             toastr.error('Something went wrong!');
           });
   });
     </script>
@endsection
