<?php $__env->startSection('css'); ?>
  <script type="text/javascript">
      var error_scrollelement = <?php echo e(count($errors) > 0 ? 'true' : 'false', false); ?>;
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="jumbotron home m-0 bg-gradient">
    <div class="container pt-lg-md">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card bg-white shadow border-0 b-radio-custom">

            <div class="p-4">
              <h4 class="text-center mb-0 font-weight-bold">
                <?php echo e(__('auth.reset_password'), false); ?>

              </h4>
              <small class="btn-block text-center mt-2"><?php echo e(__('auth.reset_pass_subtitle'), false); ?></small>
            </div>

            <div class="card-body px-lg-5 py-lg-5">

              <?php if(session('status')): ?>
                      <div class="alert alert-success">
                        <?php echo e(session('status'), false); ?>

                      </div>
                    <?php endif; ?>

              <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <form method="POST" action="<?php echo e(url('password/reset'), false); ?>" id="passwordResetForm">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="token" value="<?php echo e($token, false); ?>">

                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="feather icon-mail"></i></span>
                    </div>
                    <input class="form-control" value="<?php echo e(old('email'), false); ?>" placeholder="<?php echo e(__('auth.email'), false); ?>" name="email" required type="text">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative" id="showHidePassword">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="iconmoon icon-Key"></i></span>
                    </div>
                    <input name="password" type="password" class="form-control" required placeholder="<?php echo e(__('auth.password'), false); ?>">
                    <div class="input-group-append">
                      <span class="input-group-text c-pointer"><i class="feather icon-eye-off"></i></span>
                  </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="iconmoon icon-Key"></i></span>
                    </div>
                    <input name="password_confirmation" type="password" class="form-control" required placeholder="<?php echo e(__('auth.confirm_password'), false); ?>">
                  </div>
                </div>

                <div class="text-center">
                  <?php if($settings->captcha == 'on'): ?>
                  <?php echo NoCaptcha::displaySubmit('passwordResetForm', __('auth.reset_password'), ['data-size' => 'invisible', 'class' => 'btn btn-primary my-4 w-100']); ?>


                  <?php echo NoCaptcha::renderJs(); ?>

                  <?php else: ?>
                  <button type="submit" class="btn btn-primary my-4 w-100"><?php echo e(__('auth.reset_password'), false); ?></button>
                  <?php endif; ?>
                </div>
              </form>

              <?php if($settings->captcha == 'on'): ?>
                <small class="btn-block text-center"><?php echo e(__('auth.protected_recaptcha'), false); ?> <a href="https://policies.google.com/privacy" target="_blank"><?php echo e(__('general.privacy'), false); ?></a> - <a href="https://policies.google.com/terms" target="_blank"><?php echo e(__('general.terms'), false); ?></a></small>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/auth/passwords/reset.blade.php ENDPATH**/ ?>