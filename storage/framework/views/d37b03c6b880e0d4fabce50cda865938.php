<?php $__env->startSection('title'); ?> <?php echo e(trans('general.my_cards'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="feather icon-credit-card mr-2"></i> <?php echo e(trans('general.my_cards'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.info_my_cards'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if(session('success_removed')): ?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>

                <?php echo e(session('success_removed'), false); ?>

            </div>
          <?php endif; ?>

          <?php if(session('success_message')): ?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>

                <?php echo e(trans('general.payment_card_success'), false); ?>

            </div>
          <?php endif; ?>

          <?php if(session('error_message')): ?>
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>

                <?php echo e(session('error_message'), false); ?>

            </div>
          <?php endif; ?>

        <?php if($key_secret): ?>

          <div class="card mb-4">
            <div class="card-body">
              <p class="card-text">
                <?php if(auth()->user()->pm_type != ''): ?>
                  <img src="<?php echo e(asset('public/img/payments/brands/'.strtolower(auth()->user()->pm_type).'.svg'), false); ?>" class="mr-1">
                  <strong class="text-capitalize"><?php echo e(auth()->user()->pm_type, false); ?></strong> <br> •••• •••• •••• <?php echo e(auth()->user()->pm_last_four, false); ?>

                  <small class="float-right d-block"><?php echo e(trans('general.expiry'), false); ?>: <?php echo e($expiration, false); ?></small>

                <?php else: ?>
                  <?php echo e(trans('general.not_card_added'), false); ?>

                <?php endif; ?>
              </p>

              <a href="<?php echo e(url('settings/payments/card'), false); ?>" class="btn btn-success btn-sm"><?php echo e(auth()->user()->pm_type == '' ? __('general.add') : __('admin.edit'), false); ?></a>

              <?php if(auth()->user()->pm_type != ''): ?>
              <form method="POST" action="<?php echo e(url('stripe/delete/card'), false); ?>" class="d-inline" id="formDeleteCardStripe">
                <?php echo csrf_field(); ?>
                <input type="button" class="btn btn-danger btn-sm" id="deleteCardStripe" value="<?php echo e(__('admin.delete'), false); ?>">
              </form>
            <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>

        <?php if($paystackPayment): ?>
          <div class="card">
            <div class="card-body">
              <p class="card-text">
                <?php if(auth()->user()->paystack_card_brand != ''): ?>
                  <img src="<?php echo e(asset('public/img/payments/brands/'.strtolower(auth()->user()->paystack_card_brand).'.svg'), false); ?>" class="mr-1">
                  <strong class="text-capitalize"><?php echo e(auth()->user()->paystack_card_brand, false); ?></strong> <br> •••• •••• •••• <?php echo e(auth()->user()->paystack_last4, false); ?>

                  <small class="float-right d-block"><?php echo e(trans('general.expiry'), false); ?>: <?php echo e(auth()->user()->paystack_exp, false); ?></small>

                <?php else: ?>
                  <?php echo e(trans('general.not_card_added'), false); ?>

                <?php endif; ?>

                <small class="alert alert-primary w-100 d-block mt-1">
                  <i class="fa fa-info-circle mr-2"></i> <?php echo e(__('general.notice_charge_to_card', ['amount' => Helper::amountWithoutFormat($chargeAmountPaystack). ' '.$settings->currency_code ]), false); ?>

                </small>

                <form method="POST" action="<?php echo e(url('paystack/card/authorization'), false); ?>" class="d-inline">
                  <?php echo csrf_field(); ?>
                  <input type="submit" class="btn btn-success btn-sm" value="<?php echo e(auth()->user()->paystack_card_brand == '' ? __('general.add') : __('admin.edit'), false); ?>">
                </form>

                <?php if(auth()->user()->paystack_card_brand != ''): ?>
                <form method="POST" action="<?php echo e(url('paystack/delete/card'), false); ?>" class="d-inline" id="formDeleteCardPaystack">
                  <?php echo csrf_field(); ?>
                  <input type="button" class="btn btn-danger btn-sm" id="deleteCardPaystack" value="<?php echo e(__('admin.delete'), false); ?>">
                </form>
              <?php endif; ?>
              </p>
            </div>
          </div>
          <?php endif; ?>

          <div class="btn-block mt-2">
            <small><i class="fa fa-lock text-success mr-1"></i> <?php echo e(trans('general.info_payment_card'), false); ?></small>
          </div>

        <?php if(! $key_secret && ! $paystackPayment): ?>

          <div class="alert alert-primary text-center" role="alert">
            <i class="fa fa-info-circle mr-2"></i> <?php echo e(trans('general.not_card_added'), false); ?>

          </div>
        <?php endif; ?>
        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/my_cards.blade.php ENDPATH**/ ?>