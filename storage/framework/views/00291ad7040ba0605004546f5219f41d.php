<?php $__env->startSection('title'); ?> <?php echo e(__('users.payout_method'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi bi-credit-card mr-2"></i> <?php echo e(__('users.payout_method'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(__('general.default_payout_method'), false); ?>:
            <?php if(auth()->user()->payment_gateway != ''): ?>
              <strong class="text-success">
              <?php echo e(auth()->user()->payment_gateway == 'Bank' ? __('users.bank_transfer') : auth()->user()->payment_gateway, false); ?>

            </strong>
            <?php else: ?> <strong class="text-danger"><?php echo e(__('general.none'), false); ?></strong> <?php endif; ?>
            </p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if(session('status')): ?>
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                			<span aria-hidden="true">×</span>
                			</button>
                    <i class="bi-check2 mr-2"></i> <?php echo e(session('status'), false); ?>

                  </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      			<span aria-hidden="true">×</span>
                      			</button>
                          <i class="bi-exclamation-triangle mr-2"></i> <?php echo e(session('error'), false); ?>

                        </div>
                      <?php endif; ?>

          <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <?php if(auth()->user()->verified_id != 'yes' && auth()->user()->balance == 0.00): ?>
      <div class="alert alert-danger mb-3">
               <ul class="list-unstyled m-0">
                 <li><i class="fa fa-exclamation-triangle"></i> <?php echo e(__('general.verified_account_info'), false); ?> <a href="<?php echo e(url('settings/verify/account'), false); ?>" class="text-white link-border"><?php echo e(__('general.verify_account'), false); ?></a></li>
               </ul>
             </div>
             <?php endif; ?>

      <?php if(auth()->user()->verified_id == 'yes' || auth()->user()->balance != 0.00): ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
          <i class="fa fa-info-circle mr-2"></i>
          <span> <?php echo e(__('general.payout_method_info'), false); ?>

          <small class="btn-block">
            <?php if(! $settings->specific_day_payment_withdrawals): ?>
              * <?php echo e(__('general.payment_process_days', ['days' => $settings->days_process_withdrawals]), false); ?>


            <?php else: ?>
              * <?php echo e(__('users.date_paid'), false); ?> <?php echo e(Helper::formatDate(Helper::paymentDateOfEachMonth($settings->specific_day_payment_withdrawals)), false); ?>

            <?php endif; ?>
          </small>
            </span>
          </div>

          <?php if( $settings->payout_method_paypal == 'on' ): ?>
          <!--============ START PAYPAL ============-->
          <div class="custom-control custom-radio mb-3">
                <input name="payment_gateway" value="PayPal" id="radio1" class="custom-control-input" <?php if(auth()->user()->payment_gateway == 'PayPal'): ?> checked <?php endif; ?> type="radio">
                <label class="custom-control-label" for="radio1">
                  <span><img src="<?php echo e(url('public/img/payments', auth()->user()->dark_mode == 'off' ? 'paypal.png' : 'paypal-white.png'), false); ?>" width="70"/></span>
                  <small class="w-100 d-block">* <?php echo e(__('general.processor_fees_may_apply'), false); ?></small>
                </label>
              </div>

              <form method="POST" action="<?php echo e(url('settings/payout/method/paypal'), false); ?>" id="PayPal" <?php if(auth()->user()->payment_gateway != 'PayPal'): ?> class="display-none" <?php endif; ?>>
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-paypal"></i></span>
                      </div>
                      <input class="form-control" name="email_paypal" value="<?php echo e(auth()->user()->paypal_account == '' ? old('email_paypal') : auth()->user()->paypal_account, false); ?>" placeholder="<?php echo e(__('general.email_paypal'), false); ?>" required type="email">
                    </div>
                  </div>

                  <div class="form-group">
                      <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input class="form-control" name="email_paypal_confirmation" placeholder="<?php echo e(__('general.confirm_email_paypal'), false); ?>" required type="email">
                      </div>
                    </div>
                    <button class="btn btn-1 btn-success btn-block" type="submit"><?php echo e(__('general.save_payout_method'), false); ?></button>
              </form>
            <!--============ END PAYPAL ============-->
            <?php endif; ?>

            <?php if( $settings->payout_method_payoneer == 'on' ): ?>
            <!--============ START PAYONEER ============-->
            <div class="custom-control custom-radio mb-3 mt-3">
                  <input name="payment_gateway" value="Payoneer" id="radio2" class="custom-control-input" <?php if(auth()->user()->payment_gateway == 'Payoneer'): ?> checked <?php endif; ?> type="radio">
                  <label class="custom-control-label" for="radio2">
                    <span><img src="<?php echo e(url('public/img/payments', auth()->user()->dark_mode == 'off' ? 'payoneer.png' : 'payoneer-white.png'), false); ?>" width="110"/></span>
                    <small class="w-100 d-block">* <?php echo e(__('general.processor_fees_may_apply'), false); ?></small>
                  </label>
                </div>

                <form method="POST" action="<?php echo e(url('settings/payout/method/payoneer'), false); ?>" id="Payoneer" <?php if(auth()->user()->payment_gateway != 'Payoneer'): ?> class="display-none" <?php endif; ?>>
                  <?php echo csrf_field(); ?>

                  <div class="form-group">
                      <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input class="form-control" name="email_payoneer" value="<?php echo e(auth()->user()->payoneer_account == '' ? old('email_payoneer') : auth()->user()->payoneer_account, false); ?>" placeholder="<?php echo e(__('general.email_payoneer'), false); ?>" required type="email">
                      </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                          </div>
                          <input class="form-control" name="email_payoneer_confirmation" placeholder="<?php echo e(__('general.confirm_email_payoneer'), false); ?>" required type="email">
                        </div>
                      </div>
                      <button class="btn btn-1 btn-success btn-block" type="submit"><?php echo e(__('general.save_payout_method'), false); ?></button>
                </form>
              <!--============ END PAYONEER ============-->
              <?php endif; ?>

              <?php if($settings->payout_method_zelle == 'on'): ?>
              <!--============ START ZELLE ============-->
              <div class="custom-control custom-radio mb-3 mt-3">
                    <input name="payment_gateway" value="Zelle" id="radio3" class="custom-control-input" <?php if(auth()->user()->payment_gateway == 'Zelle'): ?> checked <?php endif; ?> type="radio">
                    <label class="custom-control-label" for="radio3">
                      <span><img src="<?php echo e(url('public/img/payments', auth()->user()->dark_mode == 'off' ? 'zelle.png' : 'zelle-white.png'), false); ?>" width="50"/></span>
                      <small class="w-100 d-block">* <?php echo e(__('general.processor_fees_may_apply'), false); ?></small>
                    </label>
                  </div>

                  <form method="POST" action="<?php echo e(url('settings/payout/method/zelle'), false); ?>" id="Zelle" <?php if(auth()->user()->payment_gateway != 'Zelle'): ?> class="display-none" <?php endif; ?>>
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                          </div>
                          <input class="form-control" name="email_zelle" value="<?php echo e(auth()->user()->zelle_account == '' ? old('email_zelle') : auth()->user()->zelle_account, false); ?>" placeholder="<?php echo e(__('general.email_zelle'), false); ?>" required type="email">
                        </div>
                      </div>

                      <div class="form-group">
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-envelope"></i></span>
                            </div>
                            <input class="form-control" name="email_zelle_confirmation" placeholder="<?php echo e(__('general.confirm_email_zelle'), false); ?>" required type="email">
                          </div>
                        </div>
                        <button class="btn btn-1 btn-success btn-block" type="submit"><?php echo e(__('general.save_payout_method'), false); ?></button>
                  </form>
                <!--============ END ZELLE ============-->
                <?php endif; ?>

                <?php if($settings->payout_method_western_union == 'on'): ?>
              <!--============ START WESTERN ============-->
              <div class="custom-control custom-radio mb-3 mt-3">
                    <input name="payment_gateway" value="Western" id="radioWestern" class="custom-control-input" <?php if(auth()->user()->payment_gateway == 'Western Union'): ?> checked <?php endif; ?> type="radio">
                    <label class="custom-control-label" for="radioWestern">
                      <span><img src="<?php echo e(url('public/img/payments/western.png'), false); ?>" width="150"/></span>
                      <small class="w-100 d-block">* <?php echo e(__('general.processor_fees_may_apply'), false); ?></small>
                    </label>
                  </div>

                  <form method="POST" action="<?php echo e(url('settings/payout/method/western'), false); ?>" id="Western" <?php if(auth()->user()->payment_gateway != 'Western Union'): ?> class="display-none" <?php endif; ?>>
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                          </div>
                          <input class="form-control" name="name" value="<?php echo e(auth()->user()->document_id == '' ? old('name') : auth()->user()->name, false); ?>" placeholder="<?php echo e(__('auth.full_name'), false); ?>" required type="text">
                        </div>
                      </div>

                      <div class="form-group">
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-address-card"></i></span>
                            </div>
                            <input class="form-control" name="document_id" value="<?php echo e(auth()->user()->document_id == '' ? old('document_id') : auth()->user()->document_id, false); ?>" placeholder="<?php echo e(__('general.document_id'), false); ?>" required type="text">
                          </div>
                        </div>
                        <button class="btn btn-1 btn-success btn-block" type="submit"><?php echo e(__('general.save_payout_method'), false); ?></button>
                  </form>
                <!--============ END WESTERN ============-->
                <?php endif; ?>

                <?php if($settings->payout_method_crypto == 'on'): ?>
              <!--============ START BITCOIN ============-->
              <div class="custom-control custom-radio mb-3 mt-3">
                    <input name="payment_gateway" value="Bitcoin" id="BitcoinInput" class="custom-control-input" <?php if(auth()->user()->payment_gateway == 'Bitcoin'): ?> checked <?php endif; ?> type="radio">
                    <label class="custom-control-label" for="BitcoinInput">
                      <span><img src="<?php echo e(url('public/img/payments', auth()->user()->dark_mode == 'off' ? 'bitcoin.png' : 'bitcoin-white.png'), false); ?>" width="100"/></span>
                      <small class="w-100 d-block">* <?php echo e(__('general.processor_fees_may_apply'), false); ?></small>
                    </label>
                  </div>

                  <form method="POST" action="<?php echo e(url('settings/payout/method/bitcoin'), false); ?>" id="Bitcoin" <?php if(auth()->user()->payment_gateway != 'Bitcoin'): ?> class="display-none" <?php endif; ?>>
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi-currency-bitcoin"></i></span>
                          </div>
                          <input class="form-control" name="crypto_wallet" value="<?php echo e(auth()->user()->crypto_wallet == '' ? old('crypto_wallet') : auth()->user()->crypto_wallet, false); ?>" placeholder="<?php echo e(__('general.bitcoin_wallet'), false); ?>" required type="text">
                        </div>
                      </div>
                        <button class="btn btn-1 btn-success btn-block" type="submit"><?php echo e(__('general.save_payout_method'), false); ?></button>
                  </form>
                <!--============ END BITCOIN ============-->
                <?php endif; ?>

                <?php if($settings->payout_method_mercadopago == 'on'): ?>
              <!--============ START WESTERN ============-->
              <div class="custom-control custom-radio mb-3 mt-3">
                    <input name="payment_gateway" value="Mercadopago" id="radioMP" class="custom-control-input" <?php if(auth()->user()->payment_gateway == 'Mercado Pago'): ?> checked <?php endif; ?> type="radio">
                    <label class="custom-control-label" for="radioMP">
                      <span><img src="<?php echo e(auth()->user()->dark_mode == 'off' ? url('public/img/payments/mercadopago.png') : url('public/img/payments/mercadopago-white.png'), false); ?>" width="150"/></span>
                      <small class="w-100 d-block">* <?php echo e(__('general.only_payments_for_argentina'), false); ?></small>
                    </label>
                  </div>

                  <form method="POST" action="<?php echo e(url('settings/payout/method/mercadopago'), false); ?>" id="MercadoPago" <?php if(auth()->user()->payment_gateway != 'Mercado Pago'): ?> class="display-none" <?php endif; ?>>
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi-stars"></i></span>
                          </div>
                          <input class="form-control" name="alias_mp" value="<?php echo e(auth()->user()->alias_mp == '' ? old('alias_mp') : auth()->user()->alias_mp, false); ?>" placeholder="Alias MP" required type="text">
                        </div>
                      </div>

                      <div class="form-group">
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="bi-123"></i></span>
                            </div>
                            <input class="form-control" name="cvu" value="<?php echo e(auth()->user()->cvu == '' ? old('cvu') : auth()->user()->cvu, false); ?>" placeholder="Nro. CVU" required type="text">
                          </div>
                        </div>
                        <button class="btn btn-1 btn-success btn-block" type="submit"><?php echo e(__('general.save_payout_method'), false); ?></button>
                  </form>
                <!--============ END WESTERN ============-->
                <?php endif; ?>

            <?php if( $settings->payout_method_bank == 'on' ): ?>
            <!--============ START BANK TRANSFER ============-->
              <div class="custom-control custom-radio mb-3 mt-3">
                    <input name="payment_gateway" value="Bank" id="radio4" class="custom-control-input" <?php if(auth()->user()->payment_gateway == 'Bank'): ?> checked <?php endif; ?> type="radio">
                    <label class="custom-control-label" for="radio4">
                      <span><strong><i class="fa fa-university mr-1 icon-sm-radio"></i> <?php echo e(__('users.bank_transfer'), false); ?></strong></span>
                      <small class="w-100 d-block">* <?php echo e(__('general.processor_fees_may_apply'), false); ?></small>
                    </label>
                  </div>

                  <form method="POST"  action="<?php echo e(url('settings/payout/method/bank'), false); ?>" id="Bank" <?php if(auth()->user()->payment_gateway != 'Bank'): ?> class="display-none" <?php endif; ?>>

                    <?php echo csrf_field(); ?>
                      <div class="form-group">
                        <textarea name="bank_details" rows="5" cols="40" class="form-control" required placeholder="<?php echo e(__('users.bank_details'), false); ?>"><?php echo e(auth()->user()->bank == '' ? old('bank_details') : auth()->user()->bank, false); ?></textarea>
                        </div>

                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                          <i class="fa fa-info-circle mr-2"></i>
                          <span><?php echo e(__('users.bank_details'), false); ?></span>
                          </div>

                        <button class="btn btn-1 btn-success btn-block" type="submit"><?php echo e(__('general.save_payout_method'), false); ?></button>
                  </form>
                  <!--============ END BANK TRANSFER ============-->
                <?php endif; ?>

      <?php endif; ?>

      <?php if(auth()->user()->verified_id == 'yes'
          && $settings->stripe_connect
          && isset(auth()->user()->country()->country_code)
          && in_array(auth()->user()->country()->country_code, $stripeConnectCountries)
          ): ?>

      <h6 class="mt-5">Stripe Connect <?php if(auth()->user()->completed_stripe_onboarding): ?> <span class="badge badge-pill badge-success font-weight-light opacity-75"><?php echo e(__('general.connected'), false); ?></span> <?php else: ?> <span class="badge badge-pill badge-danger font-weight-light opacity-75"><?php echo e(__('general.not_connected'), false); ?></span>  <?php endif; ?> </h6>
        <small class="d-block w-100 mb-3"><?php echo e(__('general.stripe_connect_desc'), false); ?></small>


          <a href="<?php echo e(route('redirect.stripe'), false); ?>" class="btn w-100 btn-lg btn-primary btn-arrow">

            <?php if(! auth()->user()->completed_stripe_onboarding): ?>
            <?php echo e(__('general.connect_stripe_account'), false); ?>


          <?php else: ?>
            <?php echo e(__('general.view_stripe_account'), false); ?>

            <?php endif; ?>
          </a>

      <?php endif; ?>

        </div><!-- end col-md-6 -->

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
  <script type="text/javascript">

  $('input[name=payment_gateway]').on('click', function() {

		if($(this).val() == 'PayPal') {
			$('#PayPal').slideDown();
		} else {
				$('#PayPal').slideUp();
		}

    if($(this).val() == 'Payoneer') {
      $('#Payoneer').slideDown();
    } else {
      $('#Payoneer').slideUp();
    }

    if($(this).val() == 'Zelle') {
      $('#Zelle').slideDown();
    } else {
      $('#Zelle').slideUp();
    }

    if($(this).val() == 'Western') {
      $('#Western').slideDown();
    } else {
      $('#Western').slideUp();
    }

    if($(this).val() == 'Bitcoin') {
      $('#Bitcoin').slideDown();
    } else {
      $('#Bitcoin').slideUp();
    }

    if($(this).val() == 'Bank') {
      $('#Bank').slideDown();
    } else {
      $('#Bank').slideUp();
    }

    if($(this).val() == 'Mercadopago') {
      $('#MercadoPago').slideDown();
    } else {
      $('#MercadoPago').slideUp();
    }

  });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/payout_method.blade.php ENDPATH**/ ?>