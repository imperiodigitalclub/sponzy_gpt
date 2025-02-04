<div class="modal fade" id="modal2fa" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white shadow border-0">
							<div class="card-body px-lg-5 py-lg-5 position-relative">
								<div class="mb-3">

									<h6><i class="bi bi-shield-lock mr-1"></i> <?php echo e(trans('general.two_step_auth'), false); ?></h6>

									<small><?php echo e(trans('general.2fa_title_modal'), false); ?></small>
								</div>

								<form method="post" action="<?php echo e(url('verify/2fa'), false); ?>" id="formVerify2fa">
									<?php echo csrf_field(); ?>

									<?php if(request()->route()->named('profile')): ?>
										<input type="hidden" name="isProfileTwoFA" value="true">
									<?php endif; ?>

									<input type="number" autocomplete="off" id="onlyNumber" onKeyPress="if(this.value.length==4) return false;" class="form-control mb-2" name="code" placeholder="<?php echo e(trans('general.enter_code'), false); ?>">

									<small class="form-text text-muted m-0">
                    <a href="javascript:void(0);" class="resend_code">
											<i class="bi bi-arrow-counterclockwise"></i> <span id="resendCode"><?php echo e(trans('general.resend_code'), false); ?></span>
                    </a>
                  </small>

									<div class="alert alert-danger display-none mt-2" id="errorModal2fa">
										<ul class="list-unstyled m-0" id="showErrorsModal2fa"></ul>
									</div>

									<div class="text-center">
										<button type="submit" id="btn2fa" class="btn btn-primary mt-3">
											<i></i> <?php echo e(trans('auth.send'), false); ?>

										</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
	</div>
</div><!-- End Modal 2FA -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-2fa.blade.php ENDPATH**/ ?>