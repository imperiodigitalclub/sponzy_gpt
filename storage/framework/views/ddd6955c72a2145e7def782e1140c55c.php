<?php $__env->startSection('title'); ?> <?php echo e(trans('general.purchased_items'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi-bag-check mr-2"></i> <?php echo e(trans('general.purchased_items'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.purchased_items_subtitle'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if($purchases->count() != 0): ?>

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
                  <th scope="col"><?php echo e(trans('general.item'), false); ?></th>
                  <th scope="col"><?php echo e(trans('general.type'), false); ?></th>
                  <th scope="col"><?php echo e(trans('general.delivery_status'), false); ?></th>
                  <th scope="col"><?php echo e(trans('general.price'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.date'), false); ?></th>
                </tr>
              </thead>

              <tbody>
                <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td>
                      <a href="<?php echo e(url('shop/product', $purchase->products()->id), false); ?>">
                        <?php echo e(Str::limit($purchase->products()->name, 25, '...'), false); ?>

                      </a>
                      </td>
                      <td><?php echo e($purchase->products()->type == 'digital' ? __('general.digital_download') : (($purchase->products()->type == 'physical') ? __('general.physical_products') : __('general.custom_content')), false); ?></td>
                      <td>
                        <?php if($purchase->delivery_status == 'delivered'): ?>
                          <span class="badge badge-pill badge-success text-uppercase"><?php echo e(__('general.delivered'), false); ?></span>

                        <?php else: ?>
                          <span class="badge badge-pill badge-warning text-uppercase"><?php echo e(__('general.pending'), false); ?></span>
                        <?php endif; ?>
                      </td>
                    <td><?php echo e(Helper::amountFormatDecimal($purchase->transactions()->amount), false); ?></td>
                    <td><?php echo e(Helper::formatDate($purchase->created_at), false); ?></td>

                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </tbody>
            </table>
          </div>
          </div><!-- card -->

            <?php if($purchases->hasPages()): ?>
              <div class="mt-2">
    			    	<?php echo e($purchases->onEachSide(0)->links(), false); ?>

                </div>
    			    	<?php endif; ?>

        <?php else: ?>
          <div class="my-5 text-center">
            <span class="btn-block mb-3">
              <i class="bi-bag-x ico-no-result"></i>
            </span>
            <h4 class="font-weight-light"><?php echo e(trans('general.no_results_found'), false); ?></h4>
          </div>
        <?php endif; ?>

        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/purchased_items.blade.php ENDPATH**/ ?>