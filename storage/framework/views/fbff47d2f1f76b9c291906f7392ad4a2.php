<script src="<?php echo e(asset('public/js/core.min.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<script src="<?php echo e(asset('public/js/bootstrap.bundle.min.js'), false); ?>"></script>
<script src="<?php echo e(asset('public/js/jqueryTimeago_' . Lang::locale() . '.js'), false); ?>"></script>
<script src="<?php echo e(asset('public/js/lazysizes.min.js'), false); ?>" async=""></script>
<script src="<?php echo e(asset('public/js/plyr/plyr.min.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<script src="<?php echo e(asset('public/js/plyr/plyr.polyfilled.min.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<script src="<?php echo e(asset('public/js/app-functions.js'), false); ?>?v=<?php echo e($settings->version, false); ?>1"></script>

<script>
	document.addEventListener('click', function (event) {
		const target = event.target.closest('.container-post-media a');

		if (target) {
			setTimeout(() => {
				const currentSlide = document.querySelector('.gslide.current');
				if (currentSlide) {
					const fullscreenButton = currentSlide.querySelector('[data-plyr="fullscreen"]');

					if (fullscreenButton) {
						fullscreenButton.click();
						console.log("Fullscreen button clicked for current slide");
					}
				}
			}, 500);
		}
	});
</script>

<?php if(!request()->is('live/*')): ?>
	<script src="<?php echo e(asset('public/js/install-app.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<?php endif; ?>

<?php if(auth()->guard()->check()): ?>
	<script src="<?php echo e(asset('public/js/fileuploader/jquery.fileuploader.min.js'), false); ?>"></script>
	<script src="<?php echo e(asset('public/js/fileuploader/fileuploader-post.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
	<script src="<?php echo e(asset('public/js/jquery-ui/jquery-ui.min.js'), false); ?>"></script>
	<?php if(
				request()->path() == '/'
				&& auth()->user()->verified_id == 'yes'
				|| request()->route()->named('profile')
				&& request()->path() == auth()->user()->username
				&& auth()->user()->verified_id == 'yes'
			): ?>
		<script src="<?php echo e(asset('public/js/jquery-ui/mentions.js'), false); ?>"></script>
	<?php endif; ?>

	<?php if($settings->story_status): ?>
		<script src="<?php echo e(asset('public/js/story/zuck.min.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
	<?php endif; ?>

	<script src="https://js.stripe.com/v3/"></script>
	<script src='https://checkout.razorpay.com/v1/checkout.js'></script>
	<script src='https://js.paystack.co/v1/inline.js'></script>
	<?php if(request()->is('my/wallet')): ?>
		<script src="<?php echo e(asset('public/js/add-funds.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
	<?php else: ?>
		<script src="<?php echo e(asset('public/js/payment.js'), false); ?>?v=<?php echo e($settings->version, false); ?>12"></script>
		<script src="<?php echo e(asset('public/js/payments-ppv.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
	<?php endif; ?>
	<script src="<?php echo e(asset('public/js/send-gift.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<?php endif; ?>

<?php if($settings->custom_js): ?>
	<script type="text/javascript">
		<?php echo $settings->custom_js; ?>

	</script>
<?php endif; ?>

<script type="text/javascript">
	const lightbox = GLightbox({
		touchNavigation: true,
		loop: false,
		closeEffect: 'fade'
	});

	<?php if(auth()->guard()->check()): ?>
		$('.btnMultipleUpload').on('click', function () {
			$('.fileuploader').toggleClass('d-block');
		});

		<?php if(request()->route()->named('post.edit') && $preloadedFile): ?>
			$(document).ready(function () {
				$('.fileuploader').addClass('d-block');
			});
		<?php endif; ?>

	<?php endif; ?>
</script>

<?php if(
		auth()->guest()
		&& !request()->is('password/reset')
		&& !request()->is('password/reset/*')
		&& !request()->is('contact')
	): ?>
	<script type="text/javascript">
		//<---------------- Login Register ----------->>>>
		onSubmitformLoginRegister = function () {
			sendFormLoginRegister();
		}

		if (!captcha) {
			$(document).on('click', '#btnLoginRegister', function (s) {
				s.preventDefault();
				sendFormLoginRegister();
			});//<<<-------- * END FUNCTION CLICK * ---->>>>
		}

		function sendFormLoginRegister() {
			var element = $(this);
			$('#btnLoginRegister').attr({ 'disabled': 'true' });
			$('#btnLoginRegister').find('i').addClass('spinner-border spinner-border-sm align-middle mr-1');

			(function () {
				$("#formLoginRegister").ajaxForm({
					dataType: 'json',
					success: function (result) {

						if (result.actionRequired) {
							$('#modal2fa').modal({
								backdrop: 'static',
								keyboard: false,
								show: true
							});

							$('#loginFormModal').modal('hide');
							return false;
						}

						// Success
						if (result.success) {
							console.log("result");
							console.log(result);
							
							if (result.isModal && result.isLoginRegister) {
								//window.location.href = result.url_return
								window.location.reload();
							}

							if (result.url_return && !result.isModal) {
								window.location.href = result.url_return;
							}

							if (result.check_account) {
								$('#checkAccount').html(result.check_account).fadeIn(500);

								$('#btnLoginRegister').removeAttr('disabled');
								$('#btnLoginRegister').find('i').removeClass('spinner-border spinner-border-sm align-middle mr-1');
								$('#errorLogin').fadeOut(100);
								$("#formLoginRegister").reset();
							}

						} else {

							if (result.errors) {
								var error = '';
								var $key = '';

								for ($key in result.errors) {
									error += '<li><i class="far fa-times-circle"></i> ' + result.errors[$key] + '</li>';
								}

								$('#showErrorsLogin').html(error);
								$('#errorLogin').fadeIn(500);
								$('#btnLoginRegister').removeAttr('disabled');
								$('#btnLoginRegister').find('i').removeClass('spinner-border spinner-border-sm align-middle mr-1');

								if (captcha) {
									grecaptcha.reset();
								}
							}
						}
					},

					statusCode: {
						419: function () {
							window.location.reload();
						}
					},
					error: function (responseText, statusText, xhr, $form) {
						// error
						$('#btnLoginRegister').removeAttr('disabled');
						$('#btnLoginRegister').find('i').removeClass('spinner-border spinner-border-sm align-middle mr-1');
						swal({
							type: 'error',
							title: error_oops,
							text: error_occurred + ' (' + xhr + ')',
						});

						if (captcha) {
							grecaptcha.reset();
						}
					}
				}).submit();
			})(); //<--- FUNCTION %
		}
	</script>
<?php endif; ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/javascript_general.blade.php ENDPATH**/ ?>