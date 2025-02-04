

<?php $__env->startSection('title'); ?> <?php echo e($title, false); ?> -<?php $__env->stopSection(); ?>

    <?php $__env->startSection('description_custom'); ?><?php echo e($description ? $description : trans('seo.description'), false); ?><?php $__env->stopSection(); ?>
    <?php $__env->startSection('keywords_custom'); ?><?php echo e($keywords ? $keywords.',' : null, false); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-12 py-5">
          <h2 class="mb-0 font-montserrat">
            <img src="<?php echo e(url('public/img-category', $image), false); ?>" class="mr-2 rounded" width="30" /> <?php echo e($title, false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans_choice('users.creators_in_this_category', 2 ), false); ?></p>
        </div>
      </div>

<div class="row">

<div class="col-md-3 mb-4">

  <?php if(!$settings->disable_creators_section): ?>
    <?php echo $__env->make('includes.menu-filters-creators', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

    <?php echo $__env->make('includes.listing-categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div><!-- end col-md-3 -->

        <?php if($users->count() != 0): ?>
          <div class="col-md-9 mb-4">
            <div class="row" id="containerWrapCreators">

              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-6 mb-4">
                <?php echo $__env->make('includes.listing-creators', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div><!-- end col-md-4 -->
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <?php echo $__env->make('includes.paginator-creators', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div><!-- row -->
          </div><!-- col-md-9 -->

        <?php else: ?>
          <div class="col-md-9">
            <div class="my-5 text-center no-updates">
              <span class="btn-block mb-3">
                <i class="fa fa-user-slash ico-no-result"></i>
              </span>
            <h4 class="font-weight-light"><?php echo e(trans('general.not_found_creators_category'), false); ?></h4>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(url('public/js/paginator-creators.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/index/categories.blade.php ENDPATH**/ ?>