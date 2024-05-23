@extends('layouts.frontend')
@section('content')

<div class=" col-12 mx-auto p-3 g-0">
<div style="display: none;" class="text-danger"><marquee behavior="scroll" direction="left"><b>महत्वपूर्ण सूचना : गलत रिजल्ट डालने पर ₹30 की पेनल्टी लगाई जाएगी। ।</b></marquee></div>

   <div class="d-flex flex-column">
      <div class="bg-gray-200 h-100 w-100 p-3 bg-light d-flex align-items-center justify-content-between hstack gap-2">
         <div class="input-group flex-1 flex-nowrap">
            <form id="create-challenge" method="POST"style="display: contents;" >
               @csrf
               <input type="number" class="form-control" id="challenge-amount" required="" name="amount"  placeholder="Amount" value="">
               <input type="hidden" value="{{$slug}}" name="challange_type"  class="getGameType">

               <button class="btn btn-primary w-25 ml-2">Set</button>
            </form>
         </div>
      </div>
      <di id="myOpenCallHeader"></div>
      
         
      <ul id="my-running-challenge-list" class="px-2 m-0">
   
</ul>
	  <div class="separator mt-3 mb-3"><img src="{{url('assets/front/images/winner-cup-icon-png-19.png')}}" alt="WinCupImg" style="height: 20px; width: 20px;">&nbsp; Challenges &nbsp;<img src="{{url('assets/front/images/winner-cup-icon-png-19.png')}}" alt="WinCupImg" style="height: 20px; width: 20px;"></div>
      <ul id="playable-challange-list" class="m-0 px-2">
      <div id="currant-games"></div>
		<div id="my-challenge-div"></div>
    <div class="separator mt-3 mb-3"><img src="{{url('assets/front/images/winner-cup-icon-png-19.png')}}" alt="WinCupImg" style="height: 20px; width: 20px;">&nbsp;Running Challenges &nbsp;<img src="{{url('assets/front/images/winner-cup-icon-png-19.png')}}" alt="WinCupImg" style="height: 20px; width: 20px;"></div>
		<div id="my-challenge-div1">
      
</div>
     
	</ul>

   </div>
   
</div>
<style>
   .btn{
   cursor: pointer;
   float: right;
   width: 50px;
   font-size: smaller !important;
    color: white !important;
    border: none;

   }
</style>
<script>
     $('#create-challenge').submit(function(e)
    { 
      e.preventDefault();
      var amount	=	$('#challenge-amount').val();
      var flag			=	1;
      
      if(!amount){
        toastr.error('Please enter amount');
        flag = 0;
      }else if(! $.isNumeric(amount)){
        toastr.error('Please enter numeric value');
        $('#challenge-amount').val('');
        flag = 0;
      }
      
    
      if(flag){
        $form = $(this);
        $.ajax({
          type: "POST",
          async: false,
          dataType: 'json',
          url: '/create-challange',
          data: $form.serialize(),
          beforeSend: function(){
            $('.loading').show();
          },
          success:function(data){							
            if(data.status==false){
              toastr.error(data.message);
            }
            if(data.status==true){
             toastr.success(data.message);
              var htmlData	=	listChallengeCre(data.data);
              $("#my-challenge-div").prepend(htmlData);
              $('.myWalletBalance').html(data.myWalletBalance);
              console.log(data.myWalletBalance);
              $('#challenge-room-code').val('');
            }
            
        },
        error:function(data){
          var errors = $.parseJSON(data.responseText);
          // toastr.error('Please enter a valid amount');
        },
        complete:function(){	
          $('#challenge-amount').val('');					
          $('.loading').hide();
        }
          
        });
      }			
        });
</script>

@endsection