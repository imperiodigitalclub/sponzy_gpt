<div class="modal fade" id="modalLivePrivateRequest" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white shadow border-0">
					<div class="card-body px-lg-5 py-lg-5 position-relative">

						<div class="text-muted text-center mb-3 position-relative modal-offset">
							<img src="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" width="100" class="avatar-modal rounded-circle mb-1">
							<h6>
								<?php echo e(__('general.request_private_live_stream'), false); ?> <?php echo e('@' . $user->username, false); ?>

								<small class="w-100 d-block font-12">* <?php echo e(__('general.in_currency', ['currency_code' => $settings->currency_code]), false); ?></small>
							</h6>
						</div>

						<form method="post" action="<?php echo e(route('request.live_private', ['user' => $user->id]), false); ?>" id="formRequestLivePrivate">

							<?php echo csrf_field(); ?>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="bi-clock"></i></span>
                                </div>
                                <select <?php if(Helper::userWallet('balance') == 0): echo 'disabled'; endif; ?> required name="minutes" class="form-control custom-select minutes" data-price-minute="<?php echo e($user->price_live_streaming_private, false); ?>">
                                    <option value=""><?php echo e(__('general.select_the_minutes'), false); ?></option>
                                    <?php for($i = 10; $i <= $settings->limit_live_streaming_private; $i+=5): ?>
                                    <option value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?> <?php echo e(__('general.minutes'), false); ?></option>
                                    <?php endfor; ?>
                                </select>
                                <span class="w-100 btn-block">
                                    <?php echo e(__('general.price_per_minute'), false); ?>: <strong><?php echo e(Helper::priceWithoutFormat($user->price_live_streaming_private), false); ?></strong>
                                </span>
                            </div>
                            

							<div class="custom-control custom-radio mb-3">
								<input name="payment_gateway_live_private" <?php if(Helper::userWallet('balance') == 0): ?> disabled <?php else: ?> checked <?php endif; ?> value="wallet" id="radioLive0" class="custom-control-input" type="radio">
								<label class="custom-control-label" for="radioLive0">
									<span>
										<strong>
										<i class="fas fa-wallet mr-1 icon-sm-radio"></i> <?php echo e(__('general.wallet'), false); ?>

										<span class="w-100 d-block font-weight-light">
											<?php echo e(__('general.available_balance'), false); ?>: <span class="font-weight-bold mr-1 balanceWallet"><?php echo e(Helper::userWallet(), false); ?></span>

											<?php if(Helper::userWallet('balance') != 0 && $settings->wallet_format <> 'real_money'): ?>
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

							<?php echo $__env->make('includes.modal-taxes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

							<div class="alert alert-danger display-none mt-2" id="errorLivePrivate">
									<ul class="list-unstyled m-0" id="showLivePrivate"></ul>
								</div>

							<div class="text-center">
								<button type="button" class="btn e-none mt-4" data-dismiss="modal"><?php echo e(__('admin.cancel'), false); ?></button>
								<button type="submit" <?php if(Helper::userWallet('balance') == 0): echo 'disabled'; endif; ?> id="livePrivateBtn" class="btn btn-primary mt-4 livePrivateBtn"><i></i> <?php echo e(__('general.send_request'), false); ?></button>
							</div>
							<?php echo $__env->make('includes.site-billing-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Modal Tip -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-live-private-request.blade.php ENDPATH**/ ?>