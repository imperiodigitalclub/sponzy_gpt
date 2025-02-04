<div class="modal fade" id="tipForm" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white shadow border-0">
					<div class="card-header pb-2 border-0 position-relative" style="height: 100px; background: <?php echo e($settings->color_default, false); ?> <?php if(auth()->user()->cover != ''): ?>  url('<?php echo e(Helper::getFile(config('path.cover').auth()->user()->cover), false); ?>') <?php endif; ?> no-repeat center center; background-size: cover;">

					</div>
					<div class="card-body px-lg-5 py-lg-5 position-relative">

						<div class="text-muted text-center mb-3 position-relative modal-offset">
							<img src="<?php echo e(Helper::getFile(config('path.avatar').auth()->user()->avatar), false); ?>" width="100" class="avatar-modal rounded-circle mb-1">
							<h6>
								<?php echo e(__('general.send_tip'), false); ?> <span class="userNameTip"></span>
								<small class="w-100 d-block font-12">* <?php echo e(__('general.in_currency', ['currency_code' => $settings->currency_code]), false); ?></small>
							</h6>
						</div>

						<form method="post" action="<?php echo e(url('send/tip'), false); ?>" id="formSendTip">

							<input type="hidden" name="id" class="userIdInput" value="<?php echo e(auth()->user()->id, false); ?>"  />

							<?php if(request()->is('messages/*')): ?>
								<input type="hidden" name="isMessage" value="1" />
							<?php endif; ?>

							<?php if(request()->route()->named(['live', 'live.private'])): ?>
								<input type="hidden" name="isLive" value="1" />

								<?php if($live): ?>
									<input type="hidden" name="liveID" value="<?php echo e($live->id, false); ?>"  />
								<?php endif; ?>

							<?php endif; ?>

							<input type="hidden" id="cardholder-name" value="<?php echo e(auth()->user()->name, false); ?>"  />
							<input type="hidden" id="cardholder-email" value="<?php echo e(auth()->user()->email, false); ?>"  />
							<input type="number" min="<?php echo e($settings->min_tip_amount, false); ?>" max="<?php echo e($settings->max_tip_amount, false); ?>" required data-min-tip="<?php echo e($settings->min_tip_amount, false); ?>" data-max-tip="<?php echo e($settings->max_tip_amount, false); ?>" autocomplete="off" id="onlyNumber" class="form-control mb-1 tipAmount" name="amount" placeholder="<?php echo e(__('general.tip_amount'), false); ?> (<?php echo e(__('general.minimum'), false); ?> <?php echo e(Helper::priceWithoutFormat($settings->min_tip_amount), false); ?>)">
							<small class="d-block w-100 mb-3">
								<i class="bi-arrow-up-square mr-1"></i> <i class="bi-arrow-down-square mr-1"></i> <?php echo e(__('general.increase_decrease_amount'), false); ?>

							  </small>
							<?php echo csrf_field(); ?>

							<?php if(! request()->route()->named('live')): ?>

							<?php $__currentLoopData = $paymentGatewaysSubscription; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								<?php

								if ($payment->type == 'card' ) {
									$paymentName = '<i class="far fa-credit-card mr-1"></i> '.__('general.debit_credit_card') .' <small class="w-100 d-block">'.__('general.powered_by').' '.$payment->name.'</small>';
								} else if ($payment->id == 1) {
									$paymentName = '<img src="'.url('public/img/payments', auth()->user()->dark_mode == 'off' ? $payment->logo : 'paypal-white.png').'" width="70"/> <small class="w-100 d-block">'.__('general.redirected_to_paypal_website').'</small>';
								} else {
									$paymentName = '<img src="'.url('public/img/payments', $payment->logo).'" width="70"/>';
								}

								$allPayments = $paymentGatewaysSubscription;

								?>
								<div class="custom-control custom-radio mb-3">
									<input name="payment_gateway_tip" required value="<?php echo e($payment->name, false); ?>" id="tip_radio<?php echo e($payment->name, false); ?>" <?php if($allPayments->count() == 1 && Helper::userWallet('balance') == 0): ?> checked <?php endif; ?> class="custom-control-input" type="radio">
									<label class="custom-control-label" for="tip_radio<?php echo e($payment->name, false); ?>">
										<span><strong><?php echo $paymentName; ?></strong></span>
									</label>
								</div>

								<?php if($payment->name == 'Stripe'): ?>
								<div id="stripeContainerTip" class="<?php if($allPayments->count() != 1): ?> display-none <?php endif; ?>">
									<div id="card-element" class="margin-bottom-10">
										<!-- A Stripe Element will be inserted here. -->
									</div>
									<!-- Used to display form errors. -->
									<div id="card-errors" class="alert alert-danger display-none" role="alert"></div>
								</div>
								<?php endif; ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						<?php endif; ?> 

							<?php if($settings->disable_wallet == 'on' && Helper::userWallet('balance') != 0 || $settings->disable_wallet == 'off'): ?>
							<div class="custom-control custom-radio mb-3">
								<input name="payment_gateway_tip" required <?php if(Helper::userWallet('balance') == 0): ?> disabled <?php endif; ?> value="wallet" id="tip_radio0" class="custom-control-input" type="radio">
								<label class="custom-control-label" for="tip_radio0">
									<span>
										<strong>
										<i class="fas fa-wallet mr-1 icon-sm-radio"></i> <?php echo e(__('general.wallet'), false); ?>

										<span class="w-100 d-block font-weight-light">
											<?php echo e(__('general.available_balance'), false); ?>: <span class="font-weight-bold mr-1 balanceWallet"><?php echo e(Helper::userWallet(), false); ?></span>

										<?php if(Helper::userWallet('balance') != 0 && $settings->wallet_format != 'real_money'): ?>
											<i class="bi bi-info-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?php echo e(Helper::equivalentMoney($settings->wallet_format), false); ?>"></i>
										<?php endif; ?>

											<?php if(Helper::userWallet('balance') == 0): ?>
											<a href="<?php echo e(url('my/wallet'), false); ?>" class="link-border"><?php echo e(__('general.recharge'), false); ?></a>
										<?php endif; ?>
										</span>
									</strong>
									</span>
								</label>
							</div>
						<?php endif; ?>

						<?php if($taxRatesCount != 0 && auth()->user()->isTaxable()->count()): ?>
							<?php echo $__env->make('includes.modal-taxes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endif; ?>

							<div class="alert alert-danger display-none" id="errorTip">
									<ul class="list-unstyled m-0" id="showErrorsTip"></ul>
								</div>

							<div class="text-center">
								<button type="button" class="btn e-none mt-4" data-dismiss="modal"><?php echo e(__('admin.cancel'), false); ?></button>
								<button type="submit" id="tipBtn" class="btn btn-primary mt-4 tipBtn"><i></i> <?php echo e(__('auth.send'), false); ?></button>
							</div>

							<?php echo $__env->make('includes.site-billing-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Modal Tip -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-tip.blade.php ENDPATH**/ ?>