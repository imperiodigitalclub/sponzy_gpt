

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.pages'), false); ?> (<?php echo e($data->count(), false); ?>)</span>

			<a href="<?php echo e(url('panel/admin/pages/create'), false); ?>" class="btn btn-sm btn-dark float-lg-end mt-1 mt-lg-0">
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
                        <th class="active"><?php echo e(trans('admin.title'), false); ?></th>
                        <th class="active"><?php echo e(trans('admin.slug'), false); ?></th>
												<th class="active"><?php echo e(trans('general.access'), false); ?></th>
                        <th class="active"><?php echo e(trans('admin.actions'), false); ?></th>
                      </tr>

                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($page->id, false); ?></td>
                        <td><?php echo e($page->title, false); ?> <span class="badge rounded-pill bg-secondary text-uppercase"><?php echo e($page->lang, false); ?></span></td>
                        <td><?php echo e(strtolower($page->slug), false); ?></td>
												<td>
	                        <?php switch($page->access):
	                          case ('all'): ?>
	                              <?php echo e(__('general.all'), false); ?>

	                              <?php break; ?>

	                          <?php case ('members'): ?>
	                              <?php echo e(__('admin.only_users'), false); ?>

	                              <?php break; ?>

	                          <?php case ('creators'): ?>
	                            <?php echo e(__('general.only_creators'), false); ?>

	                      <?php endswitch; ?>
	                      </td>
                        <td>
													<div class="d-flex">
                        	<a href="<?php echo e(url('panel/admin/pages/edit', $page->id), false); ?>" class="btn btn-success rounded-pill btn-sm me-2">
                        		<i class="bi-pencil"></i>
                        	</a>

                  <?php if($data->count() != 1): ?>

                     <?php echo Form::open([
  			            'method' => 'POST',
  			            'url' => url('panel/admin/pages', $page->id),
  			            'id' => 'form'.$page->id,
  			            'class' => 'd-inline-block align-top'
  				        ]); ?>

  	            	<?php echo Form::button('<i class="bi-trash-fill"></i>', ['data-url' => $page->id, 'class' => 'btn btn-danger btn-sm rounded-pill actionDelete']); ?>

  	        			<?php echo Form::close(); ?>


                        		<?php endif; ?>

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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/pages.blade.php ENDPATH**/ ?>