<?php $__currentLoopData = $messagesInbox; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="card msg-inbox border-bottom m-0 rounded-0">
	<div class="list-group list-group-sm list-group-flush rounded-0">

		<a 
		 href="<?php echo e($msg->remitter()->status == 'disabled' ? 'javascript:;' : url('messages', [$msg->remitter()->id, $msg->remitter()->username]), false); ?>" 
		class="item-chat list-group-item list-group-item-action text-decoration-none p-4 <?php if($msg->status == 'new' && $msg->sender->id != auth()->id()): ?> font-weight-bold unread-chat <?php endif; ?>  <?php if(request()->id == $msg->remitter()->id): ?> active disabled <?php endif; ?>">
			<div class="media">

				<?php if($msg->remitter()->status == 'disabled'): ?>
				<div class="media-left mr-3 position-relative">
					<img class="media-object rounded-circle" src="<?php echo e(Helper::getFile(config('path.avatar').$settings->avatar), false); ?>"  width="50" height="50">
				 </div>
				<?php else: ?>
				<div class="media-left mr-3 position-relative <?php if($msg->remitter()->active_status_online == 'yes'): ?> <?php if(Cache::has('is-online-' . $msg->remitter()->id)): ?> user-online <?php else: ?> user-offline <?php endif; ?> <?php endif; ?>">
					<img class="media-object rounded-circle" src="<?php echo e(Helper::getFile(config('path.avatar').$msg->remitter()->avatar), false); ?>"  width="50" height="50">
				 </div>
				<?php endif; ?>

			 <div class="media-body overflow-hidden">
				 <div class="d-flex justify-content-between align-items-center">
					<h6 class="media-heading mb-2 text-truncate">
						<?php if($msg->remitter()->status == 'disabled'): ?>
							<em><?php echo e(__('general.user_unavailable'), false); ?></em>
						<?php else: ?>
							 <?php echo e($msg->remitterName(), false); ?>

						<?php endif; ?>

						<?php if($msg->remitter()->verified_id == 'yes' && $msg->remitter()->status == 'active'): ?>
				         <small class="verified">
				   			<i class="bi bi-patch-check-fill"></i>
				   			</small>
				       <?php endif; ?>
					 </h6>
					 <small class="timeAgo text-truncate mb-2" data="<?php echo e(date('c',strtotime( $msg->created_at ) ), false); ?>"></small>
				 </div>

				 <p class="text-truncate m-0">
					 <?php if($msg->totalMsg() != 0): ?>
					 <span class="badge badge-pill badge-primary mr-1"><?php echo e($msg->totalMsg(), false); ?></span>
				 <?php endif; ?>

					 <?php if($msg->receiver->id != auth()->id()): ?>
					 	<?php if($msg->status == 'readed'): ?>
						 <span><i class="bi bi-check2-all mr-1"></i></span>
						 <?php else: ?>
						 <span><i class="bi bi-reply mr-1"></i></span>
						 <?php endif; ?>
					 <?php endif; ?>

					 <?php if($msg->media->count() == 1): ?>
					 <?php $__currentLoopData = $msg->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						 <?php switch($media->type):
							 case ('image'): ?>
							 <i class="feather icon-image"></i>
							 <?php if($msg->message == ''): ?> <?php echo e(__('general.image'), false); ?> <?php endif; ?>
								 <?php break; ?>
							 <?php case ('video'): ?>
							 <i class="feather icon-video"></i>
							 <?php if($msg->message == ''): ?> <?php echo e(__('general.video'), false); ?> <?php endif; ?>
							<?php break; ?>

							<?php case ('music'): ?>
							 <i class="feather icon-mic"></i>
							 <?php if($msg->message == ''): ?> <?php echo e(__('general.music'), false); ?> <?php endif; ?>
							<?php break; ?>

							<?php case ('zip'): ?>
							 <i class="far fa-file-archive"></i>
							 <?php if($msg->message == ''): ?> <?php echo e(__('general.zip'), false); ?> <?php endif; ?>
							<?php break; ?>

							<?php case ('epub'): ?>
							 <i class="bi-book mr-1"></i>
							 <?php if($msg->message == ''): ?> EPUB <?php endif; ?>
							<?php break; ?>
						 <?php endswitch; ?>
					 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					 <?php elseif($msg->media->count() > 1): ?>
					 	<i class="bi bi-files"></i>
					 <?php endif; ?>

					 <?php if($msg->tip == 'yes'): ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-coin mb-1" viewBox="0 0 16 16"> <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/> <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path fill-rule="evenodd" d="M8 13.5a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/> </svg>
						<?php echo e(__('general.tip'), false); ?>

					<?php endif; ?>

					<?php if($msg->gift_id	): ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-gift mb-1" viewBox="0 0 16 16"> <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43zM9 3h2.932l.023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0zM1 4v2h6V4zm8 0v2h6V4zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5z"/> </svg>
						<?php echo e(__('general.gift'), false); ?>

					<?php endif; ?>

					 <?php if($msg->price != 0.00
					 		&& $msg->media->count() == 0
							&& $msg->receiver->id == auth()->id()
							&& ! auth()->user()->checkPayPerViewMsg($msg->id)
							): ?>

						 <i class="feather icon-lock mr-1"></i> <?php echo app('translator')->get('users.content_locked'); ?>

					 <?php else: ?>
						 <?php echo e($msg->message, false); ?>

					 <?php endif; ?>

				 </p>
			 </div><!-- media-body -->
	 </div><!-- media -->
		 </a>
	</div><!-- list-group -->
</div><!-- card -->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if($messagesInbox->count() == 0): ?>
	<div class="card border-0 text-center">
  <div class="card-body">
    <h4 class="mb-0 font-montserrat mt-2">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-send-exclamation" viewBox="0 0 16 16">
				<path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372l2.8-7Zm-2.54 1.183L5.93 9.363 1.591 6.602l11.833-4.733Z"/>
				<path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1.5a.5.5 0 0 1-1 0V11a.5.5 0 0 1 1 0Zm0 3a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/>
			</svg> <?php echo e(__('general.chats'), false); ?>

		</h4>
		<p class="lead text-muted mt-0"><?php echo e(__('general.no_chats'), false); ?></p>
  </div>
</div>
<?php endif; ?>

<?php if($messagesInbox->hasMorePages()): ?>
  <div class="btn-block text-center d-none">
    <?php echo e($messagesInbox->appends(['q' => request('q')])->links('vendor.pagination.loadmore'), false); ?>

  </div>
  <?php endif; ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/messages-inbox.blade.php ENDPATH**/ ?>