<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ url('/assets/logo/' . $logo ?? '') }}" />
    <title>
        {{ isset($settingData['site_title']) && !empty($settingData['site_title']) ? $settingData['site_title'] : 'Ludo' }}
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,600,700,800,900">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ url('assets/front/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ url('assets/front/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('assets/front/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ url('assets/front/css/font.css') }}" rel="stylesheet">
    <link href="{{ url('assets/front/css/bootstrap-side-modals.css') }}" rel="stylesheet">
    <script src="{{ url('assets/front/js/cdn.jsdelivr.net_npm_sweetalert2@11.js') }}"></script>
    <link rel="apple-touch-icon" href="{{ url('/assets/logo/' . $logo ?? '') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <script src="{{ url('assets/front/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/front/js/bootstrap.min.js') }}"></script>
</head>

<body>
    <!-- <div class="bg-danger py-2 text-white w-100">Commission: 5% ◉ Referral: 2% For All Games</div> -->
    @include('partials.front-end.menu')

    <!-- <span class='d-none' id=''></span> -->
    <input type="hidden" value="{{ Auth::user()->id ?? '' }}" id="userID">
    <div class="modal modal-bottom fade" id="bottom_modal" tabindex="-1" role="dialog" aria-labelledby="bottom_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">How To Play Games & Earn?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe style="width: 100%;" src="https://www.youtube.com/watch?v=2R9GTFeynJg">
                    </iframe>
                </div>
                <div class="modal-footer modal-footer-fixed d-none">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-bottom fade" id="rules_modal" tabindex="-1" role="dialog" aria-labelledby="rules_modal">
        <div class="modal-dialog" role="document"style="
  height: 252px !important;
  overflow: scroll !important;
