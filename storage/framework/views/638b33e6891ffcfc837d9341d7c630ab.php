<?php $__env->startSection('title'); ?><?php echo e(__('general.messages'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
  <script type="text/javascript">
      var subscribed_active = <?php echo e($subscribedToYourContent || $subscribedToMyContent || auth()->user()->isSuperAdmin() || $user->isSuperAdmin() ? 'true' : 'false', false); ?>;
      var user_id_chat = <?php echo e($user->id, false); ?>;
      var msg_count_chat = <?php echo e($messages->count(), false); ?>;
  </script>

  <style>
    @media (min-width: 991px) {
    .fileuploader-theme-thumbnails .fileuploader-thumbnails-input,
    .fileuploader-theme-thumbnails .fileuploader-items-list .fileuploader-item {
      width: calc(14% - 16px);
      padding-top: 12%;
      }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm pb-0 h-100 section-msg position-fixed">
    <div class="container container-full-w h-100">
      <div class="row justify-content-center h-100">

        <div class="col-md-3 h-100 p-0 border-left second wrapper-msg-inbox" id="messagesContainer">
          <?php echo $__env->make('includes.sidebar-messages-inbox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

  <div class="col-md-9 h-100 p-0 first">

  <div class="card w-100 rounded-0 h-100 border-top-0">
    <div class="card-header bg-white pt-4">
      <div class="media">
        <a href="<?php echo e(url()->previous(), false); ?>" class="mr-3"><i class="fa fa-arrow-left"></i></a>
        <a href="<?php echo e(url($user->username), false); ?>" class="mr-3">
          <span class="position-relative user-status <?php if($user->active_status_online == 'yes'): ?> <?php if(Helper::isOnline($user->id)): ?> user-online <?php else: ?> user-offline <?php endif; ?> <?php endif; ?> d-block">
            <img src="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" class="rounded-circle" width="40" height="40">
          </span>
      </a>

        <div class="media-body">
          <h6 class="m-0">
            <a href="<?php echo e(url($user->username), false); ?>">
              <?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?>

            </a>

            <?php if($user->verified_id == 'yes'): ?>
              <small class="verified">
                   <i class="bi bi-patch-check-fill"></i>
                 </small>
            <?php endif; ?>
          </h6>

        <?php if($user->active_status_online == 'yes'): ?>

          <?php if($user->hide_last_seen == 'no'): ?>
           <small><?php echo e(__('general.active'), false); ?></small>

           <span id="timeAgo">
             <small class="timeAgo <?php if(Helper::isOnline($user->id)): ?> display-none <?php endif; ?>" id="lastSeen" data="<?php echo e(date('c', strtotime($user->last_seen ?? $user->date)), false); ?>"></small>
            </span>
          <?php else: ?>
            <?php echo e('@'.$user->username, false); ?>

            <?php endif; ?>

          <?php else: ?>
            <?php echo e('@'.$user->username, false); ?>

            <?php endif; ?>

        </div>

        <?php if($user->verified_id == 'yes' 
            && $settings->live_streaming_private == 'on' 
            && $user->allow_live_streaming_private == 'on' 
            && !auth()->user()->isRestricted($user->id)
            ): ?>
        <a href="javascript:void(0);" class="f-size-20 text-muted float-right mr-3 text-decoration-none <?php if(Helper::isOnline($user->id)): ?> requestLivePrivateModal <?php else: ?> buttonDisabled <?php endif; ?>" <?php if(Helper::isOnline($user->id)): ?> data-toggle="tooltip" data-placement="bottom" title="<?php echo e(__('general.request_private_live_stream'), false); ?>" <?php endif; ?> role="button">
					<i class="feather icon-video"></i>
				</a>
        <?php endif; ?>

        <a href="javascript:void(0);" class="f-size-20 text-muted float-right" id="dropdown_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<i class="fa fa-ellipsis-h"></i>
				</a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_options">

        <?php if($messages->count() != 0): ?>
					<?php echo Form::open([
						'method' => 'POST',
						'url' => "conversation/delete/$user->id",
						'class' => 'd-inline'
					]); ?>


					<?php echo Form::button('<i class="feather icon-trash-2 mr-2"></i> '.__('general.delete'), ['class' => 'dropdown-item actionDelete']); ?>

					<?php echo Form::close(); ?>


          <?php endif; ?>

          <?php if(auth()->user()->isRestricted($user->id)): ?>
            <button type="button" class="dropdown-item removeRestriction" data-user="<?php echo e($user->id, false); ?>" id="restrictUser">
              <i class="fas fa-ban mr-2"></i> <?php echo e(__('general.remove_restriction'), false); ?>

            </button>

          <?php else: ?>
            <button type="button" class="dropdown-item" data-user="<?php echo e($user->id, false); ?>" id="restrictUser">
              <i class="fas fa-ban mr-2"></i> <?php echo e(__('general.restrict'), false); ?>

            </button>
          <?php endif; ?>
	      </div>

      </div>

    </div>

    <div class="content px-4 py-3 custom-scrollbar container-msg" id="contentDIV" data="<?php echo e($user->id, false); ?>">

      <?php if($messages->count() != 0): ?>
      <div class="flex-column d-flex justify-content-center text-center h-100">
        <div class="w-100" id="loadAjaxChat">
          <div class="spinner-border text-primary" role="status"></div>
        </div>
      </div>
    <?php endif; ?>
      </div><!-- contentDIV -->

      <?php if(!auth()->user()->checkRestriction($user->id) && $user->allow_dm): ?>
          <div class="card-footer bg-white position-relative">

          <?php if($subscribedToYourContent || $subscribedToMyContent || auth()->user()->isSuperAdmin() || $user->isSuperAdmin()): ?>

            <div class="w-100 display-none" id="previewFile">
              <div class="previewFile d-inline"></div>
              <a href="javascript:;" class="text-danger" id="removeFile"><i class="fa fa-times-circle"></i></a>
            </div>

            <div class="progress-upload-cover" style="width: 0%; top:0;"></div>

            <div class="blocked display-none"></div>

            <!-- Alert -->
            <div class="alert alert-danger my-3" id="errorMsg" style="display: none;">
             <ul class="list-unstyled m-0" id="showErrorMsg"></ul>
           </div><!-- Alert -->

            <form action="<?php echo e(url('message/send'), false); ?>" method="post" accept-charset="UTF-8" id="formSendMsg" enctype="multipart/form-data">
              <input type="hidden" name="id_user" id="id_user" value="<?php echo e($user->id, false); ?>">
              <input type="hidden" name="_token" value="<?php echo e(csrf_token(), false); ?>">
              <input type="file" name="zip" id="zipFile" accept="application/x-zip-compressed" class="visibility-hidden">

              <div class="w-100 mr-2 position-relative">
                <div>
                <span class="triggerEmoji" data-toggle="dropdown">
                  <i class="bi-emoji-smile"></i>
                </span>

                <div class="dropdown-menu dropdown-menu-right dropdown-emoji custom-scrollbar" aria-labelledby="dropdownMenuButton">
                  <?php echo $__env->make('includes.emojis', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
                <textarea class="form-control textareaAutoSize emojiArea border-0" data-post-length="<?php echo e($settings->update_length, false); ?>" rows="1" placeholder="<?php echo e(__('general.write_something'), false); ?>" id="message" name="message"></textarea>
              </div>

              <div class="form-group display-none mt-2" id="price">
                <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
                </div>
                    <input class="form-control isNumber" autocomplete="off" name="price" placeholder="<?php echo e(__('general.price'), false); ?>" type="text">
                </div>
              </div><!-- End form-group -->

              <div class="w-100 mb-2">
                <small id="previewImage"></small>
                <a href="javascript:void(0)" id="removePhoto" class="text-danger p-1 small display-none btn-tooltip" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.delete'), false); ?>"><i class="fa fa-times-circle"></i></a>
              </div>

              <div class="w-100 mb-2">
                <small id="previewEpub"></small>
                <a href="javascript:void(0)" id="removeEpub" class="text-danger p-1 small display-none btn-tooltip-form" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.delete'), false); ?>"><i class="fa fa-times-circle"></i></a>
              </div>

              <input type="file" name="media[]" id="file" accept="image/*,video/mp4,video/x-m4v,video/quicktime,audio/mp3" multiple class="visibility-hidden filepond">

              <div class="justify-content-between mt-3 align-items-center">

                    <button type="button" class="btnMultipleUpload btn btn-upload btn-tooltip e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_media'), false); ?> (<?php echo e(__('general.media_type_upload'), false); ?>)">
                      <i class="feather icon-image align-bottom f-size-25"></i>
                    </button>

                    <?php if($settings->allow_zip_files): ?>
                    <button type="button" class="btn btn-upload btn-tooltip e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_file_zip'), false); ?>" onclick="$('#zipFile').trigger('click')">
                      <i class="bi bi-file-earmark-zip align-bottom f-size-25"></i>
                    </button>
                  <?php endif; ?>

                  <?php if(auth()->user()->verified_id == 'yes' && $settings->allow_epub_files): ?>
                  <input type="file" name="epub" id="ePubFile" accept="application/epub+zip" class="visibility-hidden">

                  <button type="button" class="btn btn-upload btn-tooltip e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_epub_file'), false); ?>" onclick="$('#ePubFile').trigger('click')">
                    <i class="bi-book f-size-25 align-bottom"></i>
                  </button>
                <?php endif; ?>

                  <?php if(auth()->user()->verified_id == 'yes'): ?>
                  <button type="button" id="setPrice" class="btn btn-upload btn-tooltip e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.set_price_for_msg'), false); ?>">
                    <i class="feather icon-tag align-bottom" style="font-size: 27px;"></i>
                  </button>
                <?php endif; ?>

                <?php if($user->verified_id == 'yes' && $settings->disable_tips == 'off'): ?>
                  <button type="button" class="btn btn-upload btn-tooltip e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="modal" title="<?php echo e(__('general.tip'), false); ?>" data-target="#tipForm" data-cover="<?php echo e(Helper::getFile(config('path.cover').$user->cover), false); ?>" data-avatar="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" data-name="<?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?>" data-userid="<?php echo e($user->id, false); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                      <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
                      <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                      <path fill-rule="evenodd" d="M8 13.5a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                    </svg>
                  </button>
                <?php endif; ?>

                <?php if($user->verified_id == 'yes' && $settings->gifts): ?>
                <button type="button" data-toggle="modal" title="<?php echo e(__('general.gifts'), false); ?>" data-target="#giftsForm" class="btn btn-upload btn-tooltip e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill">
                  <i class="bi-gift f-size-25 align-bottom"></i>
                </button>
                <?php endif; ?>

          <div class="d-inline-block float-right rounded-pill mt-1 position-relative">
            <div class="btn-blocked display-none"></div>
            <button type="submit" id="button-reply-msg" disabled data-send="<?php echo e(__('auth.send'), false); ?>" data-wait="<?php echo e(__('general.send_wait'), false); ?>" class="btn btn-sm btn-primary rounded-pill float-right e-none w-100-mobile">
              <i class="far fa-paper-plane"></i>
            </button>
            </div>

          </div><!-- media -->
        </form>
      <?php else: ?>
        <div class="alert alert-primary m-0 alert-dismissible fade show" role="alert">
          <i class="fa fa-info-circle mr-2"></i>
          <?php
            $nameUser = $user->hide_name == 'yes' ? $user->username : $user->first_name;
          ?>
        <?php echo __('general.show_form_msg_error_subscription_', ['user' => '<a href="'.url($user->username).'" class="link-border text-white">'.$nameUser.'</a>']); ?>

      </div>
        <?php endif; ?>

      </div><!-- card footer -->

      <?php else: ?>

      <div class="card-footer bg-white position-relative">
        <div class="alert alert-primary m-0 alert-dismissible fade show" role="alert">
          <i class="fa fa-info-circle mr-2"></i>
          <?php echo e(__('general.chat_unavailable'), false); ?>

        </div>
      </div>
    <?php endif; ?>

    </div><!-- card -->
  </div><!-- end col-md-8 -->

  </div><!-- end row -->
</div><!-- end container -->
</section>
<?php echo $__env->make('includes.modal-new-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php if($user->verified_id == 'yes' 
            && $settings->live_streaming_private == 'on' 
            && $user->allow_live_streaming_private == 'on' 
            && !auth()->user()->isRestricted($user->id)
            ): ?>
    <?php echo $__env->make('includes.modal-live-private-request', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('public/js/messages.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<script src="<?php echo e(asset('public/js/fileuploader/fileuploader-msg.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<script src="<?php echo e(asset('public/js/paginator-messages.js'), false); ?>"></script>

<?php if($user->verified_id == 'yes' 
            && $settings->live_streaming_private == 'on' 
            && $user->allow_live_streaming_private == 'on' 
            && !auth()->user()->isRestricted($user->id)
            ): ?>
<script src="<?php echo e(asset('public/js/live-private-request.js'), false); ?>"></script>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/messages-show.blade.php ENDPATH**/ ?>