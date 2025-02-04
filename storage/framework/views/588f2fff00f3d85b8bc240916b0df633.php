<?php if($mediaImageVideoTotal == 1): ?>

<?php $__currentLoopData = $mediaImageVideo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php
		$urlImg = url('files/messages', $msg->id).'/'.$media->file;

		if ($media->width && $media->height > $media->width) {
			$styleImgVertical = 'img-vertical-lg';
		} else {
			$styleImgVertical = null;
		}
	?>

	<?php if($media->type == 'image'): ?>
		<div class="media-grid-1">
			<a href="<?php echo e($urlImg, false); ?>" class="media-wrapper glightbox <?php echo e($styleImgVertical, false); ?>" data-gallery="gallery<?php echo e($msg->id, false); ?>" style="background-image: url('<?php echo e($urlImg, false); ?>?w=960&h=980')">
					<img src="<?php echo e($urlImg, false); ?>?w=960&h=980" <?php echo $media->width ? 'width="'. $media->width .'"' : null; ?> <?php echo $media->height ? 'height="'. $media->height .'"' : null; ?> class="post-img-grid">
			</a>
		</div>
<?php endif; ?>

<?php if($media->type == 'video'): ?>
	<div class="container-media-msg h-auto">
		<video class="js-player <?php echo e($classInvisible, false); ?>" controls <?php if(!$media->video_poster): ?> preload="metadata" <?php endif; ?> <?php if($media->video_poster): ?> preload="none" data-poster="<?php echo e(Helper::getFile(config('path.messages').$media->video_poster), false); ?>" <?php endif; ?>>
		<source src="<?php echo e(Helper::getFile(config('path.messages').$media->file), false); ?>" type="video/mp4" />
	</video>
</div>
<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>

<?php if($mediaImageVideoTotal >= 2): ?>

	<div class="media-grid-<?php echo e($mediaImageVideoTotal > 4 ? 4 : $mediaImageVideoTotal, false); ?>">

<?php $__currentLoopData = $mediaImageVideo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php

	if ($media->type == 'video') {
		$urlMedia =  Helper::getFile(config('path.messages').$media->file);
		$videoPoster = $media->video_poster ? Helper::getFile(config('path.messages').$media->video_poster) : false;
	} else {
		$urlMedia =  url("files/messages", $msg->id).'/'.$media->file;
		$videoPoster = null;
	}

		$nth++;
	?>

		<?php if($media->type == 'image' || $media->type == 'video'): ?>

			<a href="<?php echo e($urlMedia, false); ?>" class="media-wrapper glightbox" data-gallery="gallery<?php echo e($msg->id, false); ?>" style="background-image: url('<?php echo e($videoPoster ?? $urlMedia, false); ?>?w=960&h=980')">

				<?php if($nth == 4 && $mediaImageVideoTotal > 4): ?>
		        <span class="more-media">
							<h2>+<?php echo e($mediaImageVideoTotal - 4, false); ?></h2>
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

<?php endif; ?>

<?php $__currentLoopData = $msg->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	<?php if($media->type == 'music'): ?>
	<div class="wrapper-media-music <?php if($mediaCount >= 2): ?> mt-2 <?php endif; ?>">
		<audio class="js-player <?php echo e($classInvisible, false); ?>" preload="metadata" controls>
		<source src="<?php echo e(Helper::getFile(config('path.messages').$media->file), false); ?>" type="audio/mp3">
		Your browser does not support the audio tag.
	</audio>
</div>
	<?php endif; ?>

<?php if($media->type == 'zip'): ?>
	<a href="<?php echo e(url('download/message/file', $msg->id), false); ?>" class="d-block text-decoration-none <?php if($mediaCount >= 2): ?> mt-2 <?php endif; ?>">
	 <div class="card">
		 <div class="row no-gutters">
			 <div class="col-md-3 text-center bg-primary">
				 <i class="far fa-file-archive m-2 text-white" style="font-size: 40px;"></i>
			 </div>
			 <div class="col-md-9">
				 <div class="card-body py-2 px-4">
					 <h6 class="card-title text-primary text-truncate mb-0">
						 <?php echo e($media->file_name, false); ?>.zip
					 </h6>
					 <p class="card-text">
						 <small class="text-muted"><?php echo e($media->file_size, false); ?></small>
					 </p>
				 </div>
			 </div>
		 </div>
	 </div>
	 </a>
	 <?php endif; ?>

	 <?php if($media->type == 'epub'): ?>
	<a href="<?php echo e(url('viewer/message/epub', $media->id), false); ?>" target="_blank" class="d-block text-decoration-none <?php if($mediaCount >= 2): ?> mt-2 <?php endif; ?>">
	 <div class="card">
		 <div class="row no-gutters">
			 <div class="col-md-3 text-center bg-primary">
				 <i class="fas fa-book-open m-2 text-white" style="font-size: 40px;"></i>
			 </div>
			 <div class="col-md-9">
				 <div class="card-body py-2 px-4">
					 <h6 class="card-title text-primary text-truncate mb-0">
						 <?php echo e($media->file_name, false); ?>.epub
					 </h6>
					 <p class="card-text">
						 <small class="text-muted">
							<strong><?php echo e(__('general.view_online'), false); ?></strong> <i class="bi-arrow-up-right ml-1"></i>
						 </small>
					 </p>
				 </div>
			 </div>
		 </div>
	 </div>
	 </a>
	 <?php endif; ?>

 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 <?php if($msg->tip == 'yes'): ?>
	<div class="card">
		 <div class="row no-gutters">
			 <div class="col-md-12">
				 <div class="card-body py-2 px-4">
					 <h6 class="card-title text-primary text-truncate mb-0">
						 <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi-coin mr-1" viewBox="0 0 16 16">
							 <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
							 <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
							 <path fill-rule="evenodd" d="M8 13.5a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
						 </svg> <?php echo e(__('general.tip'). ' -- ' .Helper::priceWithoutFormat($msg->tip_amount), false); ?>

					 </h6>
				 </div>
			 </div>
		 </div>
	 </div>
	 <?php endif; ?>

	 <?php if($msg->gift_id): ?>
	<div class="card border-0">
		<?php if(isset($msg->gift->id)): ?>
          <span class="d-block text-center">
            <img src="<?php echo e(url('public/img/gifts', $msg->gift->image), false); ?>" width="100">
          </span>
        <?php endif; ?>

		 <div class="row no-gutters">
			 <div class="col-md-12">
				 <div class="card-body py-2 px-4">
					 <h6 class="card-title text-primary text-truncate mb-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi-gift mr-1" viewBox="0 0 16 16">
							<path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43zM9 3h2.932l.023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0zM1 4v2h6V4zm8 0v2h6V4zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5z"/>
						  </svg> 
						  <small><strong><?php echo e(__('general.gift_for'). ' ' .Helper::priceWithoutFormat($msg->gift_amount), false); ?></strong></small>
					 </h6>
				 </div>
			 </div>
		 </div>
	 </div>
	 <?php endif; ?>

<?php if($mediaCount == 0): ?>
	<?php echo $chatMessage; ?>

<?php endif; ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/media-messages.blade.php ENDPATH**/ ?>