">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Game Rules</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="offcanvas-body">
                        <ul class="list-group mb-3">
                            <li class="list-group-item text-start">यदि गेम Join करने के बाद Opponent का एक भी टोकन ओपन
                                हो जाता है और आप किसी भी कारण से तुरंत लेफ्ट करते है तो आपको सीधा <span
                                    style="color: red;">30% Loss</span> कर दिया जायेगा ! यदि आप जान भुजकर Autoexit करते
                                है तो भी आपको 100% Loss कर दिया जायेगा ! यदि दोनों प्लेयर में किसी की काटी खुली नहीं तो
                                उसे हम कैंसिल कर सकते है !</li>
                            <li class="list-group-item text-start">यदि एक टोकन बाहर है और घर के पास है तो <span
                                    style="color: red;">30% Loss</span> दिया जायेगा लेकिन यदि गेम खेला गया है और 2 काटी
                                बहार आयी हो तो गेम को लेफ्ट करने वाले को 100% Loss कर दिया जायेगा !</li>
                            <li class="list-group-item text-start">Autoexit में यदि 1 टोकन बाहर है तो गेम कैंसिल किया जा
                                सकता है लेकिन यदि आपने गेम जान भुजकर में छोड़ा होगा तो आपको Loss ही दिया जायेगा इसमें
                                अंतिम निर्णय Admin का होगा !</li>
                            <li class="list-group-item text-start">यदि आपको लगता है की Opponent ने जानभूझकर गेम को
                                Autoexit में छोड़ा है लेकिन Admin ने कैंसिल कर दिया है तो आपसे वीडियो प्रूफ माँगा जायेगा
                                इसलिए हर गेम को रिकॉर्ड करना जरुरी है ! यदि आप वीडियो प्रूफ नहीं देते है तो गेम रिजल्ट
                                एडमिन के अनुसार ही अपडेट किया जायेगा चाहे आप विन हो या गेम कैंसिल हो !</li>
                            <li class="list-group-item text-start">Game समाप्त होने के 15 मिनट के अंदर रिजल्ट डालना
                                आवश्यक है अन्यथा Opponent के रिजल्ट के आधार पर गेम अपडेट कर दिया जायेगा चाहे आप जीते या
                                हारे और इसमें पूरी ज़िम्मेदारी आपकी होगी इसमें बाद में कोई बदलाव नहीं किया जा सकता है !
                            </li>
                        </ul>
                        <ul class="list-group mb-3">
                            <li class="list-group-item text-start">Win होने के बाद आप गलत स्क्रीनशॉट डालते है तो गेम को
                                सीधा Cancel कर दिया जायेगा इसलिए यदि आप स्क्रीनशॉट लेना भूल गए है तो पहले Live Chat में
                                एडमिन को संपर्क करे उसके बाद ही उनके बताये अनुसार रिजल्ट पोस्ट करे !</li>
                            <li class="list-group-item text-start">दोनों प्लेयर की टोकन (काटी) घर से बाहर न आयी हो तो
                                लेफ्ट होकर गेम कैंसिल किया जा सकता है ! [कैंसिल प्रूफ करने के लिए वीडियो आवश्यक होगा]
                            </li>
                            <li class="list-group-item text-start">'कैंसिल' रिजल्ट डालने के बाद गेम प्ले करके जीत जाते
                                है तो उसमे हमारी कोई ज़िम्मेदारी नहीं होगी अतः गेम कैंसिल करने के बाद स्टार्ट न करे
                                अन्यथा वो कैंसिल ही माना जायेगा</li>
                            <li class="list-group-item text-start">एक बार रिजल्ट डालने के बाद बदला नहीं जा सकता है इसलिए
                                सोच समझकर रिजल्ट पोस्ट करे गलत रिजल्ट डालने पर पेनल्टी भी लगायी जाएगी चाहे आपने वो गलती
                                से डाला हो या जान भुजकर !</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="leftContainer ">
        <div class="headerContainer">
            <div id="menu-toggle">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="24" height="24"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.5 11.5A.5.5 0 0 1 5 11h10a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm-2-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm-2-4A.5.5 0 0 1 1 3h10a.5.5 0 0 1 0 1H1a.5.5 0 0 1-.5-.5z">

                    </path>
                </svg>


            </div>
            <!--  <a id="menu-toggle" class="cxy h-100">
            <div class="sideNavIcon mr-2"><img src="{{ url('assets/front/images/nav-menu-icon.svg') }}" alt=""></div>
         </a> -->
            <a href="{{ url('home') }}">
                <div class="ml-2 navLogo d-flex"><img src="{{ url('/assets/logo/' . $logo ?? '') }}" alt="">
                </div>
            </a>
            @if (isset(Auth::user()->id))
                <div class="menu-items">
                    <div class="py-1 bg-white border px-2 text-dark d-flex align-items-center rounded-2"
                        style="border-radius: 6px;"><svg style="margin-right: 7px;"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em"
                            fill="green" class="me-2">
                            <path
                                d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z">
                            </path>
                            <path
                                d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z">
                            </path>
                        </svg><a href="{{ url('wallet') }}"><strong
                                style="text-decoration: none;color: #000000c2 !important;">
                                {{ number_format((Auth::user()->wallet ?? 0) + (Auth::user()->deposit_amount ?? 0), 2) }}</strong></a>
                    </div>
                </div>
            @endif
            <span class="mx-5"></span>
        </div>
        <div class="main-area" style="padding-top: 60px;">
            @yield('content')
            <!-- @include('partials.front-end.footer') -->
        </div>
    </div>
    <div class="divider-y"></div>
    <div class="px-3 py-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"> </div>

                <div class="col-md-8"></div>
            </div>
        </div>
    </div>
    <div class="rightContainer">
        <div class="rcBanner flex-center">
            <div class="rcBanner-img-container"><img src="{{ url('/assets/logo/' . $logo ?? '') }}" alt="">
            </div>
            <div class="rcBanner-text">{{ env('SITE_NAME') }} <span class="rcBanner-text-bold">Win Real Cash!</span>
            </div>

        </div>
    </div>
    <script>
        var USERID = {{ Auth::user()->id ?? 'null' }};
        // alert(USERID);
    </script>
    <!-- // console.log('USERID'+); -->
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function(reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>

    <script src="{{ url('assets/front/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/front/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://js.pusher.com/3.1/pusher.min.js"></script>
    <!--<script src="{{ url('assets/front/js/custom.js') }}"></script>-->
    <!--<script src="{{ url('assets/front/js/basic.js') }}"></script>-->
    <script src="{{ url('assets/front/js/main.js') }}"></script>
    <script>
        // $(document).ready(function(){
        sendRequest();

        function sendRequest() {

            console.log("andsendRequest");
            setInterval(sendRequest, 10000);
            // console.log(getRandom10());
            $('.left_data').remove();
            var html = '';
            for (let i = 0; i < Math.floor(Math.random() * 10); i++) {
                html +=
                    '<li class="p-0 overflow-hidden appear-from-left apped_data left_data" id="chdiv-0"><div class="my-1 card"><div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by</span><span class="text-success fw-bold"><b>Rs ' +
                    getRandom10() +
                    '</b></span></div><div class="d-flex align-items-center justify-content-between card-body bet__cover"><div class="d-flex align-items-center flex-grow-1"><div class=" rounded-circle me-2" style="height: 24px; width: 24px;"> <img class="cover__image" src="https://www.starludoplayers.com/assets/front/images/avatar.png"></div><span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>' +
                    name() +
                    '</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2"><button class="btn btn-primary playChallange btn-sm" id="0-play" onclick="playChallenge(0);">Play</button></div></div></div></div></li>';
                // html += '<li class="p-0 overflow-hidden appear-from-left apped_data left_data" id="chdiv-0"><div class="my-1 card"><div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by</span><span class="text-success fw-bold"><b>Rs '+getRandom10()+'</b></span></div><div class="d-flex align-items-center justify-content-between card-body bet__cover"><div class="d-flex align-items-center flex-grow-1"><div class=" rounded-circle me-2" style="height: 24px; width: 24px;"> <img class="cover__image" src="https://www.starludoplayers.com/assets/front/images/avatar.png"></div><span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>'+name()+'</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2"><button class="btn btn-primary playChallange btn-sm" id="0-play" onclick="playChallenge(0);">Play</button></div></div></div></div></li>';

            }
            // $('#my-challenge-div').append(html);

        };
        // });
        function name() {
            var myArray = ["Aarav", "Omi Yadav", "Radhika", "Samne aa na", "Demo king", "Aryan Sharma", "Rohan", "Vikram",
                "Aditya Jat", "Arjun", "Siddharth", "Kiran", "Rahul rdx", "Amit", "Alok", "Ankit Demo", "Deepak",
                "Gopal", "Harish", "Ishan", "Jatin", "Kunal", "Manish", "Nitin", "Prateek", "Rajesh", "Suresh", "Varun",
                "Yogesh", "Akhil", "Bhavin", "Chetan", "Dhruv", "Girish", "Hitesh", "Kartik", "Mayank", "Naveen",
                "Pankaj", "Rakesh", "Sumit", "Vivek", "Akash", "Bharat", "Dinesh", "Hemant", "Jagdish", "Kamal",
                "Mukesh", "Nikhil", "Parth", "Ravi", "Sunil", "Vishal", "Abhinav", "Bipin", "Chirag", "Divyesh", "Hari",
                "Jayesh", "Ketan", "Nirav", "Pranav", "Rohit", "Sachin", "Tanmay", "Yash", "Arun", "Dilip", "Indrajeet",
                "Kishan", "Nishant", "Pramod", "Rajiv", "Sanjay", "Tarun", "Ajay", "Brijesh", "Ganesh", "Jignesh",
                "Krishna", "Nikhil", "Piyush", "Rajat", "Satish", "Udit", "Amar", "Deepesh", "Himanshu", "Kamlesh",
                "Mohit", "Pritesh", "Raman", "Shyam", "Varun", "Yashwant", "Anand", "Dipesh", "Ishwar", "Ketan",
                "Nishit", "Prashant", "Ranjeet", "Siddhant", "Vibhav", "Akhilesh", "Chandrashekhar", "Divyansh",
                "Hitesh", "Kapil", "Mudit", "Puneet", "Ravindra", "Sourabh", "Vijay", "Yogendra", "Alok", "Dushyant",
                "Imran", "Karan", "Nitin", "Pankaj", "Rishabh", "Sudhir", "Vikas", "Aman", "Gaurav", "Jayant", "Kartik",
                "Naveen", "Prashant", "Rohit", "Sumanth", "Vikrant", "Amitabh", "Bhupendra", "Gopal", "Jeetendra",
                "Kishore", "Neeraj", "Prateek", "Rajesh", "Sunil", "Vinay", "Amol", "Bipin", "Girish", "Jitendra",
                "Krishna", "Nikhil", "Praveen", "Rajiv", "Suresh", "Vishal", "Ankur", "Chandan", "Harish", "Kamal",
                "Nilesh", "Puneet", "Rakesh", "Tanmay", "Yash", "Anupam", "Chetan", "Hemant", "Kapil", "Nirav", "Raman",
                "Tarun", "Arun", "Dhaval", "Himanshu", "Karan", "Piyush", "Ramesh", "Shashank", "Udit", "Ashish",
                "Dheeraj", "Indrajeet", "Kishan", "Nishant", "Pramod", "Ravi", "Shyam", "Vikram", "Ashok", "Divyesh",
                "Jagdish", "Kishore", "Nishit", "Prashant", "Rohit", "Siddharth", "Vivek"
            ];
            var randomItem = myArray[Math.floor(Math.random() * myArray.length)];
            return randomItem;
        }

        function getRandom10() {
            return getRandomInt(2, 5) * 50; // Returns 10, 20, 30, 40 or 50
        }

        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        }

        // function copyRoomCode() {

        //     var copyText = document.getElementById("copy-room-code");


        //     copyText.select();
        //     copyText.setSelectionRange(0, 99999); 

        //     navigator.clipboard.writeText(copyText.value);
        //     // toastr.success('Copied');
        //     $('.roomm-code').html('Copied');

        //   }

        function copyRoomCode() {
            var copyText = document.getElementById("copy-room-code");
            copyText.select();
            copyText.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(copyText.value);

            // Update the text content inside the button
            document.querySelector('.roomm-code').textContent = 'Copied';
        }

        var button = document.querySelector('.roomm-code');
        if (button) {
            button.addEventListener('click', copyRoomCode);
            button.addEventListener('touchend', copyRoomCode);
        }

        function copyRoomCodeq() {
            var copyText = document.getElementById("copy-room-codes-copy");
            copyText.select();
            copyText.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(copyText.value);

            // Update the text content inside the button
            document.querySelector('.roomm-code').textContent = 'Copied';
        }

        var button = document.querySelector('.roomm-code');
        if (button) {
            button.addEventListener('click', copyRoomCodeq);
            button.addEventListener('touchend', copyRoomCodeq);
        }

        //   function copyRoomCodeq() {

        //     var copyText = document.getElementById("copy-room-codes-copy");


        //     copyText.select();
        //     copyText.setSelectionRange(0, 99999); 

        //     navigator.clipboard.writeText(copyText.value);
        //     // toastr.success('Copied');
        //     $('.roomm-code').html('Copied');

        //   }

        $('#post-result').submit(function(e) {
            $this = $(this);
            e.preventDefault();
            var upload_sreenshot = $('#upload_sreenshot').val();
            var flag = 1;
            if (upload_sreenshot == '') {
                toastr.error('Please Select winning image');
                flag = 0;
                return false;
            }
            $('.post_btn').html('Posting.. please wait');

            $form = $(this);
            var formData = new FormData(this);

            if (flag) {

                $.ajax({
                    type: "POST",
                    async: false,
                    dataType: 'json',
                    url: '/mark-result',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.loading').show();
                    },
                    success: function(data) {
                        // socket.emit('createChallengeServer', data.data);
                        if (data.status == false) {
                            toastr.error(data.message);

                            $('.post_btn').html('Submit');


                        }
                        if (data.status == true) {
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
                    error: function(data) {
                        var errors = $.parseJSON(data.responseText);
                        // toastr.error('Please enter a valid amount');
                    },
                    complete: function() {
                        $('#challenge-amount').val('');
                        $('.loading').hide();
                    }

                });
            }
        });

        $(document).on('change', '#upload_profile', function(e) {

            e.preventDefault();
            var upload_sreenshot = $(this).val();
            var flag = 1;
            if (upload_sreenshot == '') {
                toastr.error('Please Select winning image');
                flag = 0;
                return false;
            }
            // $form = ;

        });
        $('#post-result-looser').submit(function(e) {

            e.preventDefault();

            var formData = new FormData(this);
            var flag = true;
            if (flag) {

                $.ajax({
                    type: "POST",
                    async: false,
                    dataType: 'json',
                    url: '/mark-result',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.loading').show();
                    },
                    success: function(data) {
                        // socket.emit('createChallengeServer', data.data);
                        if (data.status == false) {
                            toastr.error(data.message);
                        }
                        if (data.status == true) {
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
                    error: function(data) {
                        var errors = $.parseJSON(data.responseText);
                        // toastr.error('Please enter a valid amount');
                    },
                    complete: function() {
                        $('#challenge-amount').val('');
                        $('.loading').hide();
                    }

                });
            }
        });
        $('#cancel-challange').submit(function(e) {

            e.preventDefault();

            var formData = new FormData(this);
            var flag = true;
            if (flag) {

                $.ajax({
                    type: "POST",
                    async: false,
                    dataType: 'json',
                    url: '/cancel-challange',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.loading').show();
                    },
                    success: function(data) {
                        // socket.emit('createChallengeServer', data.data);
                        if (data.status == false) {
                            toastr.error(data.message);
                        }
                        if (data.status == true) {
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
                    error: function(data) {
                        var errors = $.parseJSON(data.responseText);
                        // toastr.error('Please enter a valid amount');
                    },
                    complete: function() {
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
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
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
                beforeSend: function() {
                    $('.loading').show();
                },
                success: function(data) {
                    // socket.emit('createChallengeServer', data.data);
                    if (data.status == false) {
                        toastr.error(data.message);
                    }
                    if (data.status == true) {
                        toastr.success(data.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }

                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                },
                complete: function() {
                    $('#challenge-amount').val('');
                    $('.loading').hide();
                }

            });

        });

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
        $('#otp_login').submit(function(e) {
            e.preventDefault();
            var phone_login = $('.phone_login').val();
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
                        phone: phone_login
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                    },
                    beforeSend: function() {
                        $(".ajax-load").show();
                    },
                })
                .done(function(data) {
                    if (data.status == false) {
                        toastr.error(data.message);
                    }
                    if (data.status == true) {
                        toastr.success(data.message);
                        $('.otp_screen').removeClass('d-none');
                        $('.number_screen').addClass('d-none');
                    }

                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    toastr.error('Something went wrong!');
                });
        });


        $(document).on("click", ".verify_otp", function() {
            var phone_login = $('.phone_login').val();
            var login_otp_val = $('.login_otp_val').val();
            if (phone_login == '') {
                toastr.error('Enter phone number or email');
                return false;
            }
            if (login_otp_val == '') {
                toastr.error('Oops! Enter otp');
                return false;
            }

            $.ajax({
                    url: '/verify-otp',
                    type: "get",
                    data: {
                        phone: phone_login,
                        otp: login_otp_val,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                    },
                    beforeSend: function() {
                        $(".ajax-load").show();
                    },
                })
                .done(function(data) {
                    if (data.status == false) {
                        toastr.error(data.message);
                    }
                    if (data.status == true) {
                        toastr.success(data.message);
                        window.location.href = "home";
                    }

                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
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
        $(document).on("click", ".save_user_name", function() {
            var save_user_name_input = $('.save_user_name_input').val();
            var this_val = $(this);
            if (save_user_name_input == '') {
                toastr.error('Enter full name');
                return false;
            }

            $.ajax({
                    url: 'apply-name',
                    type: "get",
                    data: {
                        save_user_name_input: save_user_name_input
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                    },
                    beforeSend: function() {
                        $(".ajax-load").show();
                    },
                })
                .done(function(data) {
                    if (data.status == false) {
                        toastr.error(data.message);
                    }
                    if (data.status == true) {
                        toastr.success(data.message);
                        $('.save_user_name_input').val(data.name);
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    toastr.error('Something went wrong!');
                });
        });

        //register functiom
        //refer code system
        $(document).on("click", ".submit__btn", function() {
            var full_name = $('.full__name').val();
            var mobile_number = $('.mobile__number').val();
            var refer_code_signup = $('.refer_code_signup').val();
            
            var this_val = $(this);
            if (full_name == '') {
                toastr.error('Enter full name');
                return false;
            }
            if (mobile_number == '') {
                toastr.error('Enter mobile number');
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
                        mobile_number: mobile_number
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                    },
                    beforeSend: function() {
                        $(".ajax-load").show();
                    },
                })
                .done(function(data) {
                    if (data.status == false) {
                        console.log(data);
                        toastr.error(data.message);
                    }
                    if (data.status == true) {
                        toastr.success(data.message);
                        window.location.href = "login";
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    toastr.error('Something went wrong!');
                });
        });

        $('#verify_otp_login').submit(function(e) {
            e.preventDefault();
            var phone_login = $('.phone_login').val();
            // var password = $('.password').val();
            var this_val = $(this);
            if (phone_login == '') {
                toastr.error('Enter phone number or email');
                return false;
            }

            // if (password == '') {
            //     toastr.error('Oops! Enter password');
            //     return false;
            // }

            $.ajax({
                    url: '/verify-otp',
                    type: "get",
                    data: {
                        phone: phone_login,
                        // password: password,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                    },
                    beforeSend: function() {
                        $(".ajax-load").show();
                    },
                })
                .done(function(data) {
                    if (data.status == false) {
                        toastr.error(data.message);
                    }
                    if (data.status == true) {
                        toastr.success(data.message);
                        window.location.href = "home";
                    }

                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    toastr.error('Something went wrong!');
                });
        });
        $(document).on("click", ".update_password", function() {

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
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                    },
                    beforeSend: function() {
                        $(".ajax-load").show();
                    },
                })
                .done(function(data) {
                    if (data.status == false) {
                        toastr.error(data.message);
                    }
                    if (data.status == true) {
                        toastr.success(data.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }

                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    toastr.error('Something went wrong!');
                });
        });
        $(document).on("click", "#addMoney", function(event) {
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
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                    },
                    beforeSend: function() {
                        $(".ajax-load").show();
                    },
                })
                .done(function(data) {
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
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    toastr.error('Something went wrong!');
                });
        });

        // add money manual
        $('#addManualMoneyForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the form from submitting via the browser

            var formData = new FormData(this); // Create a FormData object from the form

            $.ajax({
                url: "{{ url('add-money-manual') }}", // The URL to submit the form data to
                type: 'POST',
                data: formData,
                contentType: false, // Tell jQuery not to set any content type header
                processData: false, // Tell jQuery not to process the data
                headers: {
                    "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    console.log("-response",response)
                    // Handle successful response
                    // alert('Form submitted successfully!');
                    $('#addManualMoneyForm')[0].reset();
                    Swal.fire(
                        'Data saved Successful lets wait once admin approve then wallet will be updated!',
                        "You're money richer shortly",
                        'success'
                    )
                },
                error: function (xhr, status, error) {
                    // Handle errors
                    // alert('An error occurred: ' + error);
                    toastr.error('An error occurred');
                }
            });
        });

        //betting js
        var getGameType = $('.getGameType').val();

        $(function() {
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


            $('#withdrawal__add').submit(function(e) {

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
                        beforeSend: function() {
                            $('.loading').show();
                        },
                        success: function(data) {
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
                        error: function(data) {
                            var errors = $.parseJSON(data.responseText);
                            // toastr.error('Please enter a valid amount');
                        },
                        complete: function() {
                            $('#challenge-amount').val('');
                            $('.loading').hide();
                        }

                    });
                }
            });




            $('#withdrawal__add_live').submit(function(e) {

                e.preventDefault();
                var method = $('#method').val();
                var accountNumber = $('#accountNumber').val();
                var confirm_accountNumber = $('#confirm_accountNumber').val();
                var ifscCode = $('#ifscCode').val();
                var mobileNo = $('#mobileNo').val();
                var amount = $('#amount').val();
                var payeeName = $('#payeeName').val();
                
                var flag = 1;

                if (method == '') {
                    toastr.error('Select withdraw method');
                    flag = 0;
                    return false;
                }
                if (accountNumber == '') {
                    toastr.error('Enter Account Number');
                    flag = 0;
                    return false;
                }
                if (confirm_accountNumber == '') {
                    toastr.error('Enter Confirm Account Number');
                    flag = 0;
                    return false;
                }
                if (confirm_accountNumber != accountNumber) {
                    toastr.error('Account Number and Confirm Account Number must be the same');
                    flag = 0;
                    return false;
                }
                if (ifscCode == '') {
                    toastr.error('Enter IFSC Code');
                    flag = 0;
                    return false;
                }
                if (payeeName == '') {
                    toastr.error('Enter payeeName');
                    flag = 0;
                    return false;
                }
                if (mobileNo == '') {
                    toastr.error('Enter Mobile Number');
                    flag = 0;
                    return false;
                }
                if (amount == '') {
                    toastr.error('Please withdraw amount');
                    flag = 0;
                    return false;
                }
                if (!$.isNumeric(amount)) {
                    toastr.error('Please enter a numeric value for amount');
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
                        url: '/add-withdrawal-live',
                        data: $form.serialize(),
                        beforeSend: function() {
                            $('.loading').show();
                        },
                        success: function(data) {
                            if (data.status == false) {
                                toastr.error(data.message);
                            }
                            if (data.status == true) {
                                Swal.fire(
                                    'Withdrawal Successful!',
                                    "Your money will be credited shortly",
                                    'success'
                                )
                            }
                        },
                        error: function(data) {
                            var errors = $.parseJSON(data.responseText);
                        },
                        complete: function() {
                            $('#accountNumber').val('');
                            $('#payeeName').val('');
                            
                            $('#confirm_accountNumber').val('');
                            $('#ifscCode').val('');
                            $('#mobileNo').val('');
                            $('#amount').val('');
                            $('.loading').hide();
                            
                            // Reload the page
                            window.location.reload();
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
            html +=
                '<span class="betCard-title pl-3 d-flex align-items-center text-uppercase">CHALLENGE FROM<span class="ml-1" style="color: #072c92;">' +
                data.cname + ' </span></span>';
            html += '<div class="d-flex pl-3"><div class="pr-3 pb-1"><span class="betCard-subTitle">Entry Fee</span>';
            html +=
                '<div class="global-rupee-icon"><img src="/assets/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">' +
                data.amount + '</span></div></div>';
            html +=
                '<div><span class="betCard-subTitle">Prize</span><div><img src="/assets/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">' +
                prize + '</span></div>';
            html += '</div><button id="' + data.id + '-play" class="bg-secondary playButton cxy" onclick="playChallenge(' +
                data.id + ');">Play</button></div></div>';

            return html;
        }

        function listChallengeCre(data) {
            // var prize	=	getPrizeAmount(data.amount);
            var html = '';

            html += '<li id="chdiv-' + data.id +
                '" class=" p-0="" overflow-hidden="appear-from-left""><div class="my-1 card">';
            html +=
                '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by You</span>';
            html += '<span class="text-success fw-bold"><b>Rs ' + data.amount +
                '</b></span></div><div class="d-flex align-items-center justify-content-between card-body bet__cover">';
            html +=
                '<div class="d-flex align-items-center flex-grow-1"><div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="31-loading">';
            html += '<i id="' + data.id +
                '-loading" class="fa fa-spinner fa-spin" style="font-size:24px"></i></div><span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;">';
            html +=
                '<b>Finding Player</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2" id="31-buttons"  id="' +
                data.id + '-buttons">';
            html += '<button class="btn btn-danger playChallange btn-sm"onclick="cancelChallengeCre(' + data.id +
                ')" style="width: 54px !important;">Delete</button></div></div></div></div></li>';
            return html;
        }



        function startGameHtml(data) {
            var prize = getPrizeAmount(data.amount);
            var html = '';

            html += '<div id="chdiv-' + data.id +
                '" class="betCard mt-1"><div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">CHALLENGE FROM<span class="ml-1" style="color: #072c92;">' +
                data.cname + ' </span></span>';
            html +=
                '<div class="d-flex pl-3"><div class="pr-3 pb-1"><span class="betCard-subTitle">Entry Fee</span><div><img src="/assets/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">' +
                data.amount + '</span>';
            html +=
                '</div></div><div><span class="betCard-subTitle">Prize</span><div><img src="/assets/front/images/global-rupeeIcon.png" width="21px" alt=""><span class="betCard-amount">' +
                prize + '</span>';
            html += '</div></div><button id="' + data.id +
                '-start-btn" class="bg-success playButton cxy" onclick="startChallenge(' + data.id +
                ')">START</button></div></div>';
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
                beforeSend: function() {

                },
                success: function(data) {
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
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
                },
                complete: function() {
                    $('.loading').hide();
                }

            });
        }

        function playChallenge(ch_id) {
            // let socket = createSocket();
            if (ch_id == '0') {
                toastr.error('Challenge already joined');
                sendRequest();
                return false;
            }
            $('.loading').show();
            $.ajax({
                type: "GET",
                async: false,
                dataType: 'json',
                url: '/challenge-requesting',
                data: 'ch_id=' + ch_id,
                beforeSend: function() {

                },
                success: function(data) {
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
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
                },
                complete: function() {
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
                beforeSend: function() {

                },
                success: function(data) {
                    // socket.emit('acceptChallengeServer', data.data);
                    if (data.status == false) {
                        toastr.error(data.message);
                    }
                    if (data.status == true) {
                        // socket.emit('cancelReqServer', data.data);

                        reloadList();
                    }
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
                },
                complete: function() {
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
                beforeSend: function() {

                },
                success: function(data) {
                    if (data.status == false) {
                        toastr.error(data.message);
                    }
                    if (data.status == true) {
                        // socket.emit('cancelReqServer', data.data);
                        document.getElementById(ch_id + '-buttons').innerHTML = '';
                        html =
                            '<button class="btn btn-danger playChallange btn-sm" onclick="cancelChallengeCre(' +
                            ch_id + ')">Delete</button>';
                        reloadList();
                    }
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
                },
                complete: function() {
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
                beforeSend: function() {
                    cancelChallengeReq

                },
                success: function(data) {
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
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
                },
                complete: function() {
                    $('.loading').hide();
                }

            });
        }

        $(window).on('focus', function() {
            // Append this text to the `body` element.
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: '/challenge-listing',
                data: 'getGameType=' + getGameType,

                beforeSend: function() {

                },
                _success: function(data) {
					console.log("-my-challenge-div");
                    var myChallenges = data.data.myChallenges;
                    var challengeRunning = data.data.challengeRunning;

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
                    $("#my-challenge-div1").append(runningChalllanges);
                    if (data.data.myRunnungCallenge != '') {
                        $("#myOpenCallHeader").html(
                            "<div class='separator mt-3 mb-3'><img src='/assets/front/images/winner-cup-icon-png-19.png'style='height: 20px; width: 20px;'>&nbsp; Your Open Challenges &nbsp;<img src='/assets/front/images/winner-cup-icon-png-19.png'  style='height: 20px; width: 20px;''></div>"
                        );
                    }
                    $("#my-running-challenge-list").html(data.data.myRunnungCallenge);


                },
                get success() {
                    return this._success;
                },
                set success(value) {
                    this._success = value;
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
                },
                complete: function() {
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


                beforeSend: function() {

                },
                _success: function(data) {
					console.log("-my-challenge-div 2");
                    var myChallenges = data.data.myChallenges;
                    //  console.log(myChallenges);
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
                    $("#my-challenge-div1").append(runningChalllanges);
                    if (data.data.myRunnungCallenge != '') {
                        $("#myOpenCallHeader").html(
                            "<div class='separator mt-3 mb-3'><img src='/assets/front/images/winner-cup-icon-png-19.png'style='height: 20px; width: 20px;'>&nbsp; Your Open Challenges &nbsp;<img src='/assets/front/images/winner-cup-icon-png-19.png'  style='height: 20px; width: 20px;''></div>"
                        );
                    }
                    $("#my-running-challenge-list").html(data.data.myRunnungCallenge);


                },
                get success() {
                    return this._success;
                },
                set success(value) {
                    this._success = value;
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
                },
                complete: function() {
                    $('.loading').hide();
                }

            });
        }

        $(document).ready(function() {
            // Append this text to the `body` element.
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: '/challenge-listing',
                data: 'getGameType=' + getGameType,

                beforeSend: function() {

                },
                _success: function(data) {
					console.log("-my-challenge-div 3");
                    var myChallenges = data.data.myChallenges;
                    var challengeRunning = data.data.challengeRunning;
                    //  console.log(myChallenges);;
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
                    $("#my-challenge-div1").append(runningChalllanges);
                    if (data.data.myRunnungCallenge != '') {
                        $("#myOpenCallHeader").html(
                            "<div class='separator mt-3 mb-3'><img src='/assets/front/images/winner-cup-icon-png-19.png'style='height: 20px; width: 20px;'>&nbsp; Your Open Challenges &nbsp;<img src='/assets/front/images/winner-cup-icon-png-19.png'  style='height: 20px; width: 20px;''></div>"
                        );
                    }
                    $("#my-running-challenge-list").html(data.data.myRunnungCallenge);


                },
                get success() {
                    return this._success;
                },
                set success(value) {
                    this._success = value;
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    hideSuccessErrorDiv('alert-success', 'alert-danger', errors.message);
                },
                complete: function() {
                    $('.loading').hide();
                }

            });
        });

        function setChallengsOpen(myChallenges) {
            var user_id = $('#userID').val();
            var html = '';
            for (let i = 0; i < myChallenges.length; i++) {
                if (myChallenges[i].status == 'challange_created' && myChallenges[i].c_id != user_id && myChallenges[i]
                    .o_id != user_id) {
                    html += '<li class="p-0 overflow-hidden appear-from-left apped_data" id="chdiv-' + myChallenges[i].id +
                        '">';
                    html += '<div class="my-1 card">';
                    html +=
                        '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by</span><span class="text-success fw-bold"><b>Rs ' +
                        myChallenges[i].amount + '</b></span></div>';
                    html += '<div class="d-flex align-items-center justify-content-between card-body bet__cover">';
                    html += '<div class="d-flex align-items-center flex-grow-1">';
                    html +=
                        '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;"> <img class="cover__image" src="' +
                        myChallenges[i].c_image + '"></div>';
                    html +=
                        '<span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>' +
                        myChallenges[i].cname + '</b></span></div>';
                    html += '<div class="d-flex align-items-center">';
                    html += '<div class="hstack gap-2">';
                    html += '<button class="btn btn-primary playChallange btn-sm" id="' + myChallenges[i].id +
                        '-play" onclick="playChallenge(' + myChallenges[i].id +
                        ');">Play</button></div></div></div></div></li>';
                }
            }

            return html;
        }

        function setChallengsRunning(myChallenges) {
            var user_id = $('#userID').val();
            var html = '';
            for (let i = 0; i < myChallenges.length; i++) {
                if (myChallenges[i].status == 'running' && myChallenges[i].c_id != user_id && myChallenges[i].o_id !=
                    user_id) {
                    html += '<li class="p-0 overflow-hidden appear-from-left apped_data">';
                    html += '<div class="my-1 card pb-2">';
                    html += '<div class="text-start">';
                    html += '<div class="d-flex align-items-center justify-content-between card-header bet_header">';
                    html += '<div class="d-flex align-items-center">';
                    html +=
                        '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="62-add-spiner"> <img class="cover__image" src="/assets/front/images/avatar.png"></div>';
                    html +=
                        '<span class="fw-semibold text-truncate" style="width: 100px; font-size: 13px;"><b class="ml-2">' +
                        myChallenges[i].cname + '</b></span></div><div>';
                    html +=
                        '<img src="/assets/front/images/vs.c153e22fa9dc9f58742d.webp" height="40" alt="vs"></div><div class="d-flex flex-row-reverse align-items-center">';
                    html +=
                        '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="62-add-spiner"><img class="cover__image" src="/assets/front/images/avatar.png">';
                    html +=
                        '</div><span class=" fw-semibold text-truncate" style="width: 100px; font-size: 13px;"><b class="ml-2">' +
                        myChallenges[i].oname + '</b></span>';
                    html +=
                        '</div></div><div class="d-flex align-items-center justify-content-center pt-3"><span class="text-success fw-bold" ><b>Rs ' +
                        myChallenges[i].amount + '</b></span></div></div></div></li>';
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
                    html += ' <li  id="chdiv-' + myChallenges[i].id +
                        '" class="p-0 overflow-hidden appear-from-left"><div class="my-1 card"><div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by You</span><span class="text-success fw-bold"><b>Rs ' +
                        myChallenges[i].amount +
                        '</b></span></div><div class="d-flex align-items-center justify-content-between card-body bet__cover"><div class="d-flex align-items-center flex-grow-1"><div class=" rounded-circle me-2" style="height: 24px; width: 24px;"  id="' +
                        myChallenges[i].id +
                        '-loading"> <i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div><span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>Finding Player</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2" id="' +
                        myChallenges[i].id +
                        '-buttons"><button class="btn btn-danger playChallange btn-sm" onclick="cancelChallengeCre(' +
                        myChallenges[i].id +
                        ')" style="width: 54px !important;">Delete</button></div></div></div></div></li>';

                } else if (myChallenges[i].status == 'requested' && myChallenges[i].c_id == user_id) {
                    html += '<li class="p-0 overflow-hidden appear-from-left"  id="chdiv-' + myChallenges[i].id + '">';
                    html += '<div class="my-1 card">';
                    html +=
                        '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by You</span><span class="text-success fw-bold"><b>Rs ' +
                        myChallenges[i].amount + '</b></span>';
                    html += '</div><div class="d-flex align-items-center justify-content-between card-body bet__cover">';
                    html += '<div class="d-flex align-items-center flex-grow-1">';
                    html += '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="' + myChallenges[i]
                        .id + '-add-spiner"> <img class="cover__image" src="' + myChallenges[i].o_image + '" ></div>';
                    html +=
                        '<span class="fw-semibold text-truncate text-start" style="width: 100px;font-size: 13px;" id="' +
                        myChallenges[i].id + '-add-name"><b>' + myChallenges[i].oname +
                        '</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2">';
                    html += '<div id="' + myChallenges[i].id +
                        '-buttons"><button class="btn btn-danger playChallange btn-sm" id="' + myChallenges[i].id +
                        '-deny" onclick="denyChallenge(' + myChallenges[i].id +
                        ')"style="width: 57px !important;">Cancel</button>';
                    html += '<button class="btn btn-success playChallange btn-sm mr-1" id="' + myChallenges[i].id +
                        '-accept"  onclick="acceptChallenge(' + myChallenges[i].id +
                        ')">Play</button><div></div></div></div></div></li>';
                } else if (myChallenges[i].status == 'requested' && myChallenges[i].o_id == user_id) {
                    html += '<li class="p-0 overflow-hidden appear-from-left apped_data" id="chdiv-' + myChallenges[i].id +
                        '"><div class="my-1 card"><div class="d-flex align-items-center justify-content-between card-header bet_header">';
                    html += '<span>Challenge set by</span><span class="text-success fw-bold"><b>Rs ' + myChallenges[i]
                        .amount + '</b></span></div>';
                    html +=
                        '<div class="d-flex align-items-center justify-content-between card-body bet__cover"><div class="d-flex align-items-center flex-grow-1">';
                    html +=
                        '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;"><img class="cover__image" src="' +
                        myChallenges[i].c_image + '" ></div>';
                    html +=
                        '<span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>' +
                        myChallenges[i].cname + '</b></span></div><div class="d-flex align-items-center">';
                    html +=
                        '<div class="hstack gap-2"><button class="btn btn-warning playChallange btn-sm" style="width: 93px !important;color:white;" id="' +
                        myChallenges[i].id + '-requested"  onclick="cancelChallengeReq(' + myChallenges[i].id +
                        ')">Requested</button>';
                    html += '</div></div></div></div></li>';
                } else if (myChallenges[i].status == 'accepted' && myChallenges[i].o_id == user_id) {

                    html += '<li class="p-0 overflow-hidden appear-from-left apped_data" id="chdiv-' + myChallenges[i].id +
                        '"><div class="my-1 card"><div class="d-flex align-items-center justify-content-between card-header bet_header">';
                    html += '<span>Challenge set by</span><span class="text-success fw-bold"><b>Rs ' + myChallenges[i]
                        .amount + '</b></span></div>';
                    html +=
                        '<div class="d-flex align-items-center justify-content-between card-body bet__cover"><div class="d-flex align-items-center flex-grow-1">';
                    html +=
                        '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;"><img class="cover__image" src="' +
                        myChallenges[i].c_image + '" ></div>';
                    html +=
                        '<span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>' +
                        myChallenges[i].cname + '</b></span></div><div class="d-flex align-items-center">';
                    html +=
                        '<div class="hstack gap-2"><button class="btn btn-warning playChallange btn-sm" style="width: 93px !important;color:white;" id="' +
                        myChallenges[i].id + '-start-btn" onclick="startChallenge(' + myChallenges[i].id +
                        ')">Start</button>';
                    html += '</div></div></div></div></li>';


                }
            }
            return html;
        }




        $(document).on("click", ".roomm-code-save", function() {
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
            if (room_code.length !== 8) {
                toastr.error('Enter a valid room code');
                return false;
            }
            $.ajax({
                    url: '/save-room-code',
                    type: "get",
                    data: {
                        room_code: room_code,
                        challagne_slug: challagne_slug,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                    },
                    beforeSend: function() {
                        $(".ajax-load").show();
                    },
                })
                .done(function(data) {
                    if (data.status == false) {
                        toastr.error(data.message);
                    }
                    if (data.status == true) {
                        toastr.success(data.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }

                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    toastr.error('Something went wrong!');
                });
        });

        //--------------------------------------//
        // Pusher code

        // Initiate the Pusher JS library
        var pusher = new Pusher('fc9cac60781277a7bee9', {
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


        channel.bind('App\\Events\\CreateBettel', function(data) {
            console.log(data.data);
            if (data.data.challenge_type == getGameType && data.data.c_id != USERID) {
                var html = '';
                html += '<li class="p-0 overflow-hidden appear-from-left apped_data" id="chdiv-' + data.data.id +
                    '">';
                html += '<div class="my-1 card">';
                html +=
                    '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by</span><span class="text-success fw-bold"><b>Rs ' +
                    data.data.amount + '</b></span></div>';
                html += '<div class="d-flex align-items-center justify-content-between card-body bet__cover">';
                html += '<div class="d-flex align-items-center flex-grow-1">';
                html +=
                    '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;"> <img class="cover__image" src="' +
                    data.data.c_image + '"></div>';
                html +=
                    '<span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>' +
                    data.data.cname + '</b></span></div>';
                html += '<div class="d-flex align-items-center">';
                html += '<div class="hstack gap-2">';
                html += '<button class="btn btn-primary playChallange btn-sm" id="' + data.data.id +
                    '-play" onclick="playChallenge(' + data.data.id +
                    ');">Play</button></div></div></div></div></li>';
            }
            $("#my-challenge-div").prepend(html);
        });

        deletebettel.bind('App\\Events\\DeleteBettel', function(data) {
            $("#chdiv-" + data.data.id).remove();
        });
        SaveRoom.bind('App\\Events\\SaveRoomCode', function(data) {
            $(".wait-room-code-" + data.data.slug).html(data.data.code);
            $(".copy-room-codess-" + data.data.slug).val(data.data.code);
        });
        Playbettel.bind('App\\Events\\Playbettel', function(data) {
            if (data.data.c_id == USERID) {
                var html = '';
                html += '<div class="my-1 card">';
                html +=
                    '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by You</span><span class="text-success fw-bold"><b>Rs ' +
                    data.data.amount + '</b></span>';
                html +=
                    '</div><div class="d-flex align-items-center justify-content-between card-body bet__cover">';
                html += '<div class="d-flex align-items-center flex-grow-1">';
                html += '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="' + data.data.id +
                    '-add-spiner"> <img class="cover__image" src="' + data.data.o_image + '" ></div>';
                html +=
                    '<span class="fw-semibold text-truncate text-start" style="width: 100px;font-size: 13px;" id="' +
                    data.data.id + '-add-name"><b>' + data.data.oname +
                    '</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2">';
                html += '<div id="' + data.data.id +
                    '-buttons"><button class="btn btn-danger playChallange btn-sm" id="' + data.data.id +
                    '-deny" onclick="denyChallenge(' + data.data.id +
                    ')"style="width: 57px !important;">Cancel</button>';

                html += '<button class="btn btn-success playChallange btn-sm mr-1" id="' + data.data.id +
                    '-accept"  onclick="acceptChallenge(' + data.data.id +
                    ')">Play</button><div></div></div></div></div>';
                playNotification();
                $("#chdiv-" + data.data.id).html(html);
            }
        });
        DenyChallenge.bind('App\\Events\\DenyChallenge', function(data) {
            if (data.data.o_id != USERID) {
                var html = '';
                html += '<div class="my-1 card">';
                html +=
                    '<div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by</span><span class="text-success fw-bold"><b>Rs ' +
                    data.data.amount + '</b></span></div>';
                html += '<div class="d-flex align-items-center justify-content-between card-body bet__cover">';
                html += '<div class="d-flex align-items-center flex-grow-1">';
                html +=
                    '<div class=" rounded-circle me-2" style="height: 24px; width: 24px;"> <img class="cover__image" src="' +
                    data.data.c_image + '"></div>';
                html +=
                    '<span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>' +
                    data.data.cname + '</b></span></div>';
                html += '<div class="d-flex align-items-center">';
                html += '<div class="hstack gap-2">';
                html += '<button class="btn btn-primary playChallange btn-sm" id="' + data.data.id +
                    '-play" onclick="playChallenge(' + data.data.id + ');">Play</button></div></div></div></div>';

                $("#chdiv-" + data.data.id).html(html);
            }
        });
        CancelReqBettel.bind('App\\Events\\CancelReqBettel', function(data) {
            if (data.data.c_id == USERID) {
                var html =
                    '<div class="my-1 card"><div class="d-flex align-items-center justify-content-between card-header bet_header"><span>Challenge set by You</span><span class="text-success fw-bold"><b>Rs ' +
                    data.data.amount +
                    '</b></span></div><div class="d-flex align-items-center justify-content-between card-body bet__cover"><div class="d-flex align-items-center flex-grow-1"><div class=" rounded-circle me-2" style="height: 24px; width: 24px;"  id="' +
                    data.data.id +
                    '-loading"> <i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div><span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>Finding Player</b></span></div><div class="d-flex align-items-center"><div class="hstack gap-2" id="' +
                    data.data.id +
                    '-buttons"><button class="btn btn-danger playChallange btn-sm" onclick="cancelChallengeCre(' +
                    data.data.id + ')" style="width: 54px !important;">Delete</button></div></div></div></div>';


                $("#chdiv-" + data.data.id).html(html);
            }
        });
        StartChallenge.bind('App\\Events\\StartChallenge', function(data) {
            if (data.data.o_id == USERID || data.data.c_id == USERID) {
                playStart();
                window.location.href = data.data.redirect_url;
            }
        });
    </script>

</body>

</html>
