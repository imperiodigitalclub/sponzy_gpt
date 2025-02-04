<ul class="list-unstyled d-lg-block d-none menu-left-home sticky-top">
	<li>
		<a href="<?php echo e(url('/'), false); ?>" <?php if(request()->is('/')): ?> class="active disabled" <?php endif; ?>>
			<i class="bi bi-house-door"></i>
			<span class="ml-2"><?php echo e(trans('admin.home'), false); ?></span>
		</a>
	</li>
	<li>
		<a href="<?php echo e(url(auth()->user()->username), false); ?>">
			<i class="bi bi-person"></i>
			<span class="ml-2"><?php echo e(auth()->user()->verified_id == 'yes' ? trans('general.my_page') : trans('users.my_profile'), false); ?></span>
		</a>
	</li>
	<?php if(auth()->user()->verified_id == 'yes'): ?>
	<li>
		<a href="<?php echo e(url('dashboard'), false); ?>">
			<i class="bi bi-speedometer2"></i>
			<span class="ml-2"><?php echo e(trans('admin.dashboard'), false); ?></span>
		</a>
	</li>
	<?php endif; ?>
		<li>
			<a href="<?php echo e(url('my/purchases'), false); ?>" <?php if(request()->is('my/purchases')): ?> class="active disabled" <?php endif; ?>>
				<i class="bi bi-bag-check"></i>
				<span class="ml-2"><?php echo e(trans('general.purchased'), false); ?></span>
			</a>
		</li>
	<li>
		<a href="<?php echo e(url('messages'), false); ?>">
			<i class="feather icon-send"></i>
			<span class="ml-2"><?php echo e(trans('general.messages'), false); ?></span>
		</a>
	</li>
	<?php if(!$settings->disable_explore_section): ?>
	<li>
		<a href="<?php echo e(url('explore'), false); ?>" <?php if(request()->is('explore')): ?> class="active disabled" <?php endif; ?>>
			<i class="bi bi-compass"></i>
			<span class="ml-2"><?php echo e(trans('general.explore'), false); ?></span>
		</a>
	</li>
	<?php endif; ?>
	<li>
		<a href="<?php echo e(url('my/subscriptions'), false); ?>">
			<i class="bi bi-person-check"></i>
			<span class="ml-2"><?php echo e(trans('admin.subscriptions'), false); ?></span>
		</a>
	</li>
	<li>
		<a href="<?php echo e(url('my/bookmarks'), false); ?>" <?php if(request()->is('my/bookmarks')): ?> class="active disabled" <?php endif; ?>>
			<i class="bi bi-bookmark"></i>
			<span class="ml-2"><?php echo e(trans('general.bookmarks'), false); ?></span>
		</a>
	</li>

</ul>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/menu-sidebar-home.blade.php ENDPATH**/ ?>