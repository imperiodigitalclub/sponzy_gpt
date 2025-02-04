

<?php $__env->startSection('title'); ?> <?php echo e(__('general.shop'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-12 py-5">
          <h2 class="mb-0 text-break">
            <?php echo e(__('general.shop'), false); ?> <?php if(request('tags')): ?> "<?php echo e(request('tags'), false); ?>" <?php endif; ?>
              <?php if(request('cat')): ?> - <?php echo e(__('general.category'), false); ?> "<?php echo e(Lang::has('shop-categories.' . $category->slug) ? __('shop-categories.' . $category->slug) : $category->name, false); ?>" <?php endif; ?>
            </h2>
          <p class="lead text-muted m-0"><?php echo e(trans('general.explore_products_creators'), false); ?>

            <?php if(auth()->guard()->guest()): ?>
              <?php if($settings->registration_active == '1'): ?>
                <a href="<?php echo e(url('signup'), false); ?>" class="link-border"><?php echo e(trans('general.join_now'), false); ?></a>
              <?php endif; ?>
          <?php endif; ?>

          <?php if(auth()->check() && auth()->user()->verified_id == 'yes'): ?>
            <span class="d-block mt-2 w-100">

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
            </span>

          <?php endif; ?>
        </p>
        </div>
      </div>

<div class="row">

<?php if($products->total() != 0): ?>
          <div class="col-md-12 mb-4">

            <div class="btn-block mb-3 text-right">
              <span>
                <select class="ml-2 custom-select mb-2 mb-lg-0 w-auto" id="filter">
                    <option <?php if(! request()->get('sort')): ?> selected <?php endif; ?> value="<?php echo e(url('shop'), false); ?>"><?php echo e(trans('general.latest'), false); ?></option>
                    <option <?php if(request()->get('sort') == 'oldest'): ?> selected <?php endif; ?> value="<?php echo e(url('shop?sort=oldest'), false); ?>"><?php echo e(trans('general.oldest'), false); ?></option>
                    <option <?php if(request()->get('sort') == 'priceMin'): ?> selected <?php endif; ?> value="<?php echo e(url('shop?sort=priceMin'), false); ?>"><?php echo e(trans('general.lowest_price'), false); ?></option>
                    <option <?php if(request()->get('sort') == 'priceMax'): ?> selected <?php endif; ?> value="<?php echo e(url('shop?sort=priceMax'), false); ?>"><?php echo e(trans('general.highest_price'), false); ?></option>
                    <?php if($settings->physical_products): ?>
                    <option <?php if(request()->get('sort') == 'physical'): ?> selected <?php endif; ?> value="<?php echo e(url('shop?sort=physical'), false); ?>"><?php echo e(trans('general.physical_products'), false); ?></option>
                    <?php endif; ?>
                    <option <?php if(request()->get('sort') == 'digital'): ?> selected <?php endif; ?> value="<?php echo e(url('shop?sort=digital'), false); ?>"><?php echo e(trans('general.digital_products'), false); ?></option>
                    <option <?php if(request()->get('sort') == 'custom'): ?> selected <?php endif; ?> value="<?php echo e(url('shop?sort=custom'), false); ?>"><?php echo e(trans('general.custom_content'), false); ?></option>
                  </select>

                  <?php if($categories->count()): ?>
                    <select class="ml-2 custom-select mb-2 mb-lg-0 w-auto filter">
                        <option <?php if(! request()->get('cat')): ?> selected <?php endif; ?> value="<?php echo e(url('shop'), false); ?>"><?php echo e(trans('general.all_categories'), false); ?></option>

                          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if(request()->get('cat') == $category->slug): ?> selected <?php endif; ?> value="<?php echo e(url("shop?cat=$category->slug"), false); ?>">
                              <?php echo e(Lang::has('shop-categories.' . $category->slug) ? __('shop-categories.' . $category->slug) : $category->name, false); ?>

                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </select>
                  <?php endif; ?>
              </span>
            </div>

            <div class="row">

              <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-4 mb-4">
                <?php echo $__env->make('shop.listing-products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div><!-- end col-md-4 -->
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <?php if($products->hasPages()): ?>
                <div class="w-100 d-block">
                  <?php echo e($products->onEachSide(0)->appends(['tags' => request('tags'), 'sort' => request('sort')])->links(), false); ?>

                </div>
              <?php endif; ?>
            </div><!-- row -->
          </div><!-- col-md-9 -->

        <?php else: ?>
          <div class="col-md-12">
            <div class="my-5 text-center no-updates">
              <span class="btn-block mb-3">
                <i class="feather icon-shopping-bag ico-no-result"></i>
              </span>
            <h4 class="font-weight-light"><?php echo e(trans('general.no_results_found'), false); ?></h4>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

<?php echo $__env->renderWhen(auth()->check() && auth()->user()->verified_id == 'yes', 'shop.modal-add-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/shop/products.blade.php ENDPATH**/ ?>