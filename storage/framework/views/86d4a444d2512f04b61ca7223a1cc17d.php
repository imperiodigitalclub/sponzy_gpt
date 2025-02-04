<?php $__env->startSection('title'); ?> <?php echo e(trans('general.products'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi-tag mr-2"></i> <?php echo e(trans('general.products'), false); ?></h2>
          <p class="lead text-muted m-0"><?php echo e(trans('general.all_products_published'), false); ?></p>

          <div class="mt-2">
            <?php if($settings->digital_product_sale && ! $settings->custom_content && ! $settings->physical_products): ?>
              <a class="btn btn-primary" href="<?php echo e(url('add/product'), false); ?>">
                <i class="bi-plus"></i> <?php echo e(__('general.add_product'), false); ?>

              </a>

            <?php elseif(! $settings->digital_product_sale && $settings->custom_content && ! $settings->physical_products): ?>
              <a class="btn btn-primary" href="<?php echo e(url('add/custom/content'), false); ?>">
                <i class="bi-plus"></i> <?php echo e(__('general.add_custom_content'), false); ?>

              </a>

            <?php elseif(! $settings->digital_product_sale && $settings->physical_products && ! $settings->custom_content): ?>
              <a class="btn btn-primary" href="<?php echo e(url('add/physical/product'), false); ?>">
                <i class="bi-plus"></i> <?php echo e(__('general.add_physical_product'), false); ?>

              </a>

            <?php else: ?>
              <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addItemForm">
                <i class="bi-plus"></i> <?php echo e(__('general.add_new'), false); ?>

              </a>
            <?php endif; ?>
          </div>

        </div>
      </div>
      <div class="row">

        <div class="col-md-12 mb-5 mb-lg-0">

          <?php if($products->count() != 0): ?>
          <div class="card shadow-sm">
          <div class="table-responsive">
            <table class="table table-striped m-0">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col"><?php echo e(trans('admin.name'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.type'), false); ?></th>
                  <th scope="col"><?php echo e(trans('general.price'), false); ?></th>
                  <th scope="col"><?php echo e(trans('general.sales'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.date'), false); ?></th>
                  <th scope="col"><?php echo e(trans('admin.status'), false); ?></th>
                </tr>
              </thead>

              <tbody>

                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <tr>
                    <td><?php echo e($product->id, false); ?></td>

                    <td>
                    <a href="<?php echo e(url('shop/product', $product->id), false); ?>" target="_blank">
                      <?php echo e(str_limit($product->name, 20, '...'), false); ?> <i class="bi bi-box-arrow-up-right ml-1"></i>
                    </a>
                    </td>
                    <td><?php echo e(($product->type == 'digital') ? __('general.digital_download') : (($product->type == 'physical') ? __('general.physical_products') : __('general.custom_content')), false); ?></td>
                    <td><?php echo e(Helper::amountFormatDecimal($product->price), false); ?></td>
                    <td><?php echo e($product->purchases->count(), false); ?></td>
                    <td><?php echo e(Helper::formatDate($product->created_at), false); ?></td>
                    <td>
                      <?php if($product->status): ?>
                        <span class="badge badge-pill badge-success text-uppercase"><?php echo e(trans('general.active'), false); ?></span>
                      <?php else: ?>
                        <span class="badge badge-pill badge-secondary text-uppercase"><?php echo e(trans('admin.disabled'), false); ?></span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
          </div><!-- card -->

          <?php if($products->hasPages()): ?>
  			    	<?php echo e($products->onEachSide(0)->links(), false); ?>

  			    	<?php endif; ?>

        <?php else: ?>
          <div class="my-5 text-center">
            <span class="btn-block mb-3">
              <i class="bi-tag ico-no-result"></i>
            </span>
            <h4 class="font-weight-light"><?php echo e(trans('general.no_results_found'), false); ?></h4>
          </div>
        <?php endif; ?>
        </div><!-- end col-md-6 -->

      </div>
    </div>
  </section>

  <?php echo $__env->renderWhen(auth()->check() && auth()->user()->verified_id == 'yes', 'shop.modal-add-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/my_products.blade.php ENDPATH**/ ?>