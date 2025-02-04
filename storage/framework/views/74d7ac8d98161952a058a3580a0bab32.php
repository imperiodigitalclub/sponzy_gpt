<?php $__env->startSection('title'); ?> <?php echo e(__('auth.login'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="jumbotron home m-0 bg-gradient">
    <div class="container pt-lg-md">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card bg-white shadow border-0 b-radio-custom">

            <div class="card-body px-lg-5 py-lg-5">

              <h4 class="text-center mb-0 font-weight-bold">
                <?php echo e(__('auth.welcome_back'), false); ?>

              </h4>
              <small class="btn-block text-center mt-2 mb-4"><?php echo e(__('auth.login_welcome'), false); ?></small>

              <?php if(session('login_required')): ?>
                <div class="alert alert-danger" id="dangerAlert">
                  <i class="fa fa-exclamation-triangle"></i> <?php echo e(session('login_required'), false); ?>

                </div>
                	<?php endif; ?>

                  <?php if(session('error_social_login')): ?>
                  <div class="alert alert-danger" id="dangerAlert">
                    <i class="fa fa-exclamation-triangle"></i> <?php echo e(__('general.error'), false); ?> "<?php echo e(session('error_social_login'), false); ?>"
                  </div>
                	<?php endif; ?>

              <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <?php if($settings->facebook_login == 'on' || $settings->google_login == 'on' || $settings->twitter_login == 'on'): ?>
              <div class="mb-2 w-100">

                <?php if($settings->facebook_login == 'on'): ?>
                  <a href="<?php echo e(url('oauth/facebook'), false); ?>" class="btn btn-facebook auth-form-btn flex-grow mb-2 w-100">
                    <i class="fab fa-facebook mr-2"></i> <?php echo e(__('auth.login_with'), false); ?> Facebook
                  </a>
                <?php endif; ?>

                <?php if($settings->twitter_login == 'on'): ?>
                <a href="<?php echo e(url('oauth/twitter'), false); ?>" class="btn btn-twitter auth-form-btn mb-2 w-100">
                  <i class="bi-twitter-x mr-2"></i> <?php echo e(__('auth.login_with'), false); ?> X
                </a>
              <?php endif; ?>

                  <?php if($settings->google_login == 'on'): ?>
                  <a href="<?php echo e(url('oauth/google'), false); ?>" class="btn btn-google auth-form-btn flex-grow w-100">
                    <img src="<?php echo e(url('public/img/google.svg'), false); ?>" class="mr-2" width="18" height="18"> <?php echo e(__('auth.login_with'), false); ?> Google
                  </a>
                <?php endif; ?>
                </div>

                <?php if(! $settings->disable_login_register_email): ?>
                  <small class="btn-block text-center my-3 text-uppercase or"><?php echo e(__('general.or'), false); ?></small>
                <?php endif; ?>

              <?php endif; ?>

              <?php if(! $settings->disable_login_register_email || request()->route()->named('login.admin')): ?>

              <form method="POST" action="<?php echo e(route('login'), false); ?>" id="formLoginRegister" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>

                  <input type="hidden" name="return" value="<?php echo e(count($errors) > 0 ? old('return') : url()->previous(), false); ?>">

                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="feather icon-mail"></i></span>
                    </div>
                    <input class="form-control" required value="<?php echo e(old('username_email'), false); ?>" placeholder="<?php echo e(__('auth.username_or_email'), false); ?>" name="username_email" type="text">

                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative" id="showHidePassword">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="iconmoon icon-Key"></i></span>
                    </div>
                    <input name="password" required type="password" class="form-control" placeholder="<?php echo e(__('auth.password'), false); ?>">
                    <div class="input-group-append">
                      <span class="input-group-text c-pointer"><i class="feather icon-eye-off"></i></span>
                  </div>
                </div>
                </div>

                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : '', false); ?>>
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span><?php echo e(__('auth.remember_me'), false); ?></span>
                  </label>
                </div>

                <div class="alert alert-danger display-none mb-0 mt-3" id="errorLogin">
                    <ul class="list-unstyled m-0" id="showErrorsLogin"></ul>
                  </div>

                <div class="text-center">
                  <?php if($settings->captcha == 'on'): ?>
                  <?php echo NoCaptcha::displaySubmit('formLoginRegister', '<i></i> '.__('auth.login'), ['data-size' => 'invisible', 'id' => 'btnLoginRegister', 'class' => 'btn btn-primary mt-4 w-100']); ?>


                  <?php echo NoCaptcha::renderJs(); ?>


                  <?php else: ?>
                  <button id="btnLoginRegister" type="submit" class="btn btn-primary mt-4 w-100">
                    <i></i> <?php echo e(__('auth.login'), false); ?>

                  </button>

                  <?php endif; ?>
                  

                  
                  
                  
                </div>
              </form>

              <?php if($settings->captcha == 'on'): ?>
                <small class="btn-block text-center mt-3"><?php echo e(__('auth.protected_recaptcha'), false); ?> <a href="https://policies.google.com/privacy" target="_blank"><?php echo e(__('general.privacy'), false); ?></a> - <a href="https://policies.google.com/terms" target="_blank"><?php echo e(__('general.terms'), false); ?></a></small>
              <?php endif; ?>

          <?php endif; ?>

            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="<?php echo e(url('password/reset'), false); ?>" class="text-light">
                <small><?php echo e(__('auth.forgot_password'), false); ?></small>
              </a>
            </div>
            <?php if($settings->registration_active == '1'): ?>
            <div class="col-6 text-right">
              <a href="<?php echo e(url('signup'), false); ?>" class="text-light">
                <small><?php echo e(__('auth.not_have_account'), false); ?></small>
              </a>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/auth/login.blade.php ENDPATH**/ ?>