<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>
    <title><?php echo e(trans('general.invoice'), false); ?> #<?php echo e(str_pad($data->id, 4, "0", STR_PAD_LEFT), false); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php echo $__env->make('includes.css_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="shortcut icon" href="<?php echo e(url('public/img', $settings->favicon), false); ?>" />
  </head>

  <body class="bg-light">
    <div class="wrapper">
  <!-- Main content -->
  <section class="invoice p-4 bg-white">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="border-bottom pb-3">
          <img src="<?php echo e(url('public/img', $settings->logo_2), false); ?>" width="110">
          <small class="float-end date-invoice mt-3"><?php echo e(trans('admin.date'), false); ?>: <?php echo e(Helper::formatDate($data->date), false); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info mb-3">
      <div class="col-sm-4 invoice-col">
        <?php echo e(trans('general.from'), false); ?>

        <address>
          <?php if($settings->company): ?>
            <span class="w-100 d-block mb-1 fw-bold"><?php echo e($settings->company, false); ?></span>
          <?php endif; ?>

          <?php if($settings->address): ?>
            <span class="w-100 d-block mb-1"><?php echo e($settings->address, false); ?></span>
          <?php endif; ?>

          <?php if($settings->city || $settings->zip): ?>
            <span class="w-100 d-block mb-1"><?php echo e($settings->city, false); ?> <?php echo e($settings->zip, false); ?></span>
          <?php endif; ?>

          <?php if($settings->country): ?>
            <span class="w-100 d-block mb-1"><?php echo e($settings->country, false); ?></span>
          <?php endif; ?>

          <span class="w-100 d-block mb-1"><?php echo e(trans('auth.email'), false); ?>: <?php echo e($settings->email_admin, false); ?></span>

          <?php if($settings->phone): ?>
          <span class="w-100 d-block mb-1">
            <?php echo e(__('general.phone'), false); ?>: <?php echo e($settings->phone, false); ?>

          </span>
          <?php endif; ?>

          <?php if($settings->vat): ?>
            <?php echo e(trans('general.vat'), false); ?>: <?php echo e($settings->vat, false); ?>

          <?php endif; ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <?php echo e(trans('general.to'), false); ?>

        <address>
          <?php if(isset($data->user()->username)): ?>
            <span class="w-100 d-block mb-1 fw-bold"><?php echo e($data->user()->name, false); ?> <?php echo e($data->user()->company != '' ? '- '.$data->user()->company : null, false); ?></span>

            <?php if($data->user()->address): ?>
              <span class="w-100 d-block mb-1"><?php echo e($data->user()->address, false); ?></span>
            <?php endif; ?>

            <?php if($data->user()->city || $data->user()->zip): ?>
              <span class="w-100 d-block mb-1"><?php echo e($data->user()->city, false); ?>, <?php echo e($data->user()->zip, false); ?></span>
            <?php endif; ?>

            <?php if(isset($data->user()->country()->country_name)): ?>
              <span class="w-100 d-block mb-1"><?php echo e($data->user()->country()->country_name, false); ?></span>
            <?php endif; ?>

            <?php echo e(trans('auth.email'), false); ?>: <?php echo e($data->user()->email, false); ?>


          <?php else: ?> 
          <?php echo e(__('general.no_available'), false); ?>

          <?php endif; ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b><?php echo e(trans('general.invoice'), false); ?> #<?php echo e(str_pad($data->id, 4, "0", STR_PAD_LEFT), false); ?></b><br>
        <b><?php echo e(trans('general.payment_due'), false); ?></b> <?php echo e(Helper::formatDate($data->date), false); ?><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-borderless table-striped">
          <thead>
          <tr>
            <th><?php echo e(trans('general.qty'), false); ?></th>
            <th class="text-center"><?php echo e(trans('general.description'), false); ?></th>
            <th class="text-end"><?php echo e(trans('general.subtotal'), false); ?></th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td class="text-center"><?php echo e(trans('general.add_funds'), false); ?></td>
            <td class="text-end"><?php echo e(Helper::amountFormatDecimal($amount), false); ?> <?php echo e($settings->currency_code, false); ?></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- /.col -->
      <div class="col-4 col-lg-6"></div>
      <!-- /.col -->
      <div class="col-8 col-lg-6">
        <div class="table-responsive">
          <table class="table">
            <tr class="border-bottom">
              <th class="w-50 text-end"><?php echo e(trans('general.subtotal'), false); ?>:</th>
              <td class="text-end"><?php echo e(Helper::amountFormatDecimal($amount), false); ?> <?php echo e($settings->currency_code, false); ?></td>
            </tr>

            <?php if($percentageApplied): ?>
              <tr class="border-bottom">
                <th class="w-50 text-end"><?php echo e(trans('general.transaction_fee'), false); ?>: <?php echo e($percentageApplied, false); ?></th>
                <td class="text-end"><?php echo e(Helper::amountFormatDecimal($transactionFee), false); ?> <?php echo e($settings->currency_code, false); ?></td>
              </tr>
            <?php endif; ?>

              <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-bottom">
                  <th class="w-50 text-end"><?php echo e($tax->name, false); ?> <?php echo e($tax->percentage, false); ?>%:</th>
                  <td class="text-end"><?php echo e(Helper::amountFormatDecimal(Helper::calculatePercentage($amount, $tax->percentage)), false); ?> <?php echo e($settings->currency_code, false); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr class="h5 text-end">
              <th class="text-end"><?php echo e(trans('general.total'), false); ?>:</th>
              <td><strong><?php echo e(Helper::amountFormatDecimal($totalAmount), false); ?> <?php echo e($settings->currency_code, false); ?></strong></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row no-print">
        <div class="col-12">
          <a href="javascript:void(0);" onclick="window.print();" class="btn btn-light border"><i class="fa fa-print"></i> <?php echo e(trans('general.print'), false); ?></a>
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
  </body>
</html>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/invoice-deposits.blade.php ENDPATH**/ ?>