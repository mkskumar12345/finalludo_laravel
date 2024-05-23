@extends('layouts.frontend')
@section('content')
         <form >
               <div class="col-col-12 mx-auto p-3 g-0">
                  <div class="card">
                     <div class="bg-light text-dark text-capitalize card-header"style="text-align: center;">register</div>
                     <div class="card-body">
                        <!-- <form class="mb-3"> -->
                             <form method="post" action="register1">
                             {{ csrf_field() }}
                           <div class="">
                              <div class="d-flex flex-column align-items-start">
                                 <label class="text-capitalize form-label">Full Name</label>
                                 <input required="true" type="text" class="form-control full__name" value="">
                              </div>
                              <div class="d-flex flex-column align-items-start mt-1">
                                 <label class="text-capitalize form-label">phone number</label>
                                 <input required="" type="tel" class="form-control mobile__number"  value="">
                              </div> 
                              <div class="d-flex flex-column align-items-start mt-1">
                                 <label class="text-capitalize form-label">refer code (optional)</label>
                                 <input type="text" class="form-control refer_code_signup" value="{{ request()->get('refer-code') }}">
                              </div>
                              <div>
                                 <p style="font-size: 0.8rem;padding: 10px 0 0 0;margin: 0;">By Continuing, you agree to our <a href="/page/terms-and-conditions">Legal Terms</a> and you are 18 years or older.</p>
                              </div>
                              <div class="d-grid py-3">
                                 <p style="font-size: 1rem;">           
                                     <button class="btn btn-primary submit-signup submit__btn text-uppercase" style="width: 100%; font-size: 16px;" type="button">Submit</button>
                                    </p>
                              </div>
                           </div>
                        </form>
                        <p style="font-size: 0.8rem; margin-top: 13px;">Already have an account? <a href="{{url('login')}}">Login</a></p>
                     </div>
                  </div>
               </div>
          
         </form>
@endsection