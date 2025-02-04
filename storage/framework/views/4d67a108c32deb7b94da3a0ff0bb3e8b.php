<?php $__env->startSection('title'); ?> <?php echo e(__('auth.password'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="iconmoon icon-Key mr-2"></i> <?php echo e(__('auth.password'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(__('auth.update_your_password'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if(session('status')): ?>
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                			<span aria-hidden="true">×</span>
                			</button>

                    <?php echo e(session('status'), false); ?>

                  </div>
                <?php endif; ?>

                <?php if(session('incorrect_pass')): ?>
 			<div class="alert alert-danger">
 				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             		<?php echo e(session('incorrect_pass'), false); ?>

             		</div>
             	<?php endif; ?>

          <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <form method="POST" action="<?php echo e(url('settings/password'), false); ?>">

            <?php echo csrf_field(); ?>

            <?php if(auth()->user()->password != ''): ?>
            <div class="form-group">
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="feather icon-unlock"></i></span>
                  </div>
                  <input class="form-control" name="old_password" placeholder="<?php echo e(__('general.old_password'), false); ?>" type="password" required>
                </div>
              </div>
              <?php endif; ?>

              <div class="form-group">
                  <div class="input-group mb-4" id="showHidePassword">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="feather icon-lock"></i></span>
                    </div>
                    <input class="form-control" name="new_password" placeholder="<?php echo e(__('general.new_password'), false); ?>" type="password" required>
                    <div class="input-group-append">
                      <span class="input-group-text c-pointer"><i class="feather icon-eye-off"></i></span>
                  </div>
                  </div>
                </div>

                <button class="btn btn-1 btn-success btn-block buttonActionSubmit" type="submit"><?php echo e(__('general.save_changes'), false); ?></button>

          </form>
        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/password.blade.php ENDPATH**/ ?>