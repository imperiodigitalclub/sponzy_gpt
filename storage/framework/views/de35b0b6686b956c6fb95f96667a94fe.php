<div class="modal fade" id="loginFormModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm modal-login" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
					<div class="card-body px-lg-5 py-lg-5 position-relative">

						<h6 class="modal-title text-center mb-3" id="loginRegisterContinue"><?php echo e(__('general.login_continue'), false); ?></h6>

						<?php if($settings->facebook_login == 'on' || $settings->google_login == 'on' || $settings->twitter_login == 'on'): ?>
						<div class="mb-2 w-100">

							<?php if($settings->facebook_login == 'on'): ?>
								<a href="<?php echo e(url('oauth/facebook'), false); ?>" class="btn btn-facebook auth-form-btn flex-grow mb-2 w-100">
									<i class="fab fa-facebook mr-2"></i> <span class="loginRegisterWith"><?php echo e(__('auth.login_with'), false); ?></span> Facebook
								</a>
							<?php endif; ?>

							<?php if($settings->twitter_login == 'on'): ?>
							<a href="<?php echo e(url('oauth/twitter'), false); ?>" class="btn btn-twitter auth-form-btn mb-2 w-100">
								<i class="bi-twitter-x mr-2"></i> <span class="loginRegisterWith"><?php echo e(__('auth.login_with'), false); ?></span> X
							</a>
						<?php endif; ?>

								<?php if($settings->google_login == 'on'): ?>
								<a href="<?php echo e(url('oauth/google'), false); ?>" class="btn btn-google auth-form-btn flex-grow w-100">
									<img src="<?php echo e(url('public/img/google.svg'), false); ?>" class="mr-2" width="18" height="18"> <span class="loginRegisterWith"><?php echo e(__('auth.login_with'), false); ?></span> Google
								</a>
							<?php endif; ?>
							</div>

						<?php if(! $settings->disable_login_register_email): ?>
							<small class="btn-block text-center my-3 text-uppercase or"><?php echo e(__('general.or'), false); ?></small>
						<?php endif; ?>
					<?php endif; ?>
						
			<?php if(! $settings->disable_login_register_email): ?>
				<form method="POST" action="<?php echo e(route('login'), false); ?>" data-url-login="<?php echo e(route('login'), false); ?>" data-url-register="<?php echo e(route('register'), false); ?>" id="formLoginRegister" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>

						<?php if(request()->route()->named('profile')): ?>
							<input type="hidden" name="isProfile" value="<?php echo e($user->username, false); ?>">
						<?php endif; ?>

						<input type="hidden" name="isModal" id="isModal" value="true">

						<div class="form-group mb-3 display-none" id="full_name">
							<div class="input-group input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="feather icon-user"></i></span>
								</div>
								<input class="form-control"  value="<?php echo e(old('name'), false); ?>" placeholder="<?php echo e(__('auth.full_name'), false); ?>" name="name" type="text">
							</div>
						</div>

					<div class="form-group mb-3 display-none" id="email">
						<div class="input-group input-group-alternative">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-mail"></i></span>
							</div>
							<input class="form-control" value="<?php echo e(old('email'), false); ?>" placeholder="<?php echo e(__('auth.email'), false); ?>" name="email" type="text">
						</div>
					</div>

					<div class="form-group mb-3" id="username_email">
						<div class="input-group input-group-alternative">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-mail"></i></span>
							</div>
							<input class="form-control" value="<?php echo e(old('username_email'), false); ?>" placeholder="<?php echo e(__('auth.username_or_email'), false); ?>" name="username_email" type="text">

						</div>
					</div>
					<div class="form-group">
						<div class="input-group input-group-alternative" id="showHidePassword">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="iconmoon icon-Key"></i></span>
							</div>
							<input name="password" type="password" class="form-control" placeholder="<?php echo e(__('auth.password'), false); ?>">
							<div class="input-group-append">
								<span class="input-group-text c-pointer"><i class="feather icon-eye-off"></i></span>
						</div>
					</div>
					<small class="form-text text-muted">
						<a href="<?php echo e(url('password/reset'), false); ?>" id="forgotPassword">
							<?php echo e(__('auth.forgot_password'), false); ?>

						</a>
					</small>
					</div>

					<div class="custom-control custom-control-alternative custom-checkbox" id="remember">
						<input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : '', false); ?>>
						<label class="custom-control-label" for=" customCheckLogin">
							<span><?php echo e(__('auth.remember_me'), false); ?></span>
						</label>
					</div>

					<div class="custom-control custom-control-alternative custom-checkbox display-none" id="agree_gdpr">
						<input class="custom-control-input" id="customCheckRegister" type="checkbox" name="agree_gdpr">
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

						<div class="alert alert-success display-none mb-0 mt-3" id="checkAccount"></div>

					<div class="text-center">
						<?php if($settings->captcha == 'on'): ?>
						<?php echo NoCaptcha::displaySubmit('formLoginRegister', '<i></i> '.__('auth.login'), ['data-size' => 'invisible', 'id' => 'btnLoginRegister', 'class' => 'btn btn-primary mt-4 w-100']); ?>


                  		<?php echo NoCaptcha::renderJs(); ?>

						
						<?php else: ?>
						<button type="submit" id="btnLoginRegister" class="btn btn-primary mt-4 w-100"><i></i> <?php echo e(__('auth.login'), false); ?></button>
						<?php endif; ?>

						<div class="w-100 mt-2">
							<button type="button" class="btn e-none p-0" data-dismiss="modal"><?php echo e(__('admin.cancel'), false); ?></button>
						</div>
					</div>
				</form>

				<?php if($settings->captcha == 'on'): ?>
					<small class="btn-block text-center mt-3"><?php echo e(__('auth.protected_recaptcha'), false); ?> <a href="https://policies.google.com/privacy" target="_blank"><?php echo e(__('general.privacy'), false); ?></a> - <a href="https://policies.google.com/terms" target="_blank"><?php echo e(__('general.terms'), false); ?></a></small>
				<?php endif; ?>

				<?php if($settings->registration_active == '1'): ?>
				<div class="row mt-3">
					<div class="col-12 text-center">
						<a href="javascript:void(0);" id="toggleLogin" data-not-account="<?php echo e(__('auth.not_have_account'), false); ?>" data-already-account="<?php echo e(__('auth.already_have_an_account'), false); ?>" data-text-login="<?php echo e(__('auth.login'), false); ?>" data-text-register="<?php echo e(__('auth.sign_up'), false); ?>">
							<strong><?php echo e(__('auth.not_have_account'), false); ?></strong>
						</a>
					</div>
				</div>
				<?php endif; ?>

			<?php else: ?>
				<div class="row mt-3">
					<div class="col-12 text-center">
						<a href="javascript:void(0);" id="toggleLogin" data-not-account="<?php echo e(__('auth.not_have_account'), false); ?>" data-already-account="<?php echo e(__('auth.already_have_an_account'), false); ?>" data-text-login="<?php echo e(__('auth.login'), false); ?>" data-text-register="<?php echo e(__('auth.sign_up'), false); ?>">
							<strong><?php echo e(__('auth.not_have_account'), false); ?></strong>
						</a>
					</div>
				</div>
			<?php endif; ?>

			</div><!-- ./ card-body -->
		</div>
	</div>
 </div>
</div>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-login.blade.php ENDPATH**/ ?>