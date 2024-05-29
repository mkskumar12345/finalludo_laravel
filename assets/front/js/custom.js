toastr.options = {
  'closeButton': true,
  'debug': false,
  'newestOnTop': false,
  'progressBar': false,
  'positionClass': 'toast-top-right',
  'preventDuplicates': false,
  'showDuration': '1000',
  'hideDuration': '1000',
  'timeOut': '5000',
  'extendedTimeOut': '1000',
  'showEasing': 'swing',
  'hideEasing': 'linear',
  'showMethod': 'fadeIn',
  'hideMethod': 'fadeOut',
}

// $(document).click(function(e){
//     // var getID = $(this).attr("id");
// // alert(this.id);
//   if($("body").hasClass("open")){
//     alert('jhg');
//   $('body').removeClass('open');

// }
// });



//Send otp
$(document).on("click", ".send_otp", function () {
  var phone_login = $('.phone_login').val();
  var password = $('.password').val();
  var this_val = $(this);
  if (phone_login == '') {
    toastr.error('Enter phone number');
    return false;
  }
  if (phone_login.length != 10) {
    toastr.error('Enter valid phone number');
    return false;
  }
  if (!$.isNumeric(phone_login)) {
    toastr.error('Mobile number must be integer');
    return false;
  }
  $.ajax({
    url: 'send-otp',
    type: "get",
    data: {
      phone: phone_login,
      password: password
    },
    headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content") },
    beforeSend: function () {
      $(".ajax-load").show();
    },
  })
    .done(function (data) {
      if (data.status == false) {
        toastr.error(data.message);
      }
      if (data.status == true) {
        toastr.success(data.message);
        // this_val.removeClass('send_otp');
        // this_val.addClass('verify_otp');
        $('.otp_screen').removeClass('d-none');
        $('.number_screen').addClass('d-none');
      }

    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
      toastr.error('Something went wrong!');
    });
});

function copyReferCode() {

  var copyText = document.getElementById("refer-code-ccc");


  copyText.select();
  copyText.setSelectionRange(0, 99999);

  navigator.clipboard.writeText(copyText.value);
  toastr.success('Copied');


}
function copyReferCodeURL() {

  var copyText = document.getElementById("refer-code-url");


  copyText.select();
  copyText.setSelectionRange(0, 99999);

  navigator.clipboard.writeText(copyText.value);
  toastr.success('Copied');

}
//refer code system
$(document).on("click", ".save_user_name", function () {
  var save_user_name_input = $('.save_user_name_input').val();
  var this_val = $(this);
  if (save_user_name_input == '') {
    toastr.error('Enter full name');
    return false;
  }

  $.ajax({
    url: 'apply-name',
    type: "get",
    data: { save_user_name_input: save_user_name_input },
    headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content") },
    beforeSend: function () {
      $(".ajax-load").show();
    },
  })
    .done(function (data) {
      if (data.status == false) {
        toastr.error(data.message);
      }
      if (data.status == true) {
        toastr.success(data.message);
        $('.save_user_name_input').val(data.name);
      }
    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
      toastr.error('Something went wrong!');
    });
});

//register functiom
//refer code system
$(document).on("click", ".submit__btn", function () {
  var full_name = $('.full__name').val();
  var mobile_number = $('.mobile__number').val();
  var refer_code_signup = $('.refer_code_signup').val();
  var password = $('.password').val();
  var confirm_password = $('.confirm_password').val();
  var email = $('.email').val();

  var this_val = $(this);
  if (full_name == '') {
    toastr.error('Enter full name');
    return false;
  }
  if (mobile_number == '') {
    toastr.error('Enter mobile number');
    return false;
  }
  if (email == '') {
    toastr.error('Enter email address');
    return false;
  }
  if (mobile_number.length != 10) {
    toastr.error('Mobile number must be 10 digits');
    return false;
  }
  if (!$.isNumeric(mobile_number)) {
    toastr.error('Mobile number must be integer');
    return false;
  }

  $.ajax({
    url: 'register-save',
    type: "get",
    data: {
      refer_code: refer_code_signup,
      full_name: full_name,
      email: email,
      mobile_number: mobile_number,
      password: password,
      confirm_password: confirm_password,
    },
    headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content") },
    beforeSend: function () {
      $(".ajax-load").show();
    },
  })
    .done(function (data) {
      if (data.status == false) {
        console.log(data);
        toastr.error(data.message);
      }
      if (data.status == true) {
        toastr.success(data.message);
        window.location.href = "login";
      }
    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
      toastr.error('Something went wrong!');
    });
});

