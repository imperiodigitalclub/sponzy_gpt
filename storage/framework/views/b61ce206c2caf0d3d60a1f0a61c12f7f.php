

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('general.blog'), false); ?></span>

			<a href="<?php echo e(url('panel/admin/blog/create'), false); ?>" class="btn btn-sm btn-dark float-lg-end mt-1 mt-lg-0">
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

                  <?php if($data->count() !=  0): ?>
                     <tr>
											 <th class="active">ID</th>
											 <th class="active"><?php echo e(trans('general.title'), false); ?></th>
											 <th class="active"><?php echo e(trans('admin.date'), false); ?></th>
											 <th class="active"><?php echo e(trans('admin.actions'), false); ?></th>
                      </tr>

                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($blog->id, false); ?></td>
                        <td><a href="<?php echo e(url('blog/post', $blog->id).'/'.$blog->slug, false); ?>" title="<?php echo e($blog->title, false); ?>" target="_blank"><?php echo e($blog->title, false); ?> <i class="bi-box-arrow-up-right"></i></a></td>
                        <td><?php echo e(date('d M, Y', strtotime($blog->date)), false); ?></td>
                        <td>
                        	<div class="d-flex">
														<a href="<?php echo e(url('panel/admin/blog', $blog->id), false); ?>" class="btn btn-success rounded-pill btn-sm me-2">
	                        		<i class="bi-pencil"></i>
	                        	</a>

														<?php echo Form::open([
		        			            'method' => 'post',
		        			            'url' => url('panel/admin/blog/delete', $blog->id),
		        			            'class' => 'displayInline'
		        				        ]); ?>

		        	            	<?php echo Form::button('<i class="bi-trash-fill"></i>', ['class' => 'btn btn-danger rounded-pill btn-sm actionDeleteBlog']); ?>

		        	        	<?php echo Form::close(); ?>


													</div>

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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/blog.blade.php ENDPATH**/ ?>