<header>
	<nav class="navbar navbar-expand-lg navbar-inverse fixed-top p-nav <?php if(auth()->guest() && request()->path() == '/'): ?> scroll shadow-custom navbar_background_color p-nav-scroll link-scroll <?php else: ?> p-3 <?php if(request()->is('live/*')): ?> d-none <?php endif; ?>  <?php if(request()->is('messages/*')): ?> d-none d-lg-block shadow-sm <?php elseif(request()->is('messages')): ?> shadow-sm <?php else: ?> shadow-custom <?php endif; ?> <?php echo e(auth()->check() && auth()->user()->dark_mode == 'on' ? 'bg-white' : 'navbar_background_color', false); ?> link-scroll <?php endif; ?>">
		<div class="container-fluid d-flex position-relative">

		<?php if(auth()->guard()->check()): ?>
			<div class="buttons-mobile-nav d-lg-none">
				<a href="<?php echo e(url('messages'), false); ?>" class="btn-mobile-nav position-relative px-1" title="<?php echo e(trans('general.messages'), false); ?>">
					<span class="noti_msg notify <?php if(auth()->user()->messagesInbox() != 0): ?> d-block <?php endif; ?>">
						<?php echo e(auth()->user()->messagesInbox(), false); ?>

					</span>
					<i class="feather icon-send icon-navbar"></i>
				</a>

				<a href="<?php echo e(url('notifications'), false); ?>" class="btn-mobile-nav position-relative px-2" title="<?php echo e(trans('general.notifications'), false); ?>">
					<span class="noti_notifications notify <?php if(auth()->user()->unseenNotifications()): ?> d-block <?php endif; ?>">
						<?php echo e(auth()->user()->unseenNotifications(), false); ?>

					</span>
					<i class="far fa-bell icon-navbar"></i>
				</a>
				
				<a class="btn-mobile-nav navbar-toggler-mobile px-1" href="#" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" role="button">
					<i class="feather icon-menu icon-navbar"></i>
				</a>
			</div>
		<?php endif; ?>

			<a class="navbar-brand" href="<?php echo e(url('/'), false); ?>">
				<?php if(auth()->check() && auth()->user()->dark_mode == 'on' ): ?>
					<img src="<?php echo e(url('public/img', $settings->logo), false); ?>" data-logo="<?php echo e($settings->logo, false); ?>" data-logo-2="<?php echo e($settings->logo_2, false); ?>" alt="<?php echo e($settings->title, false); ?>" class="logo align-bottom max-w-100" />
				<?php else: ?>
				<img src="<?php echo e(url('public/img', auth()->guest() && request()->path() == '/' ? $settings->logo_2 : $settings->logo_2), false); ?>" data-logo="<?php echo e($settings->logo_2, false); ?>" data-logo-2="<?php echo e($settings->logo_2, false); ?>" alt="<?php echo e($settings->title, false); ?>" class="logo align-bottom max-w-100" />
			<?php endif; ?>
			</a>

			<?php if(auth()->guard()->guest()): ?>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa fa-bars"></i>
				</button>
			<?php endif; ?>

			<div class="collapse navbar-collapse navbar-mobile" id="navbarCollapse">

			<div class="d-lg-none text-right pr-2 mb-2">
				<button type="button" class="navbar-toggler close-menu-mobile" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false">
					<i class="bi bi-x-lg"></i>
				</button>
			</div>

			<?php if(auth()->guest() && $settings->who_can_see_content == 'all' || auth()->check()): ?>
				<ul class="navbar-nav mr-auto">

					<?php if(!$settings->disable_creators_section): ?>
						<?php if(!$settings->disable_search_creators): ?>
						<form class="form-inline my-lg-0 position-relative" method="get" action="<?php echo e(url('creators'), false); ?>">
							<input id="searchCreatorNavbar"
								class="form-control search-bar <?php if(auth()->guest() && request()->path() == '/'): ?> border-0 <?php endif; ?>" type="text"
								required name="q" autocomplete="off" minlength="3" placeholder="<?php echo e(__('general.find_user'), false); ?>"
								aria-label="Search">
							<button class="btn btn-outline-success my-sm-0 button-search e-none" type="submit"><i
									class="bi bi-search"></i></button>
						
							<div class="dropdown-menu dd-menu-user position-absolute" style="width: 95%; top: 48px;" id="dropdownCreators">
						
								<button type="button" class="d-none" id="triggerBtn" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false"></button>
						
								<div class="w-100 text-center display-none py-2" id="spinnerSearch">
									<span class="spinner-border spinner-border-sm align-middle text-primary"></span>
								</div>
						
								<div id="containerCreators"></div>
						
								<div id="viewAll" class="display-none mt-2">
									<a class="dropdown-item border-top py-2 text-center" href="#"><?php echo e(__('general.view_all'), false); ?></a>
								</div>
							</div><!-- dropdown-menu -->
						</form>
						<?php endif; ?>
					<?php endif; ?>

					<?php if(auth()->guard()->guest()): ?>
					 <?php if(!$settings->disable_creators_section): ?>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo e(url('creators'), false); ?>"><?php echo e(__('general.explore'), false); ?></a>
						</li>
						<?php endif; ?>

						<?php if($settings->shop): ?>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo e(url('shop'), false); ?>"><?php echo e(__('general.shop'), false); ?></a>
						</li>
					<?php endif; ?>
					<?php endif; ?>

				</ul>
			<?php endif; ?>

				<ul class="navbar-nav ml-auto">
					<?php if(auth()->guard()->guest()): ?>
					<li class="nav-item mr-1">
						<a <?php if(Helper::showLoginFormModal()): ?> data-toggle="modal" data-target="#loginFormModal" <?php endif; ?> class="nav-link login-btn <?php if($settings->registration_active == '0'): ?>  btn btn-main btn-primary pr-3 pl-3 <?php endif; ?>" href="<?php echo e($settings->home_style == 0 ? url('login') : url('/'), false); ?>">
							<?php echo e(__('auth.login'), false); ?>

						</a>
					</li>

					<?php if($settings->registration_active == '1'): ?>
					<li class="nav-item">
						<a <?php if(Helper::showLoginFormModal()): ?> data-toggle="modal" data-target="#loginFormModal" <?php endif; ?> class="toggleRegister nav-link btn btn-main btn-primary btn-register-menu pr-3 pl-3 btn-arrow btn-arrow-sm" href="<?php echo e($settings->home_style == 0 ? url('signup') : url('/'), false); ?>">
							<?php echo e(__('general.getting_started'), false); ?>

						</a>
					</li>
				<?php endif; ?>

			<?php else: ?>

				<!-- ============ Menu Mobile ============-->

				<?php if(auth()->user()->role == 'admin'): ?>
					<li class="nav-item dropdown d-lg-none mt-2 border-bottom">
						<a href="<?php echo e(url('panel/admin'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
							<div>
								<i class="bi bi-speedometer2 mr-2"></i>
								<span class="d-lg-none"><?php echo e(__('admin.admin'), false); ?></span>
							</div>
						</a>
					</li>
				<?php endif; ?>

				<li class="nav-item dropdown d-lg-none <?php if(auth()->user()->role != 'admin'): ?> mt-2 <?php endif; ?>">
					<a href="<?php echo e(url(auth()->user()->username), false); ?>" class="nav-link px-2 link-menu-mobile py-1 url-user">
						<div>
							<img src="<?php echo e(Helper::getFile(config('path.avatar').auth()->user()->avatar), false); ?>" alt="User" class="rounded-circle avatarUser mr-1" width="20" height="20">
							<span class="d-lg-none"><?php echo e(auth()->user()->verified_id == 'yes' ? __('general.my_page') : __('users.my_profile'), false); ?></span>
						</div>
					</a>
				</li>

				<?php if(auth()->user()->verified_id == 'yes'): ?>
				<li class="nav-item dropdown d-lg-none">
					<a href="<?php echo e(url('dashboard'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
						<div>
							<i class="bi bi-speedometer2 mr-2"></i>
							<span class="d-lg-none"><?php echo e(__('admin.dashboard'), false); ?></span>
						</div>
						</a>
				</li>

				<li class="nav-item dropdown d-lg-none">
					<a href="<?php echo e(url('my/posts'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
						<div>
							<i class="feather icon-feather mr-2"></i>
							<span class="d-lg-none"><?php echo e(__('general.my_posts'), false); ?></span>
						</div>
						</a>
				</li>
			<?php endif; ?>

			<li class="nav-item dropdown d-lg-none">
				<a href="<?php echo e(url('my/bookmarks'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
					<div>
						<i class="feather icon-bookmark mr-2"></i>
						<span class="d-lg-none"><?php echo e(__('general.bookmarks'), false); ?></span>
					</div>
				</a>
			</li>

			<li class="nav-item dropdown d-lg-none border-bottom">
				<a href="<?php echo e(url('my/likes'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
					<div>
						<i class="feather icon-heart mr-2"></i>
						<span class="d-lg-none"><?php echo e(__('general.likes'), false); ?></span>
					</div>
				</a>
			</li>

			<?php if(auth()->user()->verified_id == 'yes'): ?>
				<li class="nav-item dropdown d-lg-none">
					<a class="nav-link px-2 link-menu-mobile py-1 balance">
						<div>
							<i class="iconmoon icon-Dollar mr-2"></i>
							<span class="d-lg-none balance"><?php echo e(__('general.balance'), false); ?>: <?php echo e(Helper::amountFormatDecimal(auth()->user()->balance), false); ?></span>
						</div>
					</a>
				</li>
				<?php endif; ?>

				<?php if($settings->disable_wallet == 'on' && auth()->user()->wallet != 0.00 || $settings->disable_wallet == 'off'): ?>
					<li class="nav-item dropdown d-lg-none border-bottom">
						<a <?php if($settings->disable_wallet == 'off'): ?> href="<?php echo e(url('my/wallet'), false); ?>" <?php endif; ?> class="nav-link px-2 link-menu-mobile py-1">
						<div>
							<i class="iconmoon icon-Wallet mr-2"></i>
							<?php echo e(__('general.wallet'), false); ?>: <span class="balanceWallet"><?php echo e(Helper::userWallet(), false); ?></span>
						</div>
						</a>
					</li>
				<?php endif; ?>

				<?php if(auth()->user()->verified_id == 'yes'): ?>
				<li class="nav-item dropdown d-lg-none">
					<a href="<?php echo e(url('my/subscribers'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
						<div>
							<i class="feather icon-users mr-2"></i>
							<span class="d-lg-none"><?php echo e(__('users.my_subscribers'), false); ?></span>
						</div>
					</a>
				</li>
				<?php endif; ?>

				<li class="nav-item dropdown d-lg-none">
					<a href="<?php echo e(url('my/subscriptions'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
						<div>
							<i class="feather icon-user-check mr-2"></i>
							<span class="d-lg-none"><?php echo e(__('users.my_subscriptions'), false); ?></span>
						</div>
					</a>
				</li>
				
				<li class="nav-item dropdown d-lg-none">
                    <a href="<?php echo e(url('shop'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
                        <div>
                            <i class="feather icon-shopping-bag mr-2"></i>
                            <span class="d-lg-none"><?php echo e(__('general.shop'), false); ?></span>
                        </div>
                    </a>
                </li>

					<li class="nav-item dropdown d-lg-none border-bottom">
						<a href="<?php echo e(url('my/purchases'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
							<div>
								<i class="bi bi-bag-check mr-2"></i>
								<span class="d-lg-none"><?php echo e(__('general.purchased'), false); ?></span>
							</div>
						</a>
					</li>

				<?php if(auth()->user()->verified_id == 'no' && auth()->user()->verified_id != 'reject'): ?>
				<li class="nav-item dropdown d-lg-none">
					<a href="<?php echo e(url('settings/verify/account'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
						<div>
							<i class="feather icon-star mr-2"></i>
							<span class="d-lg-none"><?php echo e(__('general.become_creator'), false); ?></span>
						</div>
					</a>
				</li>
			<?php endif; ?>

				<li class="nav-item dropdown d-lg-none">
					<a href="<?php echo e(auth()->user()->dark_mode == 'off' ? url('mode/dark') : url('mode/light'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
						<div>
							<i class="feather icon-<?php echo e(auth()->user()->dark_mode == 'off' ? 'moon' : 'sun', false); ?> mr-2"></i>
							<span class="d-lg-none"><?php echo e(auth()->user()->dark_mode == 'off' ? __('general.dark_mode') : __('general.light_mode'), false); ?></span>
						</div>
					</a>
				</li>

				<li class="nav-item dropdown d-lg-none mb-2">
					<a href="<?php echo e(url('logout'), false); ?>" class="nav-link px-2 link-menu-mobile py-1">
						<div>
							<i class="feather icon-log-out mr-2"></i>
							<span class="d-lg-none"><?php echo e(__('auth.logout'), false); ?></span>
						</div>
					</a>
				</li>
				<!-- =========== End Menu Mobile ============-->


					<li class="nav-item dropdown d-lg-block d-none">
						<a class="nav-link px-2" href="<?php echo e(url('/explore'), false); ?>" title="<?php echo e(__('admin.home'), false); ?>">
							<i class="feather icon-home icon-navbar"></i>
							<span class="d-lg-none align-middle ml-1"><?php echo e(__('admin.home'), false); ?></span>
						</a>
					</li>

					<?php if(!$settings->disable_creators_section): ?>
					<li class="nav-item dropdown d-lg-block d-none">
						<a class="nav-link px-2" href="<?php echo e(url('creators'), false); ?>" title="<?php echo e(__('general.explore_creators'), false); ?>">
							<i class="far	fa-compass icon-navbar"></i>
							<span class="d-lg-none align-middle ml-1"><?php echo e(__('general.explore'), false); ?></span>
						</a>
					</li>
					<?php endif; ?>

					<?php if($settings->shop): ?>
					<li class="nav-item dropdown d-lg-block d-none">
						<a class="nav-link px-2" href="<?php echo e(url('shop'), false); ?>" title="<?php echo e(__('general.shop'), false); ?>">
							<i class="feather icon-shopping-bag icon-navbar"></i>
							<span class="d-lg-none align-middle ml-1"><?php echo e(__('general.shop'), false); ?></span>
						</a>
					</li>
				<?php endif; ?>

				<li class="nav-item dropdown d-lg-block d-none">
					<a href="<?php echo e(url('messages'), false); ?>" class="nav-link px-2" title="<?php echo e(__('general.messages'), false); ?>">

						<span class="noti_msg notify <?php if(auth()->user()->messagesInbox() != 0): ?> d-block <?php endif; ?>">
							<?php echo e(auth()->user()->messagesInbox(), false); ?>

							</span>

						<i class="feather icon-send icon-navbar"></i>
						<span class="d-lg-none align-middle ml-1"><?php echo e(__('general.messages'), false); ?></span>
					</a>
				</li>

				<li class="nav-item dropdown d-lg-block d-none">
					<a href="<?php echo e(url('notifications'), false); ?>" class="nav-link px-2" title="<?php echo e(__('general.notifications'), false); ?>">

						<span class="noti_notifications notify <?php if(auth()->user()->unseenNotifications()): ?> d-block <?php endif; ?>">
							<?php echo e(auth()->user()->unseenNotifications(), false); ?>

							</span>

						<i class="far fa-bell icon-navbar"></i>
						<span class="d-lg-none align-middle ml-1"><?php echo e(__('general.notifications'), false); ?></span>
					</a>
				</li>

				<li class="nav-item dropdown d-lg-block d-none">
					<a class="nav-link" href="#" id="nav-inner-success_dropdown_1" role="button" data-toggle="dropdown">
						<img src="<?php echo e(Helper::getFile(config('path.avatar').auth()->user()->avatar), false); ?>" alt="User" class="rounded-circle avatarUser mr-1" width="28" height="28">
						<span class="d-lg-none"><?php echo e(auth()->user()->first_name, false); ?></span>
						<i class="feather icon-chevron-down m-0 align-middle"></i>
					</a>
					<div class="dropdown-menu mb-1 dropdown-menu-right dd-menu-user" aria-labelledby="nav-inner-success_dropdown_1">
						<?php if(auth()->user()->role == 'admin'): ?>
								<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('panel/admin'), false); ?>"><i class="bi bi-speedometer2 mr-2"></i> <?php echo e(__('admin.admin'), false); ?></a>
								<div class="dropdown-divider"></div>
						<?php endif; ?>

						<?php if(auth()->user()->verified_id == 'yes'): ?>
						<span class="dropdown-item dropdown-navbar balance">
							<i class="iconmoon icon-Dollar mr-2"></i> <?php echo e(__('general.balance'), false); ?>: <?php echo e(Helper::amountFormatDecimal(auth()->user()->balance), false); ?>

						</span>
					<?php endif; ?>

					<?php if($settings->disable_wallet == 'on' && auth()->user()->wallet != 0.00 || $settings->disable_wallet == 'off'): ?>
						<?php if($settings->disable_wallet == 'off'): ?>
							<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('my/wallet'), false); ?>">
								<i class="iconmoon icon-Wallet mr-2"></i> <?php echo e(__('general.wallet'), false); ?>:
								<span class="balanceWallet"><?php echo e(Helper::userWallet(), false); ?></span>
							</a>
						<?php else: ?>
							<span class="dropdown-item dropdown-navbar balance">
								<i class="iconmoon icon-Wallet mr-2"></i> <?php echo e(__('general.wallet'), false); ?>:
								<span class="balanceWallet"><?php echo e(Helper::userWallet(), false); ?></span>
							</span>
						<?php endif; ?>

						<div class="dropdown-divider"></div>
					<?php endif; ?>

					<?php if($settings->disable_wallet == 'on' && auth()->user()->verified_id == 'yes'): ?>
						<div class="dropdown-divider"></div>
					<?php endif; ?>

						<a class="dropdown-item dropdown-navbar url-user" href="<?php echo e(url(auth()->User()->username), false); ?>"><i class="feather icon-user mr-2"></i> <?php echo e(auth()->user()->verified_id == 'yes' ? __('general.my_page') : __('users.my_profile'), false); ?></a>
						<?php if(auth()->user()->verified_id == 'yes'): ?>
						<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('dashboard'), false); ?>"><i class="bi bi-speedometer2 mr-2"></i> <?php echo e(__('admin.dashboard'), false); ?></a>
						<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('my/posts'), false); ?>"><i class="feather icon-feather mr-2"></i> <?php echo e(__('general.my_posts'), false); ?></a>
					<?php endif; ?>

					<div class="dropdown-divider"></div>
						<?php if(auth()->user()->verified_id == 'yes'): ?>
						<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('my/subscribers'), false); ?>"><i class="feather icon-users mr-2"></i> <?php echo e(__('users.my_subscribers'), false); ?></a>
					<?php endif; ?>
						<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('my/subscriptions'), false); ?>"><i class="feather icon-user-check mr-2"></i> <?php echo e(__('users.my_subscriptions'), false); ?></a>
						<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('my/bookmarks'), false); ?>"><i class="feather icon-bookmark mr-2"></i> <?php echo e(__('general.bookmarks'), false); ?></a>
						<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('my/likes'), false); ?>"><i class="feather icon-heart mr-2"></i> <?php echo e(__('general.likes'), false); ?></a>

						<?php if(auth()->user()->verified_id == 'no'
									&& auth()->user()->verified_id != 'reject'
									&& $settings->requests_verify_account == 'on'
									): ?>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('settings/verify/account'), false); ?>"><i class="feather icon-star mr-2"></i> <?php echo e(__('general.become_creator'), false); ?></a>
						<?php endif; ?>

						<div class="dropdown-divider"></div>

						<?php if(auth()->user()->dark_mode == 'off'): ?>
							<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('mode/dark'), false); ?>"><i class="feather icon-moon mr-2"></i> <?php echo e(__('general.dark_mode'), false); ?></a>
						<?php else: ?>
							<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('mode/light'), false); ?>"><i class="feather icon-sun mr-2"></i> <?php echo e(__('general.light_mode'), false); ?></a>
						<?php endif; ?>

						<div class="dropdown-divider dropdown-navbar"></div>
						<a class="dropdown-item dropdown-navbar" href="<?php echo e(url('logout'), false); ?>"><i class="feather icon-log-out mr-2"></i> <?php echo e(__('auth.logout'), false); ?></a>
					</div>
				</li>

				<li class="nav-item">
					<a class="nav-link btn-arrow btn-arrow-sm btn btn-main btn-primary pr-3 pl-3" href="<?php echo e(url('settings/page'), false); ?>">
						<?php echo e(auth()->user()->verified_id == 'yes' ? __('general.edit_my_page') : __('users.edit_profile'), false); ?></a>
				</li>

					<?php endif; ?>

				</ul>
			</div>
		</div>
	</nav>
</header><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/navbar.blade.php ENDPATH**/ ?>