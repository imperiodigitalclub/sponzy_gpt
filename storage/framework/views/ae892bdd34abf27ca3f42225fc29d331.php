<!-- Start Modal payPerViewForm -->
<div class="modal fade" id="payPerViewForm" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white shadow border-0">

					<div class="card-body px-lg-5 py-lg-5 position-relative">

						<div class="mb-3">
							<i class="feather icon-unlock mr-1"></i> <strong><?php echo e(__('general.unlock_content'), false); ?></strong>
							<small class="w-100 d-block font-12">* <?php echo e(__('general.in_currency', ['currency_code' => $settings->currency_code]), false); ?></small>
						</div>

						<form method="post" action="<?php echo e(url('send/ppv'), false); ?>" id="formSendPPV">

							<input type="hidden" name="id" class="mediaIdInput" value="0" />
							<input type="hidden" name="amount" class="priceInput" value="0" />

							<?php if(request()->is('messages/*')): ?>
								<input type="hidden" name="isMessage" value="1" />
							<?php endif; ?>

							<input type="hidden" id="cardholder-name-PPV" value="<?php echo e(auth()->user()->name, false); ?>"  />
							<input type="hidden" id="cardholder-email-PPV" value="<?php echo e(auth()->user()->email, false); ?>"  />
							<?php echo csrf_field(); ?>

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
									<input name="payment_gateway_ppv" required value="<?php echo e($payment->name, false); ?>" id="ppv_radio<?php echo e($payment->name, false); ?>" <?php if($allPayments->count() == 1 && Helper::userWallet('balance') == 0): ?> checked <?php endif; ?> class="custom-control-input" type="radio">
									<label class="custom-control-label" for="ppv_radio<?php echo e($payment->name, false); ?>">
										<span><strong><?php echo $paymentName; ?></strong></span>
									</label>
								</div>

								<?php if($payment->name == 'Stripe'): ?>
								<div id="stripeContainerPPV" class="<?php if($allPayments->count() != 1): ?> display-none <?php endif; ?>">
									<div id="card-elementPPV" class="margin-bottom-10">
										<!-- A Stripe Element will be inserted here. -->
									</div>
									<!-- Used to display form errors. -->
									<div id="card-errorsPPV" class="alert alert-danger display-none" role="alert"></div>
								</div>
								<?php endif; ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							<?php if($settings->disable_wallet == 'on' && Helper::userWallet('balance') != 0 || $settings->disable_wallet == 'off'): ?>
							<div class="custom-control custom-radio mb-3">
								<input name="payment_gateway_ppv"  required <?php if(Helper::userWallet('balance') == 0): ?> disabled <?php endif; ?> value="wallet" id="ppv_radio0" class="custom-control-input" type="radio">
								<label class="custom-control-label" for="ppv_radio0">
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

							<div class="alert alert-danger display-none mt-3 mb-0" id="errorPPV">
									<ul class="list-unstyled m-0" id="showErrorsPPV"></ul>
								</div>

							<div class="text-center">
								<button type="submit" id="ppvBtn" class="btn btn-primary mt-4 ppvBtn"><i></i> <?php echo e(__('general.pay'), false); ?> <span class="pricePPV"></span></button>

								<div class="w-100 mt-2">
									<button type="button" class="btn e-none p-0" data-dismiss="modal"><?php echo e(__('admin.cancel'), false); ?></button>
								</div>
							</div>
							<?php echo $__env->make('includes.site-billing-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Modal payPerViewForm -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-payperview.blade.php ENDPATH**/ ?>