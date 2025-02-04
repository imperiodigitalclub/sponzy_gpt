<?php $__env->startSection('title'); ?> <?php echo e(trans('general.contact'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
  <script type="text/javascript">
      var error_scrollelement = <?php echo e(count($errors) > 0 ? 'true' : 'false', false); ?>;
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="jumbotron home m-0 bg-gradient">
    <div class="container pt-lg-md">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card bg-white shadow border-0 b-radio-custom">

          <div class="p-4">
            <h4 class="text-center mb-0 font-weight-bold">
              <?php echo e(trans('general.contact'), false); ?>

            </h4>
            <small class="btn-block text-center mt-2"><?php echo e(trans('general.subtitle_contact'), false); ?></small>
          </div>

            <div class="card-body px-lg-5 py-lg-5">

              <?php if(session('notification')): ?>
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    			<span aria-hidden="true">×</span>
                    			</button>

                        <?php echo e(session('notification'), false); ?>

                      </div>
                    <?php endif; ?>

              <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <form method="POST" action="<?php echo e(url('contact'), false); ?>" id="contactForm">
                  <?php echo csrf_field(); ?>

              <div class="row">

                <div class="col-md-6">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="feather icon-user"></i></span>
                    </div>
                    <input class="form-control" required value="<?php echo e(Auth::user()->name ??  old('full_name'), false); ?>" placeholder="<?php echo e(trans('auth.full_name'), false); ?>" name="full_name" type="text">
                  </div>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="feather icon-mail"></i></span>
                    </div>
                    <input name="email" required type="email" value="<?php echo e(Auth::user()->email ??  old('email'), false); ?>" class="form-control" placeholder="<?php echo e(trans('auth.email'), false); ?>">
                  </div>
                </div>
                </div>

                </div><!-- Row -->

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="feather icon-feather"></i></span>
                    </div>
                    <input name="subject" required type="text" value="<?php echo e(old('subject'), false); ?>" class="form-control" placeholder="<?php echo e(trans('general.subject'), false); ?>">
                  </div>
                </div>

                <div class="form-group">
                  <textarea name="message" required rows="4" class="form-control"><?php echo e(old('message'), false); ?></textarea>
                  </div><!-- End Form Group -->

                  <?php if($settings->link_terms != '' && $settings->link_privacy != ''): ?>
                  <div class="custom-control custom-control-alternative custom-checkbox">
                    <input class="custom-control-input" required id=" customCheckLogin" name="agree_terms_privacy" type="checkbox">
                    <label class="custom-control-label" for=" customCheckLogin">
                      <span><?php echo e(trans('general.i_agree_with'), false); ?>

                        <a href="<?php echo e($settings->link_terms, false); ?>" target="_blank"><?php echo e(trans('admin.terms_conditions'), false); ?></a>
                        <?php echo e(trans('general.and'), false); ?> <a href="<?php echo e($settings->link_privacy, false); ?>" target="_blank"><?php echo e(trans('admin.privacy_policy'), false); ?></a>
                      </span>
                    </label>
                  </div>
                <?php endif; ?>

                <div class="text-center">
                  <?php if($settings->captcha_contact == 'on'): ?>
                  <?php echo NoCaptcha::displaySubmit('contactForm', __('auth.send').' <i class="fa fa-paper-plane ml-1"></i>', ['data-size' => 'invisible', 'class' => 'btn btn-primary my-4 w-100']); ?>


                  <?php echo NoCaptcha::renderJs(); ?>

                  <?php else: ?>
                  <button type="submit" class="btn btn-primary my-4 w-100"><?php echo e(__('auth.send'), false); ?> <i class="fa fa-paper-plane ml-1"></i></button>
                  <?php endif; ?>
                </div>
              </form>
              <?php if($settings->captcha_contact == 'on'): ?>
                <small class="btn-block text-center"><?php echo e(trans('auth.protected_recaptcha'), false); ?>

                  <a href="https://policies.google.com/privacy" target="_blank"><?php echo e(trans('general.privacy'), false); ?></a> - <a href="https://policies.google.com/terms" target="_blank"><?php echo e(trans('general.terms'), false); ?></a>
                </small>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/index/contact.blade.php ENDPATH**/ ?>