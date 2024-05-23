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

<div class="px-4 py-3">
                  @if(isset($settingData['deposit_qr']) && !empty($settingData['deposit_qr']))
                  <div class="deposit-qr">
                    <img src="{{url('/assets/logo/'.$settingData['deposit_qr'] ?? '')}}" alt="" width="100%">
                  </div>
                  @endif
                  <form action="{{url('deposit-submit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-1">
                        <label for="">Amount</label>
                    <input type="numer"  min="50"  name="amount" id="" placeholder="Enter amount" class="form-control" required>
                    @if($errors->has('amount'))
                        <p class="help-block text-danger">
                            {{ $errors->first('amount') }}
                        </p>
                        @endif
                    </div>
                     <div class="form-group mt-1">
                        <label for="">Payment Screenshot</label>
                    <input type="file"  name="image" id="" placeholder="Enter amount" class="form-control" required>
                    @if($errors->has('image'))
                        <p class="help-block text-danger">
                            {{ $errors->first('image') }}
                        </p>
                        @endif
                     </div>
                    <!-- <div class="refer-footer"></div> -->
                    <button  class="refer-button cxy w-100 bg-primary " type="submit">Submit</button>
                  </form>
                 
               </div>
            
           
           
@endsection

