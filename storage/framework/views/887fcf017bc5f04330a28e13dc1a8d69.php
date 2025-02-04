

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <a class="text-reset" href="<?php echo e(url('panel/admin/pages'), false); ?>"><?php echo e(__('admin.pages'), false); ?></a>
			<i class="bi-chevron-right me-1 fs-6"></i>
			<span class="text-muted"><?php echo e(__('admin.edit'), false); ?></span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

		<?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-5">

					 <form method="post" action="<?php echo e(url('panel/admin/pages/edit', $data->id), false); ?>">
             <?php echo csrf_field(); ?>

		        <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('admin.title'), false); ?></label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($data->title, false); ?>" name="title" type="text" class="form-control">
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('admin.slug'), false); ?></label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($data->slug, false); ?>" name="slug"  type="text" class="form-control">
                <small class="d-block"><strong><?php echo e(trans('general.important'), false); ?>: <?php echo e(trans('general.slug_lang_info'), false); ?></strong></small>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('admin.keywords'), false); ?> (SEO)</label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($data->keywords, false); ?>" name="keywords" type="text" class="form-control">
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(__('admin.description'), false); ?></label>
		          <div class="col-sm-10">
                <textarea class="form-control" name="description" rows="4"><?php echo e($data->description, false); ?></textarea>
		          </div>
		        </div>

		        <div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('general.language'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="lang" class="form-select">
                  <?php $__currentLoopData = Languages::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if($language->abbreviation == session('locale')): ?> selected="selected" <?php endif; ?> value="<?php echo e($language->abbreviation, false); ?>"><?php echo e($language->name, false); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		           </select>
               <small class="d-block"><?php echo e(trans('general.page_lang'), false); ?></small>
		          </div>
		        </div>

						<div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('general.who_can_access_this_page'), false); ?></label>
		          <div class="col-sm-10">
		            <select name="access" class="form-select">
									<option <?php if($data->access == 'all'): ?> selected="selected" <?php endif; ?> value="all"><?php echo e(__('general.all'), false); ?></option>
										<option <?php if($data->access == 'members'): ?> selected="selected" <?php endif; ?> value="members"><?php echo e(__('admin.only_users'), false); ?></option>
											<option <?php if($data->access == 'creators'): ?> selected="selected" <?php endif; ?> value="creators"><?php echo e(__('general.only_creators'), false); ?></option>
		           </select>
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('admin.content'), false); ?></label>
		          <div class="col-sm-10">
                <textarea class="form-control" name="content" rows="4" id="content"><?php echo e($data->content, false); ?></textarea>
		          </div>
		        </div>

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

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('public/js/ckeditor/ckeditor-init.js'), false); ?>?v=<?php echo e($settings->version, false); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/edit-page.blade.php ENDPATH**/ ?>