<?php if($mediaImageVideoTotal == 1): ?>

	<?php $__currentLoopData = $mediaImageVideo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		<?php if($media->image != ''): ?>

	<?php
		$urlImg = $media->img_type == 'gif' ? Helper::getFile(config('path.images').$media->image) : url("files/storage", $response->id).'/'.$media->image;
	?>

	<a href="<?php echo e($urlImg, false); ?>" class="glightbox w-100" data-gallery="gallery<?php echo e($response->id, false); ?>">
		<img src="<?php echo e($urlImg, false); ?>?w=130&h=100" <?php echo $media->width ? 'width="'. $media->width .'"' : null; ?> <?php echo $media->height ? 'height="'. $media->height .'"' : null; ?> data-src="<?php echo e($urlImg, false); ?>?w=960&h=980" class="img-fluid lazyload d-inline-block w-100 post-image" alt="<?php echo e(e($response->description), false); ?>">
	</a>
	<?php endif; ?>


	<?php if($media->video != ''): ?>
	<video class="js-player w-100 <?php if(!request()->ajax()): ?>invisible <?php endif; ?>" controls <?php if(!$media->video_poster): ?> preload="metadata" <?php endif; ?> <?php if($media->video_poster): ?> preload="none" data-poster="<?php echo e(Helper::getFile(config('path.videos').$media->video_poster), false); ?>" <?php endif; ?>>
		<source src="<?php echo e(Helper::getFile(config('path.videos').$media->video), false); ?>" type="video/mp4" />
	</video>
	<?php endif; ?>

 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>

<?php if($mediaImageVideoTotal >= 2): ?>
<div class="container-post-media">

<div class="media-grid-<?php echo e($mediaImageVideoTotal > 5 ? 5 : $mediaImageVideoTotal, false); ?>">

<?php $__currentLoopData = $mediaImageVideo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php

	if ($media->type == 'video') {
		$urlMedia =  Helper::getFile(config('path.videos').$media->video);
		$videoPoster = $media->video_poster ? Helper::getFile(config('path.videos').$media->video_poster) : false;
	} else {
		$urlMedia =  $media->img_type == 'gif' ? Helper::getFile(config('path.images').$media->image) : url("files/storage", $response->id).'/'.$media->image;
		$videoPoster = null;
	}

		$nth++;
	?>

		<?php if($media->type == 'image' || $media->type == 'video'): ?>
			<a href="<?php echo e($urlMedia, false); ?>" class="media-wrapper rounded-0 glightbox" data-gallery="gallery<?php echo e($response->id, false); ?>" style="background-image: url('<?php echo e($videoPoster ?? $urlMedia, false); ?>?w=960&h=980')">
				<?php if($nth == 5 && $mediaImageVideoTotal > 5): ?>
		        <span class="more-media">
					<h2>+<?php echo e($mediaImageVideoTotal - 5, false); ?></h2>
				</span>
		    <?php endif; ?>

				<?php if($media->type == 'video'): ?>
					<span class="button-play">
						<i class="bi bi-play-fill text-white"></i>
					</span>
				<?php endif; ?>

				<?php if(! $videoPoster && $media->type == 'video'): ?>
					<video playsinline muted preload="metadata" class="video-poster-html">
						<source src="<?php echo e($urlMedia, false); ?>" type="video/mp4" />
					</video>
				<?php endif; ?>

				<?php if($videoPoster): ?>
					<img src="<?php echo e($videoPoster ?? $urlMedia, false); ?>?w=960&h=980" <?php echo $media->width ? 'width="'. $media->width .'"' : null; ?> <?php echo $media->height ? 'height="'. $media->height .'"' : null; ?> class="post-img-grid">
				<?php endif; ?>
			</a>
		<?php endif; ?>
		
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div><!-- img-grid -->
</div><!-- container-post-media -->
<?php endif; ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/media-post.blade.php ENDPATH**/ ?>