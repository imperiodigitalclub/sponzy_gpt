<?php $__env->startSection('title'); ?> <?php echo e(trans('general.payments'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi bi-receipt mr-2"></i> <?php echo e(trans('general.payments'), false); ?></h2>
          <?php if(request()->is('my/payments')): ?>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.my_payments_subtitle'), false); ?></p>
        <?php else: ?>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.my_payments_received_subtitle'), false); ?></p>
        <?php endif; ?>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if($transactions->count() != 0 && auth()->user()->verified_id == 'yes'): ?>

            <div class="btn-block mb-3 text-right">
              <span>
                <?php echo e(trans('general.filter_by'), false); ?>


                <select class="ml-2 custom-select w-auto" id="filter">
                    <option <?php if(request()->is('my/payments')): ?> selected <?php endif; ?> value="<?php echo e(url('my/payments'), false); ?>"><?php echo e(trans('general.payments_made'), false); ?></option>
                    <option <?php if(request()->is('my/payments/received')): ?> selected <?php endif; ?> value="<?php echo e(url('my/payments/received'), false); ?>"><?php echo e(trans('general.payments_received'), false); ?></option>
                  </select>
              </span>
            </div>
          <?php endif; ?>

        <?php if($transactions->count()): ?>
            <?php if(session('error_message')): ?>
            <div class="alert alert-danger mb-3">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="far fa-times-circle"></i></span>
              </button>

              <i class="fa fa-exclamation-triangle mr-2"></i> <?php echo e(trans('general.please_complete_all'), false); ?>

              <a href="<?php echo e(url('settings/page'), false); ?>#billing" class="text-white link-border"><?php echo e(trans('general.billing_information'), false); ?></a>
            </div>
            <?php endif; ?>

        <div class="card shadow-sm">
          <div class="table-responsive">
            <table class="table table-striped m-0">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                <?php if(request()->is('my/payments')): ?>
                  <th scope="col"><?php echo e(trans('general.paid_to'), false); ?></th>
                  <th scope="col"><?php echo e(trans('general.payment_gateway'), false); ?></th>
                <?php endif; ?>
                  <th scope="col"><?php echo e(trans('admin.date'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.amount'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.type'), false); ?></th>
                  <?php if(request()->is('my/payments/received')): ?>
                    <th scope="col"><?php echo e(trans('general.paid_by'), false); ?></th>
                    <th scope="col"><?php echo e(trans('general.earnings'), false); ?></th>
                  <?php endif; ?>
                  <th scope="col"><?php echo e(trans('admin.status'), false); ?></th>
                  <?php if(request()->is('my/payments')): ?>
                  <th> <?php echo e(trans('general.invoice'), false); ?></th>
                <?php endif; ?>
                </tr>
              </thead>

              <tbody>

                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e(str_pad($transaction->id, 4, "0", STR_PAD_LEFT), false); ?></td>
                    <?php if(request()->is('my/payments')): ?>
                    <td><?php echo e($transaction->subscribed()->username ?? trans('general.no_available'), false); ?></td>
                    <td><?php echo e($transaction->payment_gateway, false); ?></td>
                    <?php endif; ?>
                    <td><?php echo e(Helper::formatDate($transaction->created_at), false); ?></td>
                    <td><?php echo e(Helper::amountFormatDecimal($transaction->amount), false); ?></td>
                    <td>
                      <?php echo e(__('general.'.$transaction->type), false); ?>


                      <?php if(isset($transaction->gift->id) && request()->is('my/payments/received')): ?>
                      <span class="d-block mt-2">
                        <img src="<?php echo e(url('public/img/gifts', $transaction->gift->image), false); ?>" width="25">
                      </span>
                      <?php endif; ?>
                    </td>
                    <?php if(request()->is('my/payments/received')): ?>
                      <td><?php echo e($transaction->user()->username ?? trans('general.no_available'), false); ?></td>
                    <td>
                      <?php echo e(Helper::amountFormatDecimal($transaction->earning_net_user), false); ?>


                      <?php if($transaction->percentage_applied): ?>
                        <a tabindex="0" role="button" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="<?php echo e(trans('general.percentage_applied'), false); ?> <?php echo e($transaction->percentage_applied, false); ?> <?php echo e(trans('general.platform'), false); ?> <?php if($transaction->direct_payment): ?> (<?php echo e(__('general.direct_payment'), false); ?>) <?php endif; ?>">
                          <i class="far fa-question-circle"></i>
                        </a>
                      <?php endif; ?>
                      
                    </td>
                    <?php endif; ?>
                    <td>
                      <?php if($transaction->approved == '1'): ?>
                        <span class="badge badge-pill badge-success text-uppercase"><?php echo e(trans('general.success'), false); ?></span>
                      <?php elseif($transaction->approved == '2'): ?>
                        <span class="badge badge-pill badge-danger text-uppercase"><?php echo e(trans('general.canceled'), false); ?></span>
                        <?php if(request()->is('my/payments/received')): ?>
                          <a tabindex="0" role="button" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="<?php echo e(trans('general.payment_canceled'), false); ?>">
                        <i class="far fa-question-circle"></i>
                      </a>
                        <?php endif; ?>
                      <?php else: ?>
                        <span class="badge badge-pill badge-warning text-uppercase"><?php echo e(trans('general.pending'), false); ?></span>
                      <?php endif; ?>
                    </td>
                    <?php if(request()->is('my/payments')): ?>
                    <td>
                      <?php if($transaction->approved == '1'): ?>
                      <a href="<?php echo e(url('payments/invoice', $transaction->id), false); ?>" target="_blank"><i class="far fa-file-alt"></i> <?php echo e(trans('general.invoice'), false); ?></a>
                    </td>
                  <?php else: ?>
                    <?php echo e(trans('general.no_available'), false); ?>

                      <?php endif; ?>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </tbody>
            </table>
          </div>
          </div><!-- card -->

          <?php if($transactions->hasPages()): ?>
  			    	<?php echo e($transactions->onEachSide(0)->links(), false); ?>

  			    	<?php endif; ?>

        <?php else: ?>
          <div class="my-5 text-center">
            <span class="btn-block mb-3">
              <i class="bi bi-receipt ico-no-result"></i>
            </span>
            <?php if(request()->is('my/payments')): ?>
            <h4 class="font-weight-light"><?php echo e(trans('general.not_payment_made'), false); ?></h4>
          <?php else: ?>
            <h4 class="font-weight-light"><?php echo e(trans('general.not_payment_received'), false); ?></h4>
          <?php endif; ?>
          </div>
        <?php endif; ?>

        </div><!-- end col-md-6 -->

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/my_payments.blade.php ENDPATH**/ ?>