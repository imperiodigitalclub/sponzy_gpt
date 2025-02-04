<?php $__env->startSection('title'); ?> <?php echo e(__('general.wallet'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="iconmoon icon-Wallet mr-2"></i> <?php echo e(__('general.wallet'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(__('general.wallet_desc'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <?php if(session('error_message')): ?>
          <div class="alert alert-danger mb-3">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true"><i class="far fa-times-circle"></i></span>
            </button>

            <?php echo e(session('error_message'), false); ?>

          </div>
          <?php endif; ?>

          <?php if(session('success_message')): ?>
          <div class="alert alert-success mb-3">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true"><i class="far fa-times-circle"></i></span>
            </button>

            <?php echo e(session('success_message'), false); ?>

          </div>
          <?php endif; ?>

          <div class="alert alert-primary shadow overflow-hidden" role="alert">

            <div class="inner-wrap">
              <span>
                <h2><strong><?php echo e(Helper::userWallet(), false); ?></strong>
                  <small class="h5"><?php echo e($settings->wallet_format == 'real_money' ? $settings->currency_code : null, false); ?></small>
                </h2>

                <span class="w-100 d-block">
                <?php echo e(__('general.funds_available'), false); ?>

                </span>

                <?php if($equivalent_money): ?>
                  <span>
                    <strong><?php echo e($equivalent_money, false); ?></strong>
                  </span>
                <?php endif; ?>

                <span class="w-100 d-block mt-2">
                  <?php if(auth()->user()->balance != 0.00): ?>
                  <a href="#" data-toggle="modal" data-target="#modalTransfer" class="btn btn-1 btn-success mb-2">
                    <i class="bi bi-arrow-left-right mr-2"></i> <?php echo e(__('general.transfer_balance'), false); ?>

                  </a>
                  <?php endif; ?>
                </span>
              </span>
            </div>

            <span class="icon-wrap"><i class="iconmoon icon-Wallet"></i></span>

        </div><!-- /alert -->

          <form method="POST" action="<?php echo e(url('add/funds'), false); ?>" id="formAddFunds">

            <?php echo csrf_field(); ?>

            <div class="form-group mb-4">
              <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
              </div>
                  <input class="form-control form-control-lg" required id="onlyNumber" name="amount" min="<?php echo e($settings->min_deposits_amount, false); ?>" max="<?php echo e($settings->max_deposits_amount, false); ?>" autocomplete="off" placeholder="<?php echo e(__('admin.amount'), false); ?> (<?php echo e(__('general.minimum'), false); ?> <?php echo e(Helper::priceWithoutFormat($settings->min_deposits_amount), false); ?> - <?php echo e(__('general.maximum'), false); ?> <?php echo e(Helper::priceWithoutFormat($settings->max_deposits_amount), false); ?>)" type="number">
                  <small class="d-block w-100 my-1">
                    <i class="bi-arrow-up-square mr-1"></i> <i class="bi-arrow-down-square mr-1"></i> <?php echo e(__('general.increase_decrease_amount'), false); ?>

                  </small>
              </div>

              <p class="help-block margin-bottom-zero fee-wrap">

                <span class="d-block w-100">
                <?php echo e(__('general.transaction_fee'), false); ?>:

                <span class="float-right"><strong><?php echo e(Helper::symbolPositionLeft(), false); ?><span id="handlingFee">0</span><?php echo e(Helper::symbolPositionRight(), false); ?></strong></span>
              </span><!-- end transaction fee -->

              <?php if(auth()->user()->isTaxable()->count() && $settings->tax_on_wallet): ?>
                <?php $__currentLoopData = auth()->user()->isTaxable(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="d-block w-100 isTaxableWallet percentageAppliedTaxWallet<?php echo e($loop->iteration, false); ?>" data="<?php echo e($tax->percentage, false); ?>">
                  <?php echo e($tax->name, false); ?> <?php echo e($tax->percentage, false); ?>%:

                  <span class="float-right">
                  <strong><?php echo e(Helper::symbolPositionLeft(), false); ?><span class="percentageTax<?php echo e($loop->iteration, false); ?>">0</span><?php echo e(Helper::symbolPositionRight(), false); ?></strong>
                </span>
              </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  						<?php endif; ?>

                <span class="d-block w-100">
                  <?php echo e(__('general.total'), false); ?>:

                  <span class="float-right">
                  <strong><?php echo e(Helper::symbolPositionLeft(), false); ?><span id="total">0</span><?php echo e(Helper::symbolPositionRight(), false); ?></strong>
                </span>
              </span><!-- end total -->
              </p>

            </div><!-- End form-group -->

            <?php $__currentLoopData = PaymentGateways::where('enabled', '1')->orderBy('type', 'DESC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php
              if ($payment->type == 'card' ) {
                $paymentName = '<i class="far fa-credit-card mr-1 icon-sm-radio"></i> '. __('general.debit_credit_card') .' ('.$payment->name.')';
              } elseif ($payment->type == 'bank') {
                $paymentName = '<i class="fa fa-university mr-1 icon-sm-radio"></i> '.__('general.bank_transfer');
              } else if ($payment->name == 'PayPal') {
                $paymentName = '<img src="'.url('public/img/payments', auth()->user()->dark_mode == 'off' ? $payment->logo : 'paypal-white.png').'" width="70"/>';
              } else if ($payment->name == 'Coinpayments') {
                $paymentName = '<img src="'.url('public/img/payments', auth()->user()->dark_mode == 'off' ? $payment->logo : 'coinpayments-white.png').'" width="150"/>';
              } else if ($payment->name == 'Coinbase') {
                $paymentName = '<img src="'.url('public/img/payments', auth()->user()->dark_mode == 'off' ? $payment->logo : 'coinbase-white.png').'" width="110"/>';
              } else if ($payment->name == 'NowPayments') {
                $paymentName = '<img src="'.url('public/img/payments', auth()->user()->dark_mode == 'off' ? $payment->logo : 'nowpayments-white.png').'" width="130"/>';
              } else if ($payment->name == 'Mercadopago') {
                $paymentName = '<img src="'.url('public/img/payments', auth()->user()->dark_mode == 'off' ? $payment->logo : 'mercadopago-white.png').'" width="100"/>';
              } else if ($payment->name == 'Flutterwave') {
                $paymentName = '<img src="'.url('public/img/payments', auth()->user()->dark_mode == 'off' ? $payment->logo : 'flutterwave-white.png').'" width="150"/>';
              } else if ($payment->name == 'Mollie') {
                $paymentName = '<img src="'.url('public/img/payments', auth()->user()->dark_mode == 'off' ? $payment->logo : 'mollie-white.png').'" width="80"/>';
              } else if ($payment->name == 'Razorpay') {
                $paymentName = '<img src="'.url('public/img/payments', auth()->user()->dark_mode == 'off' ? $payment->logo : 'razorpay-white.png').'" width="110"/>';
              } else {
                $paymentName = '<img src="'.url('public/img/payments', $payment->logo).'" width="100"/>';
              }

              ?>
              <div class="custom-control custom-radio mb-3">
                <input name="payment_gateway" required value="<?php echo e($payment->name, false); ?>" id="tip_radio<?php echo e($payment->name, false); ?>" <?php if(PaymentGateways::where('enabled', '1')->count() == 1): ?> checked <?php endif; ?> class="custom-control-input" type="radio">
                <label class="custom-control-label" for="tip_radio<?php echo e($payment->name, false); ?>">
                  <span><strong><?php echo $paymentName; ?></strong></span>
                  <small class="w-100 d-block"><?php echo e($payment->fee != 0.00 || $payment->fee_cents != 0.00 ? '* '.__('general.transaction_fee').':' : null, false); ?> <?php echo e($payment->fee != 0.00 ? $payment->fee.'%' : null, false); ?> <?php echo e($payment->fee_cents != 0.00 ? '+ '. Helper::amountFormatDecimal($payment->fee_cents) : null, false); ?></small>
                </label>
              </div>

              <?php if($payment->type == 'bank'): ?>
                <div class="btn-block <?php if(PaymentGateways::where('enabled', '1')->count() != 1): ?> display-none <?php endif; ?>" id="bankTransferBox">
                  <div class="alert alert-default border">
                  <h5 class="font-weight-bold"><i class="fa fa-university mr-1 icon-sm-radio"></i> <?php echo e(__('general.make_payment_bank'), false); ?></h5>
                  <ul class="list-unstyled">
                      <li>
                        <?php echo nl2br($payment->bank_info); ?>


                        <hr />
                        <span class="d-block w-100 mt-2">
                        <?php echo e(__('general.total'), false); ?>: <strong><?php echo e(Helper::symbolPositionLeft(), false); ?><span id="total2">0</span><?php echo e(Helper::symbolPositionRight(), false); ?></strong>
                        <span>

                          <?php if($equivalent_money): ?>
                          <small class="btn-block w-100">
                            <strong><?php echo e($equivalent_money, false); ?></strong>
                          </small>
                        <?php endif; ?>

                      </li>
                  </ul>
                </div>

                <div class="mb-3 text-center">
                  <span class="btn-block mb-2" id="previewImage"></span>

                    <input type="file" name="image" id="fileBankTransfer" accept="image/*" class="visibility-hidden">
                    <button class="btn btn-1 btn-block btn-outline-primary mb-2 border-dashed" onclick="$('#fileBankTransfer').trigger('click');" type="button" id="btnFilePhoto"><?php echo e(__('general.upload_image'), false); ?> (JPG, PNG, GIF) <?php echo e(__('general.maximum'), false); ?>: <?php echo e(Helper::formatBytes($settings->file_size_allowed_verify_account * 1024), false); ?></button>

                  <small class="text-muted btn-block"><?php echo e(__('general.info_bank_transfer'), false); ?></small>
                </div>
                </div><!-- Alert -->
              <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="alert alert-danger display-none" id="errorAddFunds">
                <ul class="list-unstyled m-0" id="showErrorsFunds"></ul>
              </div>

              <div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input" required id=" customCheckLogin" name="agree_terms" type="checkbox">
                <label class="custom-control-label" for=" customCheckLogin">
                  <span><?php echo e(__('general.i_agree_with'), false); ?> <a href="<?php echo e($settings->link_terms, false); ?>" target="_blank"><?php echo e(__('admin.terms_conditions'), false); ?></a></span>
                </label>
              </div>

            <button class="btn btn-1 btn-success btn-block mt-4" id="addFundsBtn" type="submit"><i></i> <?php echo e(__('general.add_funds'), false); ?></button>
          </form>

          <?php if($data->count() != 0): ?>
          <h6 class="text-center mt-5 font-weight-light"><?php echo e(__('general.history_deposits'), false); ?></h6>

          <div class="card shadow-sm">
            <div class="table-responsive">
              <table class="table table-striped m-0">
                <thead>
                  <th scope="col">ID</th>
                  <th scope="col"><?php echo e(__('admin.amount'), false); ?></th>
                  <th scope="col"><?php echo e(__('general.payment_gateway'), false); ?></th>
                  <th scope="col"><?php echo e(__('admin.date'), false); ?></th>
                  <th scope="col"><?php echo e(__('admin.status'), false); ?></th>
                  <th> <?php echo e(__('general.invoice'), false); ?></th>
                </thead>

                <tbody>
                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                      <td><?php echo e(str_pad($deposit->id, 4, "0", STR_PAD_LEFT), false); ?></td>
                      <td><?php echo e(App\Helper::amountFormat($deposit->amount), false); ?></td>
                      <td><?php echo e($deposit->payment_gateway == 'Bank Transfer' || $deposit->payment_gateway == 'Bank' ? __('general.bank_transfer') : $deposit->payment_gateway, false); ?></td>
                      <td><?php echo e(date('d M, Y', strtotime($deposit->date)), false); ?></td>

                      <?php

                      if ($deposit->status == 'pending' ) {
                       			$mode    = 'warning';
             								$_status = __('admin.pending');
                          } else {
                            $mode = 'success';
             								$_status = __('general.success');
                          }

                       ?>

                       <td><span class="badge badge-pill badge-<?php echo e($mode, false); ?> text-uppercase"><?php echo e($_status, false); ?></span></td>

                       <td>
                         <?php if($deposit->status == 'active'): ?>
                         <a href="<?php echo e(url('deposits/invoice', $deposit->id), false); ?>" target="_blank"><i class="far fa-file-alt"></i> <?php echo e(__('general.invoice'), false); ?></a>
                       </td>
                     <?php else: ?>
                       <?php echo e(__('general.no_available'), false); ?>

                         <?php endif; ?>
                    </tr><!-- /.TR -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div><!-- table-responsive -->
          </div><!-- card -->
          <small class="w-100 d-block mt-2"><?php echo e(__('general.transaction_fee_info'), false); ?></small>

          <?php if($data->hasPages()): ?>
  			    	<div class="mt-3">
                <?php echo e($data->links(), false); ?>

              </div>
  			    	<?php endif; ?>

        <?php endif; ?>

        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>

  <?php if(auth()->user()->balance != 0.00): ?>
    <?php echo $__env->make('includes.modal-transfer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
<?php if(in_array(config('settings.currency_code'), config('currencies.zero-decimal'))): ?>
  $decimal = 0;
  <?php else: ?>
  $decimal = 2;
  <?php endif; ?>

  function toFixed(number, decimals) {
        var x = Math.pow(10, Number(decimals) + 1);
        return (Number(number) + (1 / x)).toFixed(decimals);
      }

  $('input[name=payment_gateway]').on('click', function() {

    var valueOriginal = $('#onlyNumber').val();
    var value = parseFloat($('#onlyNumber').val());
    var element = $(this).val();

    //==== Start Taxes
    var taxes = $('span.isTaxableWallet').length;
    var totalTax = 0;

    if (valueOriginal.length == 0
				|| valueOriginal == ''
				|| value < <?php echo e($settings->min_deposits_amount, false); ?>

				|| value > <?php echo e($settings->max_deposits_amount, false); ?>

      ) {
        // Reset
  			for (var i = 1; i <= taxes; i++) {
  				$('.percentageTax'+i).html('0');
  			}
        $('#handlingFee, #total, #total2').html('0');
      } else {
        // Taxes
        for (var i = 1; i <= taxes; i++) {
          var percentage = $('.percentageAppliedTaxWallet'+i).attr('data');
          var valueFinal = (value * percentage / 100);
          $('.percentageTax'+i).html(toFixed(valueFinal, $decimal));
          totalTax += valueFinal;
        }
        var totalTaxes = (Math.round(totalTax * 100) / 100).toFixed(2);
      }
      //==== End Taxes

    if (element != ''
        && value <= <?php echo e($settings->max_deposits_amount, false); ?>

        && value >= <?php echo e($settings->min_deposits_amount, false); ?>

        && valueOriginal != ''
      ) {
      // Fees
      switch (element) {
        <?php $__currentLoopData = PaymentGateways::where('enabled', '1')->get();; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        case '<?php echo e($payment->name, false); ?>':
          $fee   = <?php echo e($payment->fee, false); ?>;
          $cents =  <?php echo e($payment->fee_cents, false); ?>;
          break;
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      }

      var amount = (value * $fee / 100) + $cents;
      var amountFinal = toFixed(amount, $decimal);

      var total = (parseFloat(value) + parseFloat(amountFinal) + parseFloat(totalTaxes));

      if (valueOriginal.length != 0
  				|| valueOriginal != ''
  				|| value >= <?php echo e($settings->min_deposits_amount, false); ?>

  				|| value <= <?php echo e($settings->max_deposits_amount, false); ?>

        ) {
        $('#handlingFee').html(amountFinal);
        $('#total, #total2').html(total.toFixed($decimal));
      }
    }

});

//<-------- * TRIM * ----------->

$('#onlyNumber').on('keyup', function() {

    var valueOriginal = $(this).val();
    var value = parseFloat($(this).val());
    var paymentGateway = $('input[name=payment_gateway]:checked').val();

    if (value > <?php echo e($settings->max_deposits_amount, false); ?> || valueOriginal.length == 0) {
      $('#handlingFee').html('0');
      $('#total, #total2').html('0');
    }

    //==== Start Taxes
    var taxes = $('span.isTaxableWallet').length;
    var totalTax = 0;

    if (valueOriginal.length == 0
				|| valueOriginal == ''
				|| value < <?php echo e($settings->min_deposits_amount, false); ?>

				|| value > <?php echo e($settings->max_deposits_amount, false); ?>

      ) {
        // Reset
  			for (var i = 1; i <= taxes; i++) {
  				$('.percentageTax'+i).html('0');
  			}
        $('#handlingFee, #total, #total2').html('0');
      } else {
        // Taxes
        for (var i = 1; i <= taxes; i++) {
          var percentage = $('.percentageAppliedTaxWallet'+i).attr('data');
          var valueFinal = (value * percentage / 100);
          $('.percentageTax'+i).html(toFixed(valueFinal, $decimal));
          totalTax += valueFinal;
        }
        var totalTaxes = (Math.round(totalTax * 100) / 100).toFixed(2);
      }
      //==== End Taxes

    if (paymentGateway
        && value <= <?php echo e($settings->max_deposits_amount, false); ?>

        && value >= <?php echo e($settings->min_deposits_amount, false); ?>

        && valueOriginal != ''
      ) {

      switch(paymentGateway) {
        <?php $__currentLoopData = PaymentGateways::where('enabled', '1')->get();; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        case '<?php echo e($payment->name, false); ?>':
          $fee   = <?php echo e($payment->fee, false); ?>;
          $cents =  <?php echo e($payment->fee_cents, false); ?>;
          break;
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      }

      var amount = (value * $fee / 100) + $cents;
      var amountFinal = toFixed(amount, $decimal);

      var total = (parseFloat(value) + parseFloat(amountFinal) + parseFloat(totalTaxes));

      if (valueOriginal.length != 0
  				|| valueOriginal != ''
  				|| value >= <?php echo e($settings->min_deposits_amount, false); ?>

  				|| value <= <?php echo e($settings->max_deposits_amount, false); ?>

        ) {
        $('#handlingFee').html(amountFinal);
        $('#total, #total2').html(total.toFixed($decimal));
      } else {
        $('#handlingFee, #total, #total2').html('0');
        }
    }
});

<?php if(session('payment_process')): ?>
   swal({
     html:true,
     title: "<?php echo e(__('general.congratulations'), false); ?>",
     text: "<?php echo __('general.payment_process_wallet'); ?>",
     type: "success",
     confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
     });
  <?php endif; ?>

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/wallet.blade.php ENDPATH**/ ?>