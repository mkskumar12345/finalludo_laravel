<script>
		$(function(){
			$('#success-error-div').hide();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			//---------- load playing games on page load start ------------//

			// $.ajax({
			// 	type: "GET",
			// 	dataType: 'json',
			// 	url: 'https://apnaludo.com/get-playing-challenges',				
			// 	beforeSend: function(){
					
			// 	},
			// 	success:function(data){					
			// 		var playChallenges 			= data.data.playChallenges;
			// 		var myPlayChallenges 		= data.data.myPlayChallenges;
					
			// 		var myPlayChallengeDivHtml	=	setMyPlayChallenges(myPlayChallenges);
			// 		$("#mychallenge-div-play").empty();
			// 		$("#mychallenge-div-play").append(myPlayChallengeDivHtml);

			// 		var playChallengeDivHtml	=	setPlayChallenges(playChallenges);					
			// 		$("#challenge-div-play").empty();
			// 		$("#challenge-div-play").append(playChallengeDivHtml);
			// 	},
			// 	error:function(data){
			// 		var errors = $.parseJSON(data.responseText);
			// 		// $('#challenge-amount-error').text(errors.message);
			// 		// $('#challenge-amount-error').show();
			// 		hideSuccessErrorDiv('alert-success','alert-danger',errors.message);	
			// 	},
			// 	complete:function(){
			// 		// $('#create-challenge')[0].reset();
			// 		$('.loading').hide();
			// 	}
				
			// });

			//---------- load playing games on page load end ------------//

			
			let ip_address  =   'https://socket.apnaludo.com';
			let socket_port =   '6969';
			let socket      =   io(ip_address);

			// let ip_address  =   '127.0.0.1';
			// let socket_port =   '5000';
			// let socket      =   io(ip_address   + ':' + socket_port);

			socket.on("disconnect", (reason) => {
				console.log("client disconnected");

				let socketRe = createSocket();				
				socketRe.connect();
				console.log("client reconnected");
			});

			socket.on('createChallengeClient',(data) => {
				var htmlData	=	createChallengeSoc(data);
				$("#challenge-div").prepend(htmlData);
			});

			socket.on('cancelReqClient',(data) => {
				var htmlData	=	cancelReqSoc(data);
				//$("#challenge-div").prepend(htmlData);
			});

			socket.on('cancelChallengeClient',(data) => {
				$('#chdiv-'+data).hide();
			});

			socket.on('playChallengeClient',(data) => {
				playChallengeSoc(data);
			});

			socket.on('acceptChallengeClient',(data) => {
				acceptChallengeSoc(data);
			});

			socket.on('startChallengeClient',(data) => {
				startChallengeSoc(data);
			});

			socket.on('userResultClient',(data) => {
				$('#chdiv-'+data).hide();
			});	
			
			// $('#challenge-amount').keyup(function(e)
			// { 
			// 	var amount	=	$('#challenge-amount').val();
			// 	var flag			=	1;
			// 	var valid			=	1;
				
			// 	if(!amount){
			// 		$('#challenge-amount-error').text('Please enter amount');
			// 		$('#challenge-amount-error').addClass('error');
			// 		$('#challenge-amount-error').show();
			// 		flag = 0;
			// 	}else if(! $.isNumeric(amount)){
			// 		$('#challenge-amount-error').text('Please enter numeric value');
			// 		$('#challenge-amount-error').addClass('error');
			// 		$('#challenge-amount-error').show();
			// 		$('#challenge-amount').val('');
			// 		flag = 0;
			// 	}else if(!(amount == 30 || amount == 40 || amount%50==0)){							
			// 		$('#challenge-amount-error').text('Invalid amount!');
			// 		$('#challenge-amount-error').addClass('error');
			// 		$('#challenge-amount-error').show();
			// 		flag = 0;
			// 	}else{
			// 		$('#challenge-amount-error').text('');
			// 		$('#challenge-amount-error').removeClass('error');
			// 		$('#challenge-amount-error').hide();
			// 	}						
			// });

			$('#create-challenge').submit(function(e)
			{ 				
				e.preventDefault();
				var amount	=	$('#challenge-amount').val();
				
				var flag			=	1;
				
				if(!amount){
					hideSuccessErrorDiv('alert-success','alert-danger','Please enter amount');
					// $('#challenge-amount-error').text('Please enter amount');
					// $('#challenge-amount-error').addClass('error');
					// $('#challenge-amount-error').show();
					flag = 0;
				}else if(! $.isNumeric(amount)){
					hideSuccessErrorDiv('alert-success','alert-danger','Please enter numeric value');
					// $('#challenge-amount-error').text('Please enter numeric value');
					// $('#challenge-amount-error').addClass('error');
					// $('#challenge-amount-error').show();
					$('#challenge-amount').val('');
					flag = 0;
				}else if(!(amount == 30 || amount == 40 || amount%50==0)){		
					hideSuccessErrorDiv('alert-success','alert-danger','Please enter a valid amount');					
					// $('#challenge-amount-error').text('Invalid amount!');
					// $('#challenge-amount-error').addClass('error');
					// $('#challenge-amount-error').show();
					flag = 0;
				}
				
				
				if(flag){
					$form = $(this);
					
					$.ajax({
						type: "POST",
						async: false,
						dataType: 'json',
						url: 'https://apnaludo.com/create-challenge',
						data: $form.serialize(),
						beforeSend: function(){
							$('.loading').show();
						},
						success:function(data){							
							socket.emit('createChallengeServer', data.data);
							var htmlData	=	listChallengeCre(data.data);
							$("#my-challenge-div").append(htmlData);
					},
					error:function(data){
						var errors = $.parseJSON(data.responseText);
						// $('#challenge-amount-error').text(errors.message);
						// $('#challenge-amount-error').show();
						hideSuccessErrorDiv('alert-success','alert-danger',errors.message);	
					},
					complete:function(){	
						$('#challenge-amount').val('');					
						$('.loading').hide();
					}
						
					});
				}			
          });

			
		});

		function hideSuccessErrorDiv(remove_class,add_class,message){
			$('#success-error-div').removeClass(remove_class);
			$('#success-error-div').addClass(add_class);
			$('#success-error-div').show();
			$('#success-error-message').text(message);
			$("#success-error-div").fadeTo(2000, 500).slideUp(500, function(){
				$("#success-error-div").hide(500);
			});
		}

		function playNotification() {
			var url	=	" https://apnaludo.com/public/front/sound/notification.mp3 ";
			const audio = new Audio(url);
			audio.play();
		}

		function playStart() {
			var url	=	" https://apnaludo.com/public/front/sound/start-game.mp3 ";
			const audio = new Audio(url);
			audio.play();
		}

		function createSocket(){
			let ip_address  =   'https://socket.apnaludo.com';
			let socket_port =   '6969';
			let socket      =   io(ip_address);
			// let ip_address  =   '127.0.0.1';
			// let socket_port =   '5000';
			// let socket      =   io(ip_address   + ':' + socket_port);
			return socket;
		}

		function createChallengeSoc(data){ 
			var prize	=	getPrizeAmount(data.amount);
			var html=	'';
			
			html	+='<div id="chdiv-'+data.id+'" class="betCard mt-1">';
			html	+='<span class="betCard-title pl-3 d-flex align-items-center text-uppercase">CHALLENGE FROM<span class="ml-1" style="color: #072c92;">'+data.cname+' </span></span>';
			html	+='<div class="d-flex pl-3"><div class="pr-3 pb-1"><span class="betCard-subTitle">Entry Fee</span>';
			html	+='<div class="global-rupee-icon"><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+data.amount+'</span></div></div>';
			html	+='<div><span class="betCard-subTitle">Prize</span><div><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+prize+'</span></div>';
			html	+='</div><button id="'+data.id+'-play" class="bg-secondary playButton cxy" onclick="playChallenge('+data.id+');">Play</button></div></div>';

			return html;
		}

		function listChallengeCre(data){
			var prize	=	getPrizeAmount(data.amount);
			var html=	'';

			html	+='<div id="chdiv-'+data.id+'" class="betCard mt-1"><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">PLAYING FOR';
			html	+='<img class="mx-1" src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt="">'+data.amount+'</span><div class="betCard-title d-flex align-items-center text-uppercase">';
			html	+='<span class="ml-auto" id="'+data.id+'-buttons"><button class="btn btn-danger px-3 btn-sm" onclick="cancelChallengeCre('+data.id+')">DELETE</button>';
			html	+='</span></div></div><div class="py-1 row"><div class="pr-3 text-center col-5"><div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
			html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+data.cname+'</span></div></div><div class="pr-3 text-center col-2 cxy">';
			html	+='<div><img src="https://apnaludo.com/public/front/images/vs.png" width="30px" alt=""></div></div><div class="text-center col-5"><div class="pl-2">';
			html	+='<img class="border-50" id="'+data.id+'-loading" src="https://apnaludo.com/public/front/images/small-loading.gif" width="21px" height="21px" alt=""></div><div style="line-height: 1;"><span class="betCard-playerName" id="'+data.id+'-finding">Finding Player</span></div></div></div></div>';

			return html;
		}

		function getPrizeAmount(amount){
			var prize;
			if(amount == 30 || amount == 40 || amount == 50){
				prize	=	((2 * amount) - 5);
			}else{
				prize	=	(2 * amount) - (5/100*amount);
			}
			
			// else if(amount > 50 && amount <= 250){
			// 	prize	=	(2 * amount) - (10/100*amount);
			// }else if(amount > 250 && amount <= 500){
			// 	prize	=	((amount * 2) - 25);
			// }else if(amount > 500){
			// 	prize 	=	(amount * 2) - (5/100*amount);
			// }
			return prize;
		}

		function playingGameHtml(data){
			var html	=	'';
			var prize	=	getPrizeAmount(data.amount);
			html	+='<div class="betCard mt-1" id="playing-chdiv-'+data.id+'"><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">PLAYING FOR';
			html	+='<img class="mx-1" src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt="">'+data.amount+'</span><div class="betCard-title d-flex align-items-center text-uppercase"><span class="ml-auto mr-3">PRIZE';
			html	+='<img  class="mx-1" src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt="">'+prize+'</span></div></div><div class="py-1 row"><div class="pr-3 text-center col-5">';
			html	+='<div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
			html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+data.cname+'</span></div></div><div class="pr-3 text-center col-2 cxy">';
			html	+='<div><img src="https://apnaludo.com/public/front/images/vs.png" width="30px" alt=""></div></div><div class="text-center col-5">';
			html	+='<div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
			html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+data.oname+'</span></div></div></div></div>';

			return html;
		}

		function acceptDenyHtml(data){
			var html	=	'';
			var prize	=	getPrizeAmount(data.amount);
			html	+='<div id="chdiv-'+data.id+'" class="betCard mt-1"><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">PLAYING FOR';
			html	+='<img class="mx-1" src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt="">'+prize+'</span><div class="betCard-title d-flex align-items-center text-uppercase">';
			html	+='<span class="ml-auto" id="'+data.id+'-buttons"><button id="'+data.id+'-accept" class="btn btn-success px-3 btn-sm" style="cursor: pointer;float: left;width: 65px;height: 31px; " onclick="acceptChallenge('+data.id+')">START</button><button id="'+data.id+'-deny" class="btn btn-danger px-3 btn-sm" style="cursor: pointer;float: right;width: 72px;height: 31px;" onclick="denyChallenge('+data.id+')">REJECT</button>';
			html	+='</span></div></div><div class="py-1 row"><div class="pr-3 text-center col-5"><div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
			html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+data.cname+'</span></div></div><div class="pr-3 text-center col-2 cxy">';
			html	+='<div><img src="https://apnaludo.com/public/front/images/vs.png" width="30px" alt=""></div></div><div class="text-center col-5"><div class="pl-2">';
			html	+='<img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div><div style="line-height: 1;"><span class="betCard-playerName">'+data.oname+'</span></div></div></div></div>';
			return html;
		}

		function cancelReqHtml(data){
			// var html	=	'';
			// var prize	=	getPrizeAmount(data.amount);
			// html	+='<div id="chdiv-'+data.id+'" class="betCard mt-1">';
			// html	+='<span class="betCard-title pl-3 d-flex align-items-center text-uppercase">CHALLENGE FROM<span class="ml-1" style="color: #072c92;">You </span></span>';
			// html	+='<div class="d-flex pl-3"><div class="pr-3 pb-1"><span class="betCard-subTitle">Entry Fee</span>';
			// html	+='<div class="global-rupee-icon"><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+data.amount+'</span></div></div>';
			// html	+='<div><span class="betCard-subTitle">Prize</span><div><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+prize+'</span></div>';
			// html	+='</div><button href="javascript:void(0)" class="bg-warning playButton cxy" onclick="cancelChallengeReq('+data.id+');">Requested</button></div></div>';

			// return html;
		}

		function startGameHtml(data){
			var prize	=	getPrizeAmount(data.amount);
			var html=	'';

			html	+='<div id="chdiv-'+data.id+'" class="betCard mt-1"><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">CHALLENGE FROM<span class="ml-1" style="color: #072c92;">'+data.cname+' </span></span>';
			html 	+='<div class="d-flex pl-3"><div class="pr-3 pb-1"><span class="betCard-subTitle">Entry Fee</span><div><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+data.amount+'</span>';
			html 	+='</div></div><div><span class="betCard-subTitle">Prize</span><div><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+prize+'</span>';
			html 	+='</div></div><button id="'+data.id+'-start-btn" class="bg-success playButton cxy" onclick="startChallenge('+data.id+')">START</button></div></div>';
			return html;
		}

		function viewGameHtml(data){
			var prize	=	getPrizeAmount(data.amount);
			var html=	'';

			html	+='<div class="betCard mt-1" id="myplaying-chdiv-'+data.id+'" ><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">PLAYING FOR';
			html	+='<img class="mx-1" src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt="">'+prize+'</span><div class="betCard-title d-flex align-items-center text-uppercase">';
			html	+='<span class="ml-auto"><a href="https://apnaludo.com/challenge-detail/+data.id+"  class="btn btn-info px-3 btn-sm" >View</a>	</span></div></div>';
			html	+='<div class="py-1 row"><div class="pr-3 text-center col-5"><div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
			html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+data.cname+'</span></div></div><div class="pr-3 text-center col-2 cxy">';
			html	+='<div><img src="https://apnaludo.com/public/front/images/vs.png" width="30px" alt=""></div></div><div class="text-center col-5">';
			html	+='<div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
			html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+data.oname+'</span></div></div></div></div>';
			return html;
		}

		function playChallengeSoc(data){
			var prize	=	getPrizeAmount(data.amount);
			var html=	'';
			var user_id	=	'14437';
			//$('#chdiv-'+data.id).remove();
			if(data.c_id == user_id){ 
				var html;
				//$('#chdiv-'+data.id).remove();
				playStart();
				console.log('Buttons '+data.id+'-buttons');
				document.getElementById(data.id+'-buttons').innerHTML	=	'';
				html	=	'<button id="'+data.id+'-accept" class="btn btn-success px-3 btn-sm" style="cursor: pointer;float: left;width: 65px;height: 31px; " onclick="acceptChallenge('+data.id+')">START</button><button id="'+data.id+'-deny" class="btn btn-danger px-3 btn-sm" style="cursor: pointer;float: right;width: 72px;height: 31px;" onclick="denyChallenge('+data.id+')">REJECT</button>';
				document.getElementById(data.id+'-buttons').innerHTML	=	html;
				if(data.oname){
					document.getElementById(data.id+'-finding').innerHTML	=	data.oname;
				}				
				
				var loading	=	document.getElementById(data.id+"-loading");
				if(loading){
					loading.setAttribute("src","");
					loading.setAttribute("src","https://apnaludo.com/public/front/images/author.svg");
				}				

				// var htmlData	=	acceptDenyHtml(data);
				// $("#my-challenge-div").prepend(htmlData);
			}else if(data.o_id == user_id){
				//var htmlData	=	cancelReqHtml(data);				
				//$("#my-challenge-div").prepend(htmlData);
			}else{
				$('#chdiv-'+data.id).remove();
				var htmlCode	=	playingGameHtml(data);
				$('#challenge-div-play').append(htmlCode);
			}			
		}

		function cancelReqSoc(data){
			var user_id	=	'14437';
			console.log('Socc '+data.id+'-buttons');
			if(data.c_id == user_id){			
				document.getElementById(data.id+'-buttons').innerHTML	=	'';
				html	=	'<button class="btn btn-danger px-3 btn-sm" onclick="cancelChallengeCre('+data.id+')">DELETE</button>';
				document.getElementById(data.id+'-buttons').innerHTML	=	html;
				$("#"+data.id+"-finding").text('');
				$("#"+data.id+"-finding").text('Finding Player');
				var loading	=	document.getElementById(data.id+"-loading");
				if(loading){
					loading.setAttribute("src","");
					loading.setAttribute("src","https://apnaludo.com/public/front/images/small-loading.gif");
				}
				
				//$('#chdiv-'+data.id).remove();	
				//var htmlData	=	listChallengeCre(data);
				//$("#my-challenge-div").prepend(htmlData);
			}else if(data.o_id == user_id){
				document.getElementById(data.id+'-buttons').innerHTML	=	'';
				html	=	'<button id="'+data.id+'-play" class="bg-secondary playButton cxy" onclick="playChallenge('+data.id+');">Play</button>';
				document.getElementById(data.id+'-buttons').innerHTML	=	html;
			}else{				
				var requestBtn	=	document.getElementById(data.id+"-requested");
				if(requestBtn != null || requestBtn != undefined){
					$("#"+data.id+"-requested").removeClass('bg-warning');
					$("#"+data.id+"-requested").addClass('bg-secondary');
					$("#"+data.id+"-requested").text('');
					$("#"+data.id+"-requested").text('Play');
					requestBtn.removeAttribute("onclick");
					requestBtn.removeAttribute("id");
					requestBtn.setAttribute("id",data.id+"-play");
					requestBtn.setAttribute("onclick","playChallenge("+data.id+");");

				}
				var playingGame	=	document.getElementById('playing-chdiv-'+data.id);
				if(playingGame != null || playingGame != undefined){
					$('#playing-chdiv-'+data.id).remove();
					var htmlCode	=	createChallengeSoc(data);
					$('#challenge-div').append(htmlCode);
				}
			}			
		}

		function acceptChallengeSoc(data){
			var html=	'';
			var user_id	=	'14437';
			if(data.c_id == user_id){ 
				$('#chdiv-'+data.id).remove();
				var htmlCode	=	viewGameHtml(data);				
				$('#mychallenge-div-play').append(htmlCode);
				let redirectURL = "https://apnaludo.com/challenge-detail/:id";
				redirectURL = redirectURL.replace(':id', data.id);
				window.location.href = redirectURL;
			}else if(data.o_id == user_id){
				playStart();

				var requestBtn	=	document.getElementById(data.id+"-requested");
				$("#"+data.id+"-requested").removeClass('bg-warning');
				$("#"+data.id+"-requested").addClass('bg-success');
				$("#"+data.id+"-requested").text('');
				$("#"+data.id+"-requested").text('START');
				requestBtn.removeAttribute("onclick");
				requestBtn.removeAttribute("id");
				requestBtn.setAttribute("id",data.id+"-start-btn");
				requestBtn.setAttribute("onclick","startChallenge("+data.id+");");
				//$('#chdiv-'+data.id).remove();
				//var htmlCode	=	startGameHtml(data);				
				//$('#challenge-div').prepend(htmlCode);
			}
		}

		function startChallengeSoc(data){
			var html=	'';
			var user_id	=	'14437';
			if(data.c_id == user_id || data.o_id == user_id){
				$('#chdiv-'+data.id).remove();
				var htmlCode	=	viewGameHtml(data);				
				$('#mychallenge-div-play').append(htmlCode);
				let redirectURL = "https://apnaludo.com/challenge-detail/:id";
				redirectURL = redirectURL.replace(':id', data.id);
				window.location.href = redirectURL;
			}
		}
		
		function cancelChallengeCre(ch_id){
			let socket = createSocket();
			$('.loading').show();						
			$.ajax({
				type: "POST",
				async: false,
				dataType: 'json',
				url: 'https://apnaludo.com/cancel-challenge',
				data: 'ch_id='+ch_id,
				beforeSend: function(){
					
				},
				success:function(data){
					socket.emit('cancelChallengeServer', data.data);
					$("#chdiv-"+data.data).hide();
				},
				error:function(data){
					var errors = $.parseJSON(data.responseText);
					// $('#challenge-amount-error').text(errors.message);
					// $('#challenge-amount-error').show();
					hideSuccessErrorDiv('alert-success','alert-danger',errors.message);	
				},
				complete:function(){
					// $('#create-challenge')[0].reset();
					$('.loading').hide();
				}
				
			});		
		}

		function playChallenge(ch_id){
			let socket = createSocket();
			$('.loading').show();						
			$.ajax({
				type: "POST",
				async: false,
				dataType: 'json',
				url: 'https://apnaludo.com/play-challenge',
				data: 'ch_id='+ch_id,
				beforeSend: function(){
					
				},
				success:function(data){
					socket.emit('playChallengeServer', data.data);
					var playBtn	=	document.getElementById(ch_id+"-play");
					$("#"+ch_id+"-play").removeClass('bg-secondary');
					$("#"+ch_id+"-play").addClass('bg-warning');
					$("#"+ch_id+"-play").text('');
					$("#"+ch_id+"-play").text('Requested');
					playBtn.removeAttribute("onclick");
					playBtn.setAttribute("onclick","cancelChallengeReq("+ch_id+");");
					// playBtn.addEventListener("click", function () {
					// 	cancelChallengeReq(ch_id);
					// });
					playBtn.removeAttribute("id");
					playBtn.setAttribute("id",ch_id+"-requested");
					//$("#chdiv-"+data.data).hide();
				},
				error:function(data){
					var errors = $.parseJSON(data.responseText);
					// $('#challenge-amount-error').text(errors.message);
					// $('#challenge-amount-error').show();
					hideSuccessErrorDiv('alert-success','alert-danger',errors.message);	
				},
				complete:function(){
					// $('#create-challenge')[0].reset();
					$('.loading').hide();
				}
				
			});		
		}

		function acceptChallenge(ch_id){
			let socket = createSocket();
			$('.loading').show();						
			$.ajax({
				type: "POST",
				async: false,
				dataType: 'json',
				url: 'https://apnaludo.com/accept-challenge',
				data: 'ch_id='+ch_id,
				beforeSend: function(){
					
				},
				success:function(data){
					socket.emit('acceptChallengeServer', data.data);
					//$("#chdiv-"+data.data).hide();
				},
				error:function(data){
					var errors = $.parseJSON(data.responseText);
					// $('#challenge-amount-error').text(errors.message);
					// $('#challenge-amount-error').show();
					hideSuccessErrorDiv('alert-success','alert-danger',errors.message);	
				},
				complete:function(){
					// $('#create-challenge')[0].reset();
					$('.loading').hide();
				}
				
			});		
		}

		function denyChallenge(ch_id){
			let socket = createSocket();
			$('.loading').show();	
				
			$.ajax({
				type: "POST",
				async: false,
				dataType: 'json',
				url: 'https://apnaludo.com/deny-challenge',
				data: 'ch_id='+ch_id,
				beforeSend: function(){
					
				},
				success:function(data){ console.log('Deny  '+ch_id+'-buttons');
					socket.emit('cancelReqServer', data.data);
					document.getElementById(ch_id+'-buttons').innerHTML	=	'';
					html	=	'<button class="btn btn-danger px-3 btn-sm" onclick="cancelChallengeCre('+ch_id+')">DELETE</button>';
					document.getElementById(ch_id+'-buttons').innerHTML	=	html;
					//socket.emit('createChallengeServer', data.data);
					//$("#chdiv-"+data.data).hide();
				},
				error:function(data){
					var errors = $.parseJSON(data.responseText);
					// $('#challenge-amount-error').text(errors.message);
					// $('#challenge-amount-error').show();
					hideSuccessErrorDiv('alert-success','alert-danger',errors.message);	
				},
				complete:function(){
					// $('#create-challenge')[0].reset();
					$('.loading').hide();
				}
				
			});		
		}

		function startChallenge(ch_id){
			let socket = createSocket();
			$('.loading').show();						
			$.ajax({
				type: "POST",
				async: false,
				dataType: 'json',
				url: 'https://apnaludo.com/start-challenge',
				data: 'ch_id='+ch_id,
				beforeSend: function(){
					
				},
				success:function(data){
					socket.emit('startChallengeServer', data.data);
					//$("#chdiv-"+data.data).hide();
				},
				error:function(data){
					var errors = $.parseJSON(data.responseText);
					// $('#challenge-amount-error').text(errors.message);
					// $('#challenge-amount-error').show();
					hideSuccessErrorDiv('alert-success','alert-danger',errors.message);	
				},
				complete:function(){
					// $('#create-challenge')[0].reset();
					$('.loading').hide();
				}
				
			});		
		}

		function cancelChallengeReq(ch_id){
			let socket = createSocket();
			$('.loading').show();						
			$.ajax({
				type: "POST",
				async: false,
				dataType: 'json',
				url: 'https://apnaludo.com/cancel-challenge-req',
				data: 'ch_id='+ch_id,
				beforeSend: function(){
					
				},
				success:function(data){
					socket.emit('cancelReqServer', data.data);
					var requestBtn	=	document.getElementById(ch_id+"-requested");
					$("#"+ch_id+"-requested").removeClass('bg-warning');
					$("#"+ch_id+"-requested").addClass('bg-secondary');
					$("#"+ch_id+"-requested").text('');
					$("#"+ch_id+"-requested").text('Play');
					requestBtn.removeAttribute("onclick");
					requestBtn.removeAttribute("id");
					requestBtn.setAttribute("id",ch_id+"-play");
					requestBtn.setAttribute("onclick","playChallenge("+ch_id+");");
					// requestBtn.addEventListener("click", function () {
					// 	playChallenge(ch_id);
					// });
				},
				error:function(data){
					var errors = $.parseJSON(data.responseText);
					// $('#challenge-amount-error').text(errors.message);
					// $('#challenge-amount-error').show();
					hideSuccessErrorDiv('alert-success','alert-danger',errors.message);	
				},
				complete:function(){
					// $('#create-challenge')[0].reset();
					$('.loading').hide();
				}
				
			});		
		}

		$(window).on('focus', function () {
			// Append this text to the `body` element.
			$.ajax({
				type: "GET",
				dataType: 'json',
				url: 'https://apnaludo.com/challenge-listing',				
				beforeSend: function(){
					
				},
				success:function(data){
					var myChallenges 		= data.data.myChallenges;
					var challenges 			= data.data.challenges;
					//var myPlayChallenges 	= data.data.myPlayChallenges;
					
					var challengeDivHtml	=	setChallengsOpen(challenges);
					$("#challenge-div").empty();
					$("#challenge-div").append(challengeDivHtml);

					var myChallengeDivHtml	=	setMyChallenges(myChallenges);
					$("#my-challenge-div").empty();
					$("#my-challenge-div").append(myChallengeDivHtml);

					// var myPlayChallengeDivHtml	=	setMyPlayChallenges(myPlayChallenges);
					// $("#mychallenge-div-play").empty();
					// $("#mychallenge-div-play").append(myPlayChallengeDivHtml);
					
				//	$("#challenge-div").innerHTML = '<h1>HIIII</h1>';
				},
				error:function(data){
					var errors = $.parseJSON(data.responseText);
					// $('#challenge-amount-error').text(errors.message);
					// $('#challenge-amount-error').show();
					hideSuccessErrorDiv('alert-success','alert-danger',errors.message);	
				},
				complete:function(){
					// $('#create-challenge')[0].reset();
					$('.loading').hide();
				}
				
			});	
		});

		function setChallengsOpen(challenges){
			var user_id	=	'14437';
			var html	=	'';
			for (let i = 0; i < challenges.length; i++) {
				var prize = getPrizeAmount(challenges[i].amount);
				if(challenges[i].c_id == user_id){					
					html	+='<div id="chdiv-'+challenges[i].id+'" class="betCard mt-1"><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">PLAYING FOR';
					html	+='<img class="mx-1" src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt="">'+challenges[i].amount+'</span><div class="betCard-title d-flex align-items-center text-uppercase">';
					html	+='<span class="ml-auto" id="'+challenges[i].id+'-buttons"><button class="btn btn-danger px-3 btn-sm" onclick="cancelChallengeCre('+challenges[i].id+')">DELETE</button>';
					html	+='</span></div></div><div class="py-1 row"><div class="pr-3 text-center col-5"><div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
					html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+challenges[i].cname+'</span></div></div><div class="pr-3 text-center col-2 cxy">';
					html	+='<div><img src="https://apnaludo.com/public/front/images/vs.png" width="30px" alt=""></div></div><div class="text-center col-5"><div class="pl-2">';
					html	+='<img class="border-50" id="'+challenges[i].id+'-loading" src="https://apnaludo.com/public/front/images/small-loading.gif" width="21px" height="21px" alt=""></div><div style="line-height: 1;"><span class="betCard-playerName" id="'+challenges[i].id+'-finding">Finding Player</span></div></div></div></div>';
				}else{
					html	+='<div id="chdiv-'+challenges[i].id+'" class="betCard mt-1">';
					html	+='<span class="betCard-title pl-3 d-flex align-items-center text-uppercase">CHALLENGE FROM<span class="ml-1" style="color: #072c92;">'+challenges[i].cname+' </span></span>';
					html	+='<div class="d-flex pl-3"><div class="pr-3 pb-1"><span class="betCard-subTitle">Entry Fee</span>';
					html	+='<div class="global-rupee-icon"><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+challenges[i].amount+'</span></div></div>';
					html	+='<div><span class="betCard-subTitle">Prize</span><div><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+prize+'</span></div>';
					html	+='</div><button id="'+challenges[i].id+'-play" class="bg-secondary playButton cxy" onclick="playChallenge('+challenges[i].id+');">Play</button></div></div>';
				}			
			}

			return html;
		}

		function setMyChallenges(myChallenges){
			var user_id	=	'14437';
			var html	=	'';
			for (let i = 0; i < myChallenges.length; i++) {
				var prize = getPrizeAmount(myChallenges[i].amount);
				if(myChallenges[i].status == 1 && myChallenges[i].c_id == user_id){
					html	+='<div id="chdiv-'+myChallenges[i].id+'" class="betCard mt-1"><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">PLAYING FOR';
					html	+='<img class="mx-1" src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt="">'+myChallenges[i].amount+'</span><div class="betCard-title d-flex align-items-center text-uppercase">';
					html	+='<span class="ml-auto" id="'+myChallenges[i].id+'-buttons"><button class="btn btn-danger px-3 btn-sm" onclick="cancelChallengeCre('+myChallenges[i].id+')">DELETE</button>';
					html	+='</span></div></div><div class="py-1 row"><div class="pr-3 text-center col-5"><div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
					html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+myChallenges[i].cname+'</span></div></div><div class="pr-3 text-center col-2 cxy">';
					html	+='<div><img src="https://apnaludo.com/public/front/images/vs.png" width="30px" alt=""></div></div><div class="text-center col-5"><div class="pl-2">';
					html	+='<img class="border-50" id="'+myChallenges[i].id+'-loading" src="https://apnaludo.com/public/front/images/small-loading.gif" width="21px" height="21px" alt=""></div><div style="line-height: 1;"><span class="betCard-playerName" id="'+myChallenges[i].id+'-finding">Finding Player</span></div></div></div></div>';
				}else if(myChallenges[i].status == 1 && myChallenges[i].o_id == user_id){
					html	+='<div id="chdiv-'+myChallenges[i].id+'" class="betCard mt-1">';
					html	+='<span class="betCard-title pl-3 d-flex align-items-center text-uppercase">CHALLENGE FROM<span class="ml-1" style="color: #072c92;">'+myChallenges[i].cname+' </span></span>';
					html	+='<div class="d-flex pl-3"><div class="pr-3 pb-1"><span class="betCard-subTitle">Entry Fee</span>';
					html	+='<div class="global-rupee-icon"><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+myChallenges[i].amount+'</span></div></div>';
					html	+='<div><span class="betCard-subTitle">Prize</span><div><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+prize+'</span></div>';
					html	+='</div><button id="'+myChallenges[i].id+'-play" class="bg-secondary playButton cxy" onclick="playChallenge('+myChallenges[i].id+');">Play</button></div></div>';
				}else if(myChallenges[i].status == 2 && myChallenges[i].c_id == user_id){
					html	+='<div id="chdiv-'+myChallenges[i].id+'" class="betCard mt-1"><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">PLAYING FOR';
					html	+='<img class="mx-1" src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt="">'+prize+'</span><div class="betCard-title d-flex align-items-center text-uppercase">';
					html	+='<span class="ml-auto" id="'+myChallenges[i].id+'-buttons"><button id="'+myChallenges[i].id+'-accept" class="btn btn-success px-3 btn-sm" style="cursor: pointer;float: left;width: 65px;height: 31px; " onclick="acceptChallenge('+myChallenges[i].id+')">START</button><button id="'+myChallenges[i].id+'-deny" class="btn btn-danger px-3 btn-sm" style="cursor: pointer;float: right;width: 72px;height: 31px;" onclick="denyChallenge('+myChallenges[i].id+')">REJECT</button>';
					html	+='</span></div></div><div class="py-1 row"><div class="pr-3 text-center col-5"><div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
					html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+myChallenges[i].cname+'</span></div></div><div class="pr-3 text-center col-2 cxy">';
					html	+='<div><img src="https://apnaludo.com/public/front/images/vs.png" width="30px" alt=""></div></div><div class="text-center col-5"><div class="pl-2">';
					html	+='<img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div><div style="line-height: 1;"><span class="betCard-playerName">'+myChallenges[i].oname+'</span></div></div></div></div>';
				}else if(myChallenges[i].status == 2 && myChallenges[i].o_id == user_id){
					html	+='<div id="chdiv-'+myChallenges[i].id+'" class="betCard mt-1"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">CHALLENGE FROM<span class="ml-1" style="color: #072c92;">You </span></span>';
					html	+='<div class="d-flex pl-3"><div class="pr-3 pb-1"><span class="betCard-subTitle">Entry Fee</span><div><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+myChallenges[i].amount+'</span></div></div>';
					html	+='<div><span class="betCard-subTitle">Prize</span><div><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+prize+'</span>';
					html	+='</div></div><button id="'+myChallenges[i].id+'-requested" class="bg-warning playButton cxy" onclick="cancelChallengeReq('+myChallenges[i].id+')">Requested</button></div></div>	';	
				}else if(myChallenges[i].status == 3 && myChallenges[i].o_id == user_id){
					html    +='<div id="chdiv-'+myChallenges[i].id+'" class="betCard mt-1"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">CHALLENGE FROM<span class="ml-1" style="color: #072c92;">'+myChallenges[i].cname+' </span></span>';
					html    +='<div class="d-flex pl-3"><div class="pr-3 pb-1"><span class="betCard-subTitle">Entry Fee</span><div><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+myChallenges[i].amount+'</span>';
					html    +='</div></div><div><span class="betCard-subTitle">Prize</span><div><img src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">'+prize+'</span>';
					html    +='</div></div><button id="'+myChallenges[i].id+'-start-btn" class="bg-success playButton cxy" onclick="startChallenge('+myChallenges[i].id+')">START</button></div></div>';
				}
			}
			return html;
		}

		function setMyPlayChallenges(myPlayChallenges){
			var user_id	=	'14437';
			var html	=	'';
			for (let i = 0; i < myPlayChallenges.length; i++) {
				var prize = getPrizeAmount(myPlayChallenges[i].amount);
				html	+='<div class="betCard mt-1" id="myplaying-chdiv-'+myPlayChallenges[i].id+'" ><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">PLAYING FOR';
				html	+='<img class="mx-1" src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt="">'+prize+'</span><div class="betCard-title d-flex align-items-center text-uppercase">';
				html	+='<span class="ml-auto"><a href="https://apnaludo.com/challenge-detail/'+myPlayChallenges[i].id+'"  class="btn btn-info px-3 btn-sm" >View</a>	</span></div></div>';
				html	+='<div class="py-1 row"><div class="pr-3 text-center col-5"><div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
				html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+myPlayChallenges[i].cname+'</span></div></div><div class="pr-3 text-center col-2 cxy">';
				html	+='<div><img src="https://apnaludo.com/public/front/images/vs.png" width="30px" alt=""></div></div><div class="text-center col-5">';
				html	+='<div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
				html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+myPlayChallenges[i].oname+'</span></div></div></div></div>';
			}
			return html;
		}

		function setPlayChallenges(playChallenges){
			var user_id	=	'14437';			
			var html	=	'';
			for (let i = 0; i < playChallenges.length; i++) {
				var prize = getPrizeAmount(playChallenges[i].amount);
				html	+='<div class="betCard mt-1" id="playing-chdiv-'+playChallenges[i].id+'"><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">';
				html	+='PLAYING FOR<img class="mx-1" src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt="">'+playChallenges[i].amount+'</span><div class="betCard-title d-flex align-items-center text-uppercase">';
				html	+='<span class="ml-auto mr-3">PRIZE<img class="mx-1" src="https://apnaludo.com/public/front/images/global-rupeeIcon.png" width="21px" alt="">'+prize+'</span></div></div>';
				html	+='<div class="py-1 row"><div class="pr-3 text-center col-5"><div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
				html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+playChallenges[i].cname+'</span></div></div><div class="pr-3 text-center col-2 cxy">';
				html	+='<div><img src="https://apnaludo.com/public/front/images/vs.png" width="30px" alt=""></div></div><div class="text-center col-5">';
				html	+='<div class="pl-2"><img class="border-50" src="https://apnaludo.com/public/front/images/author.svg" width="21px" height="21px" alt=""></div>';
				html	+='<div style="line-height: 1;"><span class="betCard-playerName">'+playChallenges[i].oname+'</span></div></div></div></div>';				
			}			
			return html;
		}
		
	</script>