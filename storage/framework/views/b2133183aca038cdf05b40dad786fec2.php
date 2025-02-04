

<?php $__env->startSection('title'); ?> <?php echo e($response->title, false); ?> -<?php $__env->stopSection(); ?>

  <?php $__env->startSection('description_custom'); ?><?php echo e($response->description ? $response->description : trans('seo.description'), false); ?><?php $__env->stopSection(); ?>
  <?php $__env->startSection('keywords_custom'); ?><?php echo e($response->keywords ? $response->keywords.',' : null, false); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-12 py-5">
          <h2 class="mb-0 font-montserrat">
            <?php echo e($response->title, false); ?>

          </h2>
        </div>
      </div>
      <div class="row">

        <div class="col-md-12 col-lg-12 mb-5 mb-lg-0">
          <div class="content-p">
            <?php echo $response->content; ?>

          </div>
        </div><!-- end col-md-12 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/pages/show.blade.php ENDPATH**/ ?>