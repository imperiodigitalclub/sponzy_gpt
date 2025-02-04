<?php $__env->startSection('title'); ?> <?php echo e(__('auth.sign_up'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="jumbotron home m-0 bg-gradient">
    <div class="container pt-lg-md">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card bg-white shadow border-0 b-radio-custom">

            <div class="card-body px-lg-5 py-lg-5">

              <h4 class="text-center mb-0 font-weight-bold">
                <?php echo e(__('auth.sign_up'), false); ?>

              </h4>
              <small class="btn-block text-center mt-2 mb-4"><?php echo e(__('auth.signup_welcome'), false); ?></small>

              <?php if(session('status')): ?>
                      <div class="alert alert-success">
                        <?php echo e(session('status'), false); ?>

                      </div>
                    <?php endif; ?>

              <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <?php if($settings->facebook_login == 'on' || $settings->google_login == 'on' || $settings->twitter_login == 'on'): ?>
              <div class="mb-2 w-100">

                <?php if($settings->facebook_login == 'on'): ?>
                  <a href="<?php echo e(url('oauth/facebook'), false); ?>" class="btn btn-facebook auth-form-btn flex-grow mb-2 w-100">
                    <i class="fab fa-facebook mr-2"></i> <?php echo e(__('auth.sign_up_with'), false); ?> Facebook
                  </a>
                <?php endif; ?>

                <?php if($settings->twitter_login == 'on'): ?>
                <a href="<?php echo e(url('oauth/twitter'), false); ?>" class="btn btn-twitter auth-form-btn mb-2 w-100">
                  <i class="bi-twitter-x mr-2"></i> <?php echo e(__('auth.sign_up_with'), false); ?> X
                </a>
              <?php endif; ?>

                  <?php if($settings->google_login == 'on'): ?>
                  <a href="<?php echo e(url('oauth/google'), false); ?>" class="btn btn-google auth-form-btn flex-grow w-100">
                    <img src="<?php echo e(url('public/img/google.svg'), false); ?>" class="mr-2" width="18" height="18"> <?php echo e(__('auth.sign_up_with'), false); ?> Google
                  </a>
                <?php endif; ?>
                </div>

                <?php if(! $settings->disable_login_register_email): ?>
                  <small class="btn-block text-center my-3 text-uppercase or"><?php echo e(__('general.or'), false); ?></small>
                <?php endif; ?>

              <?php endif; ?>

        <?php if(! $settings->disable_login_register_email): ?>
              <form method="POST" action="<?php echo e(route('register'), false); ?>" id="formLoginRegister">
                  <?php echo csrf_field(); ?>
                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="feather icon-user"></i></span>
                      </div>
                      <input class="form-control" value="<?php echo e(old('name'), false); ?>" placeholder="<?php echo e(__('auth.full_name'), false); ?>" name="name" type="text" required>
                    </div>
                  </div>

                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="feather icon-mail"></i></span>
                    </div>
                    <input class="form-control" value="<?php echo e(old('email'), false); ?>" placeholder="<?php echo e(__('auth.email'), false); ?>" name="email" type="text" required>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative" id="showHidePassword">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="iconmoon icon-Key"></i></span>
                    </div>
                    <input name="password" type="password" class="form-control" placeholder="<?php echo e(__('auth.password'), false); ?>" required>
                    <div class="input-group-append">
                      <span class="input-group-text c-pointer"><i class="feather icon-eye-off"></i></span>
                  </div>
                  </div>
                </div>

                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id="customCheckRegister" type="checkbox" name="agree_gdpr" required>
                    <label class="custom-control-label" for="customCheckRegister">
                      <span>
                        <?php echo e(__('admin.i_agree_gdpr'), false); ?>

                        <a href="<?php echo e($settings->link_terms, false); ?>" target="_blank"><?php echo e(__('admin.terms_conditions'), false); ?></a>
                        <?php echo e(__('general.and'), false); ?>

                        <a href="<?php echo e($settings->link_privacy, false); ?>" target="_blank"><?php echo e(__('admin.privacy_policy'), false); ?></a>
                      </span>
                    </label>
                </div>

                <div class="alert alert-danger display-none mb-0 mt-3" id="errorLogin">
                    <ul class="list-unstyled m-0" id="showErrorsLogin"></ul>
                  </div>

                <div class="alert alert-success mb-0 mt-3 display-none" id="checkAccount"></div>

                <div class="text-center">
                  <?php if($settings->captcha == 'on'): ?>
                  <?php echo NoCaptcha::displaySubmit('formLoginRegister', '<i></i> '.__('auth.sign_up'), ['data-size' => 'invisible', 'id' => 'btnLoginRegister', 'class' => 'btn btn-primary mt-4 w-100']); ?>


                  <?php echo NoCaptcha::renderJs(); ?>


                  <?php else: ?>
                  <button type="submit" class="btn btn-primary mt-4 w-100" id="btnLoginRegister"><i></i> <?php echo e(__('auth.sign_up'), false); ?></button>
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
            <div class="col-12 text-center">
              <a href="<?php echo e(url('login'), false); ?>" class="text-light">
                <small><?php echo e(__('auth.already_have_an_account'), false); ?></small>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/auth/register.blade.php ENDPATH**/ ?>