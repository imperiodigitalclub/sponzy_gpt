<button type="button" class="btn-menu-expand btn btn-primary btn-block mb-4 d-lg-none" type="button" data-toggle="collapse" data-target="#navbarUserHome" aria-controls="navbarCollapse" aria-expanded="false">
		<i class="fa fa-bars mr-2"></i> <?php echo e(trans('general.categories'), false); ?>

	</button>

	<div class="navbar-collapse collapse d-lg-block" id="navbarUserHome">

		<span class="category-filter d-lg-block d-none">
			<i class="bi bi-list-ul mr-2"></i> <?php echo e(trans('general.categories'), false); ?>

		</span>
		
	<div class="py-1 mb-4">
	<div class="text-center">
		<?php $__currentLoopData = Categories::where('mode','on')->orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<a class="text-muted btn btn-sm bg-white border mb-2 e-none btn-category <?php if(Request::path() == "category/$category->slug" || Request::path() == "category/$category->slug/featured" || Request::path() == "category/$category->slug/more-active" || Request::path() == "category/$category->slug/new" || Request::path() == "category/$category->slug/free"): ?>active-category <?php endif; ?>" href="<?php echo e(url('category', $category->slug), false); ?>">
			<img src="<?php echo e(url('public/img-category', $category->image), false); ?>" class="mr-2 rounded" width="30" /> <?php echo e(Lang::has('categories.' . $category->slug) ? __('categories.' . $category->slug) : $category->name, false); ?>

		</a>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
</div>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/listing-categories.blade.php ENDPATH**/ ?>