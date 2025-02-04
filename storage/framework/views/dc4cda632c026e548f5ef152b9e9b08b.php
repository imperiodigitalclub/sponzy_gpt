<div class="w-100 p-3 border-bottom">
	<div class="w-100">
		<a href="<?php echo e(url()->previous(), false); ?>" class="h4 mr-1 text-decoration-none">
			<i class="fa fa-arrow-left"></i>
		</a>

		<span class="h5 align-top font-weight-bold"><?php echo e(trans('general.messages'), false); ?></span>

		<span class="float-right">
			<a href="#" class="h4 text-decoration-none" data-toggle="modal" data-target="#newMessageForm" title="<?php echo e(trans('general.new_message'), false); ?>">
				<i class="feather icon-edit"></i>
			</a>
		</span>
	</div>
</div>

<?php echo $__env->make('includes.messages-inbox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/sidebar-messages-inbox.blade.php ENDPATH**/ ?>