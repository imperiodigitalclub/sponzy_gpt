

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted"><?php echo e(__('admin.theme'), false); ?></span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

			<?php if(session('success_message')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check2 me-1"></i>	<?php echo e(session('success_message'), false); ?>


                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i class="bi bi-x-lg"></i>
                </button>
                </div>
              <?php endif; ?>

              <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-5">

					 <form method="post" action="<?php echo e(url('panel/admin/theme')); ?>" enctype="multipart/form-data">
             <?php echo csrf_field(); ?>

						 <fieldset class="row mb-5">
			         <legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.home_style'), false); ?></legend>
			         <div class="col-sm-10">
			           <div class="form-check mb-3">
			             <input class="form-check-input" type="radio" name="home_style" id="radio1" <?php if($settings->home_style == 0): ?> checked="checked" <?php endif; ?> value="0">
			             <label class="form-check-label" for="radio1">
			               <img class="border" src="<?php echo e(url('/public/img/homepage-1.jpg'), false); ?>">
			             </label>
			           </div>
			           <div class="form-check">
			             <input class="form-check-input" type="radio" name="home_style" id="radio2" <?php if($settings->home_style == 1): ?> checked="checked" <?php endif; ?> value="1">
			             <label class="form-check-label" for="radio2">
							<img class="border" src="<?php echo e(url('/public/img/homepage-2.jpg'), false); ?>">
			             </label>
			           </div>
			         </div>
			       </fieldset><!-- end row -->

		        <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.logo'), false); ?></label>
		          <div class="col-lg-5 col-sm-10">
                <div class="d-block mb-2">
                  <img src="<?php echo e(url('/public/img', $settings->logo), false); ?>" class="bg-secondary" style="width:150px">
                </div>

                <div class="input-group mb-1">
                  <input name="logo" type="file" class="form-control custom-file rounded-pill">
                </div>
                <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 487x144 px (PNG, SVG)</small>
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.logo_blue'), false); ?></label>
		          <div class="col-lg-5 col-sm-10">
                <div class="d-block mb-2">
                  <img src="<?php echo e(url('/public/img', $settings->logo_2), false); ?>" style="width:150px">
                </div>

                <div class="input-group mb-1">
                  <input name="logo_2" type="file" class="form-control custom-file rounded-pill">
                </div>
                <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 487x144 px (PNG, SVG)</small>
		          </div>
		        </div>

				<div class="row mb-3">
					<label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.watermak_video'), false); ?></label>
					<div class="col-lg-5 col-sm-10">
				  <div class="d-block mb-2">
					<img src="<?php echo e(url('/public/img', $settings->watermak_video), false); ?>" class="bg-dark" style="width:150px">
				  </div>
  
				  <div class="input-group mb-1">
					<input name="watermak_video" type="file" class="form-control custom-file rounded-pill">
				  </div>
				  <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 487x144 px (PNG)</small>
					</div>
				  </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end">Favicon</label>
		          <div class="col-lg-5 col-sm-10">
                <div class="d-block mb-2">
                  <img src="<?php echo e(url('/public/img', $settings->favicon), false); ?>">
                </div>

                <div class="input-group mb-1">
                  <input name="favicon" type="file" class="form-control custom-file rounded-pill">
                </div>
                <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 48x48 px (PNG)</small>
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.index_image_top'), false); ?></label>
		          <div class="col-lg-5 col-sm-10">
                <div class="d-block mb-2">
                  <img src="<?php echo e(url('/public/img', $settings->home_index), false); ?>" style="width:200px">
                </div>

                <div class="input-group mb-1">
                  <input name="index_image_top" type="file" class="form-control custom-file rounded-pill">
                </div>
                <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 884x592 px</small>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('admin.background'), false); ?></label>
		          <div class="col-lg-5 col-sm-10">
                <div class="d-block mb-2">
                  <img class="img-fluid" src="<?php echo e(url('/public/img', $settings->bg_gradient), false); ?>" style="width:400px">
                </div>

                <div class="input-group mb-1">
                  <input name="background" type="file" class="form-control custom-file rounded-pill">
                </div>
                <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 1441x480 px</small>
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('admin.image_index_1'), false); ?></label>
		          <div class="col-lg-5 col-sm-10">
                <div class="d-block mb-2">
                  <img src="<?php echo e(url('/public/img', $settings->img_1), false); ?>" style="width:120px">
                </div>

                <div class="input-group mb-1">
                  <input name="image_index_1" type="file" class="form-control custom-file rounded-pill">
                </div>
                <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 120x120 px</small>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('admin.image_index_2'), false); ?></label>
		          <div class="col-lg-5 col-sm-10">
                <div class="d-block mb-2">
                  <img src="<?php echo e(url('/public/img', $settings->img_2), false); ?>" style="width:120px">
                </div>

                <div class="input-group mb-1">
                  <input name="image_index_2" type="file" class="form-control custom-file rounded-pill">
                </div>
                <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 120x120 px</small>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('admin.image_index_3'), false); ?></label>
		          <div class="col-lg-5 col-sm-10">
                <div class="d-block mb-2">
                  <img src="<?php echo e(url('/public/img', $settings->img_3), false); ?>" style="width:120px">
                </div>

                <div class="input-group mb-1">
                  <input name="image_index_3" type="file" class="form-control custom-file rounded-pill">
                </div>
                <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 120x120 px</small>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('admin.image_index_4'), false); ?></label>
		          <div class="col-lg-5 col-sm-10">
                <div class="d-block mb-2">
                  <img src="<?php echo e(url('/public/img', $settings->img_4), false); ?>" style="width:120px">
                </div>

                <div class="input-group mb-1">
                  <input name="image_index_4" type="file" class="form-control custom-file rounded-pill">
                </div>
                <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 362x433 px</small>
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.avatar_default'), false); ?></label>
		          <div class="col-lg-5 col-sm-10">
                <div class="d-block mb-2">
                  <img src="<?php echo e(Helper::getFile(config('path.avatar').$settings->avatar), false); ?>" style="width:200px">
                </div>

                <div class="input-group mb-1">
                  <input name="avatar" type="file" class="form-control custom-file rounded-pill">
                </div>
                <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 250x250 px</small>
		          </div>
		        </div>

            <div class="row mb-4">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.cover_default'), false); ?></label>
		          <div class="col-lg-5 col-sm-10">
                <div class="d-block mb-2">
                  <div style="max-width: 400px; height: 150px; margin-bottom: 10px; display: block; border-radius: 6px; background: #505050 <?php if($settings->cover_default): ?> url('<?php echo e(Helper::getFile(config('path.cover').$settings->cover_default), false); ?>') no-repeat center center; background-size: cover; <?php endif; ?> ;">
                </div>

                <div class="input-group mb-1">
                  <input name="cover_default" type="file" class="form-control custom-file rounded-pill">
                </div>
                <small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 1500x800 px</small>
		          </div>
		        </div>
						</div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('admin.default_color'), false); ?></label>
		          <div class="col-sm-10">
                <input type="color" name="color" class="form-control form-control-color" value="<?php echo e($settings->color_default, false); ?>">
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.navbar_background_color'), false); ?></label>
		          <div class="col-sm-10">
                <input type="color" name="navbar_background_color" class="form-control form-control-color" value="<?php echo e($settings->navbar_background_color, false); ?>">
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.navbar_text_color'), false); ?></label>
		          <div class="col-sm-10">
                <input type="color" name="navbar_text_color" class="form-control form-control-color" value="<?php echo e($settings->navbar_text_color, false); ?>">
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.footer_background_color'), false); ?></label>
		          <div class="col-sm-10">
                <input type="color" name="footer_background_color" class="form-control form-control-color" value="<?php echo e($settings->footer_background_color, false); ?>">
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(__('general.footer_text_color'), false); ?></label>
		          <div class="col-sm-10">
                <input type="color" name="footer_text_color" class="form-control form-control-color" value="<?php echo e($settings->footer_text_color, false); ?>">
		          </div>
		        </div>

						<fieldset class="row mb-3">
							<legend class="col-form-label col-sm-2 pt-0 text-lg-end"><?php echo e(__('general.button_style'), false); ?></legend>
							<div class="col-sm-10">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="button_style" id="button_style1" <?php if($settings->button_style == 'rounded'): ?> checked="checked" <?php endif; ?> value="rounded" checked>
									<label class="form-check-label" for="button_style1">
										<?php echo e(trans('general.button_style_rounded'), false); ?>

									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="button_style" id="button_style2" <?php if($settings->button_style == 'normal'): ?> checked="checked" <?php endif; ?> value="normal">
									<label class="form-check-label" for="button_style2">
										<?php echo e(trans('admin.normal'), false); ?>

									</label>
								</div>
							</div>
						</fieldset><!-- end row -->

						<div class="row mb-3">
		          <div class="col-sm-10 offset-sm-2">
		            <button type="submit" class="btn btn-dark mt-3 px-5"><?php echo e(__('admin.save'), false); ?></button>
		          </div>
		        </div>

		       </form>

				 </div><!-- card-body -->
 			</div><!-- card  -->
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/theme.blade.php ENDPATH**/ ?>