$(document).on("click", ".verify_otp", function () {
  var phone_login = $('.phone_login').val();
  var password = $('.password').val();
  var this_val = $(this);
  if (phone_login == '') {
    toastr.error('Enter phone number or email');
    return false;
  }

  if (password == '') {
    toastr.error('Oops! Enter password');
    return false;
  }

  $.ajax({
    url: 'verify-otp',
    type: "get",
    data: {
      phone: phone_login,
      password: password,
    },
    headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content") },
    beforeSend: function () {
      $(".ajax-load").show();
    },
  })
    .done(function (data) {
      if (data.status == false) {
        toastr.error(data.message);
      }
      if (data.status == true) {
        toastr.success(data.message);
        window.location.href = "home";
      }

    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
      toastr.error('Something went wrong!');
    });
});
$(document).on("click", ".update_password", function () {

  var old_password = $('.old_password').val();
  var new_password = $('.new_password').val();
  var confirm_new_password = $('.confirm_new_password').val();
  // var this_val = $(this);


  $.ajax({
    url: '/update-password',
    type: "get",
    data: {
      old_password: old_password,
      new_password: new_password,
      confirm_new_password: confirm_new_password,
    },
    headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content") },
    beforeSend: function () {
      $(".ajax-load").show();
    },
  })
    .done(function (data) {
      if (data.status == false) {
        toastr.error(data.message);
      }
      if (data.status == true) {
        toastr.success(data.message);
        setTimeout(function () {
          location.reload();
        }, 1000);
      }

    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
      toastr.error('Something went wrong!');
    });
});
$(document).on("click", "#addMoney", function (event) {
  event.preventDefault();
  var amount = $('#addMoneyInput').val();
  var this_val = $(this);
  if (amount == '') {
    toastr.error('Enter amount');
    return false;
  }
  if (!$.isNumeric(amount)) {
    toastr.error('Amount must be integer');
    return false;
  }

  $("#addMoney").removeAttr("id");

  $.ajax({
    url: 'add-money',
    type: "get",
    data: {
      amount: amount,
    },
    headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content") },
    beforeSend: function () {
      $(".ajax-load").show();
    },
  })
    .done(function (data) {
      if (data.status == false) {
        toastr.error(data.message);
        this_val.attr("id", "addMoney");
      }
      if (data.status == true) {
        // toastr.success(data.message);
        window.location = data.paymentURL;
        this_val.attr("id", "addMoney");

      }

    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
      toastr.error('Something went wrong!');
    });
});

//betting js
var getGameType = $('.getGameType').val();

$(function () {
  $('#success-error-div').hide();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // alert (getGameType);
  // const socket = io('http://localhost:8000'); 

  // let ip_address  =   'https://socket.apnaludo.com';
  // let socket_port =   '6969';
  // // let socket      =   io(ip_address);



  // socket.on("disconnect", (reason) => {
  //   console.log("client disconnected");


  //   let socketRe = createSocket();				
  //   socketRe.connect();
  //   console.log("client reconnected");
  // });

  // socket.on('createChallengeClient',(data) => {
  //   var htmlData	=	createChallengeSoc(data);
  //   $("#challenge-div").prepend(htmlData);
  // });

  // socket.on('cancelReqClient',(data) => {
  //   var htmlData	=	cancelReqSoc(data);

  // });

  // socket.on('cancelChallengeClient',(data) => {
  //   $('#chdiv-'+data).hide();
  // });

  // socket.on('playChallengeClient',(data) => {
  //   playChallengeSoc(data);
  // });

  // socket.on('acceptChallengeClient',(data) => {
  //   acceptChallengeSoc(data);
  // });

  // socket.on('startChallengeClient',(data) => {
  //   startChallengeSoc(data);
  // });

  // socket.on('userResultClient',(data) => {
  //   $('#chdiv-'+data).hide();
  // });	


  $('#withdrawal__add').submit(function (e) {

    e.preventDefault();
    var method = $('#method').val();
    var form_upi = $('#form_upi').val();
    var confirm_upi = $('#confirm_upi').val();
    var amount = $('#amount').val();

    var flag = 1;

    if (method == '') {
      toastr.error('Select withdraw method');
      flag = 0;
      return false;
    }
    if (form_upi == '') {
      toastr.error('Enter UPI ID');
      flag = 0;
      return false;
    }
    if (confirm_upi == '') {
      toastr.error('Enter Confirm UPI ID');
      flag = 0;
      return false;
    }
    if (confirm_upi != form_upi) {
      toastr.error('UPI ID and comfirm UPI must be same');
      flag = 0;
      return false;
    }
    if (amount == '') {
      toastr.error('Please withdraw amount');
      flag = 0;
      return false;

    }
    if (!$.isNumeric(amount)) {
      toastr.error('Please enter numeric value');
      $('#amount').val('');
      flag = 0;
      return false;

    }


    if (flag) {
      $form = $(this);
      $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: '/add-withdrawal',
        data: $form.serialize(),
        beforeSend: function () {
          $('.loading').show();
        },
        success: function (data) {
          // socket.emit('createChallengeServer', data.data);
          if (data.status == false) {
            toastr.error(data.message);
          }
          if (data.status == true) {
            Swal.fire(
              'Withdrawal Successful!',
              "You're money richer shortly",
              'success'
            )
            // var htmlData	=	listChallengeCre(data.data);
            // $("#my-challenge-div").prepend(htmlData);
            // $('.myWalletBalance').html(data.myWalletBalance);
            // console.log(data.myWalletBalance);
          }

        },
        error: function (data) {
          var errors = $.parseJSON(data.responseText);
          // toastr.error('Please enter a valid amount');
        },
        complete: function () {
          $('#challenge-amount').val('');
          $('.loading').hide();
        }

      });
    }
  });



});


