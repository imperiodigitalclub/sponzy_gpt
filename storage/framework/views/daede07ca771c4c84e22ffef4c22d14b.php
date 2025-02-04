<div class="modal fade" id="modalTransfer" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white shadow border-0">
					<div class="card-body px-lg-5 py-lg-5 position-relative">
						<h6><?php echo e(__('general.balance'), false); ?>: <?php echo e(Helper::amountFormatDecimal(auth()->user()->balance), false); ?></h6>
						<form method="post" action="<?php echo e(url('transfer/balance'), false); ?>" id="formSendTip">
							<input type="number" min="1" max="<?php echo e(auth()->user()->balance, false); ?>" required autocomplete="off" id="onlyNumber" class="form-control mb-3" name="amount" placeholder="<?php echo e(__('admin.amount'), false); ?>">
							<?php echo csrf_field(); ?>

							<div class="alert alert-danger display-none" id="errorTip">
									<ul class="list-unstyled m-0" id="showErrorsTransfer"></ul>
								</div>

							<div class="text-center">
								<button type="button" class="btn e-none mt-4" data-dismiss="modal"><?php echo e(__('admin.cancel'), false); ?></button>
								<button type="submit" class="btn btn-primary mt-4 submitForm">
									<?php echo e(__('general.transfer'), false); ?>

								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Modal Tip  -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-transfer.blade.php ENDPATH**/ ?>