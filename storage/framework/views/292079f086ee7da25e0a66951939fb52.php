

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/js/select2/select2.min.css'), false); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('public/js/select2/select2-bootstrap-5-theme.min.css'), false); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.general_settings'), false); ?></span>
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

      <form method="POST" action="<?php echo e(url('panel/admin/settings'), false); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

       <div class="row mb-3">
         <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('admin.name_site'), false); ?></label>
         <div class="col-sm-10">
           <input type="text" value="<?php echo e($settings->title, false); ?>" name="title" class="form-control">
         </div>
       </div><!-- end row -->

			 <div class="row mb-3">
         <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('admin.email_admin'), false); ?></label>
         <div class="col-sm-10">
           <input type="text" value="<?php echo e($settings->email_admin, false); ?>" name="email_admin" class="form-control">
         </div>
       </div><!-- end row -->

       <div class="row mb-3">
         <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('admin.link_terms'), false); ?></label>
         <div class="col-sm-10">
           <input type="text" value="<?php echo e($settings->link_terms, false); ?>" name="link_terms" class="form-control">
         </div>
       </div><!-- end row -->

       <div class="row mb-3">
         <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('admin.link_privacy'), false); ?></label>
         <div class="col-sm-10">
           <input type="text" value="<?php echo e($settings->link_privacy, false); ?>" name="link_privacy" class="form-control">
           <small class="d-block"></small>
         </div>
       </div><!-- end row -->

       <div class="row mb-3">
         <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('admin.link_cookies'), false); ?></label>
         <div class="col-sm-10">
           <input type="text" value="<?php echo e($settings->link_cookies, false); ?>" name="link_cookies" class="form-control">
         </div>
       </div><!-- end row -->

			 <div class="row mb-3">
				 <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('admin.date_format'), false); ?></label>
				 <div class="col-sm-10">
					 <select name="date_format" class="form-select">
						 <option <?php if( $settings->date_format == 'M d, Y' ): ?> selected="selected" <?php endif; ?> value="M d, Y"><?php echo date('M d, Y'); ?></option>
							 <option <?php if( $settings->date_format == 'd M, Y' ): ?> selected="selected" <?php endif; ?> value="d M, Y"><?php echo date('d M, Y'); ?></option>
						 <option <?php if( $settings->date_format == 'Y-m-d' ): ?> selected="selected" <?php endif; ?> value="Y-m-d"><?php echo date('Y-m-d'); ?></option>
							 <option <?php if( $settings->date_format == 'm/d/Y' ): ?> selected="selected" <?php endif; ?>  value="m/d/Y"><?php echo date('m/d/Y'); ?></option>
								 <option <?php if( $settings->date_format == 'd/m/Y' ): ?> selected="selected" <?php endif; ?>  value="d/m/Y"><?php echo date('d/m/Y'); ?></option>
						 </select>
				 </div>
			 </div>

			 <div class="row mb-3">
				 <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('general.genders'), false); ?></label>
				 <div class="col-sm-10">
					 <select name="genders[]" multiple class="form-select gendersSelect">
						 <option <?php if(in_array('male', $genders)): ?> selected="selected" <?php endif; ?> value="male"><?php echo e(__('general.male'), false); ?></option>
						 <option <?php if(in_array('female', $genders)): ?> selected="selected" <?php endif; ?> value="female"><?php echo e(__('general.female'), false); ?></option>
						 <option <?php if(in_array('gay', $genders)): ?> selected="selected" <?php endif; ?> value="gay"><?php echo e(__('general.gay'), false); ?></option>
						 <option <?php if(in_array('lesbian', $genders)): ?> selected="selected" <?php endif; ?> value="lesbian"><?php echo e(__('general.lesbian'), false); ?></option>
						 <option <?php if(in_array('bisexual', $genders)): ?> selected="selected" <?php endif; ?> value="bisexual"><?php echo e(__('general.bisexual'), false); ?></option>
						 <option <?php if(in_array('transgender', $genders)): ?> selected="selected" <?php endif; ?> value="transgender"><?php echo e(__('general.transgender'), false); ?></option>
						 <option <?php if(in_array('metrosexual', $genders)): ?> selected="selected" <?php endif; ?> value="metrosexual"><?php echo e(__('general.metrosexual'), false); ?></option>
						 <option <?php if(in_array('no_binary', $genders)): ?> selected="selected" <?php endif; ?> value="no_binary"><?php echo e(__('general.no_binary'), false); ?></option>
						 <option <?php if(in_array('couple', $genders)): ?> selected="selected" <?php endif; ?> value="couple"><?php echo e(__('general.couple'), false); ?></option>
					</select>
				 </div>
			 </div>

			 <div class="row mb-3">
				 <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('general.default_language'), false); ?></label>
				 <div class="col-sm-10">
					 <select name="default_language" class="form-select">
						 <?php $__currentLoopData = Languages::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 							<option <?php if($language->abbreviation == config('app.fallback_locale')): ?> selected="selected" <?php endif; ?> value="<?php echo e($language->abbreviation, false); ?>"><?php echo e($language->name, false); ?></option>
 						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
					<small class="d-block"><?php echo e(__('general.default_language_info'), false); ?></small>
				 </div>
			 </div>

       <fieldset class="row mb-3">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.show_errors'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check">
             <input class="form-check-input" type="radio" name="app_debug" id="radio1" <?php if(config('app.debug') == true): ?> checked="checked" <?php endif; ?> value="true">
             <label class="form-check-label" for="radio1">
               On <small class="text-danger"><i class="bi-exclamation-triangle-fill mx-1"></i> <strong><?php echo e(__('general.info_show_errors'), false); ?></strong></small>
             </label>
           </div>
           <div class="form-check">
             <input class="form-check-input" type="radio" name="app_debug" id="radio2" <?php if(config('app.debug') == false): ?> checked="checked" <?php endif; ?> value="false">
             <label class="form-check-label" for="radio2">
               Off
             </label>
           </div>
         </div>
       </fieldset><!-- end row -->

       <fieldset class="row mb-3">
        <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.default_theme'), false); ?></legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="theme" id="light_mode" <?php if($settings->theme == 'light'): ?> checked="checked" <?php endif; ?> value="light">
            <label class="form-check-label" for="light_mode">
              <?php echo e(__('general.light_mode'), false); ?>

            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="theme" id="dark_mode" <?php if($settings->theme == 'dark'): ?> checked="checked" <?php endif; ?> value="dark">
            <label class="form-check-label" for="dark_mode">
              <?php echo e(__('general.dark_mode'), false); ?>

            </label>
          </div>
        </div>
      </fieldset><!-- end row -->

			 <fieldset class="row mb-3">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.who_can_see_content'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check">
             <input class="form-check-input" type="radio" name="who_can_see_content" id="radioWho1" <?php if($settings->who_can_see_content == 'all'): ?> checked="checked" <?php endif; ?> value="all">
             <label class="form-check-label" for="radioWho1">
               <?php echo e(__('general.all'), false); ?>

             </label>
           </div>
           <div class="form-check">
             <input class="form-check-input" type="radio" name="who_can_see_content" id="radioWho2" <?php if($settings->who_can_see_content == 'users'): ?> checked="checked" <?php endif; ?> value="users">
             <label class="form-check-label" for="radioWho2">
               <?php echo e(__('admin.only_users'), false); ?>

             </label>
           </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('admin.email_verification'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="email_verification" <?php if($settings->email_verification): ?> checked="checked" <?php endif; ?> value="1" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('admin.account_verification'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="account_verification" <?php if($settings->account_verification): ?> checked="checked" <?php endif; ?> value="1" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end">Captcha</legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="captcha" <?php if($settings->captcha == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.captcha_contact'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="captcha_contact" <?php if($settings->captcha_contact == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.disable_tips'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="disable_tips" <?php if($settings->disable_tips == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

       <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('admin.new_registrations'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="registration_active" <?php if($settings->registration_active): ?> checked="checked" <?php endif; ?> value="1" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.show_counter'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="show_counter" <?php if($settings->show_counter == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.disable_registration_login_email'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="disable_login_register_email" <?php if($settings->disable_login_register_email): ?> checked="checked" <?php endif; ?> value="1" role="switch">
          </div>
          <small class="d-block w-100 float-start mt-2">
            <i class="bi-info-circle me-1"></i>
            <?php echo e(__('auth.login'), false); ?> (<?php echo e(__('admin.role_admin'), false); ?>) <strong><?php echo e(url('login/admin'), false); ?></strong>
          </small>
         </div>
        
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.show_widget_creators'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="widget_creators_featured" <?php if($settings->widget_creators_featured == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.show_earnings_simulator'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="earnings_simulator" <?php if($settings->earnings_simulator == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.receive_verification_requests'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="requests_verify_account" <?php if($settings->requests_verify_account == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.hide_admin_profile'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="hide_admin_profile" <?php if($settings->hide_admin_profile == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.watermark_on_images'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="watermark" <?php if($settings->watermark == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.show_alert_adult'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="alert_adult" <?php if($settings->alert_adult == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.users_can_edit_post'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="users_can_edit_post" <?php if($settings->users_can_edit_post == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.disable_banner_cookies'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="disable_banner_cookies" <?php if($settings->disable_banner_cookies == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.referral_system'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="referral_system" <?php if($settings->referral_system == 'on'): ?> checked="checked" <?php endif; ?> value="on" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

       <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.disable_contact'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="disable_contact" <?php if($settings->disable_contact): ?> checked="checked" <?php endif; ?> value="1" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.disable_new_post_email_notification'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="disable_new_post_notification" <?php if($settings->disable_new_post_notification): ?> checked="checked" <?php endif; ?> value="1" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.disable_creators_search'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="disable_search_creators" <?php if($settings->disable_search_creators): ?> checked="checked" <?php endif; ?> value="1" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.browse_creators_by_gender_age'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="search_creators_genders" <?php if($settings->search_creators_genders): ?> checked="checked" <?php endif; ?> value="1" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.allow_qr_code_generate'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="generate_qr_code" <?php if($settings->generate_qr_code): ?> checked="checked" <?php endif; ?> value="1" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.auto_follow_admin'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="autofollow_admin" <?php if($settings->autofollow_admin): ?> checked="checked" <?php endif; ?> value="1" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

			 <fieldset class="row mb-4">
         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.allow_zip_files'), false); ?></legend>
         <div class="col-sm-10">
           <div class="form-check form-switch form-switch-md">
            <input class="form-check-input" type="checkbox" name="allow_zip_files" <?php if($settings->allow_zip_files): echo 'checked'; endif; ?> value="1" role="switch">
          </div>
         </div>
       </fieldset><!-- end row -->

       <fieldset class="row mb-4">
        <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.zip_verification_creator'), false); ?></legend>
        <div class="col-sm-10">
          <div class="form-check form-switch form-switch-md">
           <input class="form-check-input" type="checkbox" name="zip_verification_creator" <?php if($settings->zip_verification_creator): echo 'checked'; endif; ?> value="1" role="switch">
         </div>
        </div>
      </fieldset><!-- end row -->

      <fieldset class="row mb-4">
        <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.allow_scheduled_posts'), false); ?></legend>
        <div class="col-sm-10">
          <div class="form-check form-switch form-switch-md">
           <input class="form-check-input" type="checkbox" name="allow_scheduled_posts" <?php if($settings->allow_scheduled_posts): echo 'checked'; endif; ?> value="1" role="switch">
         </div>
        </div>
      </fieldset><!-- end row -->

      <fieldset class="row mb-4">
        <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.allow_creators_deactivate_profile'), false); ?> (<?php echo e(__('general.free_subscription'), false); ?>)</legend>
        <div class="col-sm-10">
          <div class="form-check form-switch form-switch-md">
           <input class="form-check-input" type="checkbox" name="allow_creators_deactivate_profile" <?php if($settings->allow_creators_deactivate_profile): echo 'checked'; endif; ?> value="1" role="switch">
         </div>
        </div>
      </fieldset><!-- end row -->

      <fieldset class="row mb-4">
        <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.allow_epub_files'), false); ?></legend>
        <div class="col-sm-10">
          <div class="form-check form-switch form-switch-md">
           <input class="form-check-input" type="checkbox" name="allow_epub_files" <?php if($settings->allow_epub_files): echo 'checked'; endif; ?> value="1" role="switch">
         </div>
        </div>
      </fieldset><!-- end row -->

      <fieldset class="row mb-4">
        <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.allow_sending_gifts'), false); ?></legend>
        <div class="col-sm-10">
          <div class="form-check form-switch form-switch-md">
           <input class="form-check-input" type="checkbox" name="gifts" <?php if($settings->gifts): echo 'checked'; endif; ?> value="1" role="switch">
         </div>
        </div>
      </fieldset><!-- end row -->

      <fieldset class="row mb-4">
        <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.disable_free_post'), false); ?></legend>
        <div class="col-sm-10">
          <div class="form-check form-switch form-switch-md">
           <input class="form-check-input" type="checkbox" name="disable_free_post" <?php if($settings->disable_free_post): echo 'checked'; endif; ?> value="1" role="switch">
         </div>
        </div>
      </fieldset><!-- end row -->

      <fieldset class="row mb-4">
        <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.disable_explore_section'), false); ?></legend>
        <div class="col-sm-10">
          <div class="form-check form-switch form-switch-md">
           <input class="form-check-input" type="checkbox" name="disable_explore_section" <?php if($settings->disable_explore_section): echo 'checked'; endif; ?> value="1" role="switch">
         </div>
        </div>
      </fieldset><!-- end row -->

      <fieldset class="row mb-4">
        <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.disable_creators_section'), false); ?></legend>
        <div class="col-sm-10">
          <div class="form-check form-switch form-switch-md">
           <input class="form-check-input" type="checkbox" name="disable_creators_section" <?php if($settings->disable_creators_section): echo 'checked'; endif; ?> value="1" role="switch">
         </div>
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

<?php $__env->startSection('javascript'); ?>
  <script>
  $('.gendersSelect').select2({
  tags: false,
  tokenSeparators: [','],
  placeholder: '<?php echo e(__('general.genders'), false); ?>',
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/settings.blade.php ENDPATH**/ ?>