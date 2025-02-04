

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.subscriptions'), false); ?> (<?php echo e($data->total(), false); ?>)</span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-4">

					<div class="table-responsive p-0">
						<table class="table table-hover">
						 <tbody>

               <?php if($data->total() !=  0 && $data->count() != 0): ?>
                  <tr>
                     <th class="active">ID</th>
										 <th class="active"><?php echo e(trans('general.subscriber'), false); ?></th>
										 <th class="active"><?php echo e(trans('general.creator'), false); ?></th>
										 <th class="active"><?php echo e(trans('admin.date'), false); ?></th>
										 <th class="active"><?php echo e(trans('admin.status'), false); ?></th>
                   </tr>

                 <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									 <tr>
										 <td><?php echo e($subscription->id, false); ?></td>
										 <td>
											 <?php if( ! isset($subscription->user()->username)): ?>
												 <?php echo e(trans('general.no_available'), false); ?>

											 <?php else: ?>
											 <a href="<?php echo e(url($subscription->user()->username), false); ?>" target="_blank">
												 <?php echo e($subscription->user()->name, false); ?>

											 </a>
											 <?php endif; ?>
										 </td>
										 <td>
											 <?php if( ! isset($subscription->subscribed()->username)): ?>
												 <?php echo e(trans('general.no_available'), false); ?>

											 <?php else: ?>
											 <a href="<?php echo e(url($subscription->subscribed()->username), false); ?>" target="_blank">
												 <?php echo e($subscription->subscribed()->name, false); ?> <i class="fa fa-external-link-square"></i>
											 </a>
										 <?php endif; ?>
										 </td>
										 <td><?php echo e(Helper::formatDate($subscription->created_at), false); ?></td>
										 <td>
											 <?php if($subscription->stripe_id == ''
												 && strtotime($subscription->ends_at) > strtotime(now()->format('Y-m-d H:i:s'))
												 && $subscription->cancelled == 'no'
													 || $subscription->stripe_id != '' && $subscription->stripe_status == 'active'
													 || $subscription->stripe_id == '' && $subscription->free == 'yes'
												 ): ?>
												 <span class="rounded-pill badge bg-success"><?php echo e(trans('general.active'), false); ?></span>
											 <?php elseif($subscription->stripe_id != '' && $subscription->stripe_status == 'incomplete'): ?>
												 <span class="rounded-pill badge bg-warning"><?php echo e(trans('general.incomplete'), false); ?></span>
											 <?php else: ?>
												 <span class="rounded-pill badge bg-danger"><?php echo e(trans('general.cancelled'), false); ?></span>
											 <?php endif; ?>
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
			<?php echo e($data->onEachSide(0)->links(), false); ?>

		<?php endif; ?>
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/subscriptions.blade.php ENDPATH**/ ?>