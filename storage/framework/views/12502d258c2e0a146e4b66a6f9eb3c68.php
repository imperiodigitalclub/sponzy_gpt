<?php $__env->startSection('title'); ?> <?php echo e(__('users.my_subscribers'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="feather icon-users mr-2"></i> <?php echo e(__('users.my_subscribers'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(__('users.my_subscribers_subtitle'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if($subscriptions->count() != 0): ?>
          <div class="card shadow-sm">
          <div class="table-responsive">
            <table class="table table-striped m-0">
              <thead>
                <tr>
                  <th scope="col"><?php echo e(__('general.subscriber'), false); ?></th>
                  <th scope="col"><?php echo e(__('admin.date'), false); ?></th>
                  <th scope="col"><?php echo e(__('general.interval'), false); ?></th>
                  <th scope="col"><?php echo e(__('admin.ends_at'), false); ?></th>
                  <th scope="col"><?php echo e(__('admin.status'), false); ?></th>
                </tr>
              </thead>

              <tbody>

                <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td>
                      <?php if(! isset($subscription->subscriber->username)): ?>
                        <?php echo e(__('general.no_available'), false); ?>

                      <?php else: ?>
                      <a href="<?php echo e(url($subscription->subscriber->username), false); ?>" class="mr-1">
                        <img src="<?php echo e(Helper::getFile(config('path.avatar').$subscription->subscriber->avatar), false); ?>" width="40" height="40" class="rounded-circle mr-2">

                        <?php echo e($subscription->subscriber->hide_name == 'yes' ? $subscription->subscriber->username : $subscription->subscriber->name, false); ?>

                      </a>

                      <a href="<?php echo e(url('messages/'.$subscription->subscriber->id, $subscription->subscriber->username), false); ?>" title="<?php echo e(__('general.message'), false); ?>">
                        <i class="feather icon-send mr-1 mr-lg-0"></i>
                      </a>
                      <?php endif; ?>
                    </td>
                    <td><?php echo e(Helper::formatDate($subscription->created_at), false); ?></td>
                    <td><?php echo e($subscription->free == 'yes'? __('general.not_applicable') : __('general.'.$subscription->interval), false); ?></td>
                <td>
                      <?php if($subscription->ends_at): ?>
                    <?php echo e(Helper::formatDate($subscription->ends_at), false); ?>

                  <?php elseif($subscription->free == 'yes'): ?>
                    <?php echo e(__('general.free_subscription'), false); ?>

                  <?php else: ?>
                  <?php echo e(__('general.no_available'), false); ?>

                  <?php endif; ?>
                </td>

                    <td>
                      <?php if($subscription->stripe_id == ''
                        && strtotime($subscription->ends_at) > strtotime(now()->format('Y-m-d H:i:s'))
                        && $subscription->cancelled == 'no'
                          || $subscription->stripe_id != '' && $subscription->stripe_status == 'active'
                          || $subscription->stripe_id == '' && $subscription->free == 'yes'
                        ): ?>
                        <span class="badge badge-pill badge-success text-uppercase"><?php echo e(__('general.active'), false); ?></span>
                      <?php elseif($subscription->stripe_id != '' && $subscription->stripe_status == 'incomplete'): ?>
                        <span class="badge badge-pill badge-warning text-uppercase"><?php echo e(__('general.incomplete'), false); ?></span>
                      <?php else: ?>
                        <span class="badge badge-pill badge-danger text-uppercase"><?php echo e(__('general.cancelled'), false); ?></span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
          </div><!-- card -->

          <?php if($subscriptions->hasPages()): ?>
  			    	<?php echo e($subscriptions->links(), false); ?>

  			    	<?php endif; ?>

        <?php else: ?>
          <div class="my-5 text-center">
            <span class="btn-block mb-3">
              <i class="feather icon-users ico-no-result"></i>
            </span>
            <h4 class="font-weight-light"><?php echo e(__('users.not_subscribers'), false); ?></h4>
          </div>
        <?php endif; ?>
        </div><!-- end col-md-6 -->

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/my_subscribers.blade.php ENDPATH**/ ?>