function playNotification() {
  var url = "/assets/audio/notification.mp3 ";
  const audio = new Audio(url);
  audio.play();
}

function playStart() {
  var url = "/assets/audio/start-game.mp3";
  const audio = new Audio(url);
  audio.play();
}



function createChallengeSoc(data) {
  var prize = getPrizeAmount(data.amount);
  var html = '';

  html += '<div id="chdiv-' + data.id + '" class="betCard mt-1">';
  html += '<span class="betCard-title pl-3 d-flex align-items-center text-uppercase">CHALLENGE FROM<span class="ml-1" style="color: #072c92;">' + data.cname + ' </span></span>';
  html += '<div class="d-flex pl-3"><div class="pr-3 pb-1"><span class="betCard-subTitle">Entry Fee</span>';
  html += '<div class="global-rupee-icon"><img src="/assets/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">' + data.amount + '</span></div></div>';
  html += '<div><span class="betCard-subTitle">Prize</span><div><img src="/assets/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">' + prize + '</span></div>';
  html += '</div><button id="' + data.id + '-play" class="bg-secondary playButton cxy" onclick="playChallenge(' + data.id + ');">Play</button></div></div>';

  return html;
}

function listChallengeCre(data) {
  // var prize	=	getPrizeAmount(data.amount);
  var html = '';

  html += '<li id="chdiv-' + data.id + '" class=" p-0="" overflow-hidden="appear-from-left""><div class="my-1 card">';
  html += '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by You</span>';
  html += '<span class="text-success fw-bold"><b>Rs ' + data.amount + '</b></span></div><div class="d-flex align-items-center justify-content-between card-body bet__cover">';
  html += '<div class="d-flex align-items-center flex-grow-1"><div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="31-loading">';
  html += '<i id="' + data.id + '-loading" class="fa fa-spinner fa-spin" style="font-size:24px"></i></div><span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;">';
  html += '<b>Finding Player</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2" id="31-buttons"  id="' + data.id + '-buttons">';
  html += '<button class="btn btn-danger playChallange btn-sm"onclick="cancelChallengeCre(' + data.id + ')" style="width: 54px !important;">Delete</button></div></div></div></div></li>';
  return html;
}



function startGameHtml(data) {
  var prize = getPrizeAmount(data.amount);
  var html = '';

  html += '<div id="chdiv-' + data.id + '" class="betCard mt-1"><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">CHALLENGE FROM<span class="ml-1" style="color: #072c92;">' + data.cname + ' </span></span>';
  html += '<div class="d-flex pl-3"><div class="pr-3 pb-1"><span class="betCard-subTitle">Entry Fee</span><div><img src="/assets/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">' + data.amount + '</span>';
  html += '</div></div><div><span class="betCard-subTitle">Prize</span><div><img src="/assets/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">' + prize + '</span>';
  html += '</div></div><button id="' + data.id + '-start-btn" class="bg-success playButton cxy" onclick="startChallenge(' + data.id + ')">START</button></div></div>';
  return html;
}



function cancelChallengeCre(ch_id) {
  // let socket = createSocket();
  $('.loading').show();
  $.ajax({
    type: "GET",
    async: false,
    dataType: 'json',
    url: '/delete-challange',
    data: 'ch_id=' + ch_id,
    beforeSend: function () {

    },
    success: function (data) {
      if (data.status == false) {
        toastr.error(data.message);
      }
      if (data.status == true) {
        toastr.success(data.message);
        // socket.emit('cancelChallengeServer', data.data);
        $("#chdiv-" + data.data).remove();
        $('.myWalletBalance').html(data.myWalletBalance);
      }

    },
    error: function (data) {
      var errors = $.parseJSON(data.responseText);
      hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
    },
    complete: function () {
      $('.loading').hide();
    }

  });
}

