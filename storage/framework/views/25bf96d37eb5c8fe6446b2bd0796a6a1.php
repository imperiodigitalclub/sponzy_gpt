

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
		          <label class="col-sm-2 col-form-label text-lg-end">Merchant ID</label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($data->key, false); ?>" name="key" type="text" class="form-control">
                <small class="d-block"><a href="https://www.coinpayments.net/acct-settings" target="_blank">https://www.coinpayments.net/acct-settings</a></small>
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end">IPN Secret Key</label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($data->key_secret, false); ?>" name="key_secret" type="password" class="form-control">
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/coinpayments-settings.blade.php ENDPATH**/ ?>