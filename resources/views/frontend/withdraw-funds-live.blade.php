@extends('layouts.frontend')
@section('content')
    <div class="px-4 py-3">
        <div class="games-section mt-1">
            <div class="d-flex position-relative align-items-center">
                <div class="games-section-title">Withdrawal Money</div>
            </div>
        </div>
        <div class="mt-3">
            <form id="withdrawal__add_live" method="post">
                <div class="form-group">
                    @csrf
                    <label for="">Withdraw Option</label>
                    <select name="method" class="form-control method" id="method">
                        <!-- <option</option> -->
                        <option value="bank">Bank</option>
                        <option disabled>UPI (not available)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="accountNumber">Enter Account Number</label>
                    <input type="text" name="accountNumber" class="form-control" placeholder="Enter Account Number"
                        id="accountNumber">
                </div>
                <div class="form-group">
                    <label for="confirm_accountNumber">Confirm Account Number</label>
                    <input type="text" name="confirm_accountNumber" class="form-control"
                        placeholder="Confirm Account Number" id="confirm_accountNumber">
                </div>
                <div class="form-group">
                    <label for="ifscCode">Enter IFSC Code</label>
                    <input type="text" name="ifscCode" class="form-control" placeholder="Enter IFSC Code" id="ifscCode">
                </div>
                <div class="form-group">
                  <label for="ifscCode">Account Holder Name</label>
                  <input type="text" name="payeeName" class="form-control" placeholder="Account Holder Name" id="payeeName">
              </div>
                
                <div class="form-group">
                    <label for="mobileNo">Enter Mobile Number</label>
                    <input type="text" name="mobileNo" class="form-control" placeholder="Enter Mobile Number"
                        id="mobileNo">
                </div>

                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="number" name="amount" class="form-control" placeholder="Enter" min="10"
                        id="amount">
                </div>
                <div>
                    <p style="font-size: 0.8rem; text-align: start;" class="mt-2">By Continuing, you agree to our <a
                            href="#/terms">Legal Terms</a> and you are 18 years or older.</p>
                </div>
                <div class="d-grid py-3">
                    <p style="font-size: 1rem;">
                        <button class="btn btn-primary  text-uppercase" style="width: 100%; font-size: 16px;" type="submit"
                            id=""><b>Withdraw</b></button>
                    </p>
                </div>
            </form>

        </div>
    </div>
@endsection
