

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.payment_settings'), false); ?></span>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e($data->name, false); ?></span>
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
				<div class="card-body p-lg-5">

					 <form method="POST" action="<?php echo e(url()->current(), false); ?>" enctype="multipart/form-data">
             <?php echo csrf_field(); ?>

		        <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('admin.fee'), false); ?></label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($data->fee, false); ?>" name="fee" type="text" class="form-control">
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('admin.fee_cents'), false); ?></label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($data->fee_cents, false); ?>" name="fee_cents" type="text" class="form-control">
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end">Consumer Key</label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($data->key, false); ?>" name="key" type="text" class="form-control">
		          </div>
		        </div>

				<div class="row mb-3">
					<label class="col-sm-2 col-form-label text-lg-end">Consumer Secret</label>
					<div class="col-sm-10">
					  <input value="<?php echo e($data->key_secret, false); ?>" name="key_secret" type="text" class="form-control">
					</div>
				  </div>

				  <div class="row mb-3">
					<label class="col-sm-2 col-form-label text-lg-end">Project ID</label>
					<div class="col-sm-10">
					  <input value="<?php echo e($data->project_id, false); ?>" name="project_id" type="text" class="form-control">
					</div>
				  </div>

				  <div class="row mb-3">
					<label class="col-sm-2 col-form-label text-lg-end">Project Secret</label>
					<div class="col-sm-10">
					  <input value="<?php echo e($data->project_secret, false); ?>" name="project_secret" type="text" class="form-control">
					</div>
				  </div>

            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(trans('admin.status'), false); ?></legend>
              <div class="col-sm-10">
                <div class="form-check form-switch form-switch-md">
                 <input class="form-check-input" type="checkbox" name="enabled" <?php if($data->enabled): ?> checked="checked" <?php endif; ?> value="1" role="switch">
               </div>
              </div>
            </fieldset>

				<fieldset class="row mb-3">
		          <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(trans('admin.subscription'), false); ?></legend>
		          <div class="col-sm-10">
		            <div class="form-check">
		              <input class="form-check-input" type="radio" name="subscription" id="radio1" <?php if($data->subscription == 'yes'): ?> checked="checked" <?php endif; ?> value="yes">
		              <label class="form-check-label" for="radio1">
		                <?php echo e(trans('admin.active'), false); ?>

		              </label>
		            </div>
		            <div class="form-check">
		              <input class="form-check-input" type="radio" name="subscription" id="radio2" <?php if($data->subscription == 'no'): ?> checked="checked" <?php endif; ?> value="no">
		              <label class="form-check-label" for="radio2">
		                <?php echo e(trans('admin.disabled'), false); ?>

		              </label>
		            </div>
								<small class="d-block"><?php echo e(trans('general.note_disable_subs_payment'), false); ?></small>
		          </div>
		        </fieldset><!-- end row -->

						<div class="row mb-3">
		          <div class="col-sm-10 offset-sm-2">
		            <button type="submit" class="btn btn-dark mt-3 px-5"><?php echo e(__('admin.save'), false); ?></button>
		          </div>
		        </div>

		       </form>

				 </div><!-- card-body -->
 			</div><!-- card  -->
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/cardinity-settings.blade.php ENDPATH**/ ?>