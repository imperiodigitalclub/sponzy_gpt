

<?php $__env->startSection('content'); ?>
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(__('admin.dashboard'), false); ?></a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <a class="text-reset" href="<?php echo e(url('panel/admin/blog'), false); ?>"><?php echo e(__('general.blog'), false); ?></a>
			<i class="bi-chevron-right me-1 fs-6"></i>
			<span class="text-muted"><?php echo e(__('admin.edit'), false); ?></span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

			<?php if(session('success_message')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check2 me-1"></i>	<?php echo e(session('success_message'), false); ?>


                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
                </div>
              <?php endif; ?>

		<?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-5">

					 <form method="post" action="<?php echo e(url('panel/admin/blog/update'), false); ?>" enctype="multipart/form-data">
						 <input type="hidden" name="id" value="<?php echo e($data->id, false); ?>">
             <?php echo csrf_field(); ?>

		        <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('general.title'), false); ?></label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($data->title, false); ?>" name="title" type="text" class="form-control">
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end"><?php echo e(trans('general.tags'), false); ?></label>
		          <div class="col-sm-10">
		            <input value="<?php echo e($data->tags, false); ?>" name="tags"  type="text" class="form-control">
		          </div>
		        </div>

		        <div class="row mb-3">
		          <label class="col-sm-2 col-form-labe text-lg-end"><?php echo e(trans('admin.thumbnail'), false); ?></label>
		          <div class="col-sm-10">
								<div class="input-group mb-1">
                  <input name="thumbnail" type="file" accept="image/*" class="form-control custom-file">
                </div>
								<small class="d-block"><?php echo e(__('general.recommended_size'), false); ?> 650x430</small>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/edit-blog.blade.php ENDPATH**/ ?>