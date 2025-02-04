

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.transactions'), false); ?> (<?php echo e($data->total(), false); ?>)</span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-4">

					<?php if($data->total() !=  0): ?>
					<div class="d-block mb-2 w-100">
						<!-- form -->
            <form class="mt-lg-0 mt-2 position-relative" role="search" autocomplete="off" action="<?php echo e(url('panel/admin/transactions'), false); ?>" method="get">
							<i class="bi bi-search btn-search bar-search"></i>
             <input type="text" name="q" class="form-control ps-5 w-auto" value="" placeholder="<?php echo e(__('admin.transaction_id'), false); ?>">
          </form><!-- form -->
				</div>
			<?php endif; ?>

					<div class="table-responsive p-0">
						<table class="table table-hover">
						 <tbody>

               <?php if($data->total() !=  0 && $data->count() != 0): ?>
                  <tr>
					<th class="active">ID</th>
					<th class="active"><?php echo e(__('admin.transaction_id'), false); ?></th>
					<th class="active"><?php echo e(__('general.user'), false); ?></th>
					<th class="active"><?php echo e(__('general.creator'), false); ?></th>
					<th class="active"><?php echo e(__('admin.type'), false); ?></th>
					<th class="active"><?php echo e(__('admin.amount'), false); ?></th>
					<th class="active"><?php echo e(__('admin.earnings_admin'), false); ?></th>
					<th class="active"><?php echo e(__('general.payment_gateway'), false); ?></th>
					<th class="active"><?php echo e(__('admin.date'), false); ?></th>
					<th class="active"><?php echo e(__('admin.status'), false); ?></th>
                   </tr>

                 <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									 <tr>
										<td><?php echo e(str_pad($transaction->id, 4, "0", STR_PAD_LEFT), false); ?></td>
										 <td>
											<?php if($transaction->approved == 1): ?>
											<a href="<?php echo e(url('payments/invoice', $transaction->id), false); ?> " target="_blank" title="<?php echo e(__('general.invoice'), false); ?> - <?php echo e($transaction->txn_id, false); ?>">
												<?php echo e(str_limit($transaction->txn_id, 25), false); ?>  <i class="bi-box-arrow-up-right"></i>
											</a>
											<?php else: ?>
											<?php echo e(str_limit($transaction->txn_id, 25), false); ?>

											<?php endif; ?>
										 </td>
										 <td>
											 <?php if(! isset($transaction->user()->username)): ?>
												 <em><?php echo e(__('general.no_available'), false); ?></em>
											 <?php else: ?>
												 <a href="<?php echo e(url($transaction->user()->username), false); ?>" target="_blank">
												 <?php echo e($transaction->user()->name, false); ?> <i class="bi-box-arrow-up-right"></i>
											 </a>
											 <?php endif; ?>
									 </td>
									 <td>
										 <?php if(! isset($transaction->subscribed()->username)): ?>
											 <em><?php echo e(__('general.no_available'), false); ?></em>
										 <?php else: ?>
											 <a href="<?php echo e(url($transaction->subscribed()->username), false); ?>" target="_blank">
											 <?php echo e($transaction->subscribed()->name, false); ?> <i class="bi-box-arrow-up-right"></i>
										 </a>
										 <?php endif; ?>
								 </td>
										 <td><?php echo e(__('general.'.$transaction->type), false); ?>

										 </td>
										 <td><?php echo e(Helper::amountFormatDecimal($transaction->amount), false); ?></td>
										 <td>
											 <?php echo e(Helper::amountFormatDecimal($transaction->earning_net_admin), false); ?>


											 <?php if($transaction->referred_commission): ?>
													 <i class="fa fa-info-circle text-muted showTooltip" title="<?php echo e(__('general.referral_commission_applied'), false); ?>"></i>
											 <?php endif; ?>
										 </td>
										 <td><?php echo e($transaction->payment_gateway, false); ?></td>
										 <td><?php echo e(Helper::formatDate($transaction->created_at), false); ?></td>
										 <td>
											 <?php if($transaction->approved == '0'): ?>
											 <span class="rounded-pill badge bg-warning mb-2 text-uppercase"><?php echo e(__('admin.pending'), false); ?></span>
										 <?php elseif($transaction->approved == '1'): ?>
											 <span class="rounded-pill badge bg-success mb-2 text-uppercase"><?php echo e(__('admin.approved'), false); ?></span>
										 <?php else: ?>
											 <span class="rounded-pill badge bg-danger mb-2 text-uppercase"><?php echo e(__('general.canceled'), false); ?></span>
										 <?php endif; ?>

									 <?php if($transaction->approved == '1'): ?>
												 <?php echo Form::open([
												 'method' => 'POST',
												 'url' => url('panel/admin/transactions/cancel', $transaction->id),
												 'class' => 'displayInline'
											 ]); ?>

											<?php echo Form::button(__('admin.cancel'), ['class' => 'btn btn-danger btn-sm padding-btn rounded-pill cancel_payment']); ?>


												<?php echo Form::close(); ?>

											<?php endif; ?>
											</td>
									 </tr><!-- /.TR -->
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									<?php else: ?>
										<h5 class="text-center p-5 text-muted fw-light m-0"><?php echo e(__('general.no_results_found'), false); ?></h5>
									<?php endif; ?>

								</tbody>
								</table>
							</div><!-- /.box-body -->

				 </div><!-- card-body -->
 			</div><!-- card  -->

			<?php if($data->lastPage() > 1): ?>
			<?php echo e($data->onEachSide(0)->links(), false); ?>

		<?php endif; ?>
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/transactions.blade.php ENDPATH**/ ?>