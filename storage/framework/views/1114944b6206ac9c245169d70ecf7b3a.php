<?php $__env->startSection('title'); ?> <?php echo e(__('general.live_stream_private_settings'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi-gear mr-2"></i> <?php echo e(__('general.live_stream_private_settings'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(__('general.subtitle_live_stream_private_settings'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if(session('status')): ?>
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                			<span aria-hidden="true">×</span>
                			</button>

                    <?php echo e(session('status'), false); ?>

                  </div>
                <?php endif; ?>

          <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <form method="POST" action="<?php echo e(url()->current(), false); ?>">
            <?php echo csrf_field(); ?>
              <div class="form-group">
                <div class="btn-block mb-4">
                    <div class="custom-control custom-switch custom-switch-lg">
                      <input type="checkbox" class="custom-control-input" name="allow_live_streaming_private" value="on" <?php if(auth()->user()->allow_live_streaming_private == 'on'): ?> checked <?php endif; ?> id="allow_live_streaming_private">
                      <label class="custom-control-label switch" for="allow_live_streaming_private"><?php echo e(__('general.allow_live_streaming_private'), false); ?></label>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-4">
                  <label class="w-100 "><?php echo e(__('general.price_live_streaming_private'), false); ?> *</label>
                  <div class="input-group mb-2">
                    
                    <div class="input-group-prepend">
                      <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
                    </div>
                        <input value="<?php echo e(auth()->user()->price_live_streaming_private, false); ?>" class="form-control form-control-lg isNumber" required name="price_live_streaming_private" autocomplete="off" placeholder="<?php echo e(__('general.price_live_streaming_private'), false); ?>" type="text">
                    </div>
                    <small class="btn-block">
                      * <?php echo e(__('general.minimum'), false); ?> <?php echo e(Helper::priceWithoutFormat($settings->live_streaming_minimum_price_private), false); ?> - <?php echo e(__('general.maximum'), false); ?> <?php echo e(Helper::priceWithoutFormat($settings->live_streaming_max_price_private), false); ?>


                      <?php if($settings->wallet_format != 'real_money'): ?>
											  <strong>(<?php echo e(Helper::equivalentMoney($settings->wallet_format), false); ?>)</strong>
										  <?php endif; ?>
                    </small>
                </div>

                <button class="btn btn-1 btn-success btn-block buttonActionSubmit" type="submit"><?php echo e(__('general.save_changes'), false); ?></button>

          </form>
        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/live-streaming-private-settings.blade.php ENDPATH**/ ?>