<?php $__env->startSection('title'); ?> <?php echo e(trans('general.withdrawals'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi bi-arrow-left-right mr-2"></i> <?php echo e(trans('general.withdrawals'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.history_withdrawals'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if(auth()->user()->payment_gateway == ''): ?>
          <div class="alert alert-warning alert-dismissible" role="alert">
          <span class="alert-inner--text"><i class="far fa-credit-card mr-2"></i> <?php echo e(trans('users.please_select_a'), false); ?>

            <a href="<?php echo e(url('settings/payout/method'), false); ?>" class="text-white link-border"><?php echo e(trans('users.payout_method'), false); ?></a>
          </span>
        </div>
        <?php endif; ?>

            <div class="row">
              <div class="col-md-12">

                <?php
                  $datePaid = Withdrawals::select('date')
                      ->where('user_id', auth()->user()->id)
                      ->where('status','pending')
                      ->orderBy('id','desc')
                      ->first();
                ?>

                <div class="alert alert-primary overflow-hidden" role="alert">

                  <div class="inner-wrap">
                    <h4>
                      <small><?php echo e(trans('general.balance'), false); ?>:</small> <?php echo e(Helper::amountFormatDecimal(auth()->user()->balance), false); ?> <small><?php echo e($settings->currency_code, false); ?></small>
                    </h4>

                    <i class="fa fa-info-circle mr-2"></i>

                    <?php if(! $datePaid): ?>
                      <span>
                        <?php echo e(trans('general.amount_min_withdrawal'), false); ?> <strong><?php echo e(Helper::amountWithoutFormat($settings->amount_min_withdrawal), false); ?> <?php echo e($settings->currency_code, false); ?></strong>

                        <?php if($settings->amount_max_withdrawal): ?>
                         - (<?php echo e(__('general.maximum'), false); ?>) <strong><?php echo e(Helper::amountWithoutFormat($settings->amount_max_withdrawal), false); ?> <?php echo e($settings->currency_code, false); ?></strong>
                        <?php endif; ?>
                  <?php endif; ?>

                  <?php if($datePaid): ?>
                    <?php if(! $settings->specific_day_payment_withdrawals): ?>
                      <?php echo e(trans('users.date_paid'), false); ?> <strong><?php echo e(Helper::formatDate(Carbon\Carbon::parse($datePaid->date)->addWeekdays($settings->days_process_withdrawals)), false); ?></strong>

                    <?php else: ?>
                      <?php echo e(trans('users.date_paid'), false); ?> <strong><?php echo e(Helper::formatDate(Helper::paymentDateOfEachMonth($settings->specific_day_payment_withdrawals)), false); ?></strong>
                    <?php endif; ?>
                  <?php endif; ?>

                  <small class="btn-block">
                    <?php if(! $settings->specific_day_payment_withdrawals): ?>
                      * <?php echo e(trans('general.payment_process_days', ['days' => $settings->days_process_withdrawals]), false); ?>


                    <?php elseif(! $datePaid): ?>
                      * <?php echo e(trans('users.date_paid'), false); ?> <?php echo e(Helper::formatDate(Helper::paymentDateOfEachMonth($settings->specific_day_payment_withdrawals)), false); ?>

                    <?php endif; ?>
                  </small>

                  </span>
                  </div>

                <span class="icon-wrap"><i class="bi bi-arrow-left-right"></i></span>

              </div><!-- /alert -->

                <h5>

                  <?php if(auth()->user()->balance >= $settings->amount_min_withdrawal
                      && auth()->user()->payment_gateway != ''
                      && auth()->user()->withdrawals()
                      ->where('status','pending')
                      ->count() == 0): ?>

                  <?php echo Form::open([
                   'method' => 'POST',
                   'url' => "settings/withdrawals",
                   'class' => 'd-inline'
                 ]); ?>


                 <?php if($settings->type_withdrawals == 'custom'): ?>
                   <div class="form-group mt-3">
                     <div class="input-group mb-2">
                     <div class="input-group-prepend">
                       <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
                     </div>
                         <input class="form-control form-control-lg isNumber" autocomplete="off" name="amount" placeholder="<?php echo e(trans('admin.amount'), false); ?>" type="text">
                     </div>
                   </div><!-- End form-group -->
                 <?php endif; ?>

                  <?php echo Form::submit(trans('general.make_withdrawal'), ['class' => 'btn btn-1 btn-success mb-2 saveChanges']); ?>

                  <?php echo Form::close(); ?>

                <?php else: ?>
                  <button class="btn btn-1 btn-success mb-2 disabled e-none"><?php echo e(trans('general.make_withdrawal'), false); ?></button>
                <?php endif; ?>

                </h5>

              </div><!-- col-md-12 -->
            </div>

          <?php if($withdrawals->count() != 0): ?>
          <div class="card shadow-sm">
          <div class="table-responsive">
            <table class="table table-striped m-0">
              <thead>
                <tr>
                  <th scope="col"><?php echo e(trans('admin.amount'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.method'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.date'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.status'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.actions'), false); ?></th>
                </tr>
              </thead>

              <tbody>

                <?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e(Helper::amountFormatDecimal($withdrawal->amount), false); ?></td>
                    <td><?php echo e($withdrawal->gateway == 'Bank' ? trans('general.bank') : $withdrawal->gateway, false); ?></td>
                    <td><?php echo e(Helper::formatDate($withdrawal->date), false); ?>

                    </td>
                    <td><?php if( $withdrawal->status == 'paid' ): ?>
                    <span class="badge badge-pill badge-success text-uppercase"><?php echo e(trans('general.paid'), false); ?></span>
                    <?php else: ?>
                    <span class="badge badge-pill badge-warning text-uppercase"><?php echo e(trans('general.pending_to_pay'), false); ?></span>
                    <?php endif; ?>
                  </td>
                    <td>

                  <?php if($withdrawal->status != 'paid' && Carbon\Carbon::parse($withdrawal->estimated_payment)->shortAbsoluteDiffForHumans() <> '5d'): ?>
                      <?php echo Form::open([
                        'method' => 'POST',
                        'url' => "delete/withdrawal/$withdrawal->id",
                        'class' => 'd-inline'
                      ]); ?>


                      <?php echo Form::button(trans('general.delete'), ['class' => 'btn btn-danger btn-sm deleteW p-1 px-2']); ?>

                      <?php echo Form::close(); ?>


                  <?php elseif($withdrawal->status != 'paid' && Carbon\Carbon::parse($withdrawal->estimated_payment)->shortAbsoluteDiffForHumans() == '5d'): ?>

                    <?php echo e(trans('general.in_process'), false); ?>

                  <?php else: ?>

                  <?php echo e(trans('general.paid'), false); ?> - <?php echo e(Helper::formatDate($withdrawal->date_paid), false); ?>


                  <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </tbody>
            </table>
          </div>
          </div><!-- card -->

          <?php if($withdrawals->hasPages()): ?>
            <?php echo e($withdrawals->links(), false); ?>

          <?php endif; ?>

        <?php endif; ?>
        </div><!-- end col-md-6 -->

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/withdrawals.blade.php ENDPATH**/ ?>