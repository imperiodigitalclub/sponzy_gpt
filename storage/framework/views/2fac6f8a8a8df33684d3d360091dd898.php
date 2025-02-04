<?php if(!isset($inPostDetail) && !isset($isCreated)): ?>
    <?php if($advertising): ?>
        <?php $__currentLoopData = $advertising; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card rounded-large border shadow-sm mb-3 position-relative p-3 advertising">

            <div class="d-flex">
                <div class="flex-shrink-0">
                    <img class="img-fluid rounded img-thanks-share" width="150"
                        src="<?php echo e(Helper::getFile(config('path.ads').$ad->image), false); ?>">
                </div>
                <div class="flex-grow-1 ml-3">
                    <h5 class="mb-1"><?php echo e($ad->title, false); ?></h5>
                    <?php echo e($ad->description, false); ?>

                    <small class="d-block w-100 text-muted"><i class="bi-badge-ad mr-1"></i> <?php echo e(__('general.advertising'), false); ?></small>
                </div>
            </div>

            <a href="<?php echo e(url('click/ad', $ad->id), false); ?>" target="_blank" class="stretched-link"></a>
        </div>

        <?php $ad->impressions(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>
<?php endif; ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/advertising.blade.php ENDPATH**/ ?>