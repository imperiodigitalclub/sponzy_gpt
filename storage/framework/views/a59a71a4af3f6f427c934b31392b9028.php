	<div class="card card-updates h-100 card-user-profile shadow-sm">
	<div class="card-cover" style="background: <?php if($response->cover != ''): ?> url(<?php echo e(route('resize', ['path' => 'cover', 'file' => $response->cover, 'size' => 480]), false); ?>)  <?php endif; ?> #505050 center center; background-size: cover;"></div>
	<div class="card-avatar <?php if(Helper::isCreatorLive($getCurrentLiveCreators, $response->id)): ?>liveLink <?php endif; ?>" <?php if(Helper::isCreatorLive($getCurrentLiveCreators, $response->id)): ?> data-url="<?php echo e(url('live', $response->username), false); ?>" <?php endif; ?>>

		<?php if(Helper::isCreatorLive($getCurrentLiveCreators, $response->id)): ?>
			<span class="live-span"><?php echo e(trans('general.live'), false); ?></span>
			<div class="live-pulse"></div>
		<?php endif; ?>


		<a href="<?php echo e(url($response->username), false); ?>">
		<img src="<?php echo e(Helper::getFile(config('path.avatar').$response->avatar), false); ?>" width="95" height="95" alt="<?php echo e($response->name, false); ?>" class="img-user-small">
		</a>
	</div>
	<div class="card-body text-center">
			<h6 class="card-title <?php if(Helper::isCreatorLive($getCurrentLiveCreators, $response->id)): ?> pt-4 mt-2 mb-1 <?php else: ?> pt-4 <?php endif; ?>">
				<?php echo e($response->hide_name == 'yes' ? $response->username : $response->name, false); ?>


				<?php if($response->verified_id == 'yes'): ?>
					<small class="verified mr-1" title="<?php echo e(trans('general.verified_account'), false); ?>"data-toggle="tooltip" data-placement="top">
						<i class="bi bi-patch-check-fill"></i>
					</small>
				<?php endif; ?>

				<?php if($response->featured == 'yes'): ?>
				<small class="text-featured" title="<?php echo e(trans('users.creator_featured'), false); ?>" data-toggle="tooltip" data-placement="top">
					<i class="fas fa fa-award"></i>
				</small>
			<?php endif; ?>
			</h6>

			<ul class="list-inline m-0">
				<li class="list-inline-item small"><i class="feather icon-image"></i> <?php echo e(Helper::formatNumber($response->media->where('type', 'image')->count()), false); ?></li>
				<li class="list-inline-item small"><i class="feather icon-video"></i> <?php echo e(Helper::formatNumber($response->media->whereIn('type', ['video', 'video_embed'])->count()), false); ?></li>
				<li class="list-inline-item small"><i class="feather icon-mic"></i> <?php echo e(Helper::formatNumber($response->media->where('type', 'music')->count()), false); ?></li>
				<?php if($response->media->where('type', 'file')->groupBy('type')->count() != 0): ?>
				<li class="list-inline-item small"><i class="far fa-file-archive"></i> <?php echo e(Helper::formatNumber($response->media->where('type', 'file')->count()), false); ?></li>
				<?php endif; ?>
			</ul>

			<p class="m-0 py-3 text-muted card-text text-truncate">
				<?php echo e(Str::limit($response->story, 100, '...'), false); ?>

			</p>
			<a href="<?php echo e(url($response->username), false); ?>" class="btn btn-1 btn-sm btn-outline-primary"><?php echo e(trans('general.go_to_page'), false); ?></a>

			<a href="<?php echo e(url($response->username), false); ?>" class="btn btn-1 btn-sm btn-outline-primary px-3 active">
				<?php if($response->plans->where('status', '1')->first() && $response->free_subscription == 'no'): ?>
					<?php echo e(__('general.price_per_month', ['price' => Helper::priceWithoutFormat($response->getPlan('monthly', 'price'))]), false); ?>

				<?php endif; ?>

				<?php if($response->free_subscription == 'yes'): ?>
					<?php echo e(__('general.free'), false); ?>

				<?php endif; ?>
			</a>

	</div>
</div><!-- End Card -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/listing-creators.blade.php ENDPATH**/ ?>