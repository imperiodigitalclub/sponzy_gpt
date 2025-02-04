<?php $__env->startSection('title'); ?> <?php echo e(trans('general.payment_card'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
  <script type="text/javascript">
      var key_stripe = "<?php echo e($key, false); ?>";
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 pt-5 pb-4">
          <h2 class="mb-0 font-montserrat"><i class="feather icon-credit-card mr-2"></i> <?php echo e(trans('general.payment_card'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.payment_card_subtitle'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <div class="col-md-8 mx-auto mb-lg-0">

          <div class="bg-white rounded-lg shadow-sm p-5">

            <div class="alert alert-success display-none" id="success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>

                <?php echo e(trans('general.payment_card_success'), false); ?>

            </div>

            <?php
              switch (auth()->user()->pm_type) {
                case 'amex':
                  $paymentDefault = '<img src="'.asset('public/img/payments/brands/amex.svg').'"> •••• •••• •••• '.auth()->user()->pm_last_four;
                  break;

                case 'diners':
                $paymentDefault = '<img src="'.asset('public/img/payments/brands/diners.svg').'"> •••• •••• •••• '.auth()->user()->pm_last_four;
                break;

                case 'discover':
                $paymentDefault = '<img src="'.asset('public/img/payments/brands/discover.svg').'"> •••• •••• •••• '.auth()->user()->pm_last_four;
                break;

                case 'jcb':
                $paymentDefault = '<img src="'.asset('public/img/payments/brands/jcb.svg').'"> •••• •••• •••• '.auth()->user()->pm_last_four;
                break;

                case 'mastercard':
                $paymentDefault = '<img src="'.asset('public/img/payments/brands/mastercard.svg').'"> •••• •••• •••• '.auth()->user()->pm_last_four;
                break;

                case 'unionpay':
                $paymentDefault = '<img src="'.asset('public/img/payments/brands/unionpay.svg').'"> •••• •••• •••• '.auth()->user()->pm_last_four;
                break;

                case 'visa':
                $paymentDefault = '<img src="'.asset('public/img/payments/brands/visa.svg').'"> •••• •••• •••• '.auth()->user()->pm_last_four;
                break;

                default:
                  $paymentDefault = trans('general.not_card_added');
                  break;
              }
            ?>

            <h5 class="text-center mb-2"><?php echo e(trans('general.default_payment_card'), false); ?></h5>
            <h6 class="text-center mb-3">
              <small><?php echo $paymentDefault; ?></small>
            </h6>

            <!-- Stripe Elements Placeholder -->
            <div id="card-element"></div>
            <div id="card-errors" class="alert alert-danger display-none" role="alert"></div>

            <button id="card-button" class="btn btn-1 btn-primary btn-block" data-secret="<?php echo e($intent->client_secret, false); ?>">
                <i></i> <?php echo e(trans('general.save_payment_card'), false); ?>

            </button>
            <div class="mt-2 text-center">
              <a href="<?php echo e(url()->previous(), false); ?>"><i class="fa fa-long-arrow-alt-left"></i> <?php echo e(trans('general.go_back'), false); ?></a>
            </div>
          </div>

          <div class="btn-block text-center mt-2">
            <small><i class="fa fa-lock text-success mr-1"></i> <?php echo e(trans('general.info_payment_card'), false); ?></small>
          </div>

        </div><!-- end col-md-8 -->

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('public/js/add-payment-card.js'), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/add_payment_card.blade.php ENDPATH**/ ?>