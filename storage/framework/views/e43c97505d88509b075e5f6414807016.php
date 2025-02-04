<?php if($settings->show_address_company_footer): ?>
<div class="w-100 d-block font-12 text-center mt-3">
    <small class="d-block w-100"><?php echo e(__('general.company'), false); ?>: <?php echo e($settings->company, false); ?></small>
    <small class="d-block w-100"><?php echo e(__('general.address'), false); ?>: <?php echo e($settings->address, false); ?> <?php echo e($settings->city, false); ?> <?php echo e($settings->country, false); ?></small>
</div>
<?php endif; ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/site-billing-info.blade.php ENDPATH**/ ?>