

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
			<span class="text-muted"><?php echo e(__('general.role_and_permissions'), false); ?></span>
			<i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e($user->name, false); ?></span>
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

			<?php if(session('error_message')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-check2 me-1"></i>	<?php echo e(session('error_message'), false); ?>


                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i class="bi bi-x-lg"></i>
                </button>
                </div>
              <?php endif; ?>

			<?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-5">

					 <form method="POST" action="<?php echo e(url('panel/admin/members/roles-and-permissions', $user->id), false); ?>" enctype="multipart/form-data">
						 <?php echo csrf_field(); ?>

						 <div class="row mb-3">
 		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('admin.role'), false); ?></label>
 		          <div class="col-sm-10">
 		            <select name="role" class="form-select">
									<option <?php if($user->role == 'normal'): ?> selected="selected" <?php endif; ?> value="normal"><?php echo e(trans('admin.normal'), false); ?></option>
									<option <?php if($user->role == 'admin'): ?> selected="selected" <?php endif; ?> value="admin"><?php echo e(trans('admin.role_admin'), false); ?></option>
 		           </select>
 		          </div>
 		        </div><!-- end row -->

						<?php if($user->role == 'admin'): ?>

						<fieldset class="row mb-3">
								<legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.can_see_post_blocked'), false); ?></legend>
								<div class="col-sm-10">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="permission" id="radio1" <?php if($user->permission == 'all'): ?> checked="checked" <?php endif; ?> value="all" checked>
										<label class="form-check-label" for="radio1">
											<?php echo e(trans('general.yes'), false); ?>

										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="permission" id="radio2" <?php if($user->permission == 'none'): ?> checked="checked" <?php endif; ?> value="none">
										<label class="form-check-label" for="radio2">
											<?php echo e(trans('general.no'), false); ?>

										</label>
									</div>
									<small class="d-block"><?php echo e(__('general.info_can_see_post_blocked'), false); ?></small>
								</div>
							</fieldset><!-- end row -->

						<div class="row mb-5">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input limitedAccess" name="permissions[]" value="limited_access" <?php if(isset($permissions) && in_array('limited_access', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="gridCheck1">
									<label class="form-check-label" for="gridCheck1">
										<?php echo e(__('general.limited_access'), false); ?>

									</label>
								</div>
								<small class="d-block"><?php echo e(__('general.info_limited_access'), false); ?></small>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="select_all" value="yes" id="select-all">
									<label class="form-check-label" for="select-all">
										<strong><?php echo e(__('general.select_all'), false); ?></strong>
									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="dashboard" <?php if(isset($permissions) && in_array('dashboard', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="gridCheck3">
									<label class="form-check-label" for="gridCheck3">
										<?php echo e(__('admin.dashboard'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="general_settings" <?php if(isset($permissions) && in_array('general_settings', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="gridCheck4">
									<label class="form-check-label" for="gridCheck4">
										<?php echo e(__('admin.general_settings'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="announcements" <?php if(isset($permissions) && in_array('announcements', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="checkAnnouncements">
									<label class="form-check-label" for="checkAnnouncements">
										<?php echo e(__('general.announcements'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="maintenance" <?php if(isset($permissions) && in_array('maintenance', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="gridCheck5">
									<label class="form-check-label" for="gridCheck5">
										<?php echo e(__('admin.maintenance_mode'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="billing" <?php if(isset($permissions) && in_array('billing', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="gridCheck6">
									<label class="form-check-label" for="gridCheck6">
										<?php echo e(__('general.billing_information'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="tax" <?php if(isset($permissions) && in_array('tax', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="gridCheck8">
									<label class="form-check-label" for="gridCheck8">
										<?php echo e(__('general.tax_rates'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="countries_states" <?php if(isset($permissions) && in_array('countries_states', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="gridCheck9">
									<label class="form-check-label" for="gridCheck9">
										<?php echo e(__('general.countries_states'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="email" <?php if(isset($permissions) && in_array('email', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="email_settings">
									<label class="form-check-label" for="email_settings">
										<?php echo e(__('admin.email_settings'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="live_streaming" <?php if(isset($permissions) && in_array('live_streaming', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="live_streaming">
									<label class="form-check-label" for="live_streaming">
										<?php echo e(__('general.live_streaming'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="live_streaming_private_requests" <?php if(isset($permissions) && in_array('live_streaming_private_requests', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="live_streaming_private_requests">
									<label class="form-check-label" for="live_streaming_private_requests">
										<?php echo e(__('general.live_streaming_private_requests'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="push_notifications" <?php if(isset($permissions) && in_array('push_notifications', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="push_notifications">
									<label class="form-check-label" for="push_notifications">
										<?php echo e(__('general.push_notifications'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="stories" <?php if(isset($permissions) && in_array('stories', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="stories">
									<label class="form-check-label" for="stories">
										<?php echo e(__('general.stories'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="comments_replies" <?php if(isset($permissions) && in_array('comments_replies', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="comments_replies">
									<label class="form-check-label" for="comments_replies">
										<?php echo e(__('general.comments_replies'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="messages" <?php if(isset($permissions) && in_array('messages', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="messages">
									<label class="form-check-label" for="messages">
										<?php echo e(__('general.messages'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="shop" <?php if(isset($permissions) && in_array('shop', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="shop">
									<label class="form-check-label" for="shop">
										<?php echo e(__('general.shop'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="products" <?php if(isset($permissions) && in_array('products', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="products">
									<label class="form-check-label" for="products">
										<?php echo e(__('general.products'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="shop_categories" <?php if(isset($permissions) && in_array('shop_categories', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="shop_categories">
									<label class="form-check-label" for="shop_categories">
										<?php echo e(__('general.shop_categories'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="storage" <?php if(isset($permissions) && in_array('storage', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="storage">
									<label class="form-check-label" for="storage">
										<?php echo e(__('admin.storage'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="theme" <?php if(isset($permissions) && in_array('theme', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="theme">
									<label class="form-check-label" for="theme">
										<?php echo e(__('admin.theme'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="custom_css_js" <?php if(isset($permissions) && in_array('custom_css_js', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="checkCustomCssJs">
									<label class="form-check-label" for="checkCustomCssJs">
										<?php echo e(__('general.custom_css_js'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="posts" <?php if(isset($permissions) && in_array('posts', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="posts">
									<label class="form-check-label" for="posts">
										<?php echo e(__('general.posts'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="subscriptions" <?php if(isset($permissions) && in_array('subscriptions', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="subscriptions">
									<label class="form-check-label" for="subscriptions">
										<?php echo e(__('admin.subscriptions'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="transactions" <?php if(isset($permissions) && in_array('transactions', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="transactions">
									<label class="form-check-label" for="transactions">
										<?php echo e(__('admin.transactions'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="deposits" <?php if(isset($permissions) && in_array('deposits', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="deposits">
									<label class="form-check-label" for="deposits">
										<?php echo e(__('general.deposits'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="members" <?php if(isset($permissions) && in_array('members', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="members">
									<label class="form-check-label" for="members">
										<?php echo e(__('admin.members'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="advertising" <?php if(isset($permissions) && in_array('advertising', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="advertising">
									<label class="form-check-label" for="advertising">
										<?php echo e(__('general.advertising'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="gifts" <?php if(isset($permissions) && in_array('gifts', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="gifts">
									<label class="form-check-label" for="gifts">
										<?php echo e(__('general.gifts'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="referrals" <?php if(isset($permissions) && in_array('referrals', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="referrals">
									<label class="form-check-label" for="referrals">
										<?php echo e(__('general.referrals'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="languages" <?php if(isset($permissions) && in_array('languages', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="languages">
									<label class="form-check-label" for="languages">
										<?php echo e(__('admin.languages'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="categories" <?php if(isset($permissions) && in_array('categories', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="categories">
									<label class="form-check-label" for="categories">
										<?php echo e(__('admin.categories'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="reports" <?php if(isset($permissions) && in_array('reports', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="reports">
									<label class="form-check-label" for="reports">
										<?php echo e(__('admin.reports'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="withdrawals" <?php if(isset($permissions) && in_array('withdrawals', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="withdrawals">
									<label class="form-check-label" for="withdrawals">
										<?php echo e(__('general.withdrawals'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="verification_requests" <?php if(isset($permissions) && in_array('verification_requests', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="verification_requests">
									<label class="form-check-label" for="verification_requests">
										<?php echo e(__('admin.verification_requests'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="pages" <?php if(isset($permissions) && in_array('pages', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="pages">
									<label class="form-check-label" for="pages">
										<?php echo e(__('admin.pages'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="blog" <?php if(isset($permissions) && in_array('blog', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="blog">
									<label class="form-check-label" for="blog">
										<?php echo e(__('general.blog'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="payment_settings" <?php if(isset($permissions) && in_array('payment_settings', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="payment_settings">
									<label class="form-check-label" for="payment_settings">
										<?php echo e(__('admin.payment_settings'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="profiles_social" <?php if(isset($permissions) && in_array('profiles_social', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="profiles_social">
									<label class="form-check-label" for="profiles_social">
										<?php echo e(__('admin.profiles_social'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="social_login" <?php if(isset($permissions) && in_array('social_login', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="social_login">
									<label class="form-check-label" for="social_login">
										<?php echo e(__('admin.social_login'), false); ?>

									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="google" <?php if(isset($permissions) && in_array('google', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="google">
									<label class="form-check-label" for="google">
										Google
									</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-10 offset-sm-2">
								<div class="form-check">
									<input class="form-check-input check" name="permissions[]" value="pwa" <?php if(isset($permissions) && in_array('pwa', $permissions)): ?> checked="checked" <?php endif; ?> type="checkbox" id="pwa">
									<label class="form-check-label" for="pwa">
										PWA
									</label>
								</div>
							</div>
						</div>
					<?php endif; ?>


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

var triggeredByChild = false;

$('.limitedAccess').on('change', function (event) {

	if ($(this).is(":checked")) {
		triggeredByChild = false;
    $('.check').prop('checked', false);
    $('#select-all').prop('checked', false);
	}

});

$('#select-all').on('change', function (event) {

	if ($(this).is(":checked")) {
    $('.check').prop('checked', true);
    $('.limitedAccess').prop('checked', false);
    triggeredByChild = false;
	}
});

$('.check').on('change', function (event) {
	if ($(this).is(":checked")) {
    triggeredByChild = false;
    $('.limitedAccess').prop('checked', false);
	}
});

$('#select-all').on('change', function (event) {

	if (! $(this).is(":checked")) {
    if (! triggeredByChild) {
        $('.check').prop('checked', false);
    }
    triggeredByChild = false;
	}
});
// Removed the checked state from "All" if any checkbox is unchecked
$('.check').on('change', function (event) {
	if (! $(this).is(":checked")) {
    triggeredByChild = true;
    $('#select-all').prop('checked', false);
	}
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/role-and-permissions-member.blade.php ENDPATH**/ ?>