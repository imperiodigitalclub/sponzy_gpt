<!-- Start Modal payPerViewForm -->
<div class="modal fade" id="addItemForm" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white shadow border-0">

					<div class="card-body px-lg-5 py-lg-5 position-relative">

						<div class="mb-4 position-relative">
						<i class="bi-tag mr-1"></i>	<strong><?php echo e(__('general.choose_type_sale'), false); ?></strong>

						<small data-dismiss="modal" class="btn-cancel-msg"><i class="bi bi-x-lg"></i></small>
						</div>

						<?php if($settings->physical_products): ?>
						<a class="card choose-type-sale mb-3" href="<?php echo e(url('add/physical/product'), false); ?>">
							<div class="card-body">
								<h6 class="mb-1"><i class="bi-controller mr-2"></i> <?php echo e(__('general.physical_products'), false); ?></h6>
								<small><?php echo e(__('general.physical_products_desc'), false); ?></small>
							</div>
						</a>
					<?php endif; ?>

					<?php if($settings->digital_product_sale): ?>
						<a class="card choose-type-sale mb-3" href="<?php echo e(url('add/product'), false); ?>">
							<div class="card-body">
								<h6 class="mb-1"><i class="bi-cloud-download mr-2"></i> <?php echo e(__('general.digital_products'), false); ?></h6>
								<small><?php echo e(__('general.digital_products_desc'), false); ?></small>
							</div>
						</a>
					<?php endif; ?>

					<?php if($settings->custom_content): ?>
						<a class="card choose-type-sale" href="<?php echo e(url('add/custom/content'), false); ?>">
							<div class="card-body">
								<h6 class="mb-1"><i class="bi-lightning-charge mr-2"></i> <?php echo e(__('general.custom_content'), false); ?></h6>
								<small><?php echo e(__('general.custom_content_desc'), false); ?></small>
							</div>
						</a>
					<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Modal addItemForm -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/shop/modal-add-item.blade.php ENDPATH**/ ?>