

<?php $__env->startSection('css'); ?>
    <style>
      .fileuploader-items {white-space: unset !important;}
      .fileuploader-item:nth-child(1) {margin-left: 16px !important;}
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-12 pt-5 pb-3">
          <h4 class="mb-0 font-montserrat">
            <a href="javascript:history.back();" class="text-decoration-none mr-2" title="<?php echo e(__('general.go_back'), false); ?>">
              <i class="fas fa-arrow-left"></i>
            </a> <?php echo e(__('general.edit_post'), false); ?>

          </h4>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-8 mb-5 mb-lg-0 wrap-post">

          <form method="POST" action="<?php echo e(url('update/edit'), false); ?>" enctype="multipart/form-data" id="formUpdateEdit">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" value="<?php echo e($data->id, false); ?>" />
          <div class="card mb-4 card-border-0 rounded-large shadow-large">
            <div class="blocked display-none"></div>
            <div class="card-body pb-0">

              <div class="media">
                <div class="media-body">
                <textarea name="description" id="updateDescription" data-post-length="<?php echo e($settings->update_length, false); ?>" rows="5" cols="40" placeholder="<?php echo e(__('general.write_something'), false); ?>" class="form-control textareaAutoSize updateDescription emojiArea border-0"><?php echo e($data->description, false); ?></textarea>
              </div>
            </div><!-- media -->

                <input class="custom-control-input d-none" id="customCheckLocked" type="checkbox" <?php echo e($data->locked == 'yes' ? 'checked' : '', false); ?>  name="locked" value="yes">

                <!-- Alert -->
                <div class="alert alert-danger my-3 display-none errorUdpate" id="errorUdpate">
                 <ul class="list-unstyled m-0 showErrorsUdpate" id="showErrorsUdpate"></ul>
               </div><!-- Alert -->

            </div><!-- card-body -->

            <div class="card-footer bg-white border-0 pt-0 rounded-large">
              <div class="justify-content-between align-items-center">

                <div class="form-group <?php if($data->price == 0.00): ?> display-none <?php endif; ?>" id="price" >
                  <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
                  </div>
                      <input class="form-control isNumber" value="<?php echo e($data->price != 0.00 ? $data->price : null, false); ?>" autocomplete="off" name="price" placeholder="<?php echo e(__('general.price'), false); ?>" type="text">
                  </div>
                </div><!-- End form-group -->

                <?php if(!$mediaCount && $data->locked == 'yes'): ?>
                <div class="form-group <?php if(! $data->title): ?> display-none <?php endif; ?>" id="titlePost" >
                  <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi-type"></i></span>
                  </div>
                      <input class="form-control <?php if($data->title): ?> active <?php endif; ?>" value="<?php echo e($data->title ? $data->title : null, false); ?>" autocomplete="off" name="title" maxlength="100" placeholder="<?php echo e(__('admin.title'), false); ?>" type="text">
                  </div>
                  <small class="form-text text-muted mb-4">
                    <?php echo e(__('general.title_post_info', ['numbers' => 100]), false); ?>

                  </small>
                </div><!-- End form-group -->
                <?php endif; ?>

                <div class="w-100 mb-2">
                  <small class="container-preview" id="previewImage">
                    <?php if($fileZip): ?>
                      <strong><em><?php echo e($fileZip->file_name, false); ?>.zip</em></strong>

                      <a href="javascript:void(0)" data-file="<?php echo e($fileZip->file, false); ?>" class="text-danger p-1 btn-tooltip removeMediaFile" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.delete'), false); ?>">
                        <i class="fa fa-times-circle"></i>
                      </a>
                    <?php endif; ?>
                  </small>
                  <a href="javascript:void(0)" id="removePhoto" class="text-danger p-1 small display-none btn-tooltip" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.delete'), false); ?>"><i class="fa fa-times-circle"></i></a>
                </div>

                <div class="w-100 mb-2">
                  <small class="container-preview" id="previewEpub">
                    <?php if($fileEpub): ?>
                      <strong><em><?php echo e($fileEpub->file_name, false); ?>.epub</em></strong>

                      <a href="javascript:void(0)" data-file="<?php echo e($fileEpub->file, false); ?>" class="text-danger p-1 btn-tooltip removeMediaFile" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.delete'), false); ?>">
                        <i class="fa fa-times-circle"></i>
                      </a>
                    <?php endif; ?>
                  </small>
                  <a href="javascript:void(0)" id="removeEpub" class="text-danger p-1 small display-none btn-tooltip-form" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.delete'), false); ?>"><i class="fa fa-times-circle"></i></a>
                </div>

                  <?php if($data->can_media_edit): ?>
                  <input <?php if($preloadedFile): ?> data-fileuploader-files='<?php echo $preloadedFile; ?>' <?php else: ?> data-filter <?php endif; ?> type="file" name="photo[]" id="filePhoto" accept="image/*,video/mp4,video/x-m4v,video/quicktime,audio/mp3" class="visibility-hidden">

                  <button type="button" class="btnMultipleUpload btn e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill btn-upload btn-tooltip" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_media'), false); ?> (<?php echo e(__('general.media_type_upload'), false); ?>)">
                    <i class="feather icon-image f-size-20 align-bottom"></i>
                  </button>

                  <?php if($settings->allow_zip_files): ?>
                  <input type="file" name="zip" id="fileZip" accept="application/x-zip-compressed" class="visibility-hidden">

                  <button type="button" class="btn btn-upload btn-tooltip e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_file_zip'), false); ?>" onclick="$('#fileZip').trigger('click')">
                    <i class="bi bi-file-earmark-zip f-size-20 align-bottom"></i>
                  </button>
                  <?php endif; ?>

                  <?php if($settings->allow_epub_files): ?>
                    <input type="file" name="epub" id="ePubFile" accept="application/epub+zip" class="visibility-hidden">

                    <button type="button" class="btn btn-post btn-tooltip-form p-bottom-8 e-none <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_epub_file'), false); ?>" onclick="$('#ePubFile').trigger('click')">
                      <i class="bi-book f-size-20 align-bottom"></i>
                    </button>
                  <?php endif; ?>

                  <?php endif; ?>

                  <?php if($data->price == 0.00): ?>
                  <button type="button" id="setPrice" class="btn btn-upload btn-tooltip e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.price_post_ppv'), false); ?>">
                    <i class="feather icon-tag f-size-20 align-bottom"></i>
                  </button>
                <?php endif; ?>

                <?php if($data->price == 0.00): ?>
                  <?php if(!$settings->disable_free_post): ?>
                  <button type="button" id="contentLocked" class="btn e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill btn-upload btn-tooltip <?php echo e($data->locked == 'yes' ? '' : 'unlock', false); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('users.locked_content'), false); ?>">
                    <i class="feather icon-<?php echo e($data->locked == 'yes' ? '' : 'un', false); ?>lock f-size-20 align-bottom"></i>
                  </button>
                  <?php endif; ?>
                <?php endif; ?>

              <?php if(!$mediaCount && $data->locked == 'yes'): ?>
              <button type="button" id="setTitle" class="btn btn-tooltip-form <?php if($data->title): ?> btn-active-hover <?php endif; ?> e-none btn-post <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.title_post_block'), false); ?>">
                <i class="bi-type f-size-20 align-bottom"></i>
              </button>
              <?php endif; ?>

              <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-post p-bottom-8 btn-tooltip-form e-none <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill">
                  <i class="bi-emoji-smile f-size-20 align-bottom"></i>
              </button>

              <div class="dropdown-menu dropdown-menu-right dropdown-emoji custom-scrollbar" aria-labelledby="dropdownEmoji">
                <?php echo $__env->make('includes.emojis', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>

                <div class="d-inline-block float-right mt-3 mt-lg-1 position-relative w-100-mobile">
                  <span class="btn-blocked display-none"></span>
                  <button type="submit" class="btn btn-sm btn-primary rounded-pill float-right btnEditUpdate w-100-mobile">
                    <i></i> <?php echo e(__('users.save'), false); ?>

                  </button>

                  <div id="the-count" class="float-right my-2 mr-2">
                    <small id="maximum"><?php echo e($settings->update_length, false); ?></small>
                  </div>
                </div>

              </div>
            </div><!-- card footer -->
          </div><!-- card -->
        </form>
        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$('#maximum').html(<?php echo e($settings->update_length, false); ?>-$('#updateDescription').val().length);

let postId = <?php echo e($data->id, false); ?>;

<?php if($fileZip || $fileEpub): ?>
  $(".removeMediaFile").on('click', function (e) {
      e.preventDefault();

      let element = $(this);
      let file = element.data('file');
      element.blur();

      swal({
          title: delete_confirm,
          type: "error",
          showLoaderOnConfirm: true,
          showCancelButton: true,
          confirmButtonColor: "#dd6b55",
          confirmButtonText: yes_confirm,
          cancelButtonText: cancel_confirm,
        },
        function (isConfirm) {
          if (isConfirm) {
            $.post(URL_BASE + '/delete/media', {
              file: file,
              _token: $('meta[name="csrf-token"]').attr('content')
            });
            element.parents('.container-preview').html('');
          }
        });
    });
  <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/edit-update.blade.php ENDPATH**/ ?>