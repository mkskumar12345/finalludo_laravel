@extends('layouts.frontend')
@section('content')
<div class="px-4 py-3">
            <div class="games-section mt-1">
               <div class="d-flex position-relative align-items-center">
                  <div class="games-section-title">Withdrawal Money</div>
               </div>
            </div>
            <div class="mt-3">
               <form id="withdrawal__add">
                  <div class="form-group">
                     @csrf
                  <label for="">Withdraw Option</label>
                  <select name="method" class="form-control method" id="">
                     <!-- <option</option> -->
                     <option value="upi">UPI</option>
                     <option disabled>Bank (not available)</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="">Enter UPI</label> 
                  <input type="text" name="upi" class="form-control "  placeholder="Enter UPI" id="form_upi">
               </div>
               <div class="form-group">
                  <label for="">Confirm UPI</label>
                  <input type="password" name="confirm_upi" class="form-control" placeholder="Enter Confirm UPI" id="confirm_upi">
               </div>
               <div class="form-group">
                  <label for="">Amount</label>
                  <input type="number" name="amount" class="form-control" placeholder="Enter" id="amount">
               </div>
               <div>
                  <p style="font-size: 0.8rem; text-align: start;" class="mt-2">By Continuing, you agree to our <a href="#/terms">Legal Terms</a> and you are 18 years or older.</p>
               </div>
               <div class="d-grid py-3">
                  <p style="font-size: 1rem;">           
                      <button class="btn btn-primary  text-uppercase" style="width: 100%; font-size: 16px;" type="submit" id=""><b>Withdraw</b></button>
                     </p>
               </div>
               </form>
             
            </div>
            <!--@if(!empty($totalWithdrawal))-->
            <!--<div class="games-section mt-4">-->
            <!--   <div class="">-->
            <!--      <b class="mt-4">Last withdrawal</b> <br>-->
            <!--      <span>Amount : ₹{{number_format($totalWithdrawal->amount,2)}}</span><br>-->
            <!--      <span>Transaction ID : {{$totalWithdrawal->transactions_id}}</span><br>-->
            <!--      <span>Status : {{ strtoupper($totalWithdrawal->addition_status)}}</span> <br>-->
            <!--      <a href="{{url('cancel-withdrawal/'.$totalWithdrawal->id)}}"><button class="btn btn-success mt-1 text-uppercase" style="width: 100%; font-size: 16px;" type="submit" id=""><b>Cancel</b></button></a>-->
            <!--   </div>-->
            <!--</div>-->
            <!--@endif-->
         </div>
         
@endsection