<?php if(! isset($single) && $messages->count() == 10): ?>
<div class="btn-block text-center wrap-container containerLoadMore" data-id="<?php echo e($user->id, false); ?>">
  <a href="javascript:void(0)" class="loadMoreMessages d-none" id="paginatorChat">
    — <?php echo e(__('general.load_messages'), false); ?>

  </a>
</div>
<?php endif; ?>

<?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php
  $mediaCount = $msg->media->count();
  $allFiles = $msg->media()->groupBy('type')->get();
  $getFirstFile =$msg->media()->whereIn('type', ['image', 'video'])->first();
  $countFilesImage = $msg->media->where('type', 'image')->count();
	$countFilesVideo = $msg->media->where('type', 'video')->count();
	$countFilesAudio = $msg->media->where('type', 'music')->count();
  $mediaImageVideoTotal = $msg->media->whereIn('type', ['image', 'video'])->count();
  $chatMessage = $msg->message ? Helper::linkText(Helper::checkText($msg->message)) : null;
  $classInvisible = ! request()->ajax() ? 'invisible' : null;
  $nth = 0; // nth foreach nth-child(3n-1)
  $mediaImageVideo = $msg->media()
				->whereIn('type', ['image', 'video'])
				->get();

  if ($getFirstFile && $getFirstFile->type == 'image') {
    $urlMedia =  url('media/storage/focus/message', $getFirstFile->id);
    $backgroundPostLocked = 'background: url('.$urlMedia.') no-repeat center center #b9b9b9; background-size: cover;';
    $textWhite = 'text-white';

  } elseif ($getFirstFile && $getFirstFile->type == 'video' && $getFirstFile->video_poster) {
      $videoPoster = url('media/storage/focus/message', $getFirstFile->id);
      $backgroundPostLocked = 'background: url('.$videoPoster.') no-repeat center center #b9b9b9; background-size: cover;';
      $textWhite = 'text-white';

  } else {
    $backgroundPostLocked = null;
    $textWhite = null;
  }
?>

