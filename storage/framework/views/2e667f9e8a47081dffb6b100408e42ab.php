<div class="menuMobile w-100 bg-white shadow-lg pb-3 pt-2 px-2 border-top">
	<ul class="list-inline d-flex bd-highlight m-0 mb-1 text-center">

				<li class="flex-fill bd-highlight">
					<a class="p-2 btn-mobile" href="<?php echo e(url('/explore'), false); ?>" title="<?php echo e(trans('admin.home'), false); ?>">
						<i class="feather icon-home icon-navbar" style="font-size: 28px;"></i>
					</a>
				</li>

				<?php if(!$settings->disable_creators_section): ?>
				<li class="flex-fill bd-highlight">
					<a class="p-2 btn-mobile" href="<?php echo e(url('creators'), false); ?>" title="<?php echo e(trans('general.explore'), false); ?>">
						<i class="far	fa-compass icon-navbar" style="font-size: 28px;"></i>
					</a>
				</li>
				<?php endif; ?>
				
    			<li class="flex-fill bd-highlight">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->verified_id == 'yes'): ?>
                            <!-- Usuário é um criador -->
                            <a class="p-2 btn-mobile btn-post position-relative" href="<?php echo e(url('/'), false); ?>?u=true" title="<?php echo e(trans('general.new_post'), false); ?>">
                                <i class="feather icon-plus-circle icon-navbar" style="font-size: 28px;"></i>
                            </a>
                        <?php else: ?>
                            <!-- Usuário não é um criador -->
                            <a class="p-2 btn-mobile btn-post position-relative" href="<?php echo e(url('/settings/verify/account'), false); ?>" title="<?php echo e(trans('general.new_post'), false); ?>">
                                <i class="feather icon-plus-circle icon-navbar" style="font-size: 28px;"></i>
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a class="p-2 btn-mobile btn-post position-relative" href="<?php echo e(url('login'), false); ?>" title="<?php echo e(trans('general.login'), false); ?>">
                            <i class="feather icon-plus-circle icon-navbar" style="font-size: 28px;"></i>
                        </a>
                    <?php endif; ?>
                </li>
                
                <li class="flex-fill bd-highlight">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->verified_id == 'yes'): ?>
                            <a class="p-2 btn-mobile position-relative" href="<?php echo e(url('/dashboard'), false); ?>" title="<?php echo e(trans('general.balance'), false); ?>">
                                <i class="feather icon-dollar-sign icon-navbar" style="font-size: 28px;"></i>
                            </a>
                        <?php else: ?>
                            <a class="p-2 btn-mobile position-relative" href="<?php echo e(url('/my/wallet'), false); ?>" title="<?php echo e(trans('general.wallet'), false); ?>">
                                <i class="feather icon-dollar-sign icon-navbar" style="font-size: 28px;"></i>
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a class="p-2 btn-mobile position-relative" href="<?php echo e(url('login'), false); ?>" title="<?php echo e(trans('general.login'), false); ?>">
                            <i class="feather icon-dollar-sign icon-navbar" style="font-size: 28px;"></i>
                        </a>
                    <?php endif; ?>
                </li>

            <!--
			<?php if($settings->shop): ?>
				<li class="flex-fill bd-highlight">
					<a class="p-2 btn-mobile" href="<?php echo e(url('shop'), false); ?>" title="<?php echo e(trans('general.shop'), false); ?>">
						<i class="feather icon-shopping-bag icon-navbar"></i>
					</a>
				</li>
			<?php endif; ?>
			-->

			<li class="flex-fill bd-highlight">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url(auth()->user()->username), false); ?>" onmouseenter="console.log('<?php echo e(url(auth()->user()), false); ?>')" class="p-2 btn-mobile position-relative" title="<?php echo e(trans('general.profile'), false); ?>">
                        <img src="<?php echo e(Helper::getFile(config('path.avatar').auth()->user()->avatar), false); ?>" class="rounded-circle" alt="<?php echo e(auth()->user()->name, false); ?>" width="30" height="30">
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(url('login'), false); ?>" class="p-2 btn-mobile position-relative" title="<?php echo e(trans('general.login'), false); ?>">
                        <i class="feather icon-user icon-navbar" style="font-size: 28px;"></i>
                    </a>
                <?php endif; ?>
            </li>
		</ul>
</div><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/menu-mobile.blade.php ENDPATH**/ ?>