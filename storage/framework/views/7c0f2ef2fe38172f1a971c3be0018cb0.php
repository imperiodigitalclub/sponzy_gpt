

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.maintenance_mode'), false); ?></span>
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
				<div class="card-body p-lg-5">

					 <form method="POST" action="<?php echo e(url('panel/admin/maintenance/mode'), false); ?>" enctype="multipart/form-data">
						 <?php echo csrf_field(); ?>

				<fieldset class="row mb-3">
 		          <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('admin.maintenance_mode'), false); ?></legend>
 		          <div class="col-sm-10">
 		            <div class="form-check form-switch form-switch-md">
 		             <input class="form-check-input" type="checkbox" name="maintenance_mode" <?php if($settings->maintenance_mode == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
 		           </div>
 		          </div>
 		        </fieldset><!-- end row -->

						<div class="row mb-3">
		          <div class="col-sm-10 offset-sm-2">
		            <button type="submit" class="btn btn-dark mt-3 px-5"><?php echo e(__('admin.save'), false); ?></button>

					<a href="<?php echo e(url('panel/admin/clear-cache'), false); ?>" class="btn btn-link text-reset mt-3 px-3 e-none text-decoration-none">
						<i class="bi-trash-fill me-1"></i> <?php echo e(__('general.clear_cache'), false); ?> 

						<?php if(file_exists(storage_path("logs".DIRECTORY_SEPARATOR."laravel.log"))): ?>
						<small class="w-100 d-block">
							(Log File: <?php echo e(Helper::formatBytes(filesize(storage_path("logs".DIRECTORY_SEPARATOR."laravel.log"))), false); ?>)
						</small>
						<?php endif; ?>
						
					</a>
		          </div>
		        </div>

		       </form>

				 </div><!-- card-body -->
 			</div><!-- card  -->
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/maintenance_mode.blade.php ENDPATH**/ ?>