function playChallenge(ch_id) {
  // let socket = createSocket();
  $('.loading').show();
  $.ajax({
    type: "GET",
    async: false,
    dataType: 'json',
    url: '/challenge-requesting',
    data: 'ch_id=' + ch_id,
    beforeSend: function () {

    },
    success: function (data) {
      if (data.status == false) {
        toastr.error(data.message);
      }
      if (data.status == true) {
        reloadList();
        // socket.emit('playChallengeServer', data.data);
        var playBtn = document.getElementById(ch_id + "-play");
        $("#" + ch_id + "-play").removeClass('bg-secondary');
        $("#" + ch_id + "-play").addClass('bg-warning');
        $("#" + ch_id + "-play").addClass('req-add-width');
        $("#" + ch_id + "-play").text('');
        $("#" + ch_id + "-play").text('Requested');
        playBtn.removeAttribute("onclick");
        playBtn.setAttribute("onclick", "cancelChallengeReq(" + ch_id + ");");
        playBtn.removeAttribute("id");
        playBtn.setAttribute("id", ch_id + "-requested");
      }

    },
    error: function (data) {
      var errors = $.parseJSON(data.responseText);
      hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
    },
    complete: function () {
      $('.loading').hide();
    }

  });
}

function acceptChallenge(ch_id) {
  // let socket = createSocket();
  $('.loading').show();
  $.ajax({
    type: "GET",
    async: false,
    dataType: 'json',
    url: '/accept-challenge',
    data: 'ch_id=' + ch_id,
    beforeSend: function () {

    },
    success: function (data) {
      // socket.emit('acceptChallengeServer', data.data);
      if (data.status == false) {
        toastr.error(data.message);
      }
      if (data.status == true) {
        // socket.emit('cancelReqServer', data.data);

        reloadList();
      }
    },
    error: function (data) {
      var errors = $.parseJSON(data.responseText);
      hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
    },
    complete: function () {
      $('.loading').hide();
    }

  });
}

function denyChallenge(ch_id) {
  // let socket = createSocket();
  $('.loading').show();

  $.ajax({
    type: "GET",
    async: false,
    dataType: 'json',
    url: '/deny-challenge',
    data: 'ch_id=' + ch_id,
    beforeSend: function () {

    },
    success: function (data) {
      if (data.status == false) {
        toastr.error(data.message);
      }
      if (data.status == true) {
        // socket.emit('cancelReqServer', data.data);
        document.getElementById(ch_id + '-buttons').innerHTML = '';
        html = '<button class="btn btn-danger playChallange btn-sm" onclick="cancelChallengeCre(' + ch_id + ')">Delete</button>';
        reloadList();
      }
    },
    error: function (data) {
      var errors = $.parseJSON(data.responseText);
      hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
    },
    complete: function () {
      $('.loading').hide();
    }

  });
}



function cancelChallengeReq(ch_id) {
  // let socket = createSocket();
  $('.loading').show();
  $.ajax({
    type: "GET",
    async: false,
    dataType: 'json',
    url: '/cancel-challenge-req',
    data: 'ch_id=' + ch_id,
    beforeSend: function () {
      cancelChallengeReq

    },
    success: function (data) {
      if (data.status == false) {
        toastr.error(data.message);
      }
      if (data.status == true) {
        // socket.emit('cancelReqServer', data.data);
        var requestBtn = document.getElementById(ch_id + "-requested");
        $("#" + ch_id + "-requested").removeClass('bg-warning');
        $("#" + ch_id + "-requested").removeClass('req-add-width');
        $("#" + ch_id + "-requested").addClass('bg-primary');
        $("#" + ch_id + "-requested").text('');
        $("#" + ch_id + "-requested").text('Play');
        requestBtn.removeAttribute("onclick");
        requestBtn.removeAttribute("id");
        requestBtn.removeAttribute("style");
        requestBtn.setAttribute("id", ch_id + "-play");
        requestBtn.setAttribute("onclick", "playChallenge(" + ch_id + ");");
        reloadList();
      }

    },
    error: function (data) {
      var errors = $.parseJSON(data.responseText);
      hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
    },
    complete: function () {
      $('.loading').hide();
    }

  });
}

