

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('general.tax_rates'), false); ?></span>

			<a href="<?php echo e(url('panel/admin/tax-rates/add'), false); ?>" class="btn btn-sm btn-dark float-lg-end mt-1 mt-lg-0">
				<i class="bi-plus-lg"></i> <?php echo e(trans('general.add_new'), false); ?>

			</a>
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

							<?php if($taxes->count() !=  0): ?>
								 <tr>
										<th class="active"><?php echo e(trans('admin.name'), false); ?></th>
										<th class="active"><?php echo e(trans('general.country'), false); ?></th>
										<th class="active"><?php echo e(trans('general.percentage'), false); ?></th>
										<th class="active"><?php echo e(trans('admin.status'), false); ?></th>
										<th class="active"><?php echo e(trans('admin.actions'), false); ?></th>
									</tr>

								<?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($tax->name, false); ?></td>
										<td><?php echo e($tax->country()->country_name, false); ?> <?php if($tax->state): ?> - <?php echo e($tax->state, false); ?> <?php endif; ?></td>
										<td><?php echo e($tax->percentage, false); ?></td>
										<td><span class="badge rounded-pill bg-<?php echo e($tax->status ? 'success' : 'secondary', false); ?>">
											<?php echo e($tax->status ? trans('general.enabled') : trans('general.disabled'), false); ?></span>
										</td>
										<td>
											<a href="<?php echo e(url('panel/admin/tax-rates/edit', $tax->id), false); ?>" class="btn btn-success rounded-pill btn-sm">
											 <i class="bi-pencil"></i>
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
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/tax-rates.blade.php ENDPATH**/ ?>