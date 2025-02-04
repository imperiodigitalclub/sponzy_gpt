<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.verification_requests'), false); ?> (<?php echo e($data->total(), false); ?>)</span>
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

			  <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-4">

					<div class="table-responsive p-0">
					<table class="table table-hover">
						<tbody>
							<?php if($data->count() !=  0): ?>
								<tr>
									<th class="active">ID</th>
									<th class="active"><?php echo e(trans('admin.user'), false); ?></th>
									<th class="active"><?php echo e(trans('general.country'), false); ?></th>
									<th class="active"><?php echo e(trans('general.image'), false); ?></th>
									<th class="active">WhatsApp</th>
									<th class="active">Instagram</th>
									<th class="active"><?php echo e(trans('admin.date'), false); ?></th>
									<th class="active"><?php echo e(trans('admin.actions'), false); ?></th>
								</tr>

								<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $verify): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($verify->id, false); ?></td>
										<td>
											<?php if(! isset($verify->user()->username)): ?>
												<em><?php echo e(trans('general.no_available'), false); ?></em>
											<?php else: ?>
												<a href="<?php echo e(url($verify->user()->username), false); ?>" target="_blank"><?php echo e($verify->user()->name, false); ?>

													<i class="bi-box-arrow-up-right ms-1"></i>
												</a>
											<?php endif; ?>
										</td>
										<td>
											<?php if(! isset($verify->user()->username) || isset($verify->user()->username) && ! isset($verify->user()->country()->country_name)): ?>
												<em><?php echo e(trans('general.no_available'), false); ?></em>
											<?php else: ?>
												<?php echo e($verify->user()->country()->country_name, false); ?>

											<?php endif; ?>
										</td>
										<td>
											<a href="<?php echo e(Helper::getFile(config('path.verification').$verify->image), false); ?>" class="glightbox" data-gallery="gallery<?php echo e($verify->id, false); ?>">
												<?php echo e(trans('admin.see_document_id'), false); ?> <i class="bi-arrows-fullscreen ms-1"></i>
											</a>
											<?php if($verify->image_reverse): ?>
												<a href="<?php echo e(Helper::getFile(config('path.verification').$verify->image_reverse), false); ?>" class="glightbox d-none" data-gallery="gallery<?php echo e($verify->id, false); ?>">
													<?php echo e(trans('admin.see_document_id'), false); ?> <i class="bi-arrows-fullscreen ms-1"></i>
												</a>
											<?php endif; ?>
											<?php if($verify->image_selfie): ?>
												<a href="<?php echo e(Helper::getFile(config('path.verification').$verify->image_selfie), false); ?>" class="glightbox d-none" data-gallery="gallery<?php echo e($verify->id, false); ?>">
													<?php echo e(trans('admin.see_document_id'), false); ?> <i class="bi-arrows-fullscreen ms-1"></i>
												</a>
											<?php endif; ?>
										</td>
										<td>
											<?php if($verify->user()->whatsapp): ?>
												<?php
													$phone = preg_replace('/\D/', '', $verify->user()->whatsapp);
													$phoneLink = 'https://wa.me/55' . $phone;
												?>
												<a href="<?php echo e($phoneLink, false); ?>" target="_blank">
													<?php echo e($verify->user()->whatsapp, false); ?> <i class="bi-box-arrow-up-right ms-1"></i>
												</a>
											<?php else: ?>
												<span class="text-muted"><em><?php echo e(__('general.not_applicable'), false); ?></em></span>
											<?php endif; ?>
										</td>
										<td>
										<?php if($verify->user()->instagram): ?>
										<?php
											$instagram = $verify->user()->instagram;
											$isLink = preg_match('/^http(s)?:\/\//', $instagram);
											$instagramLink = $isLink ? $instagram : 'https://instagram.com/' . ltrim($instagram, '@');
										?>
										<a href="<?php echo e($instagramLink, false); ?>" target="_blank">
											<?php echo e($verify->user()->instagram, false); ?> <i class="bi-box-arrow-up-right ms-1"></i>
										</a>
										<?php else: ?>
											<span class="text-muted"><em><?php echo e(__('general.not_applicable'), false); ?></em></span>
										<?php endif; ?>
										</td>
										<td><?php echo e(Helper::formatDate($verify->created_at), false); ?></td>
										<td>
											<?php if($verify->status == 'pending'): ?>
												<div class="d-flex">
													<?php if(isset($verify->user()->username)): ?>
														<?php echo Form::open([
															'method' => 'POST',
															'url' => url('panel/admin/verification/members/approve', $verify->id).'/'.$verify->user_id,
															'class' => 'displayInline'
														]); ?>

														<?php echo Form::button('<i class="bi-check2"></i>', ['class' => 'btn btn-success btn-sm rounded-pill actionApprove me-2', 'title' => trans('admin.approve')]); ?>

														<?php echo Form::close(); ?>

													<?php endif; ?>
													<?php echo Form::open([
														'method' => 'POST',
														'url' => url('panel/admin/verification/members/delete', $verify->id).'/'.$verify->user_id,
														'class' => 'displayInline'
													]); ?>

													<?php echo Form::button('<i class="bi-x"></i>', ['class' => 'btn btn-danger btn-sm rounded-pill actionDeleteVerification', 'title' => trans('admin.reject')]); ?>

													<?php echo Form::close(); ?>

												</div>
											<?php else: ?>
												<span class="rounded-pill badge bg-success"><?php echo e(trans('admin.approved'), false); ?></span>
											<?php endif; ?>
										</td>
									</tr>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/verification.blade.php ENDPATH**/ ?>