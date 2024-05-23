@extends('layouts.frontend')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@if(isset($message))
<script>
    Swal.fire(
        'Deposit Successful!',
        "Cash added to your wallet",
        'success'
    )
</script>
@endif
@if(session()->has('error'))
<script>
    toastr.error("{{session()->get('error')}}");
</script>
@endif
@if(session()->has('success'))
<script>
    toastr.success("{{session()->get('success')}}");
</script>
@endif
<form id="paymentForm" action="{{url('add-money')}}" method="get">
    <div class="px-4 py-3">
        <div class="pb-3" style="margin-bottom:50px">
            <div class="qrbodyParent">
                <div class="qrpaymentbodyIN">
                    <div class="app_title">
                        <h3><?= strtoupper(env('APP_NAME')) ?></h3>
                        <p>Open Any Upi app & scan qr code to pay</p>
                    </div>
                    <div class="qrcodestump">
                        <!-- Anchor tag with ID to open URL on page load -->
                        <a id="payNowLink" href="<?php echo $upiURL ?>">Pay Now</a>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    // Open URL on page load
    window.onload = function() {
        var payNowLink = document.getElementById('payNowLink');
        if (payNowLink) {
            window.location.href = payNowLink.href;
        }
    };
</script>
@endsection