$(window).on('focus', function () {
  // Append this text to the `body` element.
  $.ajax({
    type: "GET",
    dataType: 'json',
    url: '/challenge-listing',
    data: 'getGameType=' + getGameType,

    beforeSend: function () {

    },
    _success: function (data) {
      var myChallenges = data.data.myChallenges;
      var challengeRunning = data.data.challengeRunning;
      console.log(myChallenges);
      //  var challenges 			= data.data.challenges;
      var challengeDivHtml = setChallengsOpen(myChallenges);
      var challengeRunning = setChallengsRunning(challengeRunning);
      //  console.log(challengeDivHtml);
      //  $("#challenge-div").empty();
      //  $("#challenge-div").append(challengeDivHtml);

      var myChallengeDivHtml = setMyChallenges(myChallenges);
      $("#my-challenge-div").empty();
      $("#my-challenge-div1").empty();
      $("#my-challenge-div").append(myChallengeDivHtml);
      $("#my-challenge-div").append(challengeDivHtml);
      $("#my-challenge-div1").append(challengeRunning);
      var runningChalllanges = data.data.runningChalllanges;
      $("#my-challenge-div1").html(runningChalllanges);
      if (data.data.myRunnungCallenge != '') {
        $("#myOpenCallHeader").html("<div class='separator mt-3 mb-3'><img src='/assets/front/images/winner-cup-icon-png-19.png'style='height: 20px; width: 20px;'>&nbsp; Your Open Challenges &nbsp;<img src='/assets/front/images/winner-cup-icon-png-19.png'  style='height: 20px; width: 20px;''></div>");
      }
      $("#my-running-challenge-list").html(data.data.myRunnungCallenge);


    },
    get success() {
      return this._success;
    },
    set success(value) {
      this._success = value;
    },
    error: function (data) {
      var errors = $.parseJSON(data.responseText);
      hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
    },
    complete: function () {
      $('.loading').hide();
    }

  });
});

function reloadList() {
  // Append this text to the `body` element.
  $.ajax({
    type: "GET",
    dataType: 'json',
    url: '/challenge-listing',
    data: 'getGameType=' + getGameType,


    beforeSend: function () {

    },
    _success: function (data) {
      var myChallenges = data.data.myChallenges;
      console.log(myChallenges);
      //  var challenges 			= data.data.challenges;
      var challengeDivHtml = setChallengsOpen(myChallenges);
      //  console.log(challengeDivHtml);
      //  $("#challenge-div").empty();
      //  $("#challenge-div").append(challengeDivHtml);

      var myChallengeDivHtml = setMyChallenges(myChallenges);
      $("#my-challenge-div").empty();
      $("#my-challenge-div").append(myChallengeDivHtml);
      $("#my-challenge-div").append(challengeDivHtml);
      var runningChalllanges = data.data.runningChalllanges;
      $("#my-challenge-div1").html(runningChalllanges);
      if (data.data.myRunnungCallenge != '') {
        $("#myOpenCallHeader").html("<div class='separator mt-3 mb-3'><img src='/assets/front/images/winner-cup-icon-png-19.png'style='height: 20px; width: 20px;'>&nbsp; Your Open Challenges &nbsp;<img src='/assets/front/images/winner-cup-icon-png-19.png'  style='height: 20px; width: 20px;''></div>");
      }
      $("#my-running-challenge-list").html(data.data.myRunnungCallenge);


    },
    get success() {
      return this._success;
    },
    set success(value) {
      this._success = value;
    },
    error: function (data) {
      var errors = $.parseJSON(data.responseText);
      hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
    },
    complete: function () {
      $('.loading').hide();
    }

  });
}

$(document).ready(function () {
  // Append this text to the `body` element.
  $.ajax({
    type: "GET",
    dataType: 'json',
    url: '/challenge-listing',
    data: 'getGameType=' + getGameType,

    beforeSend: function () {

    },
    _success: function (data) {
      var myChallenges = data.data.myChallenges;
      var challengeRunning = data.data.challengeRunning;
      console.log(myChallenges);;
      //  var challenges 			= data.data.challenges;
      var challengeDivHtml = setChallengsOpen(myChallenges);
      var challengeRunning = setChallengsRunning(challengeRunning);
      //  console.log(challengeDivHtml);
      //  $("#challenge-div").empty();
      //  $("#challenge-div").append(challengeDivHtml);

      var myChallengeDivHtml = setMyChallenges(myChallenges);
      $("#my-challenge-div").empty();
      $("#my-challenge-div1").empty();
      $("#my-challenge-div").append(myChallengeDivHtml);
      $("#my-challenge-div").append(challengeDivHtml);
      $("#my-challenge-div1").append(challengeRunning);
      var runningChalllanges = data.data.runningChalllanges;
      $("#my-challenge-div1").html(runningChalllanges);
      if (data.data.myRunnungCallenge != '') {
        $("#myOpenCallHeader").html("<div class='separator mt-3 mb-3'><img src='/assets/front/images/winner-cup-icon-png-19.png'style='height: 20px; width: 20px;'>&nbsp; Your Open Challenges &nbsp;<img src='/assets/front/images/winner-cup-icon-png-19.png'  style='height: 20px; width: 20px;''></div>");
      }
      $("#my-running-challenge-list").html(data.data.myRunnungCallenge);


    },
    get success() {
      return this._success;
    },
    set success(value) {
      this._success = value;
    },
    error: function (data) {
      var errors = $.parseJSON(data.responseText);
      hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
    },
    complete: function () {
      $('.loading').hide();
    }

  });
});

