

<?php $__env->startSection('title'); ?><?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?> -<?php $__env->stopSection(); ?>
  <?php $__env->startSection('description_custom'); ?><?php echo e($user->username, false); ?> - <?php echo e(strip_tags($user->story), false); ?><?php $__env->stopSection(); ?>

  <?php $__env->startSection('css'); ?>

  <meta property="og:type" content="website" />
  <meta property="og:image:width" content="200"/>
  <meta property="og:image:height" content="200"/>

  <!-- Current locale and alternate locales -->
  <meta property="og:locale" content="en_US" />
  <meta property="og:locale:alternate" content="es_ES" />

  <!-- Og Meta Tags -->
  <link rel="canonical" href="<?php echo e(url($user->username), false); ?>"/>
  <meta property="og:site_name" content="<?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?> - <?php echo e($settings->title, false); ?>"/>
  <meta property="og:url" content="<?php echo e(url($user->username), false); ?>"/>
  <meta property="og:image" content="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>"/>

  <meta property="og:title" content="<?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?> - <?php echo e($settings->title, false); ?>"/>
  <meta property="og:description" content="<?php echo e(str_limit($updates[0]->description, 20), false); ?> <?php echo e(__('general.by'), false); ?> <?php echo e($user->hide_name == 'yes' ? '@'.$user->username : $user->name, false); ?>"/>
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:image" content="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" />
  <meta name="twitter:title" content="<?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?>" />
  <meta name="twitter:description" content="<?php echo e(str_limit($updates[0]->description, 20), false); ?> <?php echo e(__('general.by'), false); ?> <?php echo e($user->hide_name == 'yes' ? '@'.$user->username : $user->name, false); ?>"/>
  <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mb-lg-0 py-5 wrap-post">
          <?php $__currentLoopData = $updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('includes.updates', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <?php if($updatesCount == 0): ?> 
            <?php echo e(__('general.no_results_found'), false); ?>

          <?php endif; ?>
        </div><!-- end col-md-9 -->

        <div class="col-md-4 pb-4 py-lg-5">

          <?php if($users->count() != 0): ?>
              <?php echo $__env->make('includes.explore_creators', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>

            <?php echo $__env->make('includes.footer-tiny', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

 <?php if(session('noty_error')): ?>
   <script type="text/javascript">
   		swal({
   			title: "<?php echo e(__('general.error_oops'), false); ?>",
   			text: "<?php echo e(__('general.already_sent_report'), false); ?>",
   			type: "error",
   			confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
   			});
        </script>
  		 <?php endif; ?>

  <?php if(session('noty_success')): ?>
    <script type="text/javascript">
   		swal({
   			title: "<?php echo e(__('general.thanks'), false); ?>",
   			text: "<?php echo e(__('general.reported_success'), false); ?>",
   			type: "success",
   			confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
   			});
  </script>
  <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/post-detail.blade.php ENDPATH**/ ?>