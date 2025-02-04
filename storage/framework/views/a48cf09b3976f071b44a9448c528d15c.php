<!-- Start Modal payPerViewForm -->
<div class="modal fade" id="buyNowForm" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered <?php if($product->type == 'digital'): ?> modal-sm <?php endif; ?>" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white shadow border-0">

					<div class="card-body px-lg-5 py-lg-5 position-relative">

						<div class="mb-4">
							<i class="bi-cart-plus mr-1"></i> <strong><?php echo e($product->name, false); ?></strong>
							<small class="w-100 d-block font-12">* <?php echo e(__('general.in_currency', ['currency_code' => $settings->currency_code]), false); ?></small>
						</div>

						<form method="post" action="<?php echo e(url('buy/now/product'), false); ?>" id="shopProductForm">

							<input type="hidden" name="id" value="<?php echo e($product->id, false); ?>" />
							<?php echo csrf_field(); ?>

							<div class="custom-control custom-radio mb-3">
								<input name="payment_gateway_buy" <?php if(Helper::userWallet('balance') == 0): ?> disabled <?php else: ?> checked <?php endif; ?> value="wallet" id="buy_radio0" class="custom-control-input" type="radio">
								<label class="custom-control-label" for="buy_radio0">
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

							<?php if($product->type == 'custom'): ?>
							<div class="form-group mb-2">
								<textarea class="form-control textareaAutoSize" name="description_custom_content" id="descriptionCustomContent" placeholder="<?php echo e(__('general.description_custom_content'), false); ?>" rows="4"></textarea>
							</div>

							<div class="alert alert-warning" role="alert">
							 <i class="bi-exclamation-triangle mr-2"></i> <?php echo e(__('general.alert_buy_custom_content'), false); ?>

							</div>
						<?php endif; ?>

						<?php if($product->type == 'physical'): ?>
							<h6 class="mb-3"><i class="bi-truck mr-1"></i> <?php echo e(__('general.shipping'), false); ?></h6>

							<div class="row form-group mb-0">

							<div class="col-md-6">
									<div class="input-group mb-4">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-map-marked-alt"></i></span>
										</div>
										<input class="form-control" name="address" placeholder="<?php echo e(__('general.address'), false); ?>"  value="<?php echo e(auth()->user()->address, false); ?>" type="text">
									</div>
								</div><!-- ./col-md-6 -->

								<div class="col-md-6">
										<div class="input-group mb-4">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-map-pin"></i></span>
											</div>
											<input class="form-control" name="city" placeholder="<?php echo e(__('general.city'), false); ?>"  value="<?php echo e(auth()->user()->city, false); ?>" type="text">
										</div>
									</div><!-- ./col-md-6 -->

										<div class="col-md-6">
												<div class="input-group mb-4">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
													</div>
													<input class="form-control" name="zip" placeholder="<?php echo e(__('general.zip'), false); ?>"  value="<?php echo e(auth()->user()->zip, false); ?>" type="text">
												</div>
											</div><!-- ./col-md-6 -->

											<div class="col-md-6">
													<div class="input-group mb-4">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="bi-telephone"></i></span>
														</div>
														<input class="form-control" name="phone" placeholder="<?php echo e(__('general.phone'), false); ?>" type="tel">
													</div>
												</div><!-- ./col-md-6 -->

											</div><!-- ./row -->

						<div class="alert alert-warning" role="alert">
						 <i class="bi-exclamation-triangle mr-2"></i> <?php echo e(__('general.alert_buy_custom_content'), false); ?>

						</div>
					<?php endif; ?>

							<?php if(auth()->user()->isTaxable()->count() || $product->shipping_fee <> 0.00 && $product->country_free_shipping <> auth()->user()->countries_id): ?>
								<ul class="list-group list-group-flush border-dashed-radius">

									<li class="list-group-item py-1 list-taxes">
								    <div class="row">
								      <div class="col">
								        <small><?php echo e(__('general.subtotal'), false); ?>:</small>
								      </div>
								      <div class="col-auto">
								        <small class="subtotal font-weight-bold">
								        <?php echo e(Helper::amountFormatDecimal($product->price), false); ?>

								        </small>
								      </div>
								    </div>
								  </li>

									<?php $__currentLoopData = auth()->user()->isTaxable(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li class="list-group-item py-1 list-taxes isTaxable">
									    <div class="row">
									      <div class="col">
									        <small><?php echo e($tax->name, false); ?> <?php echo e($tax->percentage, false); ?>%:</small>
									      </div>
									      <div class="col-auto percentageAppliedTax">
									        <small class="font-weight-bold">
									        	<?php echo e(Helper::amountFormatDecimal(Helper::calculatePercentage($product->price, $tax->percentage)), false); ?>

									        </small>
									      </div>
									    </div>
									  </li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									<?php if($product->shipping_fee <> 0.00 && $product->country_free_shipping <> auth()->user()->countries_id): ?>
										<li class="list-group-item py-1 list-taxes">
									    <div class="row">
									      <div class="col">
									        <small><?php echo e(__('general.shipping_fee'), false); ?>:</small>
									      </div>
									      <div class="col-auto">
									        <small class="totalPPV font-weight-bold">
									        <?php echo e(Helper::amountFormatDecimal($product->shipping_fee), false); ?>

									        </small>
									      </div>
									    </div>
									  </li>
									<?php endif; ?>


									<li class="list-group-item py-1 list-taxes">
								    <div class="row">
								      <div class="col">
								        <small class="font-weight-bold"><?php echo e(__('general.total'), false); ?>:</small>
								      </div>
								      <div class="col-auto">
								        <small class="totalPPV font-weight-bold">
								        <?php echo e(Helper::calculateProductPriceOnStore($product->price, $product->country_free_shipping <> auth()->user()->countries_id ? $product->shipping_fee : 0.00), false); ?>

								        </small>
								      </div>
								    </div>
								  </li>
								</ul>
							<?php endif; ?>

							<div class="alert alert-danger display-none mb-0 mt-2" id="errorShopProduct">
									<ul class="list-unstyled m-0" id="showErrorsShopProduct"></ul>
								</div>

							<div class="text-center">
								<button type="submit" <?php if(Helper::userWallet('balance') == 0): ?> disabled <?php endif; ?> id="shopProductBtn" class="btn btn-primary mt-4 BuyNowBtn">
									<i></i> <?php echo e(__('general.pay'), false); ?> <?php echo e(Helper::calculateProductPriceOnStore($product->price, $product->country_free_shipping <> auth()->user()->countries_id ? $product->shipping_fee : 0.00), false); ?> <small><?php echo e($settings->currency_code, false); ?></small>
								</button>

								<div class="w-100 mt-2">
									<a href="#" class="btn e-none p-0" data-dismiss="modal"><?php echo e(__('admin.cancel'), false); ?></a>
								</div>
							</div>
							<?php echo $__env->make('includes.site-billing-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Modal BuyNow -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/shop/modal-buy.blade.php ENDPATH**/ ?>