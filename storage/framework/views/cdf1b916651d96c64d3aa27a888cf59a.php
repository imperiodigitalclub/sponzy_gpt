

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <a class="text-reset" href="<?php echo e(url('panel/admin/withdrawals'), false); ?>"><?php echo e(__('general.withdrawals'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      #<?php echo e($data->id, false); ?>

  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-5">

             <dl class="row">
              <dt class="col-sm-2 text-lg-end"><?php echo e(__('admin.user'), false); ?></dt>
              <dd class="col-sm-10">
                <?php if(isset($data->user()->username)): ?>
                    <a href="<?php echo e(url($data->user()->username), false); ?>" target="_blank">
                    <?php echo e($data->user()->username, false); ?> <i class="bi-box-arrow-up-right"></i>
                  </a>
                        <?php else: ?>
                            <?php echo e(__('general.no_available'), false); ?>

                    <?php endif; ?>
                </dd>

              <?php if($data->gateway == 'PayPal'): ?>
              <dt class="col-sm-2 text-lg-end"><?php echo e(__('admin.paypal_account'), false); ?></dt>
              <dd class="col-sm-10"><?php echo e($data->account, false); ?></dd>
              <?php elseif($data->gateway == 'Payoneer'): ?>
              <dt class="col-sm-2 text-lg-end"><?php echo e(__('general.payoneer_account'), false); ?></dt>
              <dd class="col-sm-10"><?php echo e($data->account, false); ?></dd>
              <?php elseif($data->gateway == 'Zelle'): ?>
              <dt class="col-sm-2 text-lg-end"><?php echo e(__('general.zelle_account'), false); ?></dt>
              <dd class="col-sm-10"><?php echo e($data->account, false); ?></dd>
              <?php elseif($data->gateway == 'Western Union'): ?>
              <dt class="col-sm-2 text-lg-end"><?php echo e(__('auth.full_name'), false); ?></dt>
              <dd class="col-sm-10"><?php echo e($data->user()->name ?? __('general.no_available'), false); ?></dd>
              <dt class="col-sm-2 text-lg-end"><?php echo e(__('general.country'), false); ?></dt>
              <dd class="col-sm-10"><?php echo e(isset($data->user()->countries_id) != '' ? $data->user()->country()->country_name : __('general.no_available'), false); ?></dd>
              <dt class="col-sm-2 text-lg-end"><?php echo e(__('general.document_id'), false); ?></dt>
              <dd class="col-sm-10"><?php echo e($data->account, false); ?></dd>
              <?php elseif($data->gateway == 'Bitcoin'): ?>
              <dt class="col-sm-2 text-lg-end"><?php echo e(__('general.bitcoin_wallet'), false); ?></dt>
              <dd class="col-sm-10"><?php echo e($data->account, false); ?></dd>
              <?php elseif($data->gateway == 'Mercado Pago'): ?>
              <dt class="col-sm-2 text-lg-end">Alias MP</dt>
              <dd class="col-sm-10"><?php echo e($data->account, false); ?></dd>
              <dt class="col-sm-2 text-lg-end">No. CVU</dt>
              <dd class="col-sm-10"><?php echo e($data->user()->cvu ?? __('general.no_available'), false); ?></dd>
              <?php else: ?>
              <dt class="col-sm-2 text-lg-end"><?php echo e(__('general.bank_details'), false); ?></dt>
              <dd class="col-sm-10"><?php echo Helper::checkText($data->account); ?></dd>
            <?php endif; ?>

            <dt class="col-sm-2 text-lg-end"><?php echo e(__('admin.amount'), false); ?></dt>
            <dd class="col-sm-10"><?php echo e(Helper::amountFormatDecimal($data->amount), false); ?></dd>

            <dt class="col-sm-2 text-lg-end"><?php echo e(__('admin.date'), false); ?></dt>
            <dd class="col-sm-10"><?php echo e(date('d M, Y', strtotime($data->date)), false); ?></dd>

            <dt class="col-sm-2 text-lg-end"><?php echo e(__('admin.status'), false); ?></dt>
            <dd class="col-sm-10"><span class="badge bg-<?php echo e($data->status == 'paid' ? 'success' : 'warning', false); ?>"><?php echo e($data->status == 'paid' ? __('general.paid') : __('general.pending_to_pay'), false); ?></span></dd>

            <?php if($data->status == 'paid'): ?>
            <dt class="col-sm-2 text-lg-end"><?php echo e(__('general.date_paid'), false); ?></dt>
            <dd class="col-sm-10"><?php echo e(date('d M, Y', strtotime($data->date_paid)), false); ?></dd>
          <?php endif; ?>

            </dl>

            <?php if($data->status == 'pending' && isset($data->user()->username)): ?>
            <form method="POST" action="<?php echo e(url('panel/admin/withdrawals/paid', $data->id), false); ?>" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
						<div class="row mb-3">
		          <div class="col-sm-10 offset-sm-2">
		            <button type="submit" class="btn btn-success mt-3 px-5"><?php echo e(__('general.mark_paid'), false); ?></button>
		          </div>
		        </div>
            </form>
          <?php endif; ?>

				 </div><!-- card-body -->
 			</div><!-- card  -->
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/withdrawal-view.blade.php ENDPATH**/ ?>