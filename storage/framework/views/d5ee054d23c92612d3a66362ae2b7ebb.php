<?php $__env->startSection('title'); ?> <?php echo e(trans('general.subscription_price'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi bi-cash-stack mr-2"></i> <?php echo e(trans('general.subscription_price'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.info_subscription'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if(session('status')): ?>
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                			<i class="bi bi-x-lg"></i>
                			</button>

                    <?php echo e(session('status'), false); ?>

                  </div>
                <?php endif; ?>

                <?php if(count($errors) > 0): ?>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                			<i class="bi bi-x-lg"></i>
                			</button>

                    <i class="far fa-times-circle mr-2"></i> <?php echo e(trans('auth.error_desc'), false); ?>

                  </div>
                <?php endif; ?>

    <?php if(auth()->user()->verified_id == 'no' && $settings->requests_verify_account == 'on'): ?>
    <div class="alert alert-danger mb-3">
             <ul class="list-unstyled m-0">
               <li><i class="fa fa-exclamation-triangle"></i> <?php echo e(trans('general.verified_account_info'), false); ?> <a href="<?php echo e(url('settings/verify/account'), false); ?>" class="text-white link-border"><?php echo e(trans('general.verify_account'), false); ?></a></li>
             </ul>
           </div>
           <?php endif; ?>

           <?php if(auth()->user()->free_subscription == 'no' && auth()->user()->verified_id == 'yes'): ?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <i class="fa fa-info-circle mr-2"></i>
              <span><?php echo e(trans('general.user_gain', ['percentage' => auth()->user()->custom_fee == 0 ? (100 - $settings->fee_commission) : (100 - auth()->user()->custom_fee)]), false); ?></span>
            </div>
          <?php endif; ?>

          <form method="POST" action="<?php echo e(url('settings/subscription'), false); ?>">

            <?php echo csrf_field(); ?>

            <div class="form-group">

              <label><strong><?php echo e(trans('general.subscription_price_weekly'), false); ?></strong></label>
              <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
              </div>
                  <input class="form-control form-control-lg isNumber subscriptionPrice" <?php if(auth()->user()->verified_id == 'no' || auth()->user()->verified_id == 'reject' || auth()->user()->free_subscription == 'yes'): ?> disabled <?php endif; ?> name="price_weekly" placeholder="0.00" value="<?php echo e($settings->currency_code == 'JPY' ? round(auth()->user()->getPlan('weekly', 'price')) : auth()->user()->getPlan('weekly', 'price'), false); ?>"  type="text">
                    <?php $__errorArgs = ['price_weekly'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($message, false); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" <?php if(auth()->user()->verified_id == 'no' || auth()->user()->verified_id == 'reject'): ?> disabled <?php endif; ?> name="status_weekly" value="1" <?php if(auth()->user()->getPlan('weekly', 'status')): ?> checked <?php endif; ?> id="customSwitchWeekly">
                  <label class="custom-control-label switch" for="customSwitchWeekly"><?php echo e(trans('general.status'), false); ?></label>
                </div>

              <label class="mt-4"><strong><?php echo e(trans('users.subscription_price'), false); ?> *</strong></label>
              <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
              </div>
                  <input class="form-control form-control-lg isNumber subscriptionPrice" <?php if(auth()->user()->verified_id == 'no' || auth()->user()->verified_id == 'reject' || auth()->user()->free_subscription == 'yes'): ?> disabled <?php endif; ?> name="price" placeholder="0.00" value="<?php echo e($settings->currency_code == 'JPY' ? round(auth()->user()->getPlan('monthly', 'price')) : auth()->user()->getPlan('monthly', 'price'), false); ?>"  type="text">
                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($message, false); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <label class="mt-4"><strong><?php echo e(trans('general.subscription_price_quarterly'), false); ?></strong></label>
              <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
              </div>
                  <input class="form-control form-control-lg isNumber subscriptionPrice" <?php if(auth()->user()->verified_id == 'no' || auth()->user()->verified_id == 'reject' || auth()->user()->free_subscription == 'yes'): ?> disabled <?php endif; ?> name="price_quarterly" placeholder="0.00" value="<?php echo e($settings->currency_code == 'JPY' ? round(auth()->user()->getPlan('quarterly', 'price')) : auth()->user()->getPlan('quarterly', 'price'), false); ?>"  type="text">
                    <?php $__errorArgs = ['price_quarterly'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($message, false); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" <?php if(auth()->user()->verified_id == 'no' || auth()->user()->verified_id == 'reject'): ?> disabled <?php endif; ?> name="status_quarterly" value="1" <?php if(auth()->user()->getPlan('quarterly', 'status')): ?> checked <?php endif; ?> id="customSwitchQuarterly">
                  <label class="custom-control-label switch" for="customSwitchQuarterly"><?php echo e(trans('general.status'), false); ?></label>
                </div>

              <label class="mt-4"><strong><?php echo e(trans('general.subscription_price_biannually'), false); ?></strong></label>
              <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
              </div>
                  <input class="form-control form-control-lg isNumber subscriptionPrice" <?php if(auth()->user()->verified_id == 'no' || auth()->user()->verified_id == 'reject' || auth()->user()->free_subscription == 'yes'): ?> disabled <?php endif; ?> name="price_biannually" placeholder="0.00" value="<?php echo e($settings->currency_code == 'JPY' ? round(auth()->user()->getPlan('biannually', 'price')) : auth()->user()->getPlan('biannually', 'price'), false); ?>"  type="text">
                    <?php $__errorArgs = ['price_biannually'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($message, false); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" <?php if(auth()->user()->verified_id == 'no' || auth()->user()->verified_id == 'reject'): ?> disabled <?php endif; ?> name="status_biannually" value="1" <?php if(auth()->user()->getPlan('biannually', 'status')): ?> checked <?php endif; ?> id="customSwitchBiannually">
                  <label class="custom-control-label switch" for="customSwitchBiannually"><?php echo e(trans('general.status'), false); ?></label>
                </div>

              <label class="mt-4"><strong><?php echo e(trans('general.subscription_price_yearly'), false); ?></strong></label>
              <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
              </div>
                  <input class="form-control form-control-lg isNumber subscriptionPrice" <?php if(auth()->user()->verified_id == 'no' || auth()->user()->verified_id == 'reject' || auth()->user()->free_subscription == 'yes'): ?> disabled <?php endif; ?> name="price_yearly" placeholder="0.00" value="<?php echo e($settings->currency_code == 'JPY' ? round(auth()->user()->getPlan('yearly', 'price')) : auth()->user()->getPlan('yearly', 'price'), false); ?>"  type="text">
                    <?php $__errorArgs = ['price_yearly'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($message, false); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" <?php if(auth()->user()->verified_id == 'no' || auth()->user()->verified_id == 'reject'): ?> disabled <?php endif; ?> name="status_yearly" value="1" <?php if(auth()->user()->getPlan('yearly', 'status')): ?> checked <?php endif; ?> id="customSwitchYearly">
                  <label class="custom-control-label switch" for="customSwitchYearly"><?php echo e(trans('general.status'), false); ?></label>
                </div>

              <div class="text-muted btn-block mb-4 mt-4">
                <div class="custom-control custom-switch custom-switch-lg">
                  <input type="checkbox" class="custom-control-input" <?php if(auth()->user()->verified_id == 'no' || auth()->user()->verified_id == 'reject'): ?> disabled <?php endif; ?> name="free_subscription" value="yes" <?php if(auth()->user()->free_subscription == 'yes'): ?> checked <?php endif; ?> id="customSwitchFreeSubscription">
                  <label class="custom-control-label switch" for="customSwitchFreeSubscription"><?php echo e(trans('general.free_subscription'), false); ?></label>
                </div>

                <?php if(auth()->user()->totalSubscriptionsActive() != 0): ?>

                  <?php if(auth()->user()->free_subscription == 'yes'): ?>
                    <div class="alert alert-warning display-none mt-3" role="alert" id="alertDisableFreeSubscriptions">
                      <i class="fas fa-exclamation-triangle mr-2"></i>
                      <span><?php echo e(trans('general.alert_disable_free_subscriptions'), false); ?></span>
                    </div>

                  <?php else: ?>
                    <div class="alert alert-warning display-none mt-3" role="alert" id="alertDisablePaidSubscriptions">
                      <i class="fas fa-exclamation-triangle mr-2"></i>
                      <span><?php echo e(trans('general.alert_disable_paid_subscriptions'), false); ?></span>
                    </div>
                  <?php endif; ?>

                <?php endif; ?>
              </div>
            </div><!-- End form-group -->

            <button class="btn btn-1 btn-success btn-block" <?php if(auth()->user()->verified_id == 'no' || auth()->user()->verified_id == 'reject'): ?> disabled <?php endif; ?> onClick="this.form.submit(); this.disabled=true; this.innerText='<?php echo e(trans('general.please_wait'), false); ?>';" type="submit">
              <?php echo e(trans('general.save_changes'), false); ?>

            </button>

          </form>
        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/subscription.blade.php ENDPATH**/ ?>