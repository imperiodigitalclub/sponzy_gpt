

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('general.posts'), false); ?> (<?php echo e($data->total(), false); ?>)</span>
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

					<?php if($data->total() !=  0 && $data->count() != 0): ?>
					<div class="d-lg-flex justify-content-lg-between align-items-center mb-2 w-100">
						<form action="<?php echo e(url('panel/admin/posts'), false); ?>" id="formSort" method="get">
							 <select name="sort" id="sort" class="form-select d-inline-block w-auto filter">
									<option <?php if($sort == ''): ?> selected="selected" <?php endif; ?> value=""><?php echo e(__('admin.sort_id'), false); ?></option>
									<option <?php if($sort == 'pending'): ?> selected="selected" <?php endif; ?> value="pending"><?php echo e(__('admin.pending'), false); ?></option>
								</select>
								</form><!-- form -->
						</div>
						<?php endif; ?>

					<div class="table-responsive p-0">
						<table class="table table-hover">
						 <tbody>

							<?php if($data->count() !=  0): ?>
								 <tr>
									  <th class="active">ID</th>
										<th class="active"><?php echo e(__('admin.description'), false); ?></th>
										<th class="active"><?php echo e(__('admin.content'), false); ?></th>
										<th class="active"><?php echo e(__('admin.type'), false); ?></th>
										<th class="active"><?php echo e(__('general.creator'), false); ?></th>
										<th class="active"><?php echo e(__('admin.date'), false); ?></th>
										<th class="active"><?php echo e(__('admin.status'), false); ?></th>
										<th class="active"><?php echo e(__('admin.actions'), false); ?></th>
									</tr>

								<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<?php
										$allFiles = $post->media()->groupBy('type')->get();
									?>

									<tr>
										<td><?php echo e($post->id, false); ?></td>
										<td><?php echo e(str_limit($post->description, 40, '...'), false); ?></td>

										<td>
											<?php if($allFiles->count() != 0): ?>
												<?php $__currentLoopData = $allFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

													<?php if($media->type == 'image'): ?>
														<i class="far fa-image"></i>
													<?php endif; ?>

													<?php if($media->type == 'video'): ?>
														<i class="far fa-play-circle"></i>
													<?php endif; ?>

													<?php if($media->type == 'music'): ?>
														<i class="fa fa-microphone"></i>
														<?php endif; ?>

														<?php if($media->type == 'file'): ?>
													<i class="far fa-file-archive"></i>
													<?php endif; ?>

													<?php if($media->type == 'epub'): ?>
													<i class="fas fa-book-open"></i>
													<?php endif; ?>

												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											<?php else: ?>
												<i class="fa fa-font"></i>
											<?php endif; ?>
										</td>

										<td><?php echo e($post->locked == 'yes' ? __('users.content_locked') : __('general.public'), false); ?></td>
										<td>
											<?php if(isset($post->user()->username)): ?>
												<a href="<?php echo e(url($post->user()->username), false); ?>" target="_blank">
													<?php echo e($post->user()->username, false); ?> <i class="fa fa-external-link-square-alt"></i>
												</a>
											<?php else: ?>
												<em><?php echo e(__('general.no_available'), false); ?></em>
											<?php endif; ?>

											</td>
										<td><?php echo e(Helper::formatDate($post->date), false); ?></td>
										<td>
											<?php switch($post->status):
												case ('active'): ?>
												<span class="rounded-pill badge bg-success">
													<?php echo e(__('admin.active'), false); ?>

												</span>
													<?php break; ?>

												<?php case ('pending'): ?>
													<span class="rounded-pill badge bg-warning">
													<?php echo e(__('admin.pending'), false); ?>

													</span>
													<?php break; ?>

												<?php case ('encode'): ?>
												<span class="rounded-pill badge bg-info">
													<?php echo e(__('general.encode'), false); ?>

													</span>
													<?php break; ?>

												<?php case ('schedule'): ?>
												<span class="rounded-pill badge bg-info">
													<?php echo e(__('general.scheduled'), false); ?>

													</span>
													<a tabindex="0" role="button" data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="<?php echo e(__('general.date_schedule'), false); ?> <?php echo e(Helper::formatDateSchedule($post->scheduled_date), false); ?>">
														<i class="far fa-question-circle"></i>
													  </a>
													<?php break; ?>
											<?php endswitch; ?>
											</td>
										<td>
											<div class="d-flex">
											<?php if(isset($post->user()->username) && $post->status != 'encode'): ?>
											<a href="<?php echo e(url($post->user()->username, 'post').'/'.$post->id, false); ?>" target="_blank" class="btn btn-success btn-sm rounded-pill me-2" title="<?php echo e(__('admin.view'), false); ?>">
												<i class="bi-eye"></i>
											</a>
										<?php endif; ?>

											<?php if($post->status == 'pending'): ?>
											<?php echo Form::open([
												'method' => 'POST',
												'url' => "panel/admin/posts/approve/$post->id",
												'class' => 'displayInline'
											]); ?>


											<?php echo Form::button(__('admin.approve'), ['class' => 'btn btn-success btn-sm padding-btn rounded-pill me-2 actionApprovePost']); ?>

											<?php echo Form::close(); ?>

											<?php endif; ?>

										 <?php echo Form::open([
											 'method' => 'POST',
											 'url' => "panel/admin/posts/delete/$post->id",
											 'class' => 'displayInline'
										 ]); ?>


										 <?php if($post->status == 'active' || $post->status == 'encode' || $post->status == 'schedule'): ?>
											 <?php echo Form::button('<i class="bi-trash-fill"></i>', ['class' => 'btn btn-danger btn-sm padding-btn rounded-pill actionDelete']); ?>


										 <?php else: ?>
											 <?php echo Form::button(__('general.reject'), ['class' => 'btn btn-danger btn-sm padding-btn rounded-pill actionDeletePost']); ?>

										 <?php endif; ?>

										 <?php echo Form::close(); ?>


									 </div>

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
			<?php echo e($data->appends(['sort' => $sort])->onEachSide(0)->links(), false); ?>

		<?php endif; ?>
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/posts.blade.php ENDPATH**/ ?>