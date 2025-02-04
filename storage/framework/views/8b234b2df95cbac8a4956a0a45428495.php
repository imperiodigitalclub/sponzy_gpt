

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.reports'), false); ?> (<?php echo e($data->count(), false); ?>)</span>
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

               <?php if($data->count() !=  0): ?>
                  <tr>
                     <th class="active">ID</th>
                     <th class="active"><?php echo e(__('admin.report_by'), false); ?></th>
                     <th class="active"><?php echo e(__('admin.reported'), false); ?></th>
					 <th class="active"><?php echo e(__('admin.type'), false); ?></th>
					 <th class="active"><?php echo e(__('general.message'), false); ?></th>
                     <th class="active"><?php echo e(__('admin.reason'), false); ?></th>
                     <th class="active"><?php echo e(__('admin.date'), false); ?></th>
                     <th class="active"><?php echo e(__('admin.actions'), false); ?></th>
                   </tr>

                 <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($report->id, false); ?></td>
						<td><a href="<?php echo e(url($report->user()->username), false); ?>" target="_blank"><?php echo e($report->user()->name, false); ?> <i class="fa fa-external-link-square-alt"></i></a></td>

						<td>
							<?php switch($report->type):
								case ('user'): ?>
									<a href="<?php echo e(url('panel/admin/members/edit', $report->report_id), false); ?>" target="_blank">
										<?php echo e(str_limit($report->userReported()->name, 15, '...'), false); ?> <i class="fa fa-external-link-square-alt"></i>
									</a>
									<?php break; ?>

								<?php case ('update'): ?>
									<a href="<?php echo e(url($report->updates()->user()->username.'/post', $report->report_id), false); ?>" target="_blank">
										<?php echo e(str_limit($report->updates()->description, 40, '...'), false); ?> <i class="fa fa-external-link-square-alt"></i>
									</a>
									<?php break; ?>
							
								<?php case ('item'): ?>
									<a href="<?php echo e(url('shop/product', $report->report_id), false); ?>" target="_blank">
										<?php echo e(str_limit($report->products()->name, 40, '...'), false); ?> <i class="fa fa-external-link-square-alt"></i>
									</a>
									<?php break; ?>

								<?php case ('live'): ?>
									<a href="<?php echo e(url('live', $report->live()->username), false); ?>" target="_blank">
										<?php echo e(str_limit($report->live()->name, 40, '...'), false); ?> <i class="fa fa-external-link-square-alt"></i>
									</a>
									<?php break; ?>								
						<?php endswitch; ?>
					</td>

					<td>
						<?php switch($report->type):
							case ('user'): ?>
								<?php echo e(__('admin.user'), false); ?>

								<?php break; ?>

							<?php case ('update'): ?>
								<?php echo e(__('general.post'), false); ?>

								<?php break; ?>

							<?php case ('item'): ?>
								<?php echo e(__('general.item'), false); ?>

								<?php break; ?>							

							<?php case ('live'): ?>
								<?php echo e(__('general.live'), false); ?>

								<?php break; ?>
						<?php endswitch; ?>
					</td>

					<td>
						<?php echo e($report->message ?? '--', false); ?>

					</td>

					<?php
						switch ($report->reason) {
							case 'copyright':
								$reason = __('admin.copyright');
								break;

							case 'privacy_issue':
								$reason = __('admin.privacy_issue');
								break;

								case 'violent_sexual':
									$reason = __('admin.violent_sexual_content');
									break;

									case 'spoofing':
										$reason = __('admin.spoofing');
										break;

										case 'spam':
											$reason = __('general.spam');
											break;

											case 'fraud':
												$reason = __('general.fraud');
												break;

												case 'under_age':
													$reason = __('general.under_age');
													break;

													case 'item_not_received':
														$reason = __('general.item_not_received');
														break;
						}
					?>

						<td><?php echo e($reason, false); ?></td>

						<td><?php echo e(Helper::formatDate($report->created_at), false); ?></td>
						<td>


							<?php echo Form::open([
							'method' => 'POST',
							'url' => url('panel/admin/reports/delete',$report->id),
							'class' => 'displayInline'
						]); ?>

					<?php echo Form::button('<i class="bi-trash-fill"></i>', ['class' => 'btn btn-danger rounded-pill btn-sm actionDelete']); ?>


						<?php echo Form::close(); ?>


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

	</div><!-- col-lg-12 -->
</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/reports.blade.php ENDPATH**/ ?>