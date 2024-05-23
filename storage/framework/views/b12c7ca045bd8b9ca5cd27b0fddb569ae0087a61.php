<?php $__env->startSection('content'); ?>

            <div class=" col-12 mx-auto p-3 g-0">
                  <div id="events-area"></div>
				  
				  <div class="youtube_play_box" style="padding: 0;">
						<p style="margin: 0;padding: 0px 0 5px 0;"><b>Refer and Earn</b></p>
						<button style="border-radius: 5px; width: 100%;margin: 0px 0 10px 0;border: inherit;background-image: linear-gradient(to right, #af00ff, #0093ec);"><a  href="<?php echo e(url('refer-earn')); ?>" style="color: #fff;font-size: 12px;font-weight: 600;">Commission 5% Only : Referral - 2% For All Games</a> </button>
				  </div>
				  
                  <div class="youtube_play_box" style="display: none;">
                       
                     <span> </span>
                     <span> </span>
                     <span> </span>
                     <span> </span>
                     <div class="see_help_option">
                         <a href="<?php echo e(url('refer-earn')); ?>">  
                           <div class="youtube_top_icon">
                              <img src="https://www.fojibhailudo.com/assets/img/global-cash-won-green-circular.png" alt="">
                              <span style="color:#000000bf !important;"><b>Refer and Earn</b></span>
                           </div>
                           <div class="box_help">
                               
                              <h6 style="color: #0cef0c;">Commission: <?php echo e($refer_amount ?? 2); ?>% For aLL win games.</h6>
                              <div class="click_icon">
                                 <div class="lds-ripple">
                                       <div></div>
                                       <div></div>
                                 </div>
                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path></svg>
                              </div>
                              
                           </div>
                           </a>
                     </div>
                     <div class="see_help_option">
                           <div class="youtube_top_icon">
                              <img src="https://www.fojibhailudo.com/assets/img/global-cash-won-green-circular.png" alt="">
                              <span style="color:#e90042 !important;"><b>Service Fees</b></span>
                           </div>
                           <div class="box_help">
                              <h6 style="color: #0cef0c;">Charge: <?php echo e($service_fee ?? 2); ?>% For aLL win games.</h6>
                               
                           </div>
                     </div>
                     
                  </div>
              <?php if(isset($settingData['home_page_message']) && !empty($settingData['home_page_message'])): ?>
              <div class="timeline_news  live_stream mt-1"><?php echo $settingData['home_page_message'] ?? ''; ?></div>
              <?php endif; ?>
                  <!-- <div role="alert"  class="fade d-flex align-items-center justify-content-between alert alert-danger show"><span><b >KYC Pending <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="20" height="20" fill="red"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"></path></svg></b></span><a href="#/kyc"><button class="btn btn-danger btn-sm text-capitalize" style="width: 100%;">complete here</button></a>
                  </div> -->
                  <div class="d-flex align-items-center justify-content-between mt-3"><h6 class="text-capitalize text-start">Game Tournaments
</h6>
                  </div>
                  <div class="p-0 container-fluid">
                     <div class="mb-3 gx-3 row mr-1 ml-1" style="margin: 0 !important;">
                        <?php if(isset($ChallangeType) && count($ChallangeType) > 0): ?>
                           <?php $__currentLoopData = $ChallangeType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item->status != 0): ?>
                                    <div class="col-6 p-1 ">
										<p style="margin: 0;padding: 5px 0;font-size: 11px;animation: blink 1s infinite;">◉ Ludo Classic (LIVE)</p>
                                        <a class="text-decoration-none text-black" href="<?php echo e(url('games/'.$item->slug ?? '')); ?>">
                                            <picture>
                                                <source media="(min-width:1024px)" srcset="<?php echo e(url('/assets/logo/'.$item->image)); ?>">
                                                <source media="(min-width:768px)" srcset="<?php echo e(url('/assets/logo/'.$item->image)); ?>">
                                                <img src="<?php echo e(url('/assets/logo/'.$item->image)); ?>" alt="<?php echo e($item->name); ?>" class="rounded-3" style="width: 100%; cursor: pointer; box-shadow: 0 0 5px 0px #0000004a;">
                                            </picture>
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <div class="col-6 p-1 ">
										<p style="margin: 0;padding: 5px 0;font-size: 11px;animation: blink 1s infinite;">◉ Classic (Coming Soon)</p>
                                        <picture>
                                            <source media="(min-width:1024px)" srcset="<?php echo e(url('/assets/logo/'.$item->image)); ?>">
                                            <source media="(min-width:768px)" srcset="<?php echo e(url('/assets/logo/'.$item->image)); ?>">
                                            <img src="<?php echo e(url('/assets/logo/'.$item->image)); ?>" alt="<?php echo e($item->name); ?>" class="rounded-3" style="width: 100%; cursor: pointer; box-shadow: 0 0 5px 0px #0000004a;">
                                        </picture>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                       <?php endif; ?>
                	<?php echo $__env->make('partials.front-end.about-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     </div>
                 
               </div>
              
            </div>
            <style>
			.timeline_news {
                font-size: 13px;
				  width: 100%;
				  display: block;
				  color: #000;
				  position: relative;
				  background: #edf6ff;
				  padding: 8px 8px !important;
				  text-align: center !important;
				  border: 1px solid #e00;
				  border-radius: 5px;
            }
			.timeline_news p{
	margin: 0;padding:0;
}
			</style>
            <a class="bg-light border shadow rounded-circle d-flex align-items-center justify-content-center position-fixed text-dark" href="<?php echo e(url('https://api.whatsapp.com/send?phone=918824681852')); ?>"
             style="height: 50px;width: 50px;z-index: 10;bottom: 18px;right: 10px;background-color: #09a209 !important;border: inherit !important;">
             <img src="<?php echo e(url('assets/front/images/liveChat.webp')); ?>" height="30px" alt="support icon">
            </a>
         <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LUDO\finalludo\resources\views/frontend/home.blade.php ENDPATH**/ ?>