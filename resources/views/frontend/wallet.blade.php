@extends('layouts.frontend')
@section('content')
    <div class="p-4 bg-light">
        <a class="d-flex align-items-center profile-wallet undefined" href="{{ url('game-history') }}">
            <div class="ml-4"><i class="fa fa-history" aria-hidden="true"></i></div>
            <div class="ml-5 mytext text-muted ">Order History</div>
        </a>
    </div>
    <div class="divider-x"></div>
    <div class="p-4 bg-light">
        <div class="wallet-card" style=" background-image: url({{ url('assets/front/images/bg-image.jpg') }});">
            <div class="d-flex align-items-center">
                <div class="mr-1"><img height="26px" width="26px"
                        src="{{ url('assets/front/images/global-rupeeIcon.png') }}" alt=""></div><span
                    class="text-white"
                    style="font-size: 1.3em; font-weight: 900;">₹{{ number_format(Auth::user()->deposit_amount, 2) }}</span>
            </div>
            <div class="text-white text-uppercase" style="font-size: 0.9em; font-weight: 500;">Manual Deposit Cash</div>
            <div class="mt-5" style="font-size: 0.9em; color: rgb(191, 211, 255);">Can be used to play Tournaments
                &amp; Battles.<br>Cannot be withdrawn to Paytm or Bank.</div>
            <a href="{{ url('add-fund-manual') }}"
                class="walletCard-btn d-flex justify-content-center align-items-center text-uppercase">Add Manual Cash</a>
        </div>
        <div class="wallet-card" style=" background-image: url({{ url('assets/front/images/bg-image.jpg') }});">
         <div class="d-flex align-items-center">
             <div class="mr-1"><img height="26px" width="26px"
                     src="{{ url('assets/front/images/global-rupeeIcon.png') }}" alt=""></div><span
                 class="text-white"
                 style="font-size: 1.3em; font-weight: 900;">₹{{ number_format(Auth::user()->deposit_amount, 2) }}</span>
         </div>
         <div class="text-white text-uppercase" style="font-size: 0.9em; font-weight: 500;">Online Deposit Cash</div>
         <div class="mt-5" style="font-size: 0.9em; color: rgb(191, 211, 255);">Can be used to play Tournaments
             &amp; Battles.<br>Cannot be withdrawn to Paytm or Bank.</div>
         <a href="{{ url('add-fund') }}"
             class="walletCard-btn d-flex justify-content-center align-items-center text-uppercase">Add Cash</a>
     </div>
        <div class="wallet-card" style="background-image: url({{ url('assets/front/images/bg-image.jpg') }});">
            <div class="d-flex align-items-center">
                <div class="mr-1"><img height="26px" width="26px"
                        src="{{ url('assets/front/images/global-rupeeIcon.png') }}" alt=""></div><span
                    class="text-white"
                    style="font-size: 1.3em; font-weight: 900;">₹{{ number_format(Auth::user()->wallet, 2) }}</span>
            </div>
            <div class="text-white text-uppercase" style="font-size: 0.9em; font-weight: 500;">Winnings Cash</div>
            <div class="mt-5" style="font-size: 0.9em; color: rgb(216, 224, 255);">Can be withdrawn to Paytm or Bank.
                Can be used to play Tournaments &amp; Battles.</div><a href="{{ url('/withdraw-funds-live') }}"
                class="walletCard-btn d-flex justify-content-center align-items-center text-uppercase">Withdraw</a>
        </div>
    </div>
@endsection
