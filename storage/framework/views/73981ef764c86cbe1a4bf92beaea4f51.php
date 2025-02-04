

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/admin/jvectormap/jquery-jvectormap-1.2.2.css'), false); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<h4 class="mb-4 fw-light"><?php echo e(__('admin.dashboard'), false); ?> <small class="fs-6">v<?php echo e($settings->version, false); ?></small></h4>

<div class="content">
	<div class="row">

		<div class="col-lg-3 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h3>
						<i class="bi-arrow-repeat me-2 icon-dashboard"></i>
						<span><?php echo e(number_format($total_subscriptions), false); ?></span>
					</h3>
					<small><?php echo e(__('admin.subscriptions'), false); ?></small>

					<span class="icon-wrap icon--admin"><i class="bi-arrow-repeat"></i></span>
				</div>
				<div class="card-footer bg-light border-0 p-3">
					<a href="<?php echo e(url('panel/admin/subscriptions'), false); ?>" class="text-muted font-weight-medium d-flex align-items-center justify-content-center arrow">
						  <?php echo e(__('general.view_all'), false); ?>

					  </a>
				  </div>
			</div><!-- card 1 -->
		</div><!-- col-lg-3 -->

		<div class="col-lg-3 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h3><i class="bi-cash-stack me-2 icon-dashboard"></i> <?php echo e(Helper::amountFormatDecimal($total_raised_funds), false); ?></h3>
					<small><?php echo e(__('admin.earnings_net'), false); ?> (<?php echo e(__('users.admin'), false); ?>)</small>

					<span class="icon-wrap icon--admin"><i class="bi-cash-stack"></i></span>
				</div>
				<div class="card-footer bg-light border-0 p-3">
					<a href="<?php echo e(url('panel/admin/transactions'), false); ?>" class="text-muted font-weight-medium d-flex align-items-center justify-content-center arrow">
						  <?php echo e(__('general.see_all_transactions'), false); ?>

					  </a>
				  </div>
			</div><!-- card 1 -->
		</div><!-- col-lg-3 -->

		<div class="col-lg-3 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h3><i class="bi-people me-2 icon-dashboard"></i> <?php echo e(number_format($totalUsers), false); ?></h3>
					<small><?php echo e(__('general.members'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi-people"></i></span>
				</div>
				<div class="card-footer bg-light border-0 p-3">
					<a href="<?php echo e(url('panel/admin/members'), false); ?>" class="text-muted font-weight-medium d-flex align-items-center justify-content-center arrow">
						  <?php echo e(__('general.view_all'), false); ?>

					  </a>
				  </div>
			</div><!-- card 1 -->
		</div><!-- col-lg-3 -->

		<div class="col-lg-3 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h3><i class="bi-pencil-square me-2 icon-dashboard"></i> <?php echo e(number_format($total_posts), false); ?></h3>
					<small><?php echo e(__('general.posts'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi-pencil-square"></i></span>
				</div>
				<div class="card-footer bg-light border-0 p-3">
					<a href="<?php echo e(url('panel/admin/posts'), false); ?>" class="text-muted font-weight-medium d-flex align-items-center justify-content-center arrow">
						  <?php echo e(__('general.view_all'), false); ?>

					  </a>
				  </div>
			</div><!-- card 1 -->
		</div><!-- col-lg-3 -->

		<div class="col-lg-4 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h6>
						<?php echo e(Helper::amountFormatDecimal($total_funds), false); ?>

					</h6>
					<small><?php echo e(__('general.total_revenue'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi bi-graph-up-arrow"></i></span>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-4 -->

		<div class="col-lg-4 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h6>
						<?php echo e(Helper::amountFormatDecimal($total_paid_funds), false); ?>

					</h6>
					<small><?php echo e(__('general.paid_to_creators'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi bi-graph-up-arrow"></i></span>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-4 -->

		<div class="col-lg-4 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h6>
						<?php echo e(Helper::amountFormatDecimal($totalPaidlastMonth), false); ?>

					</h6>
					<small><?php echo e(__('general.paid_last_month'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi bi-graph-up-arrow"></i></span>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-4 -->

		<div class="col-lg-4 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h6 class="<?php echo e($stat_revenue_today > 0 ? 'text-success' : 'text-danger', false); ?>">
						<?php echo e(Helper::amountFormatDecimal($stat_revenue_today), false); ?>


							<?php echo Helper::percentageIncreaseDecreaseAdmin($stat_revenue_today, $stat_revenue_yesterday); ?>

					</h6>
					<small><?php echo e(__('general.revenue_today'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi bi-graph-up-arrow"></i></span>
				</div>
				<div class="card-footer bg-light border-0 p-3">
					<small class="text-capitalize"><?php echo e(__('general.yesterday'), false); ?> <strong><?php echo e(Helper::amountFormatDecimal($stat_revenue_yesterday), false); ?></strong></small>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-4 -->

		<div class="col-lg-4 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h6 class="<?php echo e($stat_revenue_week > 0 ? 'text-success' : 'text-danger', false); ?>">
						<?php echo e(Helper::amountFormatDecimal($stat_revenue_week), false); ?>


							<?php echo Helper::percentageIncreaseDecreaseAdmin($stat_revenue_week, $stat_revenue_last_week); ?>

					</h6>
					<small><?php echo e(__('general.revenue_week'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi bi-graph-up"></i></span>
				</div>
				<div class="card-footer bg-light border-0 p-3">
					<small class="text-capitalize"><?php echo e(__('general.last_week'), false); ?> <strong><?php echo e(Helper::amountFormatDecimal($stat_revenue_last_week), false); ?></strong></small>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-4 -->

		<div class="col-lg-4 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h6 class="<?php echo e($stat_revenue_month > 0 ? 'text-success' : 'text-danger', false); ?>">
						<?php echo e(Helper::amountFormatDecimal($stat_revenue_month), false); ?>


							<?php echo Helper::percentageIncreaseDecreaseAdmin($stat_revenue_month, $stat_revenue_last_month); ?>

					</h6>
					<small><?php echo e(__('general.revenue_month'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi bi-graph-up-arrow"></i></span>
				</div>
				<div class="card-footer bg-light border-0 p-3">
					<small class="text-capitalize"><?php echo e(__('general.last_month'), false); ?> <strong><?php echo e(Helper::amountFormatDecimal($stat_revenue_last_month), false); ?></strong></small>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-4 -->

		<div class="col-lg-12 mt-3 py-4">
			 <div class="card shadow-custom border-0">
				 <div class="card-body">
					<div class="d-lg-flex d-block justify-content-between align-items-center mb-4">
						<h6 class="mb-4 mb-lg-0"><i class="bi-cash-stack me-2"></i> <?php echo e(trans('general.earnings'), false); ?></h6>
  
					   <select class="form-select mb-4 mb-lg-0 w-auto d-block filterEarnings">
						<option selected="" value="month"><?php echo e(__('general.this_month'), false); ?></option>
						<option value="last-month"><?php echo e(__('general.last_month'), false); ?></option>
						<option value="year"><?php echo e(__('general.this_year'), false); ?></option>       
					  </select>
					  </div>
					 
					 <div class="d-block position-relative" style="height: 350px">
                        <div class="blocked display-none" id="loadChart">
                          <span class="d-flex justify-content-center align-items-center text-center w-100 h-100">
                           <i class="spinner-border spinner-border-sm me-2 text-muted"></i> <?php echo e(__('general.loading'), false); ?>

                          </span>
                      </div>
                      <canvas id="ChartSales"></canvas>
                    </div>
				 </div>
			 </div>
		</div>

		<div class="col-lg-12 mt-0 mt-lg-3 py-4">
			 <div class="card shadow-custom border-0">
				 <div class="card-body">
					 <h6 class="mb-4"><i class="bi-person-check-fill me-2"></i> <?php echo e(__('general.subscriptions_the_month'), false); ?></h6>
					 <div style="height: 350px">
						<canvas id="ChartSubscriptions"></canvas>
					</div>
				 </div>
			 </div>
		</div>

		<div class="col-lg-6 mt-0 mt-lg-3 py-4">
			 <div class="card shadow-custom border-0">
				 <div class="card-body">
					 <h6 class="mb-4"><i class="bi-people-fill me-2"></i> <?php echo e(__('admin.latest_members'), false); ?></h6>

					 <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						 <div class="d-flex mb-3">
							  <div class="flex-shrink-0">
							    <img src="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" width="50" class="rounded-circle" />
							  </div>
							  <div class="flex-grow-1 ms-3">
							    <h6 class="m-0 fw-light text-break">
										<a href="<?php echo e(url($user->username), false); ?>" target="_blank">
											<?php echo e($user->name ?: $user->username, false); ?>

											</a>
											<small class="float-end badge rounded-pill bg-<?php echo e($user->status == 'active' ? 'success' : ($user->status == 'pending' ? 'info' : 'warning'), false); ?>">
												<?php echo e($user->status == 'active' ? __('general.active') : ($user->status == 'pending' ? __('general.pending') : __('admin.suspended')), false); ?>

											</small>
									</h6>
									<div class="w-100 small">
										<?php echo e('@'.$user->username, false); ?> / <?php echo e(Helper::formatDate($user->date), false); ?>

									</div>
							  </div>
							</div>
					 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					 <?php if($users->count() == 0): ?>
						 <small><?php echo e(__('admin.no_result'), false); ?></small>
					 <?php endif; ?>
				 </div>

				 <?php if($users->count() != 0): ?>
				 <div class="card-footer bg-light border-0 p-3">
					   <a href="<?php echo e(url('panel/admin/members'), false); ?>" class="text-muted font-weight-medium d-flex align-items-center justify-content-center arrow">
							 <?php echo e(__('admin.view_all_members'), false); ?>

						 </a>
					 </div>
				 <?php endif; ?>

			 </div>
		</div>

		<div class="col-lg-6 mt-0 mt-lg-3 py-4">
			 <div class="card shadow-custom border-0">
				 <div class="card-body">
					 <h6 class="mb-4"><i class="bi-person-check-fill me-2"></i> <?php echo e(__('admin.recent_subscriptions'), false); ?></h6>

					 <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						 <div class="d-flex mb-3">
							 <div class="flex-shrink-0">
								 <img src="<?php echo e(isset($subscription->subscriber->username) ? Helper::getFile(config('path.avatar').$subscription->subscriber->avatar) : Helper::getFile(config('path.avatar').$settings->avatar), false); ?>" width="50" class="rounded-circle" />
							 </div>
							  <div class="flex-grow-1 ms-3">
							    <h6 class="m-0 fw-light text-break">
										<?php if(! isset($subscription->subscriber->username)): ?>
											<em class="text-muted"><?php echo e(__('general.no_available'), false); ?></em>
									<?php else: ?>
										<a href="<?php echo e(url($subscription->subscriber->username), false); ?>" target="_blank">
											<?php echo e($subscription->subscriber->name, false); ?>

											</a>
										<?php endif; ?>

										<?php echo e(__('general.subscribed_to'), false); ?>


										<?php if(! isset($subscription->creator->username)): ?>
											<em class="text-muted"><?php echo e(__('general.no_available'), false); ?></em>
									<?php else: ?>
										<a href="<?php echo e(url($subscription->creator->username), false); ?>" target="_blank"><?php echo e($subscription->creator->name, false); ?></a>
									<?php endif; ?>

									</h6>

									<div class="w-100 small">
										<?php echo e(Helper::formatDate($subscription->created_at), false); ?>

									</div>
							  </div>
							</div>
					 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					 <?php if($subscriptions->count() == 0): ?>
						 <small><?php echo e(__('admin.no_result'), false); ?></small>
					 <?php endif; ?>
				 </div>

				 <?php if($subscriptions->count() != 0): ?>
				 <div class="card-footer bg-light border-0 p-3">
					   <a href="<?php echo e(url('panel/admin/subscriptions'), false); ?>" class="text-muted font-weight-medium d-flex align-items-center justify-content-center arrow">
							 <?php echo e(__('general.view_all'), false); ?>

						 </a>
					 </div>
					  <?php endif; ?>
			 </div>
		</div>

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('public/admin/jvectormap/jquery-jvectormap-1.2.2.min.js'), false); ?>" type="text/javascript"></script>
	<script src="<?php echo e(asset('public/admin/jvectormap/jquery-jvectormap-world-mill-en.js'), false); ?>" type="text/javascript"></script>
  <script src="<?php echo e(asset('public/js/Chart.min.js'), false); ?>"></script>
	<?php echo $__env->make('admin.charts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>