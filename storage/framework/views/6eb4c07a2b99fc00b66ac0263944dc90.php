<div class="col-md-6 col-lg-3 mb-3">

<button type="button" class="btn-menu-expand btn btn-primary btn-block mb-2 d-lg-none" type="button" data-toggle="collapse" data-target="#navbarUserHome" aria-controls="navbarCollapse" aria-expanded="false">
		<i class="fa fa-bars mr-2"></i> <?php echo e(__('general.menu'), false); ?>

	</button>

	<div class="navbar-collapse collapse d-lg-block" id="navbarUserHome">

		<!-- Start Account -->
		<div class="card shadow-sm card-settings mb-3">
				<div class="list-group list-group-sm list-group-flush">

    <small class="text-muted px-4 pt-3 text-uppercase mb-1 font-weight-bold"><?php echo e(__('general.account'), false); ?></small>

					<?php if(auth()->user()->verified_id == 'yes'): ?>
					<a href="<?php echo e(url('dashboard'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('dashboard')): ?> active <?php endif; ?>">
							<div>
									<i class="bi bi-speedometer2 mr-2"></i>
									<span><?php echo e(__('admin.dashboard'), false); ?></span>
							</div>
							<div>
									<i class="feather icon-chevron-right"></i>
							</div>
					</a>
				<?php endif; ?>

				<a href="<?php echo e(url(auth()->user()->username), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between url-user">
						<div>
								<i class="feather icon-user mr-2"></i>
								<span><?php echo e(auth()->user()->verified_id == 'yes' ? __('general.my_page') : __('users.my_profile'), false); ?></span>
						</div>
						<div>
								<i class="feather icon-chevron-right"></i>
						</div>
				</a>

					<a href="<?php echo e(url('settings/page'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('settings/page')): ?> active <?php endif; ?>">
							<div>
									<i class="bi bi-pencil mr-2"></i>
									<span><?php echo e(auth()->user()->verified_id == 'yes' ? __('general.edit_my_page') : __('users.edit_profile'), false); ?></span>
							</div>
							<div>
									<i class="feather icon-chevron-right"></i>
							</div>
					</a>

				<?php if(auth()->user()->verified_id == 'yes'): ?>
				  <a href="<?php echo e(url('settings/conversations'), false); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([ 'list-group-item list-group-item-action d-flex justify-content-between', 'active' => request()->is('settings/conversations')]); ?>">
					<div>
						<i class="feather icon-send mr-2"></i>
						<span><?php echo e(__('general.conversations'), false); ?></span>
					</div>
					<div>
						<i class="feather icon-chevron-right"></i>
					</div>
				</a>
			  <?php endif; ?>

					<?php if($settings->disable_wallet == 'off'): ?>
						<a href="<?php echo e(url('my/wallet'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/wallet')): ?> active <?php endif; ?>">
								<div>
										<i class="iconmoon icon-Wallet mr-2"></i>
										<span><?php echo e(__('general.wallet'), false); ?></span>
								</div>
								<div>
										<i class="feather icon-chevron-right"></i>
								</div>
						</a>
					<?php endif; ?>

          <?php if($settings->referral_system == 'on' || auth()->user()->referrals()->count() != 0): ?>
  					<a href="<?php echo e(url('my/referrals'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/referrals')): ?> active <?php endif; ?>">
  							<div>
  									<i class="bi-person-plus mr-2"></i>
  									<span><?php echo e(__('general.referrals'), false); ?></span>
  							</div>
  							<div>
  									<i class="feather icon-chevron-right"></i>
  							</div>
  					</a>
  				<?php endif; ?>

				  <?php if($settings->story_status && auth()->user()->verified_id == 'yes'): ?>
				  <a href="<?php echo e(url('my/stories'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/stories')): ?> active <?php endif; ?>">
						  <div>
								  <i class="bi-clock-history mr-2"></i>
								  <span><?php echo e(__('general.my_stories'), false); ?></span>
						  </div>
						  <div>
								  <i class="feather icon-chevron-right"></i>
						  </div>
				  </a>
			  <?php endif; ?>

					<a href="<?php echo e(url('settings/verify/account'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('settings/verify/account')): ?> active <?php endif; ?>">
							<div>
									<i class="<?php if(auth()->user()->verified_id == 'yes'): ?> feather icon-check-circle <?php else: ?> bi-star <?php endif; ?> mr-2"></i>
									<span><?php echo e(auth()->user()->verified_id == 'yes' ? __('general.verified_account') : __('general.become_creator'), false); ?></span>
							</div>
							<div>
									<i class="feather icon-chevron-right"></i>
							</div>
					</a>
					
				</div>
			</div><!-- End Account -->

			<?php if($settings->live_streaming_private == 'on'): ?>
			<!-- Start Live Streaming private -->
			<div class="card shadow-sm card-settings mb-3">
				<div class="list-group list-group-sm list-group-flush">

				<small class="text-muted px-4 pt-3 text-uppercase mb-1 font-weight-bold"><?php echo e(__('general.live_streaming_private'), false); ?></small>

				<?php if(auth()->user()->verified_id == 'yes'): ?>
				  <a href="<?php echo e(url('my/live/private/settings'), false); ?>"
					class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/live/private/settings')): ?> active <?php endif; ?>">
					<div>
						<i class="bi-gear mr-2"></i>
						<span><?php echo e(__('general.settings'), false); ?></span>
					</div>
					<div>
						<i class="feather icon-chevron-right"></i>
					</div>
				</a>

				<a href="<?php echo e(url('my/live/private/requests'), false); ?>"
					class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/live/private/requests')): ?> active <?php endif; ?>">
					<div>
						<i class="bi-box-arrow-in-down mr-2"></i>
						<span><?php echo e(__('general.requests_received'), false); ?></span>

							<span class="badge badge-warning"><?php echo e(auth()->user()->liveStreamingPrivateRequestPending() ?: null, false); ?></span>
					</div>
					<div>
						<i class="feather icon-chevron-right"></i>
					</div>
				</a>
			  <?php endif; ?>

			<a href="<?php echo e(url('my/live/private/requests/sended'), false); ?>"
					class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/live/private/requests/sended')): ?> active <?php endif; ?>">
					<div>
						<i class="bi-box-arrow-in-up mr-2"></i>
						<span><?php echo e(__('general.requests_sent'), false); ?></span>
					</div>
					<div>
						<i class="feather icon-chevron-right"></i>
					</div>
				</a>
			  

				</div>
			</div><!-- End Live Streaming private -->
			<?php endif; ?>

			<!-- Start Subscription -->
			<div class="card shadow-sm card-settings mb-3">
					<div class="list-group list-group-sm list-group-flush">

			<small class="text-muted px-4 pt-3 text-uppercase mb-1 font-weight-bold"><?php echo e(__('general.subscription'), false); ?></small>

			<?php if(auth()->user()->verified_id == 'yes'): ?>
			<a href="<?php echo e(url('settings/subscription'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('settings/subscription')): ?> active <?php endif; ?>">
					<div>
							<i class="bi bi-cash-stack mr-2"></i>
							<span><?php echo e(__('general.subscription_price'), false); ?></span>
					</div>
					<div>
							<i class="feather icon-chevron-right"></i>
					</div>
			</a>
		<?php endif; ?>

			<?php if(auth()->user()->verified_id == 'yes'): ?>
			<a href="<?php echo e(url('my/subscribers'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/subscribers')): ?> active <?php endif; ?>">
					<div>
							<i class="feather icon-users mr-2"></i>
							<span><?php echo e(__('users.my_subscribers'), false); ?></span>
					</div>
					<div>
							<i class="feather icon-chevron-right"></i>
					</div>
			</a>
		<?php endif; ?>

			<a href="<?php echo e(url('my/subscriptions'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/subscriptions')): ?> active <?php endif; ?>">
					<div>
							<i class="feather icon-user-check mr-2"></i>
							<span><?php echo e(__('users.my_subscriptions'), false); ?></span>
					</div>
					<div>
							<i class="feather icon-chevron-right"></i>
					</div>
			</a>

		</div>
	</div><!-- End Subscription -->

	<!-- Start Privacy and security -->
	<div class="card shadow-sm card-settings mb-3">
			<div class="list-group list-group-sm list-group-flush">

	<small class="text-muted px-4 pt-3 text-uppercase mb-1 font-weight-bold"><?php echo e(__('general.privacy_security'), false); ?></small>

	<a href="<?php echo e(url('privacy/security'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('privacy/security')): ?> active <?php endif; ?>">
			<div>
					<i class="bi bi-shield-check mr-2"></i>
					<span><?php echo e(__('general.privacy_security'), false); ?></span>
			</div>
			<div>
					<i class="feather icon-chevron-right"></i>
			</div>
	</a>

	<a href="<?php echo e(url('settings/password'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('settings/password')): ?> active <?php endif; ?>">
			<div>
					<i class="iconmoon icon-Key mr-2"></i>
					<span><?php echo e(__('auth.password'), false); ?></span>
			</div>
			<div>
					<i class="feather icon-chevron-right"></i>
			</div>
	</a>

	<?php if(auth()->user()->verified_id == 'yes'): ?>
	<a href="<?php echo e(url('block/countries'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('block/countries')): ?> active <?php endif; ?>">
			<div>
					<i class="bi bi-eye-slash mr-2"></i>
					<span><?php echo e(__('general.block_countries'), false); ?></span>
			</div>
			<div>
					<i class="feather icon-chevron-right"></i>
			</div>
	</a>
