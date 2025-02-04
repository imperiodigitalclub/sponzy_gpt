<?php $__env->startSection('title'); ?> <?php echo e(trans('general.my_stories'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi-clock-history mr-2"></i> <?php echo e(trans('general.my_stories'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.my_stories_subtitle'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if($stories->count() != 0): ?>
          <div class="mb-2 p-2">
            <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $__currentLoopData = $story->media()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="add-story mb-3 position-relative">
                <span class="delete-history c-pointer" data-id="<?php echo e($story->id, false); ?>" title="<?php echo e(__('general.delete'), false); ?>"><i class="bi-trash"></i></span>
                <div class="item-add-story">
                  <span class="add-story-preview">
                    <div class="text-story-preview user-select-none" style="z-index: 5; font-family:<?php echo e($media->font, false); ?>; color:<?php echo e($media->font_color, false); ?>;"><?php echo e($media->text, false); ?></div>
                    <img lazy="eager" width="100" src="<?php echo e($media->type == 'photo' ? Helper::getFile(config('path.stories').$media->name) : ($media->video_poster ? Helper::getFile(config('path.stories').$media->video_poster) : Helper::getFile(config('path.avatar').auth()->user()->avatar)), false); ?>">
                  </span>
                  <span class="info py-2 text-center text-white bg-dark-transparent c-pointer getViews" data-id="<?php echo e($media->id, false); ?>" data-total="<?php echo e($media->views()->count(), false); ?>" data-toggle="modal" data-target="#storyViews" title="<?php echo e(__('general.people_seen_story'), false); ?>">
                    <strong class="name" style="text-shadow: none;"><i class="bi-eye mr-1"></i> <?php echo e($media->views()->count(), false); ?></strong>
                  </span>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <?php echo $__env->make('includes.modal-story-views', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <?php else: ?>
          <div class="my-5 text-center">
            <span class="btn-block mb-3">
              <i class="bi-clock-history ico-no-result"></i>
            </span>
          <h4 class="font-weight-light"><?php echo e(trans('general.no_results_found'), false); ?></h4>
          <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addStory">
            <i class="bi-plus"></i> <?php echo e(__('general.add_story'), false); ?>

          </a>
          </div>

          <?php echo $__env->make('includes.modal-add-story', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if($stories->hasPages()): ?>
        <?php echo e($stories->onEachSide(0)->links(), false); ?>

        <?php endif; ?>

        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/my-stories.blade.php ENDPATH**/ ?>