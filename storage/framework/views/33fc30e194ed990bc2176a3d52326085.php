<div class="modal fade" id="newMessageForm" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white shadow border-0">

					<div class="card-body px-lg-5 py-lg-5">

						<div class="mb-2">
							<h5 class="position-relative m-0"><?php echo e(__('general.new_message'), false); ?>

								<small data-dismiss="modal" class="btn-cancel-msg"><i class="bi bi-x-lg"></i></small>
							</h5>

							<?php if(auth()->user()->verified_id == 'yes' && request()->is('messages') && auth()->user()->totalSubscriptionsActive() > 1): ?>
								<span class="form-text">
									<a href="javascript:void(0);" data-toggle="modal" data-target="#newMessageMassive" data-dismiss="modal" class="btn btn-primary btn-sm w-100 mt-2">
										<i class="feather icon-users"></i> <?php echo e(__('general.to_all_my_subscribers'), false); ?>

									</a>
								</span>
							<?php endif; ?>

						</div>

						<div class="position-relative">
							<span class="my-sm-0 btn-new-msg">
								<i class="fa fa-search"></i>
							</span>

							<input class="form-control input-new-msg rounded mb-2" id="searchCreator" type="text" name="q" autocomplete="off" placeholder="<?php echo e(auth()->user()->verified_id == 'yes' ? __('general.search') : __('general.find_user'), false); ?>" aria-label="Search">

						</div>

						<div class="w-100 text-center mt-3 display-none" id="spinner">
							<span class="spinner-border align-middle text-primary"></span>
						</div>

						<div id="containerUsers" class="text-center"></div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Modal new Message -->

<!-- End Modal New Message Massive -->
<div class="modal fade modalEditPost" id="newMessageMassive" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header border-bottom-0">
			<h5 class="modal-title"><?php echo e(__('general.new_message_all_subscribers'), false); ?></h5>
			<button type="button" class="close close-inherit" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					<i class="bi bi-x-lg"></i>
				</span>
			</button>
		</div>
		<div class="modal-body">
			<form method="POST" action="<?php echo e(url('new/message/massive'), false); ?>" enctype="multipart/form-data" id="formSendMsg">
				<input type="file" name="zip" id="zipFile" accept="application/x-zip-compressed" class="visibility-hidden">
				<?php echo csrf_field(); ?>
			<div class="card mb-4">
				<div class="blocked display-none"></div>
				<div class="card-body pb-0">

					<div class="media">
						<div class="media-body">
						<textarea rows="5" cols="40" placeholder="<?php echo e(__('general.write_something'), false); ?>" class="form-control textareaAutoSize border-0" id="message" name="message"></textarea>
					</div>
				</div><!-- media -->

						<!-- Alert -->
						<div class="alert alert-danger my-3 display-none" id="errorMsg">
						 <ul class="list-unstyled m-0" id="showErrorMsg"></ul>
					 </div><!-- Alert -->

				</div><!-- card-body -->

				<div class="card-footer bg-white border-0 pt-0 position-relative">

					<div class="progress-upload-cover" style="width: 0%; top:0;"></div>

					<div class="form-group display-none mt-2" id="price">
						<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><?php echo e($settings->currency_symbol, false); ?></span>
						</div>
								<input class="form-control isNumber" value="" autocomplete="off" name="price" placeholder="<?php echo e(__('general.price'), false); ?>" type="text">
						</div>
					</div><!-- End form-group -->

					<div class="w-100">
						<small id="previewImage"></small>
						<a href="javascript:void(0)" id="removePhoto" class="text-danger small p-1 px-2 display-none btn-tooltip" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.delete'), false); ?>"><i class="fa fa-times-circle"></i></a>
					</div>

					<div class="w-100 mb-2">
						<small id="previewEpub"></small>
						<a href="javascript:void(0)" id="removeEpub" class="text-danger p-1 small display-none btn-tooltip-form" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.delete'), false); ?>"><i class="fa fa-times-circle"></i></a>
					  </div>

					<input type="file" name="media[]" id="file" accept="image/*,video/mp4,video/x-m4v,video/quicktime,audio/mp3" multiple class="visibility-hidden filepond">


					<div class="justify-content-between align-items-center">


						<button type="button" class="btnMultipleUpload btn btn-upload btn-tooltip e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_media'), false); ?> (<?php echo e(__('general.media_type_upload'), false); ?>)">
							<i class="feather icon-image f-size-25"></i>
						</button>

						<?php if($settings->allow_zip_files): ?>
						<button type="button" class="btn btn-upload btn-tooltip e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_file_zip'), false); ?>" onclick="$('#zipFile').trigger('click')">
							<i class="bi bi-file-earmark-zip align-bottom f-size-25"></i>
						</button>
					<?php endif; ?>

					<?php if($settings->allow_epub_files): ?>
					<input type="file" name="epub" id="ePubFile" accept="application/epub+zip" class="visibility-hidden">

					<button type="button" class="btn btn-post btn-tooltip-form p-bottom-8 e-none <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.upload_epub_file'), false); ?>" onclick="$('#ePubFile').trigger('click')">
					<i class="bi-book f-size-25 align-bottom"></i>
					</button>
				<?php endif; ?>

						<button type="button" id="setPrice" class="btn btn-upload btn-tooltip e-none align-bottom <?php if(auth()->user()->dark_mode == 'off'): ?> text-primary <?php else: ?> text-white <?php endif; ?> rounded-pill" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.set_price_for_msg'), false); ?>">
							<i class="feather icon-tag align-bottom f-size-25"></i>
						</button>

						<div class="d-inline-block float-right mt-1 rounded-pill position-relative">
							<div class="btn-blocked display-none"></div>
							<button disabled type="submit" id="button-reply-msg" class="btn btn-sm btn-primary rounded-pill float-right e-none"><i class="far fa-paper-plane"></i></button>
						</div>

					</div>
				</div><!-- card footer -->
			</div><!-- card -->
		</form>
	</div><!-- modal-body -->
	</div><!-- modal-content -->
</div><!-- modal-dialog -->
</div><!-- modal -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-new-message.blade.php ENDPATH**/ ?>