function setChallengsOpen(myChallenges) {
  var user_id = $('#userID').val();
  var html = '';
  for (let i = 0; i < myChallenges.length; i++) {
    if (myChallenges[i].status == 'challange_created' && myChallenges[i].c_id != user_id && myChallenges[i].o_id != user_id) {
      html += '<li class="p-0 overflow-hidden appear-from-left apped_data" id="chdiv-' + myChallenges[i].id + '">';
      html += '<div class="my-1 card">';
      html += '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by</span><span class="text-success fw-bold"><b>Rs ' + myChallenges[i].amount + '</b></span></div>';
      html += '<div class="d-flex align-items-center justify-content-between card-body bet__cover">';
      html += '<div class="d-flex align-items-center flex-grow-1">';
      html += '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;"> <img class="cover__image" src="' + myChallenges[i].c_image + '"></div>';
      html += '<span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>' + myChallenges[i].cname + '</b></span></div>';
      html += '<div class="d-flex align-items-center">';
      html += '<div class="hstack gap-2">';
      html += '<button class="btn btn-primary playChallange btn-sm" id="' + myChallenges[i].id + '-play" onclick="playChallenge(' + myChallenges[i].id + ');">Play</button></div></div></div></div></li>';
    }
  }

  return html;
}
function setChallengsRunning(myChallenges) {
  var user_id = $('#userID').val();
  var html = '';
  for (let i = 0; i < myChallenges.length; i++) {
    if (myChallenges[i].status == 'running' && myChallenges[i].c_id != user_id && myChallenges[i].o_id != user_id) {
      html += '<li class="p-0 overflow-hidden appear-from-left apped_data">';
      html += '<div class="my-1 card pb-2">';
      html += '<div class="text-start">';
      html += '<div class="d-flex align-items-center justify-content-between card-header bet_header">';
      html += '<div class="d-flex align-items-center">';
      html += '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="62-add-spiner"> <img class="cover__image" src="/assets/front/images/avatar.png"></div>';
      html += '<span class="fw-semibold text-truncate" style="width: 100px; font-size: 13px;"><b class="ml-2">' + myChallenges[i].cname + '</b></span></div><div>';
      html += '<img src="/assets/front/images/vs.c153e22fa9dc9f58742d.webp" height="40" alt="vs"></div><div class="d-flex flex-row-reverse align-items-center">';
      html += '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="62-add-spiner"><img class="cover__image" src="/assets/front/images/avatar.png">';
      html += '</div><span class=" fw-semibold text-truncate" style="width: 100px; font-size: 13px;"><b class="ml-2">' + myChallenges[i].oname + '</b></span>';
      html += '</div></div><div class="d-flex align-items-center justify-content-center pt-3"><span class="text-success fw-bold" ><b>Rs ' + myChallenges[i].amount + '</b></span></div></div></div></li>';
    }
  }

  return html;
}

