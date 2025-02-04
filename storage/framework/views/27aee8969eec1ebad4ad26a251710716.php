

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.members'), false); ?> (<?php echo e($data->total(), false); ?>)</span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

      <?php if(session('info_message')): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <i class="bi-exclamation-triangle me-1"></i>	<?php echo e(session('info_message'), false); ?>


                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i class="bi bi-x-lg"></i>
                </button>
                </div>
              <?php endif; ?>

			<?php if(session('success_message')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check2 me-1"></i>	<?php echo e(session('success_message'), false); ?>


                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i class="bi bi-x-lg"></i>
                </button>
                </div>
              <?php endif; ?>

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-4">

          <?php if($data->count() != 0): ?>
						<div class="d-lg-flex justify-content-lg-between align-items-center mb-2 w-100">

							<form action="<?php echo e(url('panel/admin/members'), false); ?>" id="formSort" method="get">
								<select name="sort" id="sort" class="form-select d-inline-block w-auto filter">
									<option <?php if($sort == ''): ?> selected="selected" <?php endif; ?> value=""><?php echo e(__('admin.sort_id'), false); ?></option>
									<option <?php if($sort == 'admins'): ?> selected="selected" <?php endif; ?> value="admins"><?php echo e(__('users.admin'), false); ?></option>
										<option <?php if($sort == 'creators'): ?> selected="selected" <?php endif; ?> value="creators"><?php echo e(__('general.creators'), false); ?></option>
									<option <?php if($sort == 'email_pending'): ?> selected="selected" <?php endif; ?> value="email_pending"><?php echo e(__('general.verification_pending'), false); ?> (<?php echo e(__('auth.email'), false); ?>)</option>
									<option <?php if($sort == 'balance'): ?> selected="selected" <?php endif; ?> value="balance"><?php echo e(__('general.balance'), false); ?></option>
									<option <?php if($sort == 'wallet'): ?> selected="selected" <?php endif; ?> value="wallet"><?php echo e(__('general.wallet'), false); ?></option>
		        		</select>
							</form><!-- form -->

						<!-- form -->
            <form class="mt-lg-0 mt-2 position-relative" role="search" autocomplete="off" action="<?php echo e(url('panel/admin/members'), false); ?>" method="get">
							<i class="bi bi-search btn-search bar-search"></i>
             <input type="text" name="q" class="form-control ps-5 w-auto" value="" placeholder="<?php echo e(__('general.search'), false); ?>">
          </form><!-- form -->
				</div>

            <?php endif; ?>

					<div class="table-responsive p-0">
						<table class="table table-hover">
						 <tbody>

               <?php if($data->total() !=  0 && $data->count() != 0): ?>
                  <tr>
                     <th class="active">ID</th>
										 <th class="active"><?php echo e(__('auth.full_name'), false); ?></th>
										 <th class="active"><?php echo e(__('general.balance'), false); ?></th>
										 <th class="active"><?php echo e(__('general.wallet'), false); ?></th>
										 <th class="active"><?php echo e(__('general.posts'), false); ?></th>
										 <th class="active"><?php echo e(__('admin.date'), false); ?></th>
										 <th class="active"><?php echo e(__('general.last_login'), false); ?></th>
										 <th class="active">IP</th>
										 <th class="active"><?php echo e(__('admin.role'), false); ?></th>
										 <th class="active"><?php echo e(__('admin.verified'), false); ?></th>
										 <th class="active"><?php echo e(__('admin.status'), false); ?></th>
										 <th class="active"><?php echo e(__('admin.actions'), false); ?></th>
                   </tr>

                 <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                     <td><?php echo e($user->id, false); ?></td>
                     <td title="<?php echo e($user->name, false); ?>">
                       <a href="<?php echo e(url($user->username), false); ?>" target="_blank">
                         <img src="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" width="40" height="40" class="rounded-circle me-1" />
												 <?php echo e(str_limit($user->name, 20, '...'), false); ?> <i class="bi-box-arrow-up-right"></i>
                       </a>
                     </td>
                     <td><?php echo e(Helper::amountFormatDecimal($user->balance), false); ?></td>
                     <td><?php echo e(Helper::amountFormatDecimal($user->wallet), false); ?></td>
                     <td><?php echo e($user->updates()->count(), false); ?></td>
                     <td><?php echo e(Helper::formatDate($user->date), false); ?></td>
                     <td><?php echo e(Helper::formatDate($user->last_seen), false); ?></td>
                     <td><?php echo e($user->ip ? $user->ip : __('general.no_available'), false); ?></td>
                     <td>
											 <?php if($user->role == 'admin' && $user->permissions == 'full_access'): ?>
 												<span class="rounded-pill badge bg-primary"><?php echo e(__('general.super_admin'), false); ?></span>
 											<?php elseif($user->role == 'admin' && $user->permissions != 'full_access'): ?>
 													<span class="rounded-pill badge bg-primary"><?php echo e(__('admin.role_admin'), false); ?></span>
 											<?php else: ?>
 												<span class="rounded-pill badge bg-secondary"><?php echo e(__('admin.normal'), false); ?></span>
 											<?php endif; ?>
                     </td>

						<?php
							if ($user->verified_id == 'no' ) {
							$verified    = 'warning';
							$_verified = __('admin.pending');
							} elseif ($user->verified_id == 'yes' ) {
								$verified = 'success';
							$_verified = __('admin.verified');
							} else {
								$verified = 'danger';
							$_verified = __('admin.reject');
							}
						?>

		                        <td><span class="rounded-pill badge bg-<?php echo e($verified, false); ?>"><?php echo e($_verified, false); ?></span></td>

                    <?php
						if ($user->status == 'pending') {
						$mode    = 'info';
						$_status = __('admin.pending');
						} elseif ($user->status == 'active') {
						$mode = 'success';
						$_status = __('admin.active');
						} elseif ($user->status == 'disabled') {
						$mode = 'secondary';
						$_status = __('admin.disabled');
						} else {
						$mode = 'warning';
						$_status = __('admin.suspended');
                        }
                    ?>

                     <td><span class="rounded-pill badge bg-<?php echo e($mode, false); ?>"><?php echo e($_status, false); ?></span></td>
                     <td>

								<div class="d-flex">
                    <?php if($user->id <> auth()->user()->id && $user->id <> 1): ?>

                  <a href="<?php echo e(url('panel/admin/members/edit', $user->id), false); ?>" class="btn btn-success rounded-pill btn-sm me-2">
                         <i class="bi-pencil"></i>
                       </a>

                  <?php echo Form::open([
                 'method' => 'POST',
                 'url' => ['panel/admin/members', $user->id],
                 'id' => 'form'.$user->id,
                 'class' => 'd-inline-block align-top'
               ]); ?>

               <?php echo Form::button('<i class="bi-trash-fill"></i>', ['data-url' => $user->id, 'class' => 'btn btn-danger rounded-pill btn-sm actionDelete']); ?>

           <?php echo Form::close(); ?>

					 </div>

        <?php else: ?>
         ------------
                         <?php endif; ?>
                       </td>

                   </tr><!-- /.TR -->
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									<?php else: ?>
										<h5 class="text-center p-5 text-muted fw-light m-0"><?php echo e(__('general.no_results_found'), false); ?>


                      <?php if(isset($query)): ?>
                        <div class="d-block w-100 mt-2">
                          <a href="<?php echo e(url('panel/admin/members'), false); ?>"><i class="bi-arrow-left me-1"></i> <?php echo e(__('auth.back'), false); ?></a>
                        </div>
                      <?php endif; ?>
                    </h5>
									<?php endif; ?>

								</tbody>
								</table>
							</div><!-- /.box-body -->

				 </div><!-- card-body -->
 			</div><!-- card  -->

		<?php if($data->lastPage() > 1): ?>
			<?php echo e($data->appends(['q' => $query, 'sort' => $sort])->onEachSide(0)->links(), false); ?>

		<?php endif; ?>
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/members.blade.php ENDPATH**/ ?>