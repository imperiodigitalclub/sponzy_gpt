<ul class="list-group list-group-flush border-dashed-radius">

	<li class="list-group-item py-1 list-taxes">
    <div class="row">
      <div class="col">
        <small><?php echo e(trans('general.subtotal'), false); ?>:</small>
      </div>
      <div class="col-auto">
        <small class="subtotal font-weight-bold">
        <?php echo e(Helper::symbolPositionLeft(), false); ?><span class="subtotalTip">0</span><?php echo e(Helper::symbolPositionRight(), false); ?>

        </small>
      </div>
    </div>
  </li>
  
	<?php $__currentLoopData = auth()->user()->isTaxable(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li class="list-group-item py-1 list-taxes isTaxable">
	    <div class="row">
	      <div class="col">
	        <small><?php echo e($tax->name, false); ?> <?php echo e($tax->percentage, false); ?>%:</small>
	      </div>
	      <div class="col-auto percentageAppliedTax<?php echo e($loop->iteration, false); ?>" data="<?php echo e($tax->percentage, false); ?>">
	        <small class="font-weight-bold">
	        <?php echo e(Helper::symbolPositionLeft(), false); ?><span class="amount<?php echo e($loop->iteration, false); ?>">0</span><?php echo e(Helper::symbolPositionRight(), false); ?>

	        </small>
	      </div>
	    </div>
	  </li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<li class="list-group-item py-1 list-taxes">
    <div class="row">
      <div class="col">
        <small class="font-weight-bold"><?php echo e(trans('general.total'), false); ?>:</small>
      </div>
      <div class="col-auto">
        <small class="totalPPV font-weight-bold">
        <?php echo e(Helper::symbolPositionLeft(), false); ?><span class="totalTip">0</span><?php echo e(Helper::symbolPositionRight(), false); ?>

        </small>
      </div>
    </div>
  </li>

</ul>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-taxes.blade.php ENDPATH**/ ?>