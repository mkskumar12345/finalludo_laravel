function copyRoomCode() {
  
    var copyText = document.getElementById("copy-room-code");
  
   
    copyText.select();
    copyText.setSelectionRange(0, 99999); 
  
    navigator.clipboard.writeText(copyText.value);
    // toastr.success('Copied');
    $('.roomm-code').html('Copied');
   
  }

  function copyRoomCodeq() {
  
    var copyText = document.getElementById("copy-room-codes-copy");
  
   
    copyText.select();
    copyText.setSelectionRange(0, 99999); 
  
    navigator.clipboard.writeText(copyText.value);
    // toastr.success('Copied');
    $('.roomm-code').html('Copied');
   
  }

  $('#post-result').submit(function(e)
  { 
  $this= $(this);
    e.preventDefault();
    var upload_sreenshot	=	$('#upload_sreenshot').val();
    var flag			=	1;
    if(upload_sreenshot == ''){
      toastr.error('Please Select winning image');
      flag = 0;
      return false;
    }
    $('.post_btn').html('Posting.. please wait');

    $form = $(this);
    var formData = new FormData(this);

    if(flag){
      
      $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: '/mark-result',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(){
          $('.loading').show();
        },
        success:function(data){							
          // socket.emit('createChallengeServer', data.data);
          if(data.status==false){
            toastr.error(data.message);

            $('.post_btn').html('Submit');
           

          }
          if(data.status==true){
            toastr.success(data.message);
           setTimeout(function() {
            location.reload();
        }, 1000);
            // var htmlData	=	listChallengeCre(data.data);
            // $("#my-challenge-div").prepend(htmlData);
            // $('.myWalletBalance').html(data.myWalletBalance);
            // console.log(data.myWalletBalance);
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
 
    $(document).on('change', '#upload_profile', function(e) {
  
    e.preventDefault();
    var upload_sreenshot	=	$(this).val();
    var flag			=	1;
    if(upload_sreenshot == ''){
      toastr.error('Please Select winning image');
      flag = 0;
      return false;
    }
    // $form = ;
   		
      });
  $('#post-result-looser').submit(function(e)
  { 
  
    e.preventDefault();
    
    var formData = new FormData(this);
    var flag = true;
    if(flag){
      
      $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: '/mark-result',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(){
          $('.loading').show();
        },
        success:function(data){							
          // socket.emit('createChallengeServer', data.data);
          if(data.status==false){
            toastr.error(data.message);
          }
          if(data.status==true){
            toastr.success(data.message);
           setTimeout(function() {
            location.reload();
        }, 1000);
            // var htmlData	=	listChallengeCre(data.data);
            // $("#my-challenge-div").prepend(htmlData);
            // $('.myWalletBalance').html(data.myWalletBalance);
            // console.log(data.myWalletBalance);
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
  $('#cancel-challange').submit(function(e)
  { 
  
    e.preventDefault();
    
    var formData = new FormData(this);
    var flag = true;
    if(flag){
      
      $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: '/cancel-challange',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(){
          $('.loading').show();
        },
        success:function(data){							
          // socket.emit('createChallengeServer', data.data);
          if(data.status==false){
            toastr.error(data.message);
          }
          if(data.status==true){
            toastr.success(data.message);
           setTimeout(function() {
            location.reload();
        }, 1000);
            // var htmlData	=	listChallengeCre(data.data);
            // $("#my-challenge-div").prepend(htmlData);
            // $('.myWalletBalance').html(data.myWalletBalance);
            // console.log(data.myWalletBalance);
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


      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
      console.log('dssfs');
      var formData = new FormData($('#update-profile')[0]);
      console.log(formData);
     
        
        $.ajax({
          type: "POST",
          async: false,
          dataType: 'json',
          url: '/update-profile-img',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){
            $('.loading').show();
          },
          success:function(data){							
            // socket.emit('createChallengeServer', data.data);
            if(data.status==false){
              toastr.error(data.message);
            }
            if(data.status==true){
              toastr.success(data.message);
             setTimeout(function() {
              location.reload();
          }, 1000);
            }
            
        },
        error:function(data){
          var errors = $.parseJSON(data.responseText);
        },
        complete:function(){	
          $('#challenge-amount').val('');					
          $('.loading').hide();
        }
          
        });
      
    });


    
    