<?php endif; ?>

<a href="<?php echo e(url('settings/restrictions'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('settings/restrictions')): ?> active <?php endif; ?>">
		<div>
				<i class="feather icon-slash mr-2"></i>
				<span><?php echo e(__('general.restricted_users'), false); ?></span>
		</div>
		<div>
				<i class="feather icon-chevron-right"></i>
		</div>
</a>

			</div>
		</div><!-- End Privacy and security -->

			<!-- Start Payments -->
			<div class="card shadow-sm card-settings mb-3">
					<div class="list-group list-group-sm list-group-flush">

	    <small class="text-muted px-4 pt-3 text-uppercase mb-1 font-weight-bold"><?php echo e(__('general.payments'), false); ?></small>

			<a href="<?php echo e(url('my/payments'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/payments')): ?> active <?php endif; ?>">
					<div>
							<i class="bi bi-receipt mr-2"></i>
							<span><?php echo e(__('general.payments'), false); ?></span>
					</div>
					<div>
							<i class="feather icon-chevron-right"></i>
					</div>
			</a>

			<?php if(auth()->user()->verified_id == 'yes'): ?>
			<a href="<?php echo e(url('my/payments/received'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/payments/received')): ?> active <?php endif; ?>">
					<div>
							<i class="bi bi-receipt mr-2"></i>
							<span><?php echo e(__('general.payments_received'), false); ?></span>
					</div>
					<div>
							<i class="feather icon-chevron-right"></i>
					</div>
			</a>
		<?php endif; ?>

			<?php if($showSectionMyCards): ?>
				<a href="<?php echo e(url('my/cards'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/cards')): ?> active <?php endif; ?>">
						<div>
								<i class="feather icon-credit-card mr-2"></i>
								<span><?php echo e(__('general.my_cards'), false); ?></span>
						</div>
						<div>
								<i class="feather icon-chevron-right"></i>
						</div>
				</a>
				<?php endif; ?>

				<?php if(auth()->user()->verified_id == 'yes'): ?>
				<a href="<?php echo e(url('settings/payout/method'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('settings/payout/method')): ?> active <?php endif; ?>">
						<div>
								<i class="bi bi-credit-card mr-2"></i>
								<span><?php echo e(__('users.payout_method'), false); ?></span>
						</div>
						<div>
								<i class="feather icon-chevron-right"></i>
						</div>
				</a>

				<a href="<?php echo e(url('settings/withdrawals'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('settings/withdrawals')): ?> active <?php endif; ?>">
						<div>
								<i class="bi bi-arrow-left-right mr-2"></i>
								<span><?php echo e(__('general.withdrawals'), false); ?></span>
						</div>
						<div>
								<i class="feather icon-chevron-right"></i>
						</div>
				</a>
			<?php endif; ?>

					</div>
				</div><!-- End Payments -->

	<?php if($settings->shop
			|| auth()->user()->sales()->count() != 0 && auth()->user()->verified_id == 'yes'
			|| auth()->user()->sales()->count() != 0 && auth()->user()->verified_id == 'yes'
			|| auth()->user()->purchasedItems()->count() != 0): ?>
	<!-- Start Shop -->
	<div class="card shadow-sm card-settings">
			<div class="list-group list-group-sm list-group-flush">

				<small class="text-muted px-4 pt-3 text-uppercase mb-1 font-weight-bold"><?php echo e(__('general.shop'), false); ?></small>

					<?php if($settings->shop && auth()->user()->verified_id == 'yes' || auth()->user()->sales()->count() != 0 && auth()->user()->verified_id == 'yes'): ?>
					<a href="<?php echo e(url('my/sales'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/sales')): ?> active <?php endif; ?>">
							<div>
									<i class="bi-cart2 mr-2"></i>
									<span class="mr-1"><?php echo e(__('general.sales'), false); ?></span>

										<span class="badge badge-warning"><?php echo e(auth()->user()->sales()->whereDeliveryStatus('pending')->count() ?: null, false); ?></span>
							</div>
							<div>
									<i class="feather icon-chevron-right"></i>
							</div>
					</a>
				<?php endif; ?>

				<?php if($settings->shop && auth()->user()->verified_id == 'yes' || auth()->user()->products()->count() != 0 && auth()->user()->verified_id == 'yes'): ?>
				<a href="<?php echo e(url('my/products'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between">
						<div>
								<i class="bi-tag mr-2"></i>
								<span><?php echo e(__('general.products'), false); ?></span>
						</div>
						<div>
								<i class="feather icon-chevron-right"></i>
						</div>
				</a>
			<?php endif; ?>

					<?php if($settings->shop || auth()->user()->purchasedItems()->count() != 0): ?>
					<a href="<?php echo e(url('my/purchased/items'), false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between <?php if(request()->is('my/purchased/items')): ?> active <?php endif; ?>">
							<div>
									<i class="bi-bag-check mr-2"></i>
									<span><?php echo e(__('general.purchased_items'), false); ?></span>
							</div>
							<div>
									<i class="feather icon-chevron-right"></i>
							</div>
					</a>
				<?php endif; ?>
			</div>
	</div><!-- End Shop -->
	<?php endif; ?>

	</div>
</div>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/cards-settings.blade.php ENDPATH**/ ?>