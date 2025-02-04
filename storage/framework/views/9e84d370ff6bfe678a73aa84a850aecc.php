<?php $__env->startSection('title'); ?> <?php echo e(trans('general.privacy_security'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi bi-shield-check mr-2"></i> <?php echo e(trans('general.privacy_security'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.desc_privacy'), false); ?></p>
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

          <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <h5><?php echo e(__('general.login_sessions'), false); ?></h5>
              <div class="card mb-4">
                <div class="card-body">

                  <?php if($agents->count() || $currentSession): ?>
                  <small class="w-100 d-block"><strong><?php echo e(__('general.last_login_record'), false); ?></strong></small>

                  <?php if($currentSession): ?>
                  <p class="card-text mb-4 border-bottom pb-2">
                    <i class="bi-<?php echo e($currentSession->device_type == 'phone' ? 'phone' : 'display', false); ?> mr-1"></i> 
                    <strong><?php echo e($currentSession->getNameBrowser(), false); ?> <?php echo e(__('general.on'), false); ?> <?php echo e($currentSession->getNamePlatform(), false); ?><?php echo e($currentSession->device_type == 'phone' ? ', '.$currentSession->device : null, false); ?></strong>
                  <span class="badge badge-pill badge-success"><?php echo e(__('general.active_now'), false); ?></span>

                  <small class="text-muted w-100 d-block mt-2 mb-0">
                    <?php echo e($currentSession->ip, false); ?> - <?php echo e($currentSession->country ? $currentSession->country.' - ' : null, false); ?> <span class="timeAgo" data="<?php echo e(date('c', strtotime($currentSession->updated_at)), false); ?>"></span> 
                  </small> 
                  </p>
                  <?php endif; ?>
                  
                  <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <p class="card-text mb-1">
                    <i class="bi-<?php echo e($agent->device_type == 'phone' ? 'phone' : 'display', false); ?> mr-1"></i> 
                    <strong><?php echo e($agent->getNameBrowser(), false); ?> <?php echo e(__('general.on'), false); ?>  <?php echo e($agent->getNamePlatform(), false); ?> <?php echo e($agent->device_type == 'phone' ? ', '.$agent->device : null, false); ?></strong> 
                  </p>
                  <small class="text-muted w-100 d-block mb-2">
                    <?php echo e($agent->ip, false); ?> - <?php echo e($agent->country ? $agent->country.' - ' : null, false); ?> <span class="timeAgo" data="<?php echo e(date('c', strtotime($agent->updated_at)), false); ?>"></span> 
                  </small> 
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                  <small class="text-muted w-100 d-block my-3 font-weight-bold"> <i class="bi-exclamation-triangle mr-1"></i> <?php echo e(__('general.login_session_alert'), false); ?></small> 

                  <?php if($agents->count() != 0): ?>
                  <a href="#" class="btn btn-sm btn-danger mt-2" data-toggle="modal" data-target="#logoutDevices">
                    <i class="bi-x-circle mr-1"></i> <?php echo e(__('general.close_all_sessions'), false); ?>

                  </a>

                  <?php echo $__env->make('includes.modal-logout-devices', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                  <?php endif; ?>

                  <?php else: ?>
                   <?php echo e(__('general.no_results_found'), false); ?>

                  <?php endif; ?>
                </div>
              </div>

          <?php if(auth()->user()->verified_id == 'yes'): ?>
            <h5><?php echo e(__('general.privacy'), false); ?></h5>

            <form method="POST" action="<?php echo e(url('privacy/security'), false); ?>">

              <?php echo csrf_field(); ?>

              <div class="form-group">
                <div class="btn-block mb-4">
                  <div class="custom-control custom-switch custom-switch-lg">
                    <input type="checkbox" class="custom-control-input" name="hide_profile" value="yes" <?php if(auth()->user()->hide_profile == 'yes'): ?> checked <?php endif; ?> id="customSwitch1">
                    <label class="custom-control-label switch" for="customSwitch1"><?php echo e(__('general.hide_profile'), false); ?> <?php echo e(__('general.info_hide_profile'), false); ?></label>
                  </div>
                </div>

                <div class="btn-block mb-4">
                  <div class="custom-control custom-switch custom-switch-lg">
                    <input type="checkbox" class="custom-control-input" name="hide_last_seen" value="yes" <?php if(auth()->user()->hide_last_seen == 'yes'): ?> checked <?php endif; ?> id="customSwitch2">
                    <label class="custom-control-label switch" for="customSwitch2"><?php echo e(__('general.hide_last_seen'), false); ?></label>
                  </div>
                </div>

                <div class="btn-block mb-4">
                  <div class="custom-control custom-switch custom-switch-lg">
                    <input type="checkbox" class="custom-control-input" name="active_status_online" value="yes" <?php if(auth()->user()->active_status_online == 'yes'): ?> checked <?php endif; ?> id="customSwitch6">
                    <label class="custom-control-label switch" for="customSwitch6"><?php echo e(__('general.active_status_online'), false); ?></label>
                  </div>
                </div>

                <div class="btn-block mb-4">
                  <div class="custom-control custom-switch custom-switch-lg">
                    <input type="checkbox" class="custom-control-input" name="hide_count_subscribers" value="yes" <?php if(auth()->user()->hide_count_subscribers == 'yes'): ?> checked <?php endif; ?> id="customSwitch3">
                    <label class="custom-control-label switch" for="customSwitch3"><?php echo e(__('general.hide_count_subscribers'), false); ?></label>
                  </div>
                </div>

                <div class="btn-block mb-4">
                  <div class="custom-control custom-switch custom-switch-lg">
                    <input type="checkbox" class="custom-control-input" name="hide_my_country" value="yes" <?php if(auth()->user()->hide_my_country == 'yes'): ?> checked <?php endif; ?> id="customSwitch4">
                    <label class="custom-control-label switch" for="customSwitch4"><?php echo e(__('general.hide_my_country'), false); ?></label>
                  </div>
                </div>

                <div class="btn-block mb-4">
                  <div class="custom-control custom-switch custom-switch-lg">
                    <input type="checkbox" class="custom-control-input" name="show_my_birthdate" value="yes" <?php if(auth()->user()->show_my_birthdate == 'yes'): ?> checked <?php endif; ?> id="customSwitch5">
                    <label class="custom-control-label switch" for="customSwitch5"><?php echo e(__('general.show_my_birthdate'), false); ?></label>
                  </div>
                </div>

                <div class="btn-block mb-4">
                  <div class="custom-control custom-switch custom-switch-lg">
                    <input type="checkbox" class="custom-control-input" name="posts_privacy" value="1" <?php if(auth()->user()->posts_privacy): ?> checked <?php endif; ?> id="posts_privacy">
                    <label class="custom-control-label switch" for="posts_privacy"><?php echo e(__('general.posts_privacy'), false); ?></label>
                  </div>
                </div>

                <h5 class="mt-5"><?php echo e(__('general.security'), false); ?></h5>

                <div class="btn-block mb-4">
                  <div class="custom-control custom-switch custom-switch-lg">
                    <input type="checkbox" class="custom-control-input" name="two_factor_auth" value="yes" <?php if(auth()->user()->two_factor_auth == 'yes'): ?> checked <?php endif; ?> id="customSwitch7">
                    <label class="custom-control-label switch" for="customSwitch7">
                      <?php echo e(__('general.two_step_auth'), false); ?>

                      <i class="bi bi-info-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('general.two_step_auth_info'), false); ?>"></i>
                    </label>
                  </div>
                </div>
              </div><!-- End form-group -->

              <button class="btn btn-1 btn-success btn-block" onClick="this.form.submit(); this.disabled=true; this.innerText='<?php echo e(__('general.please_wait'), false); ?>';" type="submit"><?php echo e(__('general.save_changes'), false); ?></button>

            </form>
          <?php endif; ?>

          <?php if(! auth()->user()->isSuperAdmin()): ?>
          <h5 class="mt-5"><?php echo e(__('general.delete_account'), false); ?></h5>
          <small class="w-100"><?php echo e(__('general.delete_account_alert'), false); ?></small>

          <div class="w-100 d-block mt-2 mb-5">
            <a class="btn btn-main btn-danger pr-3 pl-3" href="<?php echo e(url('account/delete'), false); ?>">
              <i class="feather icon-user-x mr-1"></i> <?php echo e(__('general.delete_account'), false); ?></small>
            </a>
          </div>

            <?php if(auth()->user()->verified_id == 'yes' && auth()->user()->free_subscription == 'yes' && $settings->allow_creators_deactivate_profile): ?>
            <h5 class="mt-5"><?php echo e(__('general.deactivate_your_account'), false); ?></h5>
            <small class="w-100"><?php echo e(__('general.deactivate_your_account_alert'), false); ?></small>

            <div class="w-100 d-block mt-2 mb-5">
              <form action="<?php echo e(route('deactivate.account'), false); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="btn btn-main btn-warning pr-3 pl-3" id="actionDeactivate">
                  <i class="bi-person-slash mr-1"></i> <?php echo e(__('general.deactivate_your_account'), false); ?></small>
                </button>
              </form>
              
            </div>
          <?php endif; ?>
        <?php endif; ?>

        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $("#actionDeactivate").on('click', function (e) {
		e.preventDefault();

		var element = $(this);
		var form = $(element).parents('form');

		element.blur();

		swal(
			{
				title: delete_confirm,
				type: "warning",
				showLoaderOnConfirm: true,
				showCancelButton: true,
				confirmButtonColor: "#ffc107",
				confirmButtonText: "<?php echo e(__('general.yes_confirm_deactivate'), false); ?>",
				cancelButtonText: cancel_confirm,
				closeOnConfirm: false,
			},
			function (isConfirm) {
				if (isConfirm) {
					form.submit();
				}
			});
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/privacy_security.blade.php ENDPATH**/ ?>