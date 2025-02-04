<div class="container">
  <div class="row">
		<?php $__currentLoopData = Helper::emojis(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emoji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-3">
	      <span class="emoji" data-emoji="<?php echo e($emoji, false); ?>"><?php echo e($emoji, false); ?></span>
	    </div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/emojis.blade.php ENDPATH**/ ?>