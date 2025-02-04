

<?php $__env->startSection('title'); ?> <?php echo e($product->name, false); ?> -<?php $__env->stopSection(); ?>

  <?php $__env->startSection('description_custom'); ?><?php echo e($product->description ? $product->description : trans('seo.description'), false); ?><?php $__env->stopSection(); ?>
  <?php $__env->startSection('keywords_custom'); ?><?php echo e($product->tags ? $product->tags.',' : null, false); ?><?php $__env->stopSection(); ?>

    <?php $__env->startSection('css'); ?>
    <meta property="og:type" content="website" />
    <meta property="og:image:width" content="800"/>
    <meta property="og:image:height" content="600"/>

    <!-- Current locale and alternate locales -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:locale:alternate" content="es_ES" />

    <!-- Og Meta Tags -->
    <link rel="canonical" href="<?php echo e(url()->current(), false); ?>"/>
    <meta property="og:site_name" content="<?php echo e($product->name, false); ?> - <?php echo e($settings->title, false); ?>"/>
    <meta property="og:url" content="<?php echo e(url()->current(), false); ?>"/>
    <meta property="og:image" content="<?php echo e(Helper::getFile(config('path.shop').$product->previews[0]->name), false); ?>"/>

    <meta property="og:title" content="<?php echo e($product->name, false); ?> - <?php echo e($settings->title, false); ?>"/>
    <meta property="og:description" content="<?php echo e(strip_tags($product->description), false); ?>"/>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="<?php echo e(Helper::getFile(config('path.shop').$product->previews[0]->name), false); ?>" />
    <meta name="twitter:title" content="<?php echo e($product->name, false); ?>" />
    <meta name="twitter:description" content="<?php echo e(strip_tags($product->description), false); ?>"/>

    <link href="<?php echo e(asset('public/js/splide/splide.min.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet" type="text/css" />
    <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container py-5">
      <div class="row">

        <div class="col-md-7 mb-lg-0 mb-4">

          <?php if($previews == 1): ?>
          <div class="text-center mb-4 position-relative bg-light rounded-large shadow-large">
            <a href="<?php echo e(Helper::getFile(config('path.shop').$product->previews[0]->name), false); ?>" class="glightbox w-100" data-gallery="gallery<?php echo e($product->id, false); ?>">
              <img class="img-fluid rounded-large" src="<?php echo e(Helper::getFile(config('path.shop').$product->previews[0]->name), false); ?>" style="max-height:600px; cursor: zoom-in;">
            </a>
          </div>
          <?php endif; ?>

          <?php if($previews > 1): ?>
          <section id="mainCarousel" class="splide text-center rounded-large">
            <div class="splide__track">
              <ul class="splide__list">
                <?php for($i=0; $i < $previews; $i++): ?>
                <li class="splide__slide">
                  <a href="<?php echo e(Helper::getFile(config('path.shop').$product->previews[$i]->name), false); ?>" class="glightbox" data-gallery="gallery<?php echo e($product->id, false); ?>">
                    <img class="img-fluid rounded-large" src="<?php echo e(route('resize', ['path' => 'shop', 'file' => $product->previews[$i]->name, 'size' => 600, 'crop' => 'fit']), false); ?>" style="cursor: zoom-in;">
                  </a>
                </li>
                <?php endfor; ?>
              </ul>
            </div>
          </section>

          <ul id="thumbnails-shop" class="thumbnails-shop mb-3">
            <?php for($i=0; $i < $previews; $i++): ?>
            <li class="thumbnail-shop">
              <img class="img-fluid rounded" src="<?php echo e(route('resize', ['path' => 'shop', 'file' => $product->previews[$i]->name, 'size' => 80, 'crop' => 'fit']), false); ?>">
            </li>
            <?php endfor; ?>
          </ul>
          <?php endif; ?>

          <h4 class="mb-3"><?php echo e(__('general.description'), false); ?></h4>
          <p class="text-break">
            <?php echo Helper::checkText($product->description); ?>

          </p>

        </div><!-- end col-md-7 -->


    <div class="col-md-5">

      <div class="card rounded-large shadow-large card-border-0">

        <div class="card-body p-lg-5 p-4">

          <h3 class="mb-2 font-weight-bold text-break"><?php echo e($product->name, false); ?></h3>

      <div class="card bg-transparent mb-4 border-0">
    	  <div class="card-body p-0">
    	    <div class="d-flex">
    			  <div class="d-flex my-2 align-items-center">
              <a href="<?php echo e(url($product->user()->username), false); ?>">
    			      <img class="rounded-circle mr-2" src="<?php echo e(Helper::getFile(config('path.avatar').$product->user()->avatar), false); ?>" width="60" height="60">
              </a>

    						<div class="d-block">
    						<a href="<?php echo e(url($product->user()->username), false); ?>">
                  <strong><?php echo e($product->user()->username, false); ?></strong>

                  <small class="verified mr-1">
        						<i class="bi bi-patch-check-fill"></i>
        					</small>
                </a>

    							<div class="d-block">
    								<small class="media-heading text-muted btn-block margin-zero"><?php echo e(Helper::formatDate($product->created_at), false); ?></small>
    							</div>
    						</div>
    			  </div>
    			</div>
    	  </div>
    	</div><!-- end card -->

      <h3>
        <?php echo e(Helper::amountFormatDecimal($product->price), false); ?> <small><?php echo e($settings->currency_code, false); ?></small>
      </h3>

      <?php if(auth()->check()
          && auth()->id() != $product->user()->id
          && ! $verifyPurchaseUser
          || auth()->check()
          && auth()->id() != $product->user()->id
          && $verifyPurchaseUser
          && $product->type == 'custom'
          || auth()->check()
          && auth()->id() != $product->user()->id
          && $verifyPurchaseUser
          && $product->type == 'physical'
          || auth()->guest()
          ): ?>
      <button class="btn btn-1 btn-primary btn-block mt-4" <?php if($product->quantity == 0 && $product->type == 'physical'): ?> disabled <?php endif; ?> type="button" data-toggle="modal" <?php if(auth()->guard()->check()): ?> data-target="#buyNowForm" <?php else: ?> data-target="#loginFormModal" <?php endif; ?>>
        <?php echo e($product->quantity == 0 && $product->type == 'physical' ? __('general.sold_out') : __('general.buy_now'), false); ?>

      </button>

    <?php elseif(auth()->check() && auth()->id() != $product->user()->id && $verifyPurchaseUser && $product->type == 'digital'): ?>
      <a class="btn btn-1 btn-primary btn-block mt-4" href="<?php echo e(url('product/download', $product->id), false); ?>">
        <?php echo e(__('general.download'), false); ?>

      </a>

    <?php elseif(auth()->check() && auth()->id() == $product->user()->id): ?>
      <a class="btn btn-1 btn-primary btn-block mt-4" href="#" data-toggle="modal" data-target="#editForm">
        <i class="bi-pencil mr-1"></i> <?php echo e(__('admin.edit'), false); ?>

      </a>

      <form method="post" action="<?php echo e(url('delete/product', $product->id), false); ?>">
        <?php echo csrf_field(); ?>
        <button class="btn btn-1 btn-outline-danger btn-block mt-2 actionDeleteItem" type="button">
          <i class="bi-trash mr-1"></i> <?php echo e(__('admin.delete'), false); ?>

        </button>
      </form>

      <?php echo $__env->make('shop.modal-edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php endif; ?>

      <div class="w-100 d-block mt-3">
        <i class="bi-cart2 mr-2"></i> <?php echo e(__('general.purchases'), false); ?> (<?php echo e($product->purchases()->count(), false); ?>)
      </div>

      <?php if($product->type == 'digital'): ?>
        <div class="w-100 d-block mt-3">
          <i class="bi-cloud-download mr-2"></i> <?php echo e(__('general.digital_download'), false); ?>

        </div>

        <div class="w-100 d-block mt-3">
          <i class="bi-box-seam mr-2"></i> <?php echo e(__('general.file'), false); ?> <span class="text-uppercase"><?php echo e($product->extension, false); ?></span> - <small><?php echo e($product->size, false); ?></small>
        </div>

      <?php elseif($product->type == 'custom'): ?>
        <div class="w-100 d-block mt-4">
          <i class="fa fa-fire-alt mr-2"></i> <?php echo e(__('general.delivery_time'), false); ?> (<?php echo e($product->delivery_time, false); ?> <?php echo e(trans_choice('general.days', $product->delivery_time), false); ?>)
        </div>

      <?php else: ?>

        <?php if($product->quantity <> 0): ?>
          <div class="w-100 d-block mt-4">
            <i class="bi-boxes mr-2"></i> <?php echo e(__('general.quantity'), false); ?> <span class="badge badge-pill badge-success"><?php echo e($product->quantity, false); ?></span>
          </div>
        <?php else: ?>
          <div class="w-100 d-block mt-4 text-danger">
            <i class="bi-boxes mr-2"></i> <em><?php echo e(__('general.sold_out'), false); ?></em>
          </div>
        <?php endif; ?>

        <?php if($product->shipping_fee <> 0.00): ?>
          <div class="w-100 d-block mt-4">
            <i class="bi-truck mr-2"></i> <?php echo e(__('general.shipping_fee'), false); ?> - <?php echo e(Helper::amountFormatDecimal($product->shipping_fee), false); ?> <small><?php echo e($settings->currency_code, false); ?></small>

            <?php if($product->country_free_shipping): ?>
              <small><em>(<?php echo e(__('general.free_shipping'), false); ?> <?php echo e($product->country()->country_name, false); ?>)</em></small>
            <?php endif; ?>
          </div>

        <?php else: ?>
          <div class="w-100 d-block mt-4">
            <i class="bi-truck mr-2"></i> <?php echo e(__('general.free_shipping'), false); ?>

          </div>
        <?php endif; ?>

        <div class="w-100 d-block mt-4">
          <i class="bi-box-seam mr-2"></i> <?php echo e($product->box_contents, false); ?>

        </div>

      <?php endif; ?>

      <?php if($product->category): ?>
        <div class="w-100 d-block mt-4">
          <i class="bi-tag mr-2"></i>
          <a href="<?php echo e(url("shop?cat="), false); ?><?php echo e($product->categoryId->slug, false); ?>" >
            <?php echo e(Lang::has('shop-categories.' . $product->categoryId->slug) ? __('shop-categories.' . $product->categoryId->slug) : $product->categoryId->name, false); ?>

          </a>
        </div>
      <?php endif; ?>

      <div class="w-100 d-block mt-4">
        <?php for($i = 0; $i < count($tags); ++$i): ?>
          <a href="<?php echo e(url('shop?tags=').trim($tags[$i]), false); ?>">#<?php echo e(trim($tags[$i]), false); ?></a>
        <?php endfor; ?>
      </div>

      <div class="w-100 d-block mt-4">
        <i class="feather icon-share mr-2"></i> <span class="mr-2"><?php echo e(__('general.share'), false); ?></span>

        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url()->current().Helper::referralLink(), false); ?>" title="Facebook" target="_blank" class="d-inline-block mr-2 h5">
          <i class="fab fa-facebook facebook-btn"></i>
        </a>

        <a href="https://twitter.com/intent/tweet?url=<?php echo e(url()->current().Helper::referralLink(), false); ?>&text=<?php echo e($product->name, false); ?>" title="Twitter" target="_blank" class="d-inline-block mr-2 h5">
          <i class="bi-twitter-x"></i>
        </a>

        <a href="whatsapp://send?text=<?php echo e(url()->current().Helper::referralLink(), false); ?>" data-action="share/whatsapp/share" class="d-inline-block h5" title="WhatsApp">
          <i class="fab fa-whatsapp btn-whatsapp"></i>
        </a>
      </div><!-- Share -->

      <?php if(auth()->check() && auth()->id() != $product->user()->id): ?>
        <div class="w-100 d-block mt-4">
          <button type="button" class="btn e-none btn-link text-danger p-0" data-toggle="modal" data-target="#reportItem">
                <small><i class="bi-flag mr-1"></i> <?php echo e(__('general.report_item'), false); ?></small>
              </button>
        </div>
      <?php endif; ?>

      </div><!-- card-body -->
    </div><!-- card -->


    </div><!-- end col-5 -->

      </div><!-- row -->
    </div><!-- container -->

    <?php if(auth()->guard()->check()): ?>
      <?php echo $__env->make('shop.modal-buy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if(auth()->check() && auth()->id() != $product->user()->id): ?>
    <div class="modal fade modalReport" id="reportItem" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-danger modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title font-weight-light" id="modal-title-default">
              <i class="fas fa-flag mr-1"></i> <?php echo e(trans('general.report_item'), false); ?>

            </h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
            </button>
          </div>

        <!-- form start -->
        <form method="POST" action="<?php echo e(url('report/item', $product->id), false); ?>" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo csrf_field(); ?>
          <!-- Start Form Group -->
          <div class="form-group">
            <label><?php echo e(trans('admin.please_reason'), false); ?></label>
              <select name="reason" class="form-control custom-select">
                <?php if($verifyPurchaseUser && $product->type != 'digital'): ?>
                <option value="item_not_received"><?php echo e(trans('general.item_not_received'), false); ?></option>
              <?php endif; ?>
                <option value="spoofing"><?php echo e(trans('admin.spoofing'), false); ?></option>
                  <option value="copyright"><?php echo e(trans('admin.copyright'), false); ?></option>
                  <option value="privacy_issue"><?php echo e(trans('admin.privacy_issue'), false); ?></option>
                  <option value="violent_sexual"><?php echo e(trans('admin.violent_sexual_content'), false); ?></option>
                  <option value="fraud"><?php echo e(trans('general.fraud'), false); ?></option>
                </select>

                <textarea name="message" rows="" cols="40" maxlength="200" placeholder="<?php echo e(__('general.message'), false); ?> (<?php echo e(__('general.optional'), false); ?>)" class="form-control mt-2 textareaAutoSize"></textarea>
                
                </div><!-- /.form-group-->
            </div><!-- Modal body -->

            <div class="modal-footer">
              <button type="button" class="btn border text-white" data-dismiss="modal"><?php echo e(trans('admin.cancel'), false); ?></button>
              <button type="submit" class="btn btn-xs btn-white sendReport ml-auto"><i></i> <?php echo e(trans('general.report_item'), false); ?></button>
            </div>
            </form>
          </div><!-- Modal content -->
        </div><!-- Modal dialog -->
      </div><!-- Modal -->
    <?php endif; ?>

<?php if($totalProducts > 1): ?>
<div class="container pt-5 border-top">
		 <div class="row">

       <div class="col-md-12 mb-4">

         <div class="d-flex justify-content-between align-items-center">
    		 <h4 class="font-weight-light"><?php echo e(__('general.other_items_of'), false); ?> <?php echo e('@'.$product->user()->username, false); ?></h4>

         <?php if($totalProducts > 4): ?>
         <h5 class="font-weight-light">
           <a href="<?php echo e(url($product->user()->username, 'shop'), false); ?>">
             <?php echo e(__('general.view_all'), false); ?>

           </a>
         </h5>
       <?php endif; ?>
      </div>

    	 </div>

       <?php $__currentLoopData = $userProducts->where('id', '<>', $product->id)->take(3)->inRandomOrder()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <div class="col-md-4 mb-4">
         <?php echo $__env->make('shop.listing-products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       </div><!-- end col-md-4 -->
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

     </div><!-- row -->
	 </div><!-- container -->
<?php endif; ?>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
  <?php if(auth()->guard()->check()): ?>
    <script src="<?php echo e(asset('public/js/shop.js'), false); ?>"></script>
  <?php endif; ?>

  <?php if($previews > 1): ?>
    <script src="<?php echo e(asset('public/js/splide/splide.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('public/js/splide/splide-init.js'), false); ?>"></script>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/shop/show.blade.php ENDPATH**/ ?>