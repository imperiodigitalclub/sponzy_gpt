<?php $__env->startSection('content'); ?>

  <section class="section section-sm">
      <div class="container pt-5">
  <div class="row">

    <div class="col-md-12 col-lg-12 mb-5 mb-lg-0">
      <div class="text-center">
        <h3><i class="feather icon-wifi-off mr-2"></i> <?php echo e(__('general.error_internet_disconnected_pwa'), false); ?></h3>
        <p>
          <?php echo e(__('general.error_internet_disconnected_pwa_2'), false); ?>

        </p>
      </div>
    </div><!-- end col-md-12 -->
  </div>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/vendor/laravelpwa/offline.blade.php ENDPATH**/ ?>