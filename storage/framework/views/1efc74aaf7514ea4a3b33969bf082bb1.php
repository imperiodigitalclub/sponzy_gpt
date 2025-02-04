

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('general.withdrawals'), false); ?> (<?php echo e($data->total(), false); ?>)</span>
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

					<div class="table-responsive p-0">
						<table class="table table-hover">
						 <tbody>

               <?php if($data->total() !=  0 && $data->count() != 0): ?>
                  <tr>
                     <th class="active">ID</th>
             <th class="active"><?php echo e(trans('admin.user'), false); ?></th>
               <th class="active"><?php echo e(trans('admin.amount'), false); ?></th>
               <th class="active"><?php echo e(trans('admin.method'), false); ?></th>
               <th class="active"><?php echo e(trans('admin.status'), false); ?></th>
               <th class="active"><?php echo e(trans('admin.date'), false); ?></th>
               <th class="active"><?php echo e(trans('admin.actions'), false); ?></th>
                   </tr><!-- /.TR -->

            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                   <tr>
                     <td><?php echo e($withdrawal->id, false); ?></td>
                     <td>
                       <?php if(isset($withdrawal->user()->username)): ?>
                           
                       <a href="<?php echo e(url($withdrawal->user()->username), false); ?>" target="_blank">
                        <?php echo e($withdrawal->user()->username, false); ?> <i class="bi-box-arrow-up-right"></i>
                      </a>
                           <?php else: ?>
                               <?php echo e(__('general.no_available'), false); ?>

                       <?php endif; ?>
                       
                       </td>
                     <td><?php echo e(Helper::amountFormatDecimal($withdrawal->amount), false); ?></td>
                     <td><?php echo e($withdrawal->gateway == 'Bank' ? trans('general.bank_transfer') : $withdrawal->gateway, false); ?></td>
                     <td>
                       <?php if($withdrawal->status == 'paid'): ?>
                       <span class="badge bg-success"><?php echo e(trans('general.paid'), false); ?></span>
                       <?php else: ?>
                       <span class="badge bg-warning"><?php echo e(trans('general.pending_to_pay'), false); ?></span>
                       <?php endif; ?>
                     </td>
                     <td><?php echo e(date('d M, Y', strtotime($withdrawal->date)), false); ?></td>
                     <td>

                       <a href="<?php echo e(url('panel/admin/withdrawal',$withdrawal->id), false); ?>" class="btn btn-1 btn-sm btn-outline-dark" title="<?php echo e(trans('admin.view'), false); ?>">
                        <i class="bi-eye me-1"></i>  <?php echo e(trans('admin.view'), false); ?>

                       </a>
                       </td>

                   </tr><!-- /.TR -->
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									<?php else: ?>
										<h5 class="text-center p-5 text-muted fw-light m-0"><?php echo e(trans('general.no_results_found'), false); ?></h5>
									<?php endif; ?>

								</tbody>
								</table>
							</div><!-- /.box-body -->

				 </div><!-- card-body -->
 			</div><!-- card  -->

			<?php if($data->lastPage() > 1): ?>
			<?php echo e($data->links(), false); ?>

		<?php endif; ?>
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/withdrawals.blade.php ENDPATH**/ ?>