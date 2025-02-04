

<?php $__env->startSection('title'); ?> <?php echo e(trans('general.blog'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-12 py-5">
          <h2 class="mb-0 text-break"><?php echo e(trans('general.latest_blog'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.subtitle_blog'), false); ?></p>
        </div>
      </div>

      <div class="row">
        <?php if($blogs->total() != 0): ?>

          <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
              <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="card-cover w-100" style="height:250px; background: <?php if($response->image != ''): ?> url(<?php echo e(route('resize', ['path' => 'admin', 'file' => $response->image, 'size' => 480]), false); ?>)  <?php endif; ?> #505050 center center;"></div>
                <div class="col p-4 d-flex flex-column position-static">
                  <small class="d-inline-block mb-2"><?php echo e(trans('general.by'), false); ?> <?php echo e($response->user()->name, false); ?> </small>
                  <h3 class="mb-0"><?php echo e($response->title, false); ?></h3>
                  <div class="mb-1 text-muted"><?php echo e(Helper::formatDate($response->date), false); ?></div>
                  <p class="card-text mb-auto"><?php echo e(Str::limit(strip_tags($response->content), 120, '...'), false); ?></p>
                  <a href="<?php echo e(url('blog/post', $response->id).'/'.$response->slug, false); ?>" class="stretched-link"><?php echo e(trans('general.continue_reading'), false); ?> <i class="bi-arrow-right"></i></a>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <?php if($blogs->hasPages()): ?>
            <div class="w-100 d-block">
              <?php echo e($blogs->links(), false); ?>

            </div>
          <?php endif; ?>

        <?php else: ?>
          <div class="col-md-12">
            <div class="my-5 text-center no-updates">
              <span class="btn-block mb-3">
                <i class="fa fa-exclamation ico-no-result"></i>
              </span>
            <h4 class="font-weight-light"><?php echo e(trans('general.no_results_found'), false); ?></h4>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/index/blog.blade.php ENDPATH**/ ?>