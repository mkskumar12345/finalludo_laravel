<?php $__env->startSection('content'); ?>
<div class="p-4 bg-light">
            <a class="d-flex align-items-center profile-wallet undefined" href="<?php echo e(url('game-history')); ?>">
               <div class="ml-4"><i class="fa fa-history" aria-hidden="true"></i></div>
               <div class="ml-5 mytext text-muted ">Order History</div>
            </a>
         </div>
         <div class="divider-x"></div>
         <div class="p-4 bg-light">
            <div class="wallet-card" style=" background-image: url(<?php echo e(url('assets/front/images/bg-image.jpg')); ?>);">
               <div class="d-flex align-items-center">
                  <div class="mr-1"><img height="26px" width="26px" src="<?php echo e(url('assets/front/images/global-rupeeIcon.png')); ?>" alt=""></div><span
                     class="text-white" style="font-size: 1.3em; font-weight: 900;">₹<?php echo e(number_format(Auth::user()->deposit_amount,2)); ?></span>
               </div>
               <div class="text-white text-uppercase" style="font-size: 0.9em; font-weight: 500;">Deposit Cash</div>
               <div class="mt-5" style="font-size: 0.9em; color: rgb(191, 211, 255);">Can be used to play Tournaments
                  &amp; Battles.<br>Cannot be withdrawn to Paytm or Bank.</div>
               <a href="<?php echo e(url('add-fund')); ?>"
                  class="walletCard-btn d-flex justify-content-center align-items-center text-uppercase">Add Cash</a>
            </div>
            <div class="wallet-card" style="background-image: url(<?php echo e(url('assets/front/images/bg-image.jpg')); ?>);">
               <div class="d-flex align-items-center">
                  <div class="mr-1"><img height="26px" width="26px" src="<?php echo e(url('assets/front/images/global-rupeeIcon.png')); ?>" alt=""></div><span
                     class="text-white" style="font-size: 1.3em; font-weight: 900;">₹<?php echo e(number_format(Auth::user()->wallet,2)); ?></span>
               </div>
               <div class="text-white text-uppercase" style="font-size: 0.9em; font-weight: 500;">Winnings Cash</div>
               <div class="mt-5" style="font-size: 0.9em; color: rgb(216, 224, 255);">Can be withdrawn to Paytm or Bank.
                  Can be used to play Tournaments &amp; Battles.</div><a href="<?php echo e(url('/withdraw-funds-live')); ?>"
                  class="walletCard-btn d-flex justify-content-center align-items-center text-uppercase">Withdraw</a>
            </div>
         </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LUDO\finalludo\resources\views/frontend/wallet.blade.php ENDPATH**/ ?>