function setMyChallenges(myChallenges) {
  var user_id = $('#userID').val();
  var html = '';
  console.log(user_id);
  for (let i = 0; i < myChallenges.length; i++) {
    console.log(myChallenges[i]);
    // var prize = getPrizeAmount(myChallenges[i].amount);

    if (myChallenges[i].status == 'challange_created' && myChallenges[i].c_id == user_id) {
      html += ' <li  id="chdiv-' + myChallenges[i].id + '" class="p-0 overflow-hidden appear-from-left"><div class="my-1 card"><div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by You</span><span class="text-success fw-bold"><b>Rs ' + myChallenges[i].amount + '</b></span></div><div class="d-flex align-items-center justify-content-between card-body bet__cover"><div class="d-flex align-items-center flex-grow-1"><div class=" rounded-circle me-2" style="height: 24px; width: 24px;"  id="' + myChallenges[i].id + '-loading"> <i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div><span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>Finding Player</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2" id="' + myChallenges[i].id + '-buttons"><button class="btn btn-danger playChallange btn-sm" onclick="cancelChallengeCre(' + myChallenges[i].id + ')" style="width: 54px !important;">Delete</button></div></div></div></div></li>';

    } else if (myChallenges[i].status == 'requested' && myChallenges[i].c_id == user_id) {
      html += '<li class="p-0 overflow-hidden appear-from-left"  id="chdiv-' + myChallenges[i].id + '">';
      html += '<div class="my-1 card">';
      html += '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by You</span><span class="text-success fw-bold"><b>Rs ' + myChallenges[i].amount + '</b></span>';
      html += '</div><div class="d-flex align-items-center justify-content-between card-body bet__cover">';
      html += '<div class="d-flex align-items-center flex-grow-1">';
      html += '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="' + myChallenges[i].id + '-add-spiner"> <img class="cover__image" src="' + myChallenges[i].o_image + '" ></div>';
      html += '<span class="fw-semibold text-truncate text-start" style="width: 100px;font-size: 13px;" id="' + myChallenges[i].id + '-add-name"><b>' + myChallenges[i].oname + '</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2">';
      html += '<div id="' + myChallenges[i].id + '-buttons"><button class="btn btn-danger playChallange btn-sm" id="' + myChallenges[i].id + '-deny" onclick="denyChallenge(' + myChallenges[i].id + ')"style="width: 57px !important;">Cancel</button>';
      html += '<button class="btn btn-success playChallange btn-sm mr-1" id="' + myChallenges[i].id + '-accept"  onclick="acceptChallenge(' + myChallenges[i].id + ')">Play</button><div></div></div></div></div></li>';
    } else if (myChallenges[i].status == 'requested' && myChallenges[i].o_id == user_id) {
      html += '<li class="p-0 overflow-hidden appear-from-left apped_data" id="chdiv-' + myChallenges[i].id + '"><div class="my-1 card"><div class="d-flex align-items-center justify-content-between card-header bet_header">';
      html += '<span>Challenge set by</span><span class="text-success fw-bold"><b>Rs ' + myChallenges[i].amount + '</b></span></div>';
      html += '<div class="d-flex align-items-center justify-content-between card-body bet__cover"><div class="d-flex align-items-center flex-grow-1">';
      html += '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;"><img class="cover__image" src="' + myChallenges[i].c_image + '" ></div>';
      html += '<span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>' + myChallenges[i].cname + '</b></span></div><div class="d-flex align-items-center">';
      html += '<div class="hstack gap-2"><button class="btn btn-warning playChallange btn-sm" style="width: 93px !important;color:white;" id="' + myChallenges[i].id + '-requested"  onclick="cancelChallengeReq(' + myChallenges[i].id + ')">Requested</button>';
      html += '</div></div></div></div></li>';
    } else if (myChallenges[i].status == 'accepted' && myChallenges[i].o_id == user_id) {

      html += '<li class="p-0 overflow-hidden appear-from-left apped_data" id="chdiv-' + myChallenges[i].id + '"><div class="my-1 card"><div class="d-flex align-items-center justify-content-between card-header bet_header">';
      html += '<span>Challenge set by</span><span class="text-success fw-bold"><b>Rs ' + myChallenges[i].amount + '</b></span></div>';
      html += '<div class="d-flex align-items-center justify-content-between card-body bet__cover"><div class="d-flex align-items-center flex-grow-1">';
      html += '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;"><img class="cover__image" src="' + myChallenges[i].c_image + '" ></div>';
      html += '<span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>' + myChallenges[i].cname + '</b></span></div><div class="d-flex align-items-center">';
      html += '<div class="hstack gap-2"><button class="btn btn-warning playChallange btn-sm" style="width: 93px !important;color:white;" id="' + myChallenges[i].id + '-start-btn" onclick="startChallenge(' + myChallenges[i].id + ')">Start</button>';
      html += '</div></div></div></div></li>';


    }
  }
  return html;
}




$(document).on("click", ".roomm-code-save", function () {
  var room_code = $('#room_code').val();
  var challagne_slug = $('#challagne_slug').val();
  var this_val = $(this);
  if (room_code == '') {
    toastr.error('Enter room code');
    return false;
  }
  if (!$.isNumeric(room_code)) {
    toastr.error('Room code must be integer');
    return false;
  }
  if (room_code.length < 4) {
    toastr.error('Enter valid room code');
    return false;

  }
  $.ajax({
    url: '/save-room-code',
    type: "get",
    data: {
      room_code: room_code,
      challagne_slug: challagne_slug,
    },
    headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content") },
    beforeSend: function () {
      $(".ajax-load").show();
    },
  })
    .done(function (data) {
      if (data.status == false) {
        toastr.error(data.message);
      }
      if (data.status == true) {
        toastr.success(data.message);
        setTimeout(function () {
          location.reload();
        }, 1000);
      }

    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
      toastr.error('Something went wrong!');
    });
});

//--------------------------------------//
// Pusher code

// Initiate the Pusher JS library
var pusher = new Pusher('c66a3e1c54e6f83acdde', {
  cluster: 'ap2',
  encrypted: true
});

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('createBettel-' + getGameType);
var deletebettel = pusher.subscribe('deletebettel');
var Playbettel = pusher.subscribe('Playbettel');
var DenyChallenge = pusher.subscribe('DenyChallenge');
var StartChallenge = pusher.subscribe('StartChallenge');
var CancelReqBettel = pusher.subscribe('CancelReqBettel');
var SaveRoom = pusher.subscribe('SaveRoomCode');


