<div class="mb-2">
  <h6 class="mb-3 text-muted font-weight-light filter-explorer">
    <?php echo e(__('general.explore_creators'), false); ?>


<?php if(auth()->guard()->check()): ?>
  <?php if($users->count() > 2): ?>
    <a href="javascript:void(0);" class="float-right h5 text-decoration-none refresh_creators refresh-btn mr-2">
      <i class="feather icon-refresh-cw"></i>
    </a>

    <a href="javascript:void(0);" class="float-right h5 text-decoration-none refresh_creators toggleFindFreeCreators btn-tooltip mr-3" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.show_only_free'), false); ?>">
      <i class="feather icon-tag"></i>
    </a>
    <?php endif; ?>

  <?php else: ?>
    <?php if(!$settings->disable_creators_section): ?>
      <a href="<?php echo e(url('creators'), false); ?>" class="float-right"><?php echo e(__('general.view_all'), false); ?> <small class="pl-1"><i class="fa fa-long-arrow-alt-right"></i></small></a>
    <?php endif; ?>
<?php endif; ?>
  </h6>

  <ul class="list-group">
    <div class="containerRefreshCreators">
      <?php echo $__env->make('includes.listing-explore-creators', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div><!-- containerRefreshCreators -->
  </ul>
</div><!-- d-lg-none -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/explore_creators.blade.php ENDPATH**/ ?>