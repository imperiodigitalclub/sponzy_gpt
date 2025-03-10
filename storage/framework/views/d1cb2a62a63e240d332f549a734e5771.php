<?php echo $__env->make('includes.alert-payment-disabled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Modal modalCarrosselOuMultiplo -->
<div class="modal fade" id="modalCarrosselOuMultiplo" tabindex="-1" aria-labelledby="chooseOption">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="chooseOption">Escolha uma opção</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Você selecionou múltiplos arquivos. Deseja criar um carrossel ou múltiplos posts?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnCarrossel">Criar Carrossel</button>
            <button type="button" class="btn btn-secondary" id="btnMultiplo">Criar Múltiplos Posts</button>
          </div>
        </div>
      </div>
    </div>

<div class="progress-wrapper px-3 px-lg-0 display-none mb-3" id="progress">
    <div class="progress-info">
      <div class="progress-percentage">
        <span class="percent">0%</span>
      </div>
    </div>
    <div class="progress progress-xs">
      <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
  </div>

  <div class="w-100 mb-1 display-none pl-3" id="dateScheduleContainer">
    <small class="font-weight-bold">
     <i class="bi-calendar-event mr-1"></i> <?php echo e(__('general.date_schedule'), false); ?> <span id="dateSchedule"></span>
    </small>
    <a href="javascript:void(0)" id="deleteSchedule" class="text-danger p-1 px-2 btn-tooltip-form" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.delete'), false); ?>"><i class="fa fa-times-circle"></i></a>
    </div>

      <form method="POST" action="<?php echo e(url('update/create'), false); ?>" enctype="multipart/form-data" id="formUpdateCreate">
        <?php echo csrf_field(); ?>
      <div class="card mb-4 card-border-0 rounded-large shadow-large">
        <div class="blocked display-none"></div>
        <div class="card-body pb-0">

          <div class="media">
          <span class="rounded-circle mr-3">
      				<img src="<?php echo e(Helper::getFile(config('path.avatar').auth()->user()->avatar), false); ?>" class="rounded-circle avatarUser" width="60" height="60">
      		</span>

          <div class="media-body position-relative">

            <textarea  class="form-control textareaAutoSize border-0 emojiArea mentions" name="description" id="updateDescription" data-post-length="<?php echo e($settings->update_length, false); ?>" rows="4" cols="40" placeholder="<?php echo e(__('general.write_something'), false); ?>"></textarea>
          </div>
        </div><!-- media -->

        <input class="custom-control-input d-none" id="customCheckLocked" type="checkbox" checked name="locked" value="yes">
        <input type="hidden" name="createCarousel" id="createCarousel" value="">

          <!-- Alert -->
          <div class="alert alert-danger my-3 display-none" id="errorUdpate">
           <ul class="list-unstyled m-0" id="showErrorsUdpate"></ul>
         </div><!-- Alert -->

        </div>
        <div class="card-footer bg-white border-0 pt-0 rounded-large">
          <div class="justify-content-between align-items-center">

            <div class="form-group display-none" id="price" >
              <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
              </div>
                  <input class="form-control isNumber" autocomplete="off" name="price" placeholder="<?php echo e(__('general.price'), false); ?>" type="text">
              </div>
            </div><!-- End form-group -->

            <div class="form-group display-none" id="titlePost" >
              <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="bi-type"></i></span>
              </div>
                  <input class="form-control" autocomplete="off" name="title" maxlength="100" placeholder="<?php echo e(__('admin.title'), false); ?>" type="text">
              </div>
              <small class="form-text text-muted mb-4">
                <?php echo e(__('general.title_post_info', ['numbers' => 100]), false); ?>

              </small>
            </div><!-- End form-group -->

            <div class="w-100 mb-2">
              <small id="previewImage"></small>
              <a href="javascript:void(0)" id="removePhoto" class="text-danger p-1 small display-none btn-tooltip-form" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.delete'), false); ?>"><i class="fa fa-times-circle"></i></a>
            </div>

            <div class="w-100 mb-2">
              <small id="previewEpub"></small>
              <a href="javascript:void(0)" id="removeEpub" class="text-danger p-1 small display-none btn-tooltip-form" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.delete'), false); ?>"><i class="fa fa-times-circle"></i></a>
            </div>

            <input type="file" name="photo[]" id="filePhoto" accept="image/*,video/mp4,video/x-m4v,video/quicktime,audio/mp3" multiple class="visibility-hidden filepond">

            <button type="button" class="btn btn-post btnMultipleUpload btn-tooltip-form e-none <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_media'), false); ?> (<?php echo e(__('general.media_type_upload'), false); ?>)">
              <i class="feather icon-image f-size-20 align-bottom"></i>
            </button>

            <?php if($settings->allow_zip_files): ?>
            <input type="file" name="zip" id="fileZip" accept="application/x-zip-compressed" class="visibility-hidden">

            <button type="button" class="btn btn-post btn-tooltip-form p-bottom-8 e-none <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_file_zip'), false); ?>" onclick="$('#fileZip').trigger('click')">
              <i class="bi-file-earmark-zip f-size-20 align-bottom"></i>
            </button>
          <?php endif; ?>

          <?php if($settings->allow_epub_files): ?>
            <input type="file" name="epub" id="ePubFile" accept="application/epub+zip" class="visibility-hidden">

            <button type="button" class="btn btn-post btn-tooltip-form p-bottom-8 e-none <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_epub_file'), false); ?>" onclick="$('#ePubFile').trigger('click')">
              <i class="bi-book f-size-20 align-bottom"></i>
            </button>
          <?php endif; ?>

            <button type="button" id="setPrice" class="btn btn-post btn-tooltip-form e-none <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.price_post_ppv'), false); ?>">
              <i class="feather icon-tag f-size-20 align-bottom"></i>
            </button>

            <?php if(!$settings->disable_free_post): ?>
              <button type="button" id="contentLocked" class="btn btn-post btn-tooltip-form e-none <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('users.locked_content'), false); ?>">
                <i class="feather icon-lock f-size-20 align-bottom"></i>
              </button>
            <?php endif; ?>

            <?php if($settings->live_streaming_status == 'on'): ?>
              <button type="button" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.stream_live'), false); ?>" class="btn btn-post p-bottom-8 btn-tooltip-form e-none btnCreateLive <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill">
                  <i class="bi-broadcast f-size-20 align-bottom"></i>
              </button>
            <?php endif; ?>

            <?php if($settings->allow_scheduled_posts): ?>
              <button type="button" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.schedule'), false); ?>" class="btn btn-post p-bottom-8 btn-tooltip-form e-none btnSchedulePost <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill">
                  <i class="bi-calendar-event f-size-20 align-bottom"></i>
              </button>

              <input type="hidden" name="scheduled_date" id="inputScheduled" value="">
            <?php endif; ?>

            <button type="button" id="setTitle" class="btn btn-tooltip-form e-none btn-post <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.title_post_block'), false); ?>">
              <i class="bi-type f-size-20 align-bottom"></i>
            </button>

            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-post p-bottom-8 btn-tooltip-form e-none <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill">
                <i class="bi-emoji-smile f-size-20 align-bottom"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-right dropdown-emoji custom-scrollbar" aria-labelledby="dropdownEmoji">
              <?php echo $__env->make('includes.emojis', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="d-inline-block float-right mt-3 mt-lg-1 position-relative w-100-mobile">

              <span class="d-inline-block float-right position-relative rounded-pill w-100-mobile">
                <span class="btn-blocked display-none"></span>

                <button type="submit" class="btn btn-sm btn-primary rounded-pill float-right e-none w-100-mobile" data-empty="<?php echo e(__('general.empty_post'), false); ?>" data-error="<?php echo e(__('general.error'), false); ?>" data-msg-error="<?php echo e(__('general.error_internet_disconnected'), false); ?>" id="btnCreateUpdate">
                  <i></i> <span id="textPostPublish"><?php echo e(__('general.publish'), false); ?></span>
                </button>
              </span>


              <div id="the-count" class="float-right my-2 mr-2">
                <small id="maximum"><?php echo e($settings->update_length, false); ?></small>
              </div>
            </div>

          </div>
        </div><!-- card footer -->
      </div><!-- card -->
    </form>

    <!-- Post Pending -->
    <div class="alert alert-primary display-none card-border-0" role="alert" id="alertPostPending">
      <button type="button" class="close mt-1" id="btnAlertPostPending">
        <span aria-hidden="true">
          <i class="bi bi-x-lg"></i>
        </span>
      </button>

        <i class="bi-info-circle mr-1"></i> <?php echo e(__('general.alert_post_pending_review'), false); ?>

        <a href="<?php echo e(url('my/posts'), false); ?>" class="link-border text-white"><?php echo e(__('general.my_posts'), false); ?></a>
    </div>

    <!-- Post Schedule -->
    <div class="alert alert-primary display-none card-border-0" role="alert" id="alertPostSchedule">
      <button type="button" class="close mt-1" id="btnAlertPostSchedule">
        <span aria-hidden="true">
          <i class="bi bi-x-lg"></i>
        </span>
      </button>

        <i class="bi-info-circle mr-1"></i> <?php echo e(__('general.alert_post_schedule'), false); ?>

        <a href="<?php echo e(url('my/posts'), false); ?>" class="link-border text-white"><?php echo e(__('general.my_posts'), false); ?></a>
    </div><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/form-post.blade.php ENDPATH**/ ?>