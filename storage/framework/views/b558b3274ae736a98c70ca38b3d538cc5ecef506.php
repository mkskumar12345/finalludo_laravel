<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <?php if(isset($message)): ?>
        <script>
            Swal.fire(
                'Deposit Successful!',
                "Cash added to your wallet",
                'success'
            )
        </script>
    <?php endif; ?>
    <?php if(session()->has('error')): ?>
        <script>
            toastr.error("<?php echo e(session()->get('error')); ?>");
        </script>
    <?php endif; ?>
    <?php if(session()->has('success')): ?>
        <script>
            toastr.success("<?php echo e(session()->get('success')); ?>");
        </script>
    <?php endif; ?>
    <form action="<?php echo e(url('add-money')); ?>" method="get">
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
                            <input aria-invalid="false" type="number" min="<?php echo e($minDeposit); ?>"
                                max="<?php echo e($maxDeposit); ?>"class="MuiInputBase-input MuiInput-input MuiInputBase-inputAdornedStart"
                                name="amount" id="addMoneyInput" value="">
                        </div>
                        <p class="MuiFormHelperText-root">Min: <?php echo e($minDeposit); ?>, Max: <?php echo e($maxDeposit); ?></p>
                    </div>
                </div>

            </div>
            <div class="refer-footer"><button class="refer-button cxy w-100 bg-primary " type="submit">Next</button></div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LUDO\finalludo\resources\views/frontend/add-fund.blade.php ENDPATH**/ ?>