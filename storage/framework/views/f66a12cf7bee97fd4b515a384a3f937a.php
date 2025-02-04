<?php $__env->startSection('title'); ?><?php echo e(trans('general.messages'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm pb-0 h-100 section-msg position-fixed">
      <div class="container container-full-w h-100">
        <div class="row justify-content-center h-100">

          <div class="col-md-3 h-100 p-0 border-left wrapper-msg-inbox" id="messagesContainer">
              <?php echo $__env->make('includes.sidebar-messages-inbox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>

        <div class="col-md-9 h-100 p-0">
          <div class="card w-100 rounded-0 h-100 border-top-0">
            <div class="content px-4 py-3 d-scrollbars container-msg">

              <div class="flex-column d-flex justify-content-center text-center h-100">

                <div class="w-100">
                  <h2 class="mb-0 font-montserrat"><i class="feather icon-send mr-2"></i> <?php echo e(trans('general.messages'), false); ?></h2>
                  <p class="lead text-muted mt-0"><?php echo e(trans('general.messages_subtitle'), false); ?></p>
                  <button class="btn btn-primary btn-sm w-small-100" data-toggle="modal" data-target="#newMessageForm">
                    <i class="bi bi-plus-lg mr-1"></i> <?php echo e(trans('general.new_message'), false); ?>

                  </button>
                </div>

              </div>
            </div><!-- container-msg -->

            </div><!-- card -->
            </div><!-- end col-md-6 -->
          </div><!-- end row -->
        </div><!-- end container -->
</section>
<?php echo $__env->make('includes.modal-new-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('public/js/messages.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<script src="<?php echo e(asset('public/js/fileuploader/fileuploader-msg.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<script src="<?php echo e(asset('public/js/paginator-messages.js'), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/messages.blade.php ENDPATH**/ ?>