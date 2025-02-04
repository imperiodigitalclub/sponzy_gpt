<div class="modal fade" id="giftsForm" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modalGifts modal-dialog-scrollable" role="document">
		<div class="modal-content p-lg-3">
			<div class="modal-header border-bottom-0">
				<h6 class="modal-title">
                    <i class="bi-gift mr-1"></i> <?php echo e(__('general.send_a_gift'), false); ?>

                    <small class="d-block w-100"><?php echo e(__('general.send_gift_desc_payment'), false); ?></small>
                </h6>
				<button type="button" class="close close-inherit" data-dismiss="modal" aria-label="Close">
					<i class="bi bi-x-lg"></i>
				</button>
			  </div>

			<form method="post" style="display: contents;" action="<?php echo e(url('send/gift'), false); ?>" id="formSendGift">
				<?php echo csrf_field(); ?>

				<?php if(request()->route()->named('profile')): ?>
					<input type="hidden" name="user_id" value="<?php echo e($user->id, false); ?>" />
				<?php endif; ?>

				<?php if(request()->is('messages/*')): ?>
					<input type="hidden" name="isMessage" value="1" />
					<input type="hidden" name="user_id" value="<?php echo e($user->id, false); ?>" />
				<?php endif; ?>

				<?php if(request()->route()->named(['live', 'live.private'])): ?>
					<input type="hidden" name="isLive" value="1" />
					
					<?php if($live): ?>
						<input type="hidden" name="liveID" value="<?php echo e($live->id, false); ?>"  />
						<input type="hidden" name="user_id" value="<?php echo e($creator->id, false); ?>" />
					<?php endif; ?>

				<?php endif; ?>

			<div class="modal-body p-0 custom-scrollbar">
				<div class="card bg-white shadow border-0">
					<div class="card-body text-center">
                        <div class="btn-group-toggle btn-group-radio d-inline" data-toggle="buttons">
                        <?php $__currentLoopData = $gifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="btn btn-radio">
                              <input type="radio" required name="gift" value="<?php echo e($gift->id, false); ?>" id="gift<?php echo e($gift->id, false); ?>"> 
                              <img src="<?php echo e(url('public/img/gifts', $gift->image), false); ?>" width="80">
                              <small class="d-block w-100 mt-1">
                                <?php echo e(Helper::formatPrice($gift->price, true), false); ?>

                              </small>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
					</div>
				</div>
			</div>

            <div class="modal-footer">
                <?php if($taxRatesCount != 0 && auth()->user()->isTaxable()->count()): ?>
                  <ul class="list-group w-100 list-group-flush border-dashed-radius">
                  	<?php $__currentLoopData = auth()->user()->isTaxable(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  		<li class="list-group-item py-1 list-taxes">
                  	    <div class="row">
                  	      <div class="col">
                  	        <small><?php echo e($tax->name, false); ?> <?php echo e($tax->percentage, false); ?>% <?php echo e(__('general.applied_price'), false); ?></small>
                  	      </div>
                  	    </div>
                  	  </li>
                  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                <?php endif; ?>

				<div class="alert alert-danger w-100 display-none" id="errorGift">
					<ul class="list-unstyled m-0" id="showErrorsGift"></ul>
				</div>

                <div class="text-center w-100">
                    <button type="submit" class="btn btn-primary px-5 giftBtn">
						<i></i> <?php echo e(__('general.send_gift'), false); ?>

					</button>
                </div>
              </div>
			</form>
		</div>
	</div>
</div><!-- End Modal new Message --><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-gifts.blade.php ENDPATH**/ ?>