channel.bind('App\\Events\\CreateBettel', function (data) {
  console.log(data.data);
  if (data.data.challenge_type == getGameType && data.data.c_id != USERID) {
    var html = '';
    html += '<li class="p-0 overflow-hidden appear-from-left apped_data" id="chdiv-' + data.data.id + '">';
    html += '<div class="my-1 card">';
    html += '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by</span><span class="text-success fw-bold"><b>Rs ' + data.data.amount + '</b></span></div>';
    html += '<div class="d-flex align-items-center justify-content-between card-body bet__cover">';
    html += '<div class="d-flex align-items-center flex-grow-1">';
    html += '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;"> <img class="cover__image" src="' + data.data.c_image + '"></div>';
    html += '<span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>' + data.data.cname + '</b></span></div>';
    html += '<div class="d-flex align-items-center">';
    html += '<div class="hstack gap-2">';
    html += '<button class="btn btn-primary playChallange btn-sm" id="' + data.data.id + '-play" onclick="playChallenge(' + data.data.id + ');">Play</button></div></div></div></div></li>';
  }
  $("#my-challenge-div").prepend(html);
});

deletebettel.bind('App\\Events\\DeleteBettel', function (data) {
  $("#chdiv-" + data.data.id).remove();
});
SaveRoom.bind('App\\Events\\SaveRoomCode', function (data) {
  $(".wait-room-code-" + data.data.slug).html(data.data.code);
  $(".copy-room-codess-" + data.data.slug).val(data.data.code);
});
Playbettel.bind('App\\Events\\Playbettel', function (data) {
  if (data.data.c_id == USERID) {
    var html = '';
    html += '<div class="my-1 card">';
    html += '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by You</span><span class="text-success fw-bold"><b>Rs ' + data.data.amount + '</b></span>';
    html += '</div><div class="d-flex align-items-center justify-content-between card-body bet__cover">';
    html += '<div class="d-flex align-items-center flex-grow-1">';
    html += '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="' + data.data.id + '-add-spiner"> <img class="cover__image" src="' + data.data.o_image + '" ></div>';
    html += '<span class="fw-semibold text-truncate text-start" style="width: 100px;font-size: 13px;" id="' + data.data.id + '-add-name"><b>' + data.data.oname + '</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2">';
    html += '<div id="' + data.data.id + '-buttons"><button class="btn btn-danger playChallange btn-sm" id="' + data.data.id + '-deny" onclick="denyChallenge(' + data.data.id + ')"style="width: 57px !important;">Cancel</button>';

    html += '<button class="btn btn-success playChallange btn-sm mr-1" id="' + data.data.id + '-accept"  onclick="acceptChallenge(' + data.data.id + ')">Play</button><div></div></div></div></div>';
    playNotification();
    $("#chdiv-" + data.data.id).html(html);
  }
});
DenyChallenge.bind('App\\Events\\DenyChallenge', function (data) {
  if (data.data.o_id != USERID) {
    var html = '';
    html += '<div class="my-1 card">';
    html += '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by</span><span class="text-success fw-bold"><b>Rs ' + data.data.amount + '</b></span></div>';
    html += '<div class="d-flex align-items-center justify-content-between card-body bet__cover">';
    html += '<div class="d-flex align-items-center flex-grow-1">';
    html += '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;"> <img class="cover__image" src="' + data.data.c_image + '"></div>';
    html += '<span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>' + data.data.cname + '</b></span></div>';
    html += '<div class="d-flex align-items-center">';
    html += '<div class="hstack gap-2">';
    html += '<button class="btn btn-primary playChallange btn-sm" id="' + data.data.id + '-play" onclick="playChallenge(' + data.data.id + ');">Play</button></div></div></div></div>';

    $("#chdiv-" + data.data.id).html(html);
  }
});
CancelReqBettel.bind('App\\Events\\CancelReqBettel', function (data) {
  if (data.data.c_id == USERID) {
    var html = '<div class="my-1 card"><div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by You</span><span class="text-success fw-bold"><b>Rs ' + data.data.amount + '</b></span></div><div class="d-flex align-items-center justify-content-between card-body bet__cover"><div class="d-flex align-items-center flex-grow-1"><div class=" rounded-circle me-2" style="height: 24px; width: 24px;"  id="' + data.data.id + '-loading"> <i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div><span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>Finding Player</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2" id="' + data.data.id + '-buttons"><button class="btn btn-danger playChallange btn-sm" onclick="cancelChallengeCre(' + data.data.id + ')" style="width: 54px !important;">Delete</button></div></div></div></div>';


    $("#chdiv-" + data.data.id).html(html);
  }
});
StartChallenge.bind('App\\Events\\StartChallenge', function (data) {
  if (data.data.o_id == USERID || data.data.c_id == USERID) {
    playStart();
    window.location.href = data.data.redirect_url;
  }
});
