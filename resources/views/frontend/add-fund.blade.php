@extends('layouts.frontend')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @if (isset($message))
        <script>
            Swal.fire(
                'Deposit Successful!',
                "Cash added to your wallet",
                'success'
            )
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            toastr.error("{{ session()->get('error') }}");
        </script>
    @endif
    @if (session()->has('success'))
        <script>
            toastr.success("{{ session()->get('success') }}");
        </script>
    @endif
    <form action="{{ url('add-money') }}" method="get">
        <div class="px-4 py-3">
            <div class="games-section">
                <div class="d-flex position-relative align-items-center">
                    <div class="games-section-title mb-2">Choose Amount to Add</div>
                    <!-- <div class="games-section-title"></div> -->
                </div>
                <span class="text-danger">पेमेंट सफलतापूर्वक होने के बाद में 5 से 10 मिनट का इंतजार करें | अमाउंट आपके वॉलेट
                    में ऐड कर दिया जाएगा । अन्य किसी समस्या के लिए व्हाट्सएप करें !  8824681852</span>
            </div>
            <div class="pb-3">
                <div class="MuiFormControl-root mt-4 MuiFormControl-fullWidth">
                    <div class="MuiFormControl-root MuiTextField-root">
                        <label
                            class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink">Enter
                            Amount</label>
                        <div
                            class="MuiInputBase-root MuiInput-root MuiInput-underline jss13 MuiInputBase-formControl MuiInput-formControl MuiInputBase-adornedStart">
                            <div class="MuiInputAdornment-root MuiInputAdornment-positionStart">
                                <span
                                    class="MuiTypography-root MuiTypography-body1 MuiTypography-colorTextSecondary mr-2">₹</span>
                            </div>
                            <input aria-invalid="false" type="number" min="{{ $minDeposit }}"
                                max="{{ $maxDeposit }}"class="MuiInputBase-input MuiInput-input MuiInputBase-inputAdornedStart"
                                name="amount" id="addMoneyInput" value="">
                        </div>
                        <p class="MuiFormHelperText-root">Min: {{ $minDeposit }}, Max: {{ $maxDeposit }}</p>
                    </div>
                </div>

            </div>
            <div class="refer-footer"><button class="refer-button cxy w-100 bg-primary " type="submit">Next</button></div>
        </div>
    </form>
@endsection
