<!-- Start Modal payPerViewForm -->
<div class="modal fade" id="addStory" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white shadow border-0">

					<div class="card-body px-lg-5 py-lg-5 position-relative">

						<div class="mb-4 position-relative">
						<i class="bi-clock-history mr-1"></i>	<strong><?php echo e(__('general.choose_type_story'), false); ?></strong>

						<small data-dismiss="modal" class="btn-cancel-msg"><i class="bi bi-x-lg"></i></small>
						</div>

						<?php if($settings->story_image): ?>
						<a class="card choose-type-sale mb-3" href="<?php echo e(url('create/story'), false); ?>">
							<div class="card-body">
								<h6 class="mb-1"><i class="bi-image mr-2"></i> <?php echo e(__('general.story_image'), false); ?></h6>
							</div>
						</a>
					<?php endif; ?>

					<?php if($settings->story_text): ?>
						<a class="card choose-type-sale mb-3" href="<?php echo e(url('create/story/text'), false); ?>">
							<div class="card-body">
								<h6 class="mb-1"><i class="bi-type mr-2"></i> <?php echo e(__('general.story_text'), false); ?></h6>
							</div>
						</a>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Modal addItemForm -->
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-add-story.blade.php ENDPATH**/ ?>