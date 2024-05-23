<?php $__env->startSection('content'); ?>
    <div class="bg-light text-dark card-header"style="text-align: center;">Login Your Account</div>
    <div class="card-body " style="margin: 20px;background: #edf6ff;border: 1px solid #007bff;border-radius:10px;">
        <form id="otp_login" method="POST"style="display: contents;">
            <div class="number_screen"> <label for="phone" class="w-100 text-start form-label">Mobile Number</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z">
                            </path>
                        </svg>
                    </span>
                    <input type="text" name="phone" id="phone" class="form-control phone_login"
                        aria-describedby="phone" value="">
                </div>
                
                <div class="d-grid py-3" style="padding-bottom: 0 !important;">
                    <p style="font-size: 0.8rem; margin: 0;">By Continuing, you agree to our <a href="/page/terms-and-conditions">Legal
                            Terms</a> and you are 18 years or older.</p>
                </div>
                

                <div class="d-grid py-3">
                    <p style="font-size: 1rem;">
                        <button class="btn btn-primary send_otp submit-signup send_otptext-uppercase"
                            style="width: 100%; font-size: 16px;">Login</button>
                    </p>
                </div>
                 

                <div>
                   <p style="font-size: 0.9rem; margin: 20px 0 0 0;">Don't have an account? <a href="<?php echo e(url('register')); ?>">Register</a></p>
                </div> 
            </div>

            <div class="otp_screen d-none">
                <a href="<?php echo e(url('login')); ?>">
                    <div class="d-flex align-items-center justify-content-start py-3" style="padding-top: 0 !important;">
                        
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em"
                                fill="currentColor" class="me-1">
                                <path fill-rule="evenodd"
                                    d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z">

                                </path>
                            </svg>
                            <span class="text-capitalize">change number</span>
                        
                    </div>
                </a>

                <div class="py-6 justify-content-between " style="display: flex;">
                    <div style="display: flex; align-items: center;">
                        <!-- <input aria-label="Please enter verification code. Digit 1" autocomplete="off" class="  form-control" type="tel" required="" value="" style="flex: 1 1 0%; text-align: center;"> -->
                    </div>
                    <input class="form-control login_otp_val" name="otp" type="tel" placeholder="Enter OTP"
                        autocomplete="off" value="">


                </div>
                <!--<div class="d-flex align-items-center justify-content-end mt-3">-->
                <!--    <button class="btn btn-outline-dark btn-sm"style="width: 95px; !important">Resend OTP</button>-->
                <!--</div>-->
                <div class="d-grid py-3">
                    <p style="font-size: 0.8rem;">By Continuing, you agree to our <a href="/page/terms-and-conditions">Legal
                            Terms</a> and you are 18 years or older.</p>
                    <button class="btn btn-primary text-uppercase verify_otp"style="width: 100%;font-size: 15px;"
                        type="button">verify</button>
						
						<br>
                </div>
            </div>
        </form>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LUDO\finalludo\resources\views/frontend/login.blade.php ENDPATH**/ ?>