<?php if($msg->sender->id == auth()->user()->id): ?>
<div data="<?php echo e($msg->id, false); ?>" class="media py-2 chatlist">
<div class="media-body position-relative">
  <?php if($msg->tip == 'no' && !$msg->gift_id): ?>
  <a href="javascript:void(0);" class="btn-removeMsg removeMsg" data="<?php echo e($msg->id, false); ?>" title="<?php echo e(__('general.delete'), false); ?>">
    <i class="fa fa-trash-alt"></i>
    </a>
  <?php endif; ?>
  <div class="<?php if($mediaCount == 0): ?> float-right <?php else: ?> wrapper-msg-left <?php endif; ?> message position-relative text-word-break <?php if($mediaCount == 0 && $msg->tip == 'no' && !$msg->gift_id): ?> bg-primary <?php else: ?> media-container <?php endif; ?> text-white <?php if($msg->format == 'zip'): ?> w-50 <?php else: ?> w-auto <?php endif; ?>  rounded-bottom-right-0">
      <?php echo $__env->make('includes.media-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>

  <?php if($mediaCount != 0 && $msg->message != ''): ?>
    <div class="w-100 d-inline-block">
      <div class="w-auto position-relative text-word-break message bg-primary float-right text-white rounded-top-right-0">
        <?php echo $chatMessage; ?>

      </div>
    </div>
<?php endif; ?>
    <span class="w-100 d-block text-muted float-right text-right pr-1 small">
      <?php if($msg->price != 0.00): ?>
        <?php echo e(Helper::formatPrice($msg->price), false); ?> <i class="feather icon-lock mr-1"></i> -
      <?php endif; ?>
      <span class="timeAgo" data="<?php echo e(date('c', strtotime($msg->created_at)), false); ?>"></span>
    </span>
</div><!-- media-body -->

<a href="<?php echo e(url($msg->sender->username), false); ?>" class="align-self-end ml-3 d-none">
  <img src="<?php echo e(Helper::getFile(config('path.avatar').$msg->sender->avatar), false); ?>" class="rounded-circle" width="50" height="50">
</a>
</div><!-- media -->
<?php else: ?>
<div data="<?php echo e($msg->id, false); ?>" class="media py-2 chatlist">
<a href="<?php echo e(url($msg->sender->username), false); ?>" class="align-self-end mr-3">
  <img src="<?php echo e(Helper::getFile(config('path.avatar').$msg->sender->avatar), false); ?>" class="rounded-circle avatar-chat" width="50" height="50">
</a>
<div class="media-body position-relative">
  <?php if($msg->price != 0.00 && ! auth()->user()->checkPayPerViewMsg($msg->id)): ?>
    <div class="btn-block p-sm text-center content-locked mb-2 pt-lg pb-lg px-3 <?php echo e($textWhite, false); ?> custom-rounded float-left" style="<?php echo e($backgroundPostLocked, false); ?> max-width: 500px;">
    		<span class="btn-block text-center mb-3">
          <i class="feather ico-no-result border-0 icon-lock <?php echo e($textWhite, false); ?>"></i></span>
        <a href="javascript:void(0);" data-toggle="modal" data-target="#payPerViewForm" data-mediaid="<?php echo e($msg->id, false); ?>" data-price="<?php echo e(Helper::formatPrice($msg->price, true), false); ?>" data-subtotalprice="<?php echo e(Helper::formatPrice($msg->price), false); ?>" data-pricegross="<?php echo e($msg->price, false); ?>" class="btn btn-primary w-100">
          <i class="feather icon-unlock mr-1"></i> <?php echo e(__('general.unlock_for'), false); ?> <?php echo e(Helper::formatPrice($msg->price), false); ?>

        </a>

    <ul class="list-inline mt-3">
          <?php if($mediaCount == 0): ?>
      			<li class="list-inline-item"><i class="bi bi-file-font"></i> <?php echo e(__('admin.text'), false); ?></li>
      		<?php endif; ?>

        <?php $__currentLoopData = $allFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($media->type == 'image'): ?>
      			<li class="list-inline-item"><i class="feather icon-image"></i> <?php echo e($countFilesImage, false); ?></li>
      		<?php endif; ?>

      		<?php if($media->type == 'video'): ?>
      			<li class="list-inline-item"><i class="feather icon-video"></i> <?php echo e($countFilesVideo, false); ?> <?php if($media->duration_video && $countFilesVideo == 1 || $media->quality_video && $countFilesVideo == 1): ?> <small class="ml-1"><?php if($media->quality_video): ?><span class="quality-video"><?php echo e($media->quality_video, false); ?></span><?php endif; ?> <?php echo e($media->duration_video, false); ?></small> <?php endif; ?></li>
      		<?php endif; ?>

      		<?php if($media->type == 'music'): ?>
      			<li class="list-inline-item"><i class="feather icon-mic"></i> <?php echo e($countFilesAudio, false); ?></li>
      			<?php endif; ?>

      			<?php if($media->type == 'zip'): ?>
      			<li class="list-inline-item"><i class="far fa-file-archive"></i> <?php echo e($media->file_size, false); ?></li>
      		<?php endif; ?>

          <?php if($media->type == 'epub'): ?>
            <li class="list-inline-item"><i class="bi-book"></i> <?php echo e($media->file_size, false); ?></li>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

      </div><!-- btn-block parent -->
    <?php endif; ?>

<?php if($msg->price == 0.00 || $msg->price != 0.00 && auth()->user()->checkPayPerViewMsg($msg->id)): ?>
  <div class="<?php if($mediaCount == 0): ?> float-left <?php else: ?> wrapper-msg-right <?php endif; ?> message position-relative text-word-break <?php if($mediaCount == 0 && $msg->tip == 'no' && !$msg->gift_id): ?> bg-light <?php else: ?> media-container <?php endif; ?> <?php if($msg->format == 'zip'): ?> w-50 <?php else: ?> w-auto <?php endif; ?> rounded-bottom-left-0">
        <?php echo $__env->make('includes.media-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <?php endif; ?>

  <?php if($mediaCount != 0 && $msg->message != ''): ?>
    <div class="w-100 d-inline-block">
      <div class="w-auto position-relative text-word-break message bg-light float-left rounded-top-left-0">
        <?php echo $chatMessage; ?>

      </div>
  </div>
<?php endif; ?>

<span class="w-100 d-block text-muted float-left pl-1 small">
    <span class="timeAgo" data="<?php echo e(date('c', strtotime($msg->created_at)), false); ?>"></span>
  <?php if($msg->price != 0.00): ?>
    - <?php echo e(Helper::formatPrice($msg->price), false); ?> <?php echo e(auth()->user()->checkPayPerViewMsg($msg->id) ? __('general.paid') : null, false); ?> <i class="feather icon-lock mr-1"></i>
  <?php endif; ?>
</span>
</div><!-- media-body -->
</div><!-- media -->
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/messages-chat.blade.php ENDPATH**/ ?>