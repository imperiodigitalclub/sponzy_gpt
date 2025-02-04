

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <a class="text-reset" href="<?php echo e(url('panel/admin/members'), false); ?>"><?php echo e(__('admin.members'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.edit'), false); ?></span>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e($user->username, false); ?></span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-9 mb-4">

    <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-5">

					 <form class="form-horizontal" method="POST" action="<?php echo e(url('panel/admin/members/edit', $user->id), false); ?>" enctype="multipart/form-data">
             <?php echo csrf_field(); ?>
             <input type="hidden" name="id" value="<?php echo e($user->id, false); ?>">

             <div class="row mb-3">
 		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.avatar'), false); ?></label>
 		          <div class="col-sm-10">
 		            <img src="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" width="120" height="120" class="rounded-circle" />
 		          </div>
 		        </div>

		        <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('admin.name'), false); ?></label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($user->name, false); ?>" name="name" type="text" class="form-control">
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('auth.username'), false); ?></label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($user->username, false); ?>" disabled type="text" class="form-control">
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('auth.email'), false); ?></label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($user->email, false); ?>" name="email" type="text" class="form-control">
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('admin.verified'), false); ?> (<?php echo e(__('general.creator'), false); ?>)</label>
		          <div class="col-sm-10">
		            <select name="verified" class="form-select">
									<option <?php if($user->verified_id == 'no'): ?> selected="selected" <?php endif; ?> value="no"><?php echo e(__('admin.pending'), false); ?></option>
							  	<option <?php if($user->verified_id == 'yes'): ?> selected="selected" <?php endif; ?> value="yes"><?php echo e(__('admin.verified'), false); ?></option>
							  	<option <?php if($user->verified_id == 'reject'): ?> selected="selected" <?php endif; ?> value="reject"><?php echo e(__('admin.reject'), false); ?></option>
		           </select>
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('admin.status'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="status" class="form-select">
                  <option <?php if($user->status == 'active'): ?> selected="selected" <?php endif; ?> value="active"><?php echo e(__('admin.active'), false); ?></option>
                  <option <?php if($user->status == 'pending'): ?> selected="selected" <?php endif; ?> value="pending"><?php echo e(__('admin.pending'), false); ?></option>
				  <?php if($user->verified_id == 'yes'): ?>
				  <option <?php if($user->status == 'disabled'): ?> selected="selected" <?php endif; ?> value="disabled"><?php echo e(__('admin.disabled'), false); ?></option>
				  <?php endif; ?>
                  <option <?php if($user->status == 'suspended'): ?> selected="suspended" <?php endif; ?> value="suspended"><?php echo e(__('admin.suspended'), false); ?></option>
		           </select>
		          </div>
		        </div>

						<?php if($user->verified_id == 'yes'): ?>
						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('general.custom_fee'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="custom_fee" class="form-select">
									<option <?php if($user->custom_fee == 0): ?> selected="selected" <?php endif; ?> value="0" ><?php echo e(__('general.none'), false); ?></option>
                  <?php for($i=1; $i <= 50; ++$i): ?>
                    <option <?php if($user->custom_fee == $i): ?> selected="selected" <?php endif; ?> value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?>%</option>
                    <?php endfor; ?>
		           </select>
		          </div>
		        </div>
						<?php endif; ?>

						<div class="row mb-3">
 							<label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.balance'), false); ?></label>
 							<div class="col-sm-10">
 								<input value="<?php echo e($user->balance, false); ?>" name="balance" type="text" class="form-control isNumber" autocomplete="off">
 							</div>
 						</div>

						<div class="row mb-3">
 							<label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.wallet'), false); ?></label>
 							<div class="col-sm-10">
 								<input value="<?php echo e($user->wallet, false); ?>" name="wallet" type="text" class="form-control isNumber" autocomplete="off">
 							</div>
 						</div>

			<?php if($user->verified_id == 'yes'): ?>
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.featured'), false); ?></legend>
              <div class="col-sm-10">
                <div class="form-check form-switch form-switch-md">
                 <input class="form-check-input" type="checkbox" name="featured" <?php if($user->featured == 'yes'): ?> checked="checked" <?php endif; ?> value="yes" role="switch">
               </div>
              </div>
            </fieldset><!-- end row -->
			<?php endif; ?>

						<div class="row mb-3">
		          <div class="col-sm-10 offset-sm-2">
		            <button type="submit" class="btn btn-dark mt-3 px-5 me-2"><?php echo e(__('admin.save'), false); ?></button>
                <a href="<?php echo e(url($user->username), false); ?>" target="_blank" class="btn btn-link text-reset mt-3 px-3 e-none text-decoration-none"><?php echo e(__('admin.view'), false); ?> <i class="bi-box-arrow-up-right ms-1"></i></a>
		          </div>
		        </div>

		       </form>

				 </div><!-- card-body -->
 			</div><!-- card  -->
 		</div><!-- col-lg-9 -->

		<div class="col-md-3">
      <div class="d-block text-center mb-3">

      <a href="<?php echo e(url('panel/admin/members/roles-and-permissions', $user->id), false); ?>" class="btn btn-lg btn-primary rounded-pill w-100 mb-3">
        <?php echo e(__('general.role_and_permissions'), false); ?>

      </a>

      <?php if($user->status == 'pending'): ?>
        <a href="<?php echo e(url('panel/admin/resend/email', $user->id), false); ?>" class="btn btn-lg btn-light border rounded-pill w-100 mb-3">
          <?php echo e(__('general.resend_confirmation_email'), false); ?>

        </a>
      <?php endif; ?>

      <?php echo Form::open([
            'method' => 'post',
            'url' => ['panel/admin/login/user', $user->id],
            'class' => 'displayInline'
          ]); ?>

  	        <?php echo Form::submit(__('general.login_as_user'), ['class' => 'btn btn-lg btn-success rounded-pill w-100 mb-3 loginAsUser']); ?>

  	    <?php echo Form::close(); ?>


  		<?php echo Form::open([
            'method' => 'post',
            'url' => url('panel/admin/members', $user->id),
            'class' => 'displayInline'
          ]); ?>

  	        <?php echo Form::submit(__('admin.delete'), ['data-url' => $user->id, 'class' => 'btn btn-lg btn-danger rounded-pill w-100 mb-3 actionDelete']); ?>

  	    <?php echo Form::close(); ?>

	        </div>

          <?php

          if ($user->status == 'pending') {
            $_status = __('admin.pending');
          } elseif ($user->status == 'active') {
            $_status = __('admin.active');
          } else {
            $_status = __('admin.suspended');
          }

        ?>

          <ol class="list-group">
            <li class="list-group-item border-none"> <strong><?php echo e(__('admin.registered'), false); ?></strong>: <span class="pull-right color-strong"><?php echo e(Helper::formatDate($user->date), false); ?></span></li>
            <li class="list-group-item border-none"> <strong><?php echo e(__('general.last_login'), false); ?></strong>: <span class="pull-right color-strong"><?php echo e(Helper::formatDate($user->last_seen), false); ?></span></li>
            <li class="list-group-item border-none"> <strong><?php echo e(__('admin.status'), false); ?></strong>: <span class="pull-right color-strong"><?php echo e($_status, false); ?></span></li>
            <li class="list-group-item border-none"> <strong><?php echo e(__('admin.role'), false); ?></strong>: <span class="pull-right color-strong"><?php echo e($user->role == 'admin' ? __('admin.role_admin') : __('admin.normal'), false); ?></span></li>
            <li class="list-group-item border-none"> <strong><?php echo e(__('general.country'), false); ?></strong>: <span class="pull-right color-strong"><?php if($user->countries_id != ''): ?> <?php echo e($user->country()->country_name, false); ?> <?php else: ?> <?php echo e(__('admin.not_established'), false); ?> <?php endif; ?></span></li>
            <li class="list-group-item border-none"> <strong><?php echo e(__('general.gender'), false); ?></strong>: <span class="pull-right color-strong"><?php echo e($user->gender ? __('general.'.$user->gender) : __('general.not_specified'), false); ?></span></li>
            <li class="list-group-item border-none"> <strong><?php echo e(__('general.birthdate'), false); ?></strong>: <span class="pull-right color-strong"><?php echo e($user->birthdate ? $user->birthdate : __('general.no_available'), false); ?></span></li>
          </ol>

        </div><!-- col-md-3 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/edit-member.blade.php ENDPATH**/ ?>