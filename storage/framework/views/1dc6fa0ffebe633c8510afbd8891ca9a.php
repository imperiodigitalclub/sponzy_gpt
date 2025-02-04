<?php if(count($errors) > 0): ?>
	<!-- Start Box Body -->
  <div class="box-body">
	<div class="alert alert-danger" id="dangerAlert">
		<?php echo e(trans('auth.error_desc'), false); ?> <br><br>
		<ul class="list-unstyled">
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li><i class="far fa-times-circle"></i> <?php echo e($error, false); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div>
</div><!-- /.box-body -->
<?php endif; ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/errors/errors-forms.blade.php ENDPATH**/ ?>