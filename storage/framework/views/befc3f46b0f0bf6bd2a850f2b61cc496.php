

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('general.deposits'), false); ?> (<?php echo e($data->total(), false); ?>)</span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

			<?php if(session('success_message')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check2 me-1"></i>	<?php echo e(session('success_message'), false); ?>


                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i class="bi bi-x-lg"></i>
                </button>
                </div>
              <?php endif; ?>

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-4">

					<?php if($data->total() != 0): ?>
					<div class="d-block mb-2 w-100">
						<!-- form -->
						<form class="mt-lg-0 mt-2 position-relative" role="search" autocomplete="off" action="<?php echo e(url('panel/admin/deposits'), false); ?>" method="get">
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
                     <th class="active"><?php echo e(__('admin.user'), false); ?></th>
                     <th class="active"><?php echo e(__('admin.transaction_id'), false); ?></th>
                     <th class="active"><?php echo e(__('admin.amount'), false); ?></th>
                     <th class="active"><?php echo e(__('general.payment_gateway'), false); ?></th>
                     <th class="active"><?php echo e(__('admin.date'), false); ?></th>
										 <th class="active"><?php echo e(__('admin.status'), false); ?></th>
                   </tr><!-- /.TR -->


                 <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                     <td><?php echo e($deposit->id, false); ?></td>
                     <td>
						<?php if(isset($deposit->user()->username)): ?>
						<a href="<?php echo e(url($deposit->user()->username), false); ?>" target="_blank">
							<?php echo e($deposit->user()->username, false); ?> <i class="bi-box-arrow-up-right"></i>
						</a>
					<?php else: ?>
						<?php echo e(__('general.no_available'), false); ?>

					<?php endif; ?>
						</td>
                     <td>
						<?php if($deposit->status == 'pending'): ?>
							<?php echo e($deposit->txn_id, false); ?> 
						<?php else: ?>
						<a href="<?php echo e(url('deposits/invoice', $deposit->id), false); ?> " target="_blank" title="<?php echo e(__('general.invoice'), false); ?>">
							<?php echo e($deposit->txn_id, false); ?>  <i class="bi-box-arrow-up-right"></i>
						</a>
						<?php endif; ?>
					</td>
                     <td><?php echo e(Helper::amountFormat($deposit->amount), false); ?></td>
                     <td><?php echo e($deposit->payment_gateway, false); ?></td>
                     <td><?php echo e(date('d M, Y', strtotime($deposit->date)), false); ?></td>

					<td>
						<span class="rounded-pill badge bg-<?php echo e($deposit->status == 'pending' ? 'warning' : 'success', false); ?> text-uppercase"><?php echo e($deposit->status == 'pending' ? __('admin.pending') : __('general.success'), false); ?></span>
						<?php if($deposit->payment_gateway == 'Bank Transfer' || $deposit->payment_gateway == 'Bank'): ?>
						<a href="<?php echo e(url('panel/admin/deposits', $deposit->id), false); ?>" class="btn btn-success btn-sm rounded-pill" title="<?php echo e(__('admin.view'), false); ?>">
							<i class="bi-eye"></i>
						</a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/deposits.blade.php ENDPATH**/ ?>