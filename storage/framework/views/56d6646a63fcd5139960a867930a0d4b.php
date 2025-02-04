<?php $__env->startSection('title'); ?> <?php echo e(__('general.live_streaming_private_requests'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi-box-arrow-in-down mr-2"></i> <?php echo e(__('general.live_streaming_private_requests'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(__('general.subtitle_live_streaming_private_requests'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if($lives->count() != 0): ?>
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
                    <th class="active"><?php echo e(__('general.buyer'), false); ?></th>
                    <th class="active text-capitalize"><?php echo e(__('general.minutes'), false); ?></th>
                    <th class="active"><?php echo e(__('general.price'), false); ?></th>
                    <th class="active"><?php echo e(__('admin.status'), false); ?></th>
                    <th class="active"><?php echo e(__('admin.date'), false); ?></th>
                  <th scope="col"><?php echo e(__('admin.actions'), false); ?></th>
                </tr>
              </thead>

              <tbody>
                <?php $__currentLoopData = $lives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $live): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td>
                        <?php if(! isset($live->user->username)): ?>
                        <?php echo e(__('general.no_available'), false); ?>

                        <?php else: ?>
                        <a href="<?php echo e(url($live->user->username), false); ?>" target="_blank">
                        <?php echo e($live->user->name, false); ?> <i class="bi-box-arrow-up-right"></i> 
                        
                            <?php if(!$live->status->value): ?>
                                <span class="badge badge-pill badge-<?php echo e(Helper::isOnline($live->user->id) ? 'success' : 'danger', false); ?>">
                                    <?php echo e(Helper::isOnline($live->user->id) ? __('general.online') : __('general.offline'), false); ?>

                                </span>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo e($live->minutes, false); ?>

                    </td>
                    <td><?php echo e(Helper::amountFormatDecimal($live->transaction->amount), false); ?></td>
                    <td>
                        <span class="badge badge-pill badge-<?php echo e($live->status->label(), false); ?> text-uppercase">
                            <?php echo e($live->status->locale(), false); ?>

                        </span>
                    </td>
                    <td><?php echo e(Helper::formatDate($live->created_at), false); ?></td>

                    <td>
                        <div class="d-flex">
                          <?php if(!$live->status->value): ?>
                            <form class="d-inline-block" method="post" action="<?php echo e(route('live.accept', ['live' => $live->id]), false); ?>">
                              <?php echo csrf_field(); ?>
                              <button <?php if(!Helper::isOnline($live->user->id)): echo 'disabled'; endif; ?> type="submit" title="<?php echo e(!Helper::isOnline($live->user->id) ? __('general.user_online_accept_request') : __('general.accept_request'), false); ?>" class="mr-2 btn btn-success btn-sm-custom actionAcceptLive">
                                <i class="bi-check2"></i>
                              </button>
                            </form>
  
                            <form class="d-inline-block" method="post" action="<?php echo e(route('live.reject', ['live' => $live->id]), false); ?>">
                              <?php echo csrf_field(); ?>
                              <button title="<?php echo e(__('general.reject_request'), false); ?>" class="btn btn-danger btn-sm-custom actionAcceptReject rejectLiveRequest" type="button">
                                <i class="bi-x-lg"></i>
                              </button>
                            </form>
                            </div>

                            <?php else: ?>
                            <?php echo e(__('general.not_applicable'), false); ?>

                          <?php endif; ?>
                      </td>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </tbody>
            </table>
          </div>
          </div><!-- card -->
          <small class="w-100 d-block mt-2"><?php echo e(__('general.info_live_streaming_private_requests'), false); ?></small>

            <?php if($lives->hasPages()): ?>
              <div class="mt-2">
                <?php echo e($lives->onEachSide(0)->links(), false); ?>

            </div>
    		<?php endif; ?>

        <?php else: ?>
          <div class="my-5 text-center">
            <span class="btn-block mb-3">
              <i class="bi-box-arrow-in-down ico-no-result"></i>
            </span>
            <h4 class="font-weight-light"><?php echo e(__('general.no_results_found'), false); ?></h4>
          </div>
        <?php endif; ?>

        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/live-streaming-private-requests.blade.php ENDPATH**/ ?>