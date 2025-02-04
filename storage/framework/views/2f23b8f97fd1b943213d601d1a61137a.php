<?php $__env->startSection('title'); ?> <?php echo e(trans('general.restricted_users'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="feather icon-slash mr-2"></i> <?php echo e(trans('general.restricted_users'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.info_restricted_users'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if($restrictions->count() != 0): ?>

            <?php if(session('message')): ?>
            <div class="alert alert-success mb-3">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="far fa-times-circle"></i></span>
              </button>
              <i class="fa fa-check mr-1"></i> <?php echo e(session('message'), false); ?>

            </div>
            <?php endif; ?>

            <?php if(session('error_message')): ?>
            <div class="alert alert-danger mb-3">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="far fa-times-circle"></i></span>
              </button>
              <i class="fa fa-check mr-1"></i> <?php echo e(session('error_message'), false); ?>

            </div>
            <?php endif; ?>

          <div class="card shadow-sm">
          <div class="table-responsive">
            <table class="table table-striped m-0">
              <thead>
                <tr>
                  <th scope="col"><?php echo e(trans('general.user'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.date'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.actions'), false); ?></th>
                </tr>
              </thead>

              <tbody>
                <?php $__currentLoopData = $restrictions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restriction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                      <td>
                        <?php if(! isset($restriction->userRestricted()->username)): ?>
                          <?php echo e(trans('general.no_available'), false); ?>

                        <?php else: ?>
                        <a href="<?php echo e(url($restriction->userRestricted()->username), false); ?>">
                          <img src="<?php echo e(Helper::getFile(config('path.avatar').$restriction->userRestricted()->avatar), false); ?>" width="40" height="40" class="rounded-circle mr-2">

                          <?php echo e('@'.$restriction->userRestricted()->username, false); ?>

                        </a>
                      <?php endif; ?>
                      </td>
                    <td><?php echo e(Helper::formatDate($restriction->created_at), false); ?></td>

                    <td>
                      <button title="" class="btn btn-danger btn-sm-custom removeRestriction" type="button" data-user="<?php echo e($restriction->userRestricted()->id, false); ?>" id="restrictUser">
                        <i class="bi-trash"></i> <?php echo e(__('general.remove_restriction'), false); ?>

                      </button>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </tbody>
            </table>
          </div>
          </div><!-- card -->

            <?php if($restrictions->hasPages()): ?>
              <div class="mt-2">
    			    	<?php echo e($restrictions->onEachSide(0)->links(), false); ?>

                </div>
    			    	<?php endif; ?>

        <?php else: ?>
          <div class="my-5 text-center">
            <span class="btn-block mb-3">
              <i class="feather icon-slash ico-no-result"></i>
            </span>
            <h4 class="font-weight-light"><?php echo e(trans('general.no_results_found'), false); ?></h4>
          </div>
        <?php endif; ?>

        </div><!-- end col-md-6 -->

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/restricted_users.blade.php ENDPATH**/ ?>