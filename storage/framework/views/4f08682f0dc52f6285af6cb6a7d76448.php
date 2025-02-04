

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/js/select2/select2.min.css'), false); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('public/js/select2/select2-bootstrap-5-theme.min.css'), false); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.payment_settings'), false); ?></span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

			<?php if(session('success_message')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check2 me-1"></i>	<?php echo e(session('success_message'), false); ?>


                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i class="bi bi-x-lg"></i>
                </button>
                </div>
              <?php endif; ?>

              <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-5">

					 <form method="POST" action="<?php echo e(url('panel/admin/payments'), false); ?>" enctype="multipart/form-data">
             <?php echo csrf_field(); ?>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('admin.currency_code'), false); ?></label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($settings->currency_code, false); ?>" name="currency_code" type="text" class="form-control">
		          </div>
		        </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('admin.currency_symbol'), false); ?></label>
              <div class="col-sm-10">
                <input value="<?php echo e($settings->currency_symbol, false); ?>" name="currency_symbol" type="text" class="form-control">
                <small class="d-block"><?php echo e(__('admin.notice_currency'), false); ?></small>
              </div>
            </div>

		        <div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('admin.fee_commission'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="fee_commission" class="form-select">
                  <?php for($i=1; $i <= 95; ++$i): ?>
                    <option <?php if($settings->fee_commission == $i): ?> selected="selected" <?php endif; ?> value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?>%</option>
                    <?php endfor; ?>
		           </select>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('general.percentage_referred'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="percentage_referred" class="form-select">
                  <?php for($i=1; $i <= 30; ++$i): ?>
                    <option <?php if($settings->percentage_referred == $i): ?> selected="selected" <?php endif; ?> value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?>%</option>
                    <?php endfor; ?>
		           </select>
		          </div>
		        </div>

						<div class="row mb-3">
							<label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('general.referral_transaction_limit'), false); ?></label>
							<div class="col-sm-10">
								<select name="referral_transaction_limit" class="form-select">
									<option <?php if($settings->referral_transaction_limit == 'unlimited'): ?> selected="selected" <?php endif; ?> value="unlimited">
										<?php echo e(trans('admin.unlimited'), false); ?>

									</option>

									<?php for($i=1; $i <= 100; ++$i): ?>
										<option <?php if($settings->referral_transaction_limit == $i): ?> selected="selected" <?php endif; ?> value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></option>
										<?php endfor; ?>
							 </select>
							</div>
						</div>

						<div class="row mb-3">
              <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('admin.min_subscription_amount'), false); ?></label>
              <div class="col-sm-10">
                <input value="<?php echo e($settings->min_subscription_amount, false); ?>" name="min_subscription_amount" type="number" min="1" autocomplete="off" class="form-control onlyNumber">
              </div>
            </div>

						<div class="row mb-3">
              <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('admin.max_subscription_amount'), false); ?></label>
              <div class="col-sm-10">
                <input value="<?php echo e($settings->max_subscription_amount, false); ?>" name="max_subscription_amount" type="number" min="1" autocomplete="off" class="form-control onlyNumber">
              </div>
            </div>

						<div class="row mb-3">
              <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('general.min_tip_amount'), false); ?></label>
              <div class="col-sm-10">
                <input value="<?php echo e($settings->min_tip_amount, false); ?>" name="min_tip_amount" type="number" min="1" autocomplete="off" class="form-control onlyNumber">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('general.max_tip_amount'), false); ?></label>
              <div class="col-sm-10">
                <input value="<?php echo e($settings->max_tip_amount, false); ?>" name="max_tip_amount" type="number" min="1" autocomplete="off" class="form-control onlyNumber">
              </div>
            </div>

						<div class="row mb-3">
              <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('general.min_ppv_amount'), false); ?></label>
              <div class="col-sm-10">
                <input value="<?php echo e($settings->min_ppv_amount, false); ?>" name="min_ppv_amount" type="number" min="1" autocomplete="off" class="form-control onlyNumber">
              </div>
            </div>

						<div class="row mb-3">
              <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('general.max_ppv_amount'), false); ?></label>
              <div class="col-sm-10">
                <input value="<?php echo e($settings->max_ppv_amount, false); ?>" name="max_ppv_amount" type="number" min="1" autocomplete="off" class="form-control onlyNumber">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('general.min_deposits_amount'), false); ?></label>
              <div class="col-sm-10">
                <input value="<?php echo e($settings->min_deposits_amount, false); ?>" name="min_deposits_amount" type="number" min="1" autocomplete="off" class="form-control">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('general.max_deposits_amount'), false); ?></label>
              <div class="col-sm-10">
                <input value="<?php echo e($settings->max_deposits_amount, false); ?>" name="max_deposits_amount" type="number" min="1" autocomplete="off" class="form-control">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('general.amount_min_withdrawal'), false); ?></label>
              <div class="col-sm-10">
                <input value="<?php echo e($settings->amount_min_withdrawal, false); ?>" name="amount_min_withdrawal" type="number" min="1" autocomplete="off" class="form-control">
              </div>
            </div>

			<div class="row mb-3">
				<label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('general.amount_max_withdrawal'), false); ?></label>
				<div class="col-sm-10">
				  <input value="<?php echo e($settings->amount_max_withdrawal, false); ?>" name="amount_max_withdrawal" type="number" autocomplete="off" class="form-control">
				  <small class="d-block"><?php echo e(trans('general.info_max_withdrawal'), false); ?></small>
				</div>
			  </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('admin.currency_position'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="currency_position" class="form-select">
									<option <?php if($settings->currency_position == 'left'): ?> selected="selected" <?php endif; ?> value="left"><?php echo e($settings->currency_symbol, false); ?>99 - <?php echo e(trans('admin.left'), false); ?></option>
									<option <?php if($settings->currency_position == 'left_space'): ?> selected="selected" <?php endif; ?> value="left_space"><?php echo e($settings->currency_symbol, false); ?> 99 - <?php echo e(trans('general.left_with_space'), false); ?></option>
									<option <?php if($settings->currency_position == 'right'): ?> selected="selected" <?php endif; ?> value="right">99<?php echo e($settings->currency_symbol, false); ?> - <?php echo e(trans('admin.right'), false); ?></option>
									<option <?php if($settings->currency_position == 'right_space'): ?> selected="selected" <?php endif; ?> value="right_space">99 <?php echo e($settings->currency_symbol, false); ?> - <?php echo e(trans('general.right_with_space'), false); ?></option>
		           </select>
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('general.decimal_format'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="decimal_format" class="form-select">
                  <option <?php if($settings->decimal_format == 'dot'): ?> selected="selected" <?php endif; ?> value="dot">1,999.95</option>
                  <option <?php if($settings->decimal_format == 'comma'): ?> selected="selected" <?php endif; ?> value="comma">1.999,95</option>
                </select>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('general.specific_day_payment_withdrawals'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="specific_day_payment_withdrawals" class="form-select">
									<option <?php if(! $settings->specific_day_payment_withdrawals): ?> selected="selected" <?php endif; ?>>
										<?php echo e(trans('general.not_specified'), false); ?>

									</option>
									<?php for($i=1; $i <= 25; ++$i): ?>
										<option <?php if($settings->specific_day_payment_withdrawals == $i): ?> selected="selected" <?php endif; ?> value="<?php echo e($i, false); ?>"><?php echo e(trans('general.day_of_each_month', ['day' => $i]), false); ?></option>
										<?php endfor; ?>
                </select>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('admin.days_process_withdrawals'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="days_process_withdrawals" class="form-select">
									<?php for($i=1; $i <= 30; ++$i): ?>
										<option <?php if( $settings->days_process_withdrawals == $i ): ?> selected="selected" <?php endif; ?> value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?> (<?php echo e(trans_choice('general.days', $i), false); ?>)</option>
										<?php endfor; ?>
                </select>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('general.type_withdrawals'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="type_withdrawals" class="form-select">
									<option <?php if($settings->type_withdrawals == 'custom'): ?> selected="selected" <?php endif; ?> value="custom"><?php echo e(trans('general.custom_amount'), false); ?></option>
									<option <?php if($settings->type_withdrawals == 'balance'): ?> selected="selected" <?php endif; ?> value="balance"><?php echo e(trans('general.total_balance'), false); ?></option>
                </select>
		          </div>
		        </div>

				<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('users.payout_method'), false); ?> (PayPal)</label>
		          <div class="col-sm-10">
		            <select name="payout_method_paypal" class="form-select">
                  <option <?php if($settings->payout_method_paypal == 'on'): ?> selected="selected" <?php endif; ?> value="on"><?php echo e(__('general.enabled'), false); ?></option>
                  <option <?php if($settings->payout_method_paypal == 'off'): ?> selected="selected" <?php endif; ?> value="off"><?php echo e(__('general.disabled'), false); ?></option>
                </select>
					<small class="d-block"><?php echo e(trans('general.payout_method_desc'), false); ?></small>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('users.payout_method'), false); ?> (Payoneer)</label>
		          <div class="col-sm-10">
		            <select name="payout_method_payoneer" class="form-select">
                  <option <?php if($settings->payout_method_payoneer == 'on'): ?> selected="selected" <?php endif; ?> value="on"><?php echo e(__('general.enabled'), false); ?></option>
                  <option <?php if($settings->payout_method_payoneer == 'off'): ?> selected="selected" <?php endif; ?> value="off"><?php echo e(__('general.disabled'), false); ?></option>
                </select>
								<small class="d-block"><?php echo e(trans('general.payout_method_desc'), false); ?></small>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('users.payout_method'), false); ?> (Zelle)</label>
		          <div class="col-sm-10">
		            <select name="payout_method_zelle" class="form-select">
                  <option <?php if($settings->payout_method_zelle == 'on'): ?> selected="selected" <?php endif; ?> value="on"><?php echo e(__('general.enabled'), false); ?></option>
                  <option <?php if($settings->payout_method_zelle == 'off'): ?> selected="selected" <?php endif; ?> value="off"><?php echo e(__('general.disabled'), false); ?></option>
                </select>
								<small class="d-block"><?php echo e(trans('general.payout_method_desc'), false); ?></small>
		          </div>
		        </div>

				<div class="row mb-3">
					<label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('users.payout_method'), false); ?> (Western Union)</label>
					<div class="col-sm-10">
					  <select name="payout_method_western_union" class="form-select">
					<option <?php if($settings->payout_method_western_union == 'on'): ?> selected="selected" <?php endif; ?> value="on"><?php echo e(__('general.enabled'), false); ?></option>
					<option <?php if($settings->payout_method_western_union == 'off'): ?> selected="selected" <?php endif; ?> value="off"><?php echo e(__('general.disabled'), false); ?></option>
				  </select>
					  <small class="d-block"><?php echo e(trans('general.payout_method_desc'), false); ?></small>
					</div>
				  </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('users.payout_method'), false); ?> (<?php echo e(__('general.bank'), false); ?>)</label>
		          <div class="col-sm-10">
		            <select name="payout_method_bank" class="form-select">
                  <option <?php if($settings->payout_method_bank == 'on'): ?> selected="selected" <?php endif; ?> value="on"><?php echo e(__('general.enabled'), false); ?></option>
                  <option <?php if($settings->payout_method_bank == 'off'): ?> selected="selected" <?php endif; ?> value="off"><?php echo e(__('general.disabled'), false); ?></option>
                </select>
								<small class="d-block"><?php echo e(trans('general.payout_method_desc'), false); ?></small>
		          </div>
		        </div>

				<div class="row mb-3">
					<label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('users.payout_method'), false); ?> (Bitcoin)</label>
					<div class="col-sm-10">
					  <select name="payout_method_crypto" class="form-select">
					<option <?php if($settings->payout_method_crypto == 'on'): ?> selected="selected" <?php endif; ?> value="on"><?php echo e(__('general.enabled'), false); ?></option>
					<option <?php if($settings->payout_method_crypto == 'off'): ?> selected="selected" <?php endif; ?> value="off"><?php echo e(__('general.disabled'), false); ?></option>
				  </select>
					  <small class="d-block"><?php echo e(trans('general.payout_method_desc'), false); ?></small>
					</div>
				  </div>

				  <div class="row mb-3">
					<label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('users.payout_method'), false); ?> (Mercado Pago)</label>
					<div class="col-sm-10">
					  <select name="payout_method_mercadopago" class="form-select">
					<option <?php if($settings->payout_method_mercadopago == 'on'): echo 'selected'; endif; ?> value="on"><?php echo e(__('general.enabled'), false); ?></option>
					<option <?php if($settings->payout_method_mercadopago == 'off'): echo 'selected'; endif; ?> value="off"><?php echo e(__('general.disabled'), false); ?></option>
				  </select>
					  <small class="d-block"><?php echo e(trans('general.payout_method_desc'), false); ?></small>
					</div>
				  </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('general.wallet'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="disable_wallet" class="form-select">
									<option <?php if( $settings->disable_wallet == 'off' ): ?> selected="selected" <?php endif; ?> value="off"><?php echo e(trans('general.enabled'), false); ?></option>
									<option <?php if( $settings->disable_wallet == 'on' ): ?> selected="selected" <?php endif; ?> value="on"><?php echo e(trans('general.disabled'), false); ?></option>
                </select>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('general.apply_taxes_wallet'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="tax_on_wallet" class="form-select">
                  <option <?php if($settings->tax_on_wallet): ?> selected="selected" <?php endif; ?> value="1"><?php echo e(__('general.enabled'), false); ?></option>
                  <option <?php if(! $settings->tax_on_wallet): ?> selected="selected" <?php endif; ?> value="0"><?php echo e(__('general.disabled'), false); ?></option>
                </select>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('general.money_format'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="wallet_format" class="form-select">
									<option <?php if( $settings->wallet_format == 'real_money' ): ?> selected="selected" <?php endif; ?> value="real_money"><?php echo e(trans('general.real_money'), false); ?> (<?php echo e($settings->currency_symbol, false); ?>)</option>
									<option <?php if( $settings->wallet_format == 'credits' ): ?> selected="selected" <?php endif; ?> value="credits"><?php echo e(trans('general.credits'), false); ?></option>
									<option <?php if( $settings->wallet_format == 'points' ): ?> selected="selected" <?php endif; ?> value="points"><?php echo e(trans('general.points'), false); ?></option>
									<option <?php if( $settings->wallet_format == 'tokens' ): ?> selected="selected" <?php endif; ?> value="tokens"><?php echo e(trans('general.tokens'), false); ?></option>
                </select>
								<small class="d-block">
 								 <?php echo e(trans('general.equivalent_money_format'), false); ?> <?php echo e(Helper::amountFormatDecimal(1), false); ?> <?php echo e($settings->currency_code, false); ?>

 							 </small>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end">Stripe Connect</label>
		          <div class="col-sm-10">
		            <select name="stripe_connect" class="form-select">
                  <option <?php if($settings->stripe_connect): ?> selected="selected" <?php endif; ?> value="1"><?php echo e(__('general.enabled'), false); ?></option>
                  <option <?php if(! $settings->stripe_connect): ?> selected="selected" <?php endif; ?> value="0"><?php echo e(__('general.disabled'), false); ?></option>
                </select>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('general.stripe_connect_countries'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="stripe_connect_countries[]" multiple class="form-select stripeConnectCountries">
									<?php $__currentLoopData = Countries::orderBy('country_name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option <?php if(in_array($country->country_code, $stripeConnectCountries)): ?> selected="selected" <?php endif; ?> value="<?php echo e($country->country_code, false); ?>"><?php echo e($country->country_name, false); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		           </select>
							 <small class="d-block">
								 <?php echo e(trans('general.info_stripe_connect_countries'), false); ?> <a href="https://dashboard.stripe.com/settings/connect/express" target="_blank">https://dashboard.stripe.com/settings/connect/express</a>
							 </small>
		          </div>
		        </div>

						<div class="row mb-3">
		          <div class="col-sm-10 offset-sm-2">
		            <button type="submit" class="btn btn-dark mt-3 px-5"><?php echo e(__('admin.save'), false); ?></button>
		          </div>
		        </div>

		       </form>

				 </div><!-- card-body -->
 			</div><!-- card  -->
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
  <script>
  $('.stripeConnectCountries').select2({
  tags: false,
  tokenSeparators: [','],
  placeholder: '<?php echo e(trans('general.country'), false); ?>',
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/payments-settings.blade.php ENDPATH**/ ?>