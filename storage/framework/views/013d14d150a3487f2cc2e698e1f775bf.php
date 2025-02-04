<!-- Start Modal liveStreamingForm -->
<div class="modal fade" id="liveStreamingForm" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white shadow border-0">

					<div class="card-body px-lg-5 py-lg-5 position-relative">

						<div class="mb-3">
							<i class="bi bi-broadcast mr-1"></i> <strong><?php echo e(trans('general.create_live_stream'), false); ?></strong>
						</div>

						<form method="post" action="<?php echo e(url('create/live'), false); ?>" id="formSendLive">

							<?php echo csrf_field(); ?>

							<div class="form-group">
		            <div class="input-group mb-4">
		            <div class="input-group-prepend">
		              <span class="input-group-text"><i class="bi bi-lightning-charge"></i></span>
		            </div>
		                <input type="text" autocomplete="off" class="form-control" name="name" placeholder="<?php echo e(__('auth.name'), false); ?> *">
		            </div>
		          </div><!-- End form-group -->

							<div class="form-group">
                <div class="input-group mb-2" id="AvailabilityGroup">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-eye"></i></span>
                </div>
                <select name="availability" id="Availability" class="form-control custom-select">
                  <option value="all_pay" data-text="<?php echo e(trans('general.desc_available_everyone_paid'), false); ?>"><?php echo e(trans('general.available_everyone_paid'), false); ?></option>
									<option value="free_paid_subscribers" data-text="<?php echo e(trans('general.info_price_live'), false); ?>"><?php echo e(trans('general.available_free_paid_subscribers'), false); ?></option>

									<?php if($settings->live_streaming_free): ?>
										<option value="everyone_free" data-text="<?php echo e(trans('general.desc_everyone_free'), false); ?>"><?php echo e(trans('general.available_everyone_free'), false); ?></option>
									<?php endif; ?>
                  </select>
                  </div>

									<?php if($settings->limit_live_streaming_paid != 0): ?>
										<small class="form-text text-danger" id="LimitLiveStreamingPaid">
											<i class="bi bi-exclamation-triangle-fill mr-1"></i> <strong><?php echo e(trans('general.limit__minutes_per_transmission_paid', ['min' => $settings->limit_live_streaming_paid]), false); ?></strong>
											</small>
									<?php endif; ?>

									<?php if($settings->limit_live_streaming_free != 0): ?>
										<small class="form-text display-none text-danger" id="everyoneFreeAlert">
											<i class="bi bi-exclamation-triangle-fill mr-1"></i> <strong><?php echo e(trans('general.limit__minutes_per_transmission_free', ['min' => $settings->limit_live_streaming_free]), false); ?></strong>
											</small>
									<?php endif; ?>

                </div><!-- ./form-group -->

							<div class="form-group mb-0">
		            <div class="input-group">
		            <div class="input-group-prepend">
		              <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
		            </div>
		                <input type="number" min="<?php echo e($settings->live_streaming_minimum_price, false); ?>" autocomplete="off" id="onlyNumber" class="form-control priceLive" name="price" placeholder="<?php echo e(__('general.price'), false); ?> (<?php echo e(__('general.minimum'), false); ?> <?php echo e(Helper::priceWithoutFormat($settings->live_streaming_minimum_price), false); ?>)">
		            </div>
		          </div><!-- End form-group -->
							<small class="form-text mb-4" id="descAvailability"><?php echo e(trans('general.desc_available_everyone_paid'), false); ?></small>

							<div class="alert alert-danger display-none mb-0 mt-3" id="errorLive">
									<ul class="list-unstyled m-0" id="showErrorsLive"></ul>
								</div>

							<div class="text-center">
								<button type="button" class="btn e-none mt-4" data-dismiss="modal"><?php echo e(trans('admin.cancel'), false); ?></button>
								<button type="submit" id="liveBtn" class="btn btn-primary mt-4 liveBtn"><i></i> <?php echo e(trans('users.create'), false); ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Modal liveStreamingForm -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-live-stream.blade.php ENDPATH**/ ?>