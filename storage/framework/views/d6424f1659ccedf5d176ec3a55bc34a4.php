<?php echo $__env->make('includes.advertising', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
  <?php $__currentLoopData = $updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php
			if (auth()->check()) {
				$checkUserSubscription = auth()->user()->checkSubscription($response->creator);
				$checkPayPerView = auth()->user()->payPerView()->where('updates_id', $response->id)->first();
			}

		$creatorLive = Helper::isCreatorLive($getCurrentLiveCreators , $response->creator->id);

		$totalLikes = number_format($response->likes->count());
		$totalComments = $response->totalComments();
		$mediaCount = $response->media->count();
		$allFiles = $response->media()->groupBy('type')->get();
		$getFirstFile = $response->media()->whereIn('type', ['image', 'video'])->where('video_embed', '')->first();

		$mediaImageVideo = $response->media()
				->whereIn('type', ['image', 'video'])
				->where('video_embed', '')
				->get();

		if ($getFirstFile && $getFirstFile->type == 'image') {
			$urlMedia =  url('media/storage/focus/photo', $getFirstFile->id);
			$backgroundPostLocked = 'background: url('.$urlMedia.') no-repeat center center #b9b9b9; background-size: cover;';
			$textWhite = 'text-white';

		} elseif ($getFirstFile && $getFirstFile->type == 'video' && $getFirstFile->video_poster) {
				$videoPoster = url('media/storage/focus/video', $getFirstFile->video_poster);
				$backgroundPostLocked = 'background: url('.$videoPoster.') no-repeat center center #b9b9b9; background-size: cover;';
				$textWhite = 'text-white';

		} else {
			$backgroundPostLocked = null;
			$textWhite = null;
		}

		$countFilesImage = $response->media->where('type', 'image')->count();
		$countFilesVideo = $response->media->whereIn('type', ['video', 'video_embed'])->count();
		$countFilesAudio = $response->media->where('type', 'music')->count();
		$mediaImageVideoTotal = $response->media->whereIn('type', ['image', 'video'])->count();

		$isVideoEmbed = $response->media[0]->video_embed ?? false;

		$nth = 0; // nth foreach nth-child(3n-1)
		
	?>
	<div class="card mb-3 card-updates views rounded-large shadow-large card-border-0 <?php if($response->status == 'pending'): ?> post-pending <?php endif; ?> <?php if($response->fixed_post == '1' && request()->path() == $response->creator->username || auth()->check() && $response->fixed_post == '1' && $response->creator->id == auth()->user()->id): ?> pinned-post <?php endif; ?>" data="<?php echo e($response->id, false); ?>">
	<div class="card-body">
		<div class="pinned_post text-muted small w-100 mb-2 <?php echo e($response->fixed_post == '1' && request()->path() == $response->creator->username || auth()->check() && $response->fixed_post == '1' && $response->creator->id == auth()->user()->id ? 'pinned-current' : 'display-none', false); ?>">
			<i class="bi bi-pin mr-2"></i> <?php echo e(__('general.pinned_post'), false); ?>

		</div>

		<?php if($response->status == 'pending'): ?>
			<h6 class="text-muted w-100 mb-4">
				<i class="bi bi-eye-fill mr-1"></i> <em><?php echo e(__('general.post_pending_review'), false); ?></em>
			</h6>
		<?php endif; ?>

		<?php if($response->status == 'schedule'): ?>
			<h6 class="text-muted w-100 mb-4">
				<i class="bi-calendar-fill mr-1"></i> <em><?php echo e(__('general.date_schedule'), false); ?> <?php echo e(Helper::formatDateSchedule($response->scheduled_date), false); ?></em>
			</h6>
		<?php endif; ?>

	<div class="media">
		<span class="rounded-circle mr-3 position-relative">
			<a href="<?php echo e($creatorLive ? url('live', $response->creator->username) : url($response->creator->username), false); ?>">

				<?php if(auth()->check() && $creatorLive): ?>
					<span class="live-span"><?php echo e(__('general.live'), false); ?></span>
				<?php endif; ?>

				<img src="<?php echo e(Helper::getFile(config('path.avatar').$response->creator->avatar), false); ?>" alt="<?php echo e($response->creator->hide_name == 'yes' ? $response->creator->username : $response->creator->name, false); ?>" class="rounded-circle avatarUser" width="60" height="60">
				</a>
		</span>

		<div class="media-body">
				<h5 class="mb-0 font-montserrat">
					<a href="<?php echo e(url($response->creator->username), false); ?>">
					<?php echo e($response->creator->hide_name == 'yes' ? $response->creator->username : $response->creator->name, false); ?>

				</a>

				<?php if($response->creator->verified_id == 'yes'): ?>
					<small class="verified" title="<?php echo e(__('general.verified_account'), false); ?>"data-toggle="tooltip" data-placement="top">
						<i class="bi bi-patch-check-fill"></i>
					</small>
				<?php endif; ?>

				<small class="text-muted font-14"><?php echo e('@'.$response->creator->username, false); ?></small>

				<?php if(auth()->check() && auth()->user()->id == $response->creator->id): ?>
				<a href="javascript:void(0);" class="text-muted float-right" id="dropdown_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<i class="fa fa-ellipsis-h"></i>
				</a>

				<!-- Target -->
				<button class="d-none copy-url" id="url<?php echo e($response->id, false); ?>" data-clipboard-text="<?php echo e(url($response->creator->username.'/post', $response->id), false); ?>"><?php echo e(__('general.copy_link'), false); ?></button>

				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_options">
					<?php if(request()->path() != $response->creator->username.'/post/'.$response->id): ?>
						<a class="dropdown-item mb-1" href="<?php echo e(url($response->creator->username.'/post', $response->id), false); ?>"><i class="bi bi-box-arrow-in-up-right mr-2"></i> <?php echo e(__('general.go_to_post'), false); ?></a>
					<?php endif; ?>

					<?php if($response->status == 'active'): ?>
						<a class="dropdown-item mb-1 pin-post" href="javascript:void(0);" data-id="<?php echo e($response->id, false); ?>">
							<i class="bi bi-pin mr-2"></i> <?php echo e($response->fixed_post == '0' ? __('general.pin_to_your_profile') : __('general.unpin_from_profile'), false); ?>

						</a>
					<?php endif; ?>

					<button class="dropdown-item mb-1" onclick="$('#url<?php echo e($response->id, false); ?>').trigger('click')"><i class="feather icon-link mr-2"></i> <?php echo e(__('general.copy_link'), false); ?></button>

					<a href="<?php echo e(route('post.edit', ['id' => $response->id]), false); ?>" class="dropdown-item mb-1">
						<i class="bi bi-pencil mr-2"></i> <?php echo e(__('general.edit_post'), false); ?>

					</a>

					<?php echo Form::open([
						'method' => 'POST',
						'url' => "update/delete/$response->id",
						'class' => 'd-inline'
					]); ?>


					<?php if(isset($inPostDetail)): ?>
					<?php echo Form::hidden('inPostDetail', 'true'); ?>

				<?php endif; ?>

					<?php echo Form::button('<i class="feather icon-trash-2 mr-2"></i> '.__('general.delete_post'), ['class' => 'dropdown-item mb-1 actionDelete']); ?>

					<?php echo Form::close(); ?>

	      </div>
			<?php endif; ?>

				<?php if(auth()->check()
					&& auth()->user()->id != $response->creator->id
					&& $response->locked == 'yes'
					&& $checkUserSubscription && $response->price == 0.00

					|| auth()->check()
						&& auth()->user()->id != $response->creator->id
						&& $response->locked == 'yes'
						&& $checkUserSubscription
						&& $response->price != 0.00
						&& $checkPayPerView

					|| auth()->check()
						&& auth()->user()->id != $response->creator->id
						&& $response->price != 0.00
						&& ! $checkUserSubscription
						&& $checkPayPerView

					|| auth()->check() && auth()->user()->id != $response->creator->id && auth()->user()->role == 'admin' && auth()->user()->permission == 'all'
					|| auth()->check() && auth()->user()->id != $response->creator->id && $response->locked == 'no'
					): ?>
					<a href="javascript:void(0);" class="text-muted float-right" id="dropdown_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<i class="fa fa-ellipsis-h"></i>
					</a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_options">

						<!-- Target -->
						<button class="d-none copy-url" id="url<?php echo e($response->id, false); ?>" data-clipboard-text="<?php echo e(url($response->creator->username.'/post', $response->id).Helper::referralLink(), false); ?>">
							<?php echo e(__('general.copy_link'), false); ?>

						</button>

						<?php if(request()->path() != $response->creator->username.'/post/'.$response->id): ?>
							<a class="dropdown-item" href="<?php echo e(url($response->creator->username.'/post', $response->id), false); ?>">
								<i class="bi bi-box-arrow-in-up-right mr-2"></i> <?php echo e(__('general.go_to_post'), false); ?>

							</a>
						<?php endif; ?>

						<button class="dropdown-item" onclick="$('#url<?php echo e($response->id, false); ?>').trigger('click')">
							<i class="feather icon-link mr-2"></i> <?php echo e(__('general.copy_link'), false); ?>

						</button>

						<button type="button" class="dropdown-item" data-toggle="modal" data-target="#reportUpdate<?php echo e($response->id, false); ?>">
							<i class="bi bi-flag mr-2"></i>  <?php echo e(__('admin.report'), false); ?>

						</button>

					</div>

			<div class="modal fade modalReport" id="reportUpdate<?php echo e($response->id, false); ?>" tabindex="-1" role="dialog" aria-hidden="true">
     		<div class="modal-dialog modal-danger modal-sm">
     			<div class="modal-content">
						<div class="modal-header">
              <h6 class="modal-title font-weight-light" id="modal-title-default">
								<i class="fas fa-flag mr-1"></i> <?php echo e(__('admin.report_update'), false); ?>

							</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-times"></i>
              </button>
            </div>

					<!-- form start -->
					<form method="POST" action="<?php echo e(url('report/update', $response->id), false); ?>" enctype="multipart/form-data">
				  <div class="modal-body">
						<?php echo csrf_field(); ?>
				    <!-- Start Form Group -->
            <div class="form-group">
              <label><?php echo e(__('admin.please_reason'), false); ?></label>
              	<select name="reason" class="form-control custom-select">
                    <option value="copyright"><?php echo e(__('admin.copyright'), false); ?></option>
                    <option value="privacy_issue"><?php echo e(__('admin.privacy_issue'), false); ?></option>
                    <option value="violent_sexual"><?php echo e(__('admin.violent_sexual_content'), false); ?></option>
                  </select>

				  <textarea name="message" rows="" cols="40" maxlength="200" placeholder="<?php echo e(__('general.message'), false); ?> (<?php echo e(__('general.optional'), false); ?>)" class="form-control mt-2 textareaAutoSize"></textarea>
                  </div><!-- /.form-group-->
				      </div><!-- Modal body -->

							<div class="modal-footer">
								<button type="button" class="btn border text-white" data-dismiss="modal"><?php echo e(__('admin.cancel'), false); ?></button>
								<button type="submit" class="btn btn-xs btn-white sendReport ml-auto"><i></i> <?php echo e(__('admin.report_update'), false); ?></button>
							</div>
							</form>
     				</div><!-- Modal content -->
     			</div><!-- Modal dialog -->
     		</div><!-- Modal -->
				<?php endif; ?>
			</h5>

				<small class="timeAgo text-muted" data="<?php echo e(date('c', strtotime($response->date)), false); ?>"></small>

				<?php if($response->locked == 'no'): ?>
				<small class="text-muted type-post" title="<?php echo e(__('general.public'), false); ?>">
					<i class="iconmoon icon-WorldWide mr-1"></i>
				</small>
				<?php endif; ?>

			<?php if($response->locked == 'yes'): ?>

				<small class="text-muted type-post" title="<?php echo e(__('users.content_locked'), false); ?>">

					<i class="feather icon-lock mr-1"></i>

					<?php if(auth()->check() && $response->price != 0.00
							&& $checkUserSubscription
							&& ! $checkPayPerView
							|| auth()->check() && $response->price != 0.00
							&& ! $checkUserSubscription
							&& ! $checkPayPerView
						): ?>
						<?php echo e(Helper::formatPrice($response->price), false); ?>


					<?php elseif(auth()->check() && $checkPayPerView): ?>
						<?php echo e(__('general.paid'), false); ?>

					<?php endif; ?>
				</small>
			<?php endif; ?>
		</div><!-- media body -->
	</div><!-- media -->
</div><!-- card body -->

<?php if(auth()->check() && auth()->user()->id == $response->creator->id
	|| $response->locked == 'yes' && $mediaCount != 0

	|| auth()->check() && $response->locked == 'yes'
	&& $checkUserSubscription
	&& $response->price == 0.00

	|| auth()->check() && $response->locked == 'yes'
	&& $checkUserSubscription
	&& $response->price != 0.00
	&& $checkPayPerView

	|| auth()->check() && $response->locked == 'yes'
	&& $response->price != 0.00
	&& ! $checkUserSubscription
	&& $checkPayPerView

	|| auth()->check() && auth()->user()->role == 'admin' && auth()->user()->permission == 'all'
	|| $response->locked == 'no'
	): ?>
	<div class="card-body pt-0 pb-3">
		<p class="mb-0 truncated position-relative text-word-break">
			<?php echo Helper::linkText(Helper::checkText($response->description, $isVideoEmbed ?? null)); ?>

		</p>
		<a href="javascript:void(0);" class="display-none link-border"><?php echo e(__('general.view_all'), false); ?></a>
	</div>

<?php else: ?>
	<?php if($response->title): ?>
	<div class="card-body pt-0 pb-3">
		<p class="mb-0 update-text position-relative text-word-break font-weight-bold">
			<?php echo Helper::linkText($response->title); ?>

		</p>
	</div>
	<?php endif; ?>
<?php endif; ?>

		<?php if(auth()->check() && auth()->user()->id == $response->creator->id

		|| auth()->check() && $response->locked == 'yes'
		&& $checkUserSubscription
		&& $response->price == 0.00

		|| auth()->check() && $response->locked == 'yes'
		&& $checkUserSubscription
		&& $response->price != 0.00
		&& $checkPayPerView

		|| auth()->check() && $response->locked == 'yes'
		&& $response->price != 0.00
		&& ! $checkUserSubscription
		&& $checkPayPerView

		|| auth()->check() && auth()->user()->role == 'admin' && auth()->user()->permission == 'all'
		|| $response->locked == 'no'
		): ?>

	<div class="btn-block">

		<?php if($mediaImageVideoTotal <> 0): ?>
			<?php echo $__env->make('includes.media-post', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php $__currentLoopData = $response->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($media->music != ''): ?>
			<div class="mx-3 border rounded <?php if($mediaCount > 1): ?> mt-3 <?php endif; ?>">
				<audio id="music-<?php echo e($media->id, false); ?>" preload="metadata" class="js-player w-100 <?php if(!request()->ajax()): ?>invisible <?php endif; ?>" controls>
					<source src="<?php echo e(Helper::getFile(config('path.music').$media->music), false); ?>" type="audio/mp3">
					Your browser does not support the audio tag.
				</audio>
			</div>
			<?php endif; ?>

			<?php if($media->type == 'file'): ?>
			<a href="<?php echo e(url('download/file', $response->id), false); ?>" class="d-block text-decoration-none <?php if($mediaCount > 1): ?> mt-3 <?php endif; ?>">
				<div class="card mb-3 mx-3">
					<div class="row no-gutters">
						<div class="col-md-2 text-center bg-primary rounded-left">
							<i class="far fa-file-archive m-4 text-white" style="font-size: 40px;"></i>
						</div>
						<div class="col-md-10">
							<div class="card-body">
								<h5 class="card-title text-primary text-truncate mb-0">
									<?php echo e($media->file_name, false); ?>.zip
								</h5>
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
			<a href="<?php echo e(url('viewer/epub', $media->id), false); ?>" target="_blank" class="d-block text-decoration-none <?php if($mediaCount > 1): ?> mt-3 <?php endif; ?>">
				<div class="card mb-3 mx-3">
					<div class="row no-gutters">
						<div class="col-md-2 text-center bg-primary rounded-left">
							<i class="fas fa-book-open m-4 text-white" style="font-size: 40px;"></i>
						</div>
						<div class="col-md-10">
							<div class="card-body">
								<h5 class="card-title text-primary text-truncate mb-1">
									<?php echo e($media->file_name, false); ?>.epub
								</h5>
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

		<?php if($isVideoEmbed): ?>
				<?php if(in_array(Helper::videoUrl($isVideoEmbed), array('youtube.com','www.youtube.com','youtu.be','www.youtu.be', 'm.youtube.com'))): ?>
					<div class="embed-responsive embed-responsive-16by9 mb-2">
						<iframe class="embed-responsive-item" height="360" src="https://www.youtube.com/embed/<?php echo e(Helper::getYoutubeId($isVideoEmbed), false); ?>" allowfullscreen></iframe>
					</div>
				<?php endif; ?>

				<?php if(in_array(Helper::videoUrl($isVideoEmbed), array('vimeo.com','player.vimeo.com'))): ?>
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="https://player.vimeo.com/video/<?php echo e(Helper::getVimeoId($isVideoEmbed), false); ?>" allowfullscreen></iframe>
					</div>
				<?php endif; ?>

		<?php endif; ?>

	</div><!-- btn-block -->

<?php else: ?>

	<div class="btn-block p-sm text-center content-locked pt-lg pb-lg px-3 <?php echo e($textWhite, false); ?>" style="<?php echo e($backgroundPostLocked, false); ?>">
		<span class="btn-block text-center mb-3"><i class="feather icon-lock ico-no-result border-0 <?php echo e($textWhite, false); ?>"></i></span>

		<?php if($response->creator->planActive() && $response->price == 0.00
				|| $response->creator->free_subscription == 'yes' && $response->price == 0.00): ?>
			<a href="<?php echo e(request()->route()->named('profile') ? 'javascript:void(0);' : url($response->creator->username), false); ?>" <?php if(auth()->guard()->guest()): ?> data-toggle="modal" data-target="#loginFormModal" <?php else: ?> <?php if(request()->route()->named('profile')): ?> <?php if($response->creator->free_subscription == 'yes'): ?> data-toggle="modal" data-target="#subscriptionFreeForm" <?php else: ?> data-toggle="modal" data-target="#subscriptionForm" <?php endif; ?> <?php endif; ?> <?php endif; ?> class="btn btn-primary w-100">
				<?php echo e(__('general.content_locked_user_logged'), false); ?>

			</a>
		<?php elseif($response->creator->planActive() && $response->price != 0.00
				|| $response->creator->free_subscription == 'yes' && $response->price != 0.00): ?>
				<a href="javascript:void(0);" <?php if(auth()->guard()->guest()): ?> data-toggle="modal" data-target="#loginFormModal" <?php else: ?> <?php if($response->status == 'active'): ?> data-toggle="modal" data-target="#payPerViewForm" data-mediaid="<?php echo e($response->id, false); ?>" data-price="<?php echo e(Helper::formatPrice($response->price, true), false); ?>" data-subtotalprice="<?php echo e(Helper::formatPrice($response->price), false); ?>" data-pricegross="<?php echo e($response->price, false); ?>" <?php endif; ?> <?php endif; ?> class="btn btn-primary w-100">
					<?php if(auth()->guard()->guest()): ?>
						<?php echo e(__('general.content_locked_user_logged'), false); ?>

					<?php else: ?>

						<?php if($response->status == 'active'): ?>
								<i class="feather icon-unlock mr-1"></i> <?php echo e(__('general.unlock_post_for'), false); ?> <?php echo e(Helper::formatPrice($response->price), false); ?>


							<?php else: ?>
								<?php echo e(__('general.post_pending_review'), false); ?>

						<?php endif; ?>
						<?php endif; ?>
				</a>
		<?php else: ?>
			<a href="javascript:void(0);" class="btn btn-primary disabled w-100">
				<?php echo e(__('general.subscription_not_available'), false); ?>

			</a>
		<?php endif; ?>

		<ul class="list-inline mt-3">

		<?php if($mediaCount == 0): ?>
			<li class="list-inline-item"><i class="bi bi-file-font"></i> <?php echo e(__('admin.text'), false); ?></li>
		<?php endif; ?>

<?php if($mediaCount != 0): ?>
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

			<?php if($media->type == 'file'): ?>
			<li class="list-inline-item"><i class="far fa-file-archive"></i> <?php echo e($media->file_size, false); ?></li>
		<?php endif; ?>

		<?php if($media->type == 'epub'): ?>
			<li class="list-inline-item"><i class="bi-book"></i> <?php echo e($media->file_size, false); ?></li>
		<?php endif; ?>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</ul>

</div><!-- btn-block parent -->

	<?php endif; ?>

<?php if($response->status == 'active'): ?>
<div class="card-footer bg-white border-top-0 rounded-large">
    <h4 class="mb-2">
			<?php
			$likeActive = auth()->check() && auth()->user()->likes()->where('updates_id', $response->id)->where('status','1')->first();
			$bookmarkActive = auth()->check() && auth()->user()->bookmarks()->where('updates_id', $response->id)->first();

			if(auth()->check() && auth()->user()->id == $response->creator->id

			|| auth()->check() && $response->locked == 'yes'
			&& $checkUserSubscription
			&& $response->price == 0.00

			|| auth()->check() && $response->locked == 'yes'
			&& $checkUserSubscription
			&& $response->price != 0.00
			&& $checkPayPerView

			|| auth()->check() && $response->locked == 'yes'
			&& $response->price != 0.00
			&& ! $checkUserSubscription
			&& $checkPayPerView

			|| auth()->check() && auth()->user()->role == 'admin' && auth()->user()->permission == 'all'
			|| auth()->check() && $response->locked == 'no') {
				$buttonLike = 'likeButton';
				$buttonBookmark = 'btnBookmark';
			} else {
				$buttonLike = null;
				$buttonBookmark = null;
			}
			?>

			<a class="pulse-btn btnLike <?php if($likeActive): ?>active <?php endif; ?> <?php echo e($buttonLike, false); ?> text-muted mr-14px" href="javascript:void(0);" <?php if(auth()->guard()->guest()): ?> data-toggle="modal" data-target="#loginFormModal" <?php endif; ?> <?php if(auth()->guard()->check()): ?> data-id="<?php echo e($response->id, false); ?>" <?php endif; ?>>
				<i class="<?php if($likeActive): ?>fas <?php else: ?> far <?php endif; ?> fa-heart"></i>
			</a>

			<span class="<?php if(auth()->guard()->check()): ?> <?php if(auth()->user()->checkRestriction($response->creator->id)): ?> buttonDisabled <?php else: ?> text-muted <?php endif; ?> <?php else: ?> text-muted <?php endif; ?> disabled mr-14px <?php if(auth()->guard()->check()): ?> <?php if(! isset($inPostDetail) && $buttonLike): ?> pulse-btn toggleComments <?php endif; ?> <?php endif; ?>">
				<i class="far fa-comment"></i>
			</span>

			<a class="pulse-btn text-muted text-decoration-none mr-14px" href="javascript:void(0);" title="<?php echo e(__('general.share'), false); ?>" data-toggle="modal" data-target="#sharePost<?php echo e($response->id, false); ?>">
				<i class="feather icon-share"></i>
			</a>

			<!-- Share modal -->
			<div class="modal fade" id="sharePost<?php echo e($response->id, false); ?>" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header border-bottom-0">
						<button type="button" class="close close-inherit" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true"><i class="bi bi-x-lg"></i></span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-3 col-6 mb-3">
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url($response->creator->username.'/post', $response->id).Helper::referralLink(), false); ?>" title="Facebook" target="_blank" class="social-share text-muted d-block text-center h6">
										<i class="fab fa-facebook-square facebook-btn"></i>
										<span class="btn-block mt-3">Facebook</span>
									</a>
								</div>
								<div class="col-md-3 col-6 mb-3">
									<a href="https://twitter.com/intent/tweet?url=<?php echo e(url($response->creator->username.'/post', $response->id).Helper::referralLink(), false); ?>&text=<?php echo e(e( $response->creator->hide_name == 'yes' ? $response->creator->username : $response->creator->name ), false); ?>" data-url="<?php echo e(url($response->creator->username.'/post', $response->id), false); ?>" class="social-share text-muted d-block text-center h6" target="_blank" title="Twitter">
										<i class="bi-twitter-x text-dark"></i> <span class="btn-block mt-3">Twitter</span>
									</a>
								</div>
								<div class="col-md-3 col-6 mb-3">
									<a href="whatsapp://send?text=<?php echo e(url($response->creator->username.'/post', $response->id).Helper::referralLink(), false); ?>" data-action="share/whatsapp/share" class="social-share text-muted d-block text-center h6" title="WhatsApp">
										<i class="fab fa-whatsapp btn-whatsapp"></i> <span class="btn-block mt-3">WhatsApp</span>
									</a>
								</div>

								<div class="col-md-3 col-6 mb-3">
									<a href="sms:?&body=<?php echo e(__('general.check_this'), false); ?> <?php echo e(url($response->creator->username.'/post', $response->id).Helper::referralLink(), false); ?>" class="social-share text-muted d-block text-center h6" title="<?php echo e(__('general.sms'), false); ?>">
										<i class="fa fa-sms"></i> <span class="btn-block mt-3"><?php echo e(__('general.sms'), false); ?></span>
									</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			</div>
			<!-- modal share -->

	<?php if(auth()->guard()->check()): ?>
		<?php if(auth()->user()->id != $response->creator->id
					&& $checkUserSubscription && $response->price == 0.00
					&& $settings->disable_tips == 'off'

					|| auth()->user()->id != $response->creator->id
					&& $checkUserSubscription
					&& $response->price != 0.00
					&& $checkPayPerView
					&& $settings->disable_tips == 'off'

					|| auth()->check() && $response->locked == 'yes'
					&& $response->price != 0.00
					&& ! $checkUserSubscription
					&& $checkPayPerView
					&& $settings->disable_tips == 'off'

					|| auth()->user()->id != $response->creator->id
					&& $response->locked == 'no'
					&& $settings->disable_tips == 'off'
					): ?>
<a href="javascript:void(0);" data-toggle="modal" title="<?php echo e(__('general.tip'), false); ?>" data-target="#tipForm" class="pulse-btn text-muted text-decoration-none" <?php if(auth()->guard()->check()): ?> data-id="<?php echo e($response->id, false); ?>" data-cover="<?php echo e(Helper::getFile(config('path.cover').$response->creator->cover), false); ?>" data-avatar="<?php echo e(Helper::getFile(config('path.avatar').$response->creator->avatar), false); ?>" data-name="<?php echo e($response->creator->hide_name == 'yes' ? $response->creator->username : $response->creator->name, false); ?>" data-userid="<?php echo e($response->creator->id, false); ?>" <?php endif; ?>>
<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
  <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path fill-rule="evenodd" d="M8 13.5a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
</svg>

				<h6 class="d-inline font-weight-lighter"><?php echo app('translator')->get('general.tip'); ?></h6>
			</a>
		<?php endif; ?>
	<?php endif; ?>

			<a href="javascript:void(0);" <?php if(auth()->guard()->guest()): ?> data-toggle="modal" data-target="#loginFormModal" <?php endif; ?> class="pulse-btn <?php if($bookmarkActive): ?> text-primary <?php else: ?> text-muted <?php endif; ?> float-right <?php echo e($buttonBookmark, false); ?>" <?php if(auth()->guard()->check()): ?> data-id="<?php echo e($response->id, false); ?>" <?php endif; ?>>
				<i class="<?php if($bookmarkActive): ?>fas <?php else: ?> far <?php endif; ?> fa-bookmark"></i>
			</a>
		</h4>

		<div class="w-100 mb-3 containerLikeComment">
			<span class="countLikes text-muted dot-item">
				<?php echo e(trans_choice('general.like_likes', $totalLikes, ['total' => number_format($totalLikes)]), false); ?>

			</span> 
			<span class="text-muted totalComments dot-item <?php if(auth()->guard()->check()): ?> <?php if(! isset($inPostDetail) && $buttonLike): ?>toggleComments <?php endif; ?> <?php endif; ?>">
				<?php echo e(trans_choice('general.comment_comments', $totalComments, ['total' => number_format($totalComments)]), false); ?>

			</span>

			<?php if($response->video_views): ?>
			<span class="text-muted dot-item">
				<i class="bi-play mr-1"></i> <?php echo e(Helper::formatNumber($response->video_views), false); ?>

			</span>
			<?php endif; ?>
		</div>

<?php if(auth()->guard()->check()): ?>

<?php if(! auth()->user()->checkRestriction($response->creator->id)): ?>
<div class="container-comments <?php if( ! isset($inPostDetail)): ?> display-none <?php endif; ?>">

<div class="container-media">
<?php if($response->comments->count() != 0): ?>

	<?php
	  $comments = $response->comments()
	  	->with(['user:id,name,username,avatar,hide_name,verified_id', 'replies', 'likes'])
		->take($settings->number_comments_show)
		->orderBy('id', 'DESC')->get();

	  $data = [];

	  if ($comments->count()) {
	      $data['reverse'] = collect($comments->values())->reverse();
	  } else {
	      $data['reverse'] = $comments;
	  }

	  $dataComments = $data['reverse'];
	  $counter = ($response->comments()->count() - $settings->number_comments_show);
	?>

	<?php if(auth()->user()->id == $response->creator->id

		|| $response->locked == 'yes'
		&& $checkUserSubscription
		&& $response->price == 0.00

		|| $response->locked == 'yes'
		&& $checkUserSubscription
		&& $response->price != 0.00
		&& $checkPayPerView

		|| auth()->check() && $response->locked == 'yes'
		&& $response->price != 0.00
		&& ! $checkUserSubscription
		&& $checkPayPerView

		|| auth()->user()->role == 'admin'
		&& auth()->user()->permission == 'all'
		|| $response->locked == 'no'): ?>

		<?php echo $__env->make('includes.comments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php endif; ?>

<?php endif; ?>
	</div><!-- container-media -->

	<?php if(auth()->user()->id == $response->creator->id

		|| $response->locked == 'yes'
		&& $checkUserSubscription
		&& $response->price == 0.00

		|| $response->locked == 'yes'
		&& $checkUserSubscription
		&& $response->price != 0.00
		&& $checkPayPerView

		|| auth()->check() && $response->locked == 'yes'
		&& $response->price != 0.00
		&& ! $checkUserSubscription
		&& $checkPayPerView

		|| auth()->user()->role == 'admin'
		&& auth()->user()->permission == 'all'
		|| $response->locked == 'no'): ?>

		<div class="alert alert-danger alert-small dangerAlertComments display-none">
			<ul class="list-unstyled m-0 showErrorsComments"></ul>
		</div><!-- Alert -->

		<div class="isReplyTo display-none w-100 bg-light py-2 px-3 mb-3 rounded">
			<?php echo e(__('general.replying_to'), false); ?> <span class="username-reply"></span>

			<span class="float-right c-pointer cancelReply" title="<?php echo e(__('admin.cancel'), false); ?>">
				<i class="bi-x-lg"></i>
			</span>
		</div>

		<div class="media position-relative pt-3 border-top">
			<div class="blocked display-none"></div>
			<span href="#" class="float-left">
				<img src="<?php echo e(Helper::getFile(config('path.avatar').auth()->user()->avatar), false); ?>" class="rounded-circle mr-1 avatarUser" width="40">
			</span>
			<div class="media-body">
				<form action="<?php echo e(url('comment/store'), false); ?>" method="post" class="comments-form">
					<?php echo csrf_field(); ?>
					<input type="hidden" name="update_id" value="<?php echo e($response->id, false); ?>" />
					<input class="isReply" type="hidden" name="isReply" value="" />

					<div>
					<span class="triggerEmoji" data-toggle="dropdown">
						<i class="bi-emoji-smile"></i>
					</span>

					<div class="dropdown-menu dropdown-menu-right dropdown-emoji custom-scrollbar" aria-labelledby="dropdownMenuButton">
				    <?php echo $__env->make('includes.emojis', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				  </div>
				</div>

				<input type="text" name="comment" class="form-control comments inputComment emojiArea border-0" autocomplete="off" placeholder="<?php echo e(__('general.write_comment'), false); ?>"></div>
				</form>
			</div>
			<?php endif; ?>

			</div><!-- container-comments -->
		<?php endif; ?>

			<?php endif; ?>
  </div><!-- card-footer -->
	<?php endif; ?>
</div><!-- card -->

<?php if(request()->is('/') && $loop->first && $users->count() != 0
	|| request()->is('explore') && $loop->first && $users->count() != 0
	|| request()->is('my/bookmarks') && $loop->first && $users->count() != 0
	|| request()->is('my/purchases') && $loop->first && $users->count() != 0
	|| request()->is('my/likes') && $loop->first && $users->count() != 0
	): ?>
	<div class="p-3 d-lg-none">
		<?php echo $__env->make('includes.explore_creators', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if(! isset($singlePost)): ?>
<div class="card mb-3 pb-4 loadMoreSpin d-none rounded-large shadow-large">
	<div class="card-body">
		<div class="media">
		<span class="rounded-circle mr-3">
			<span class="item-loading position-relative loading-avatar"></span>
		</span>
		<div class="media-body">
			<h5 class="mb-0 item-loading position-relative loading-name"></h5>
			<small class="text-muted item-loading position-relative loading-time"></small>
		</div>
	</div>
</div>
	<div class="card-body pt-0 pb-3">
		<p class="mb-1 item-loading position-relative loading-text-1"></p>
		<p class="mb-1 item-loading position-relative loading-text-2"></p>
		<p class="mb-0 item-loading position-relative loading-text-3"></p>
	</div>
</div>
<?php endif; ?>

<?php
if (request()->ajax()) {
	$getHasPages = $updates->count() < $settings->number_posts_show ? false : true;
} else {
	if (request()->route()->named('profile')) {
		$getHasPages = $updates->count() < $settings->number_posts_show ? false : true;
	} else {
		$getHasPages = $hasPages ?? null;
	}
}
?>

<?php if($getHasPages): ?>
	<button rel="next" class="btn btn-primary w-100 text-center loadPaginator d-none" id="paginator">
		<?php echo e(__('general.loadmore'), false); ?>

	</button>
<?php endif; ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/updates.blade.php ENDPATH**/ ?>