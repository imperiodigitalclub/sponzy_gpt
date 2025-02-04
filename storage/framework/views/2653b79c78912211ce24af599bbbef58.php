<a href="<?php echo e(url('shop/product', $product->id), false); ?>" class="link-shop">
	<div class="card card-updates h-100 card-user-profile shadow-sm">
		<span class="badge type-item p-2 badge-pill">
			<?php echo ($product->type == 'digital')
				? '<i class="bi-cloud-download mr-2"></i>'. __('general.digital_download')
				: (($product->type == 'physical')
				? '<i class="bi-controller mr-2"></i>'. __('general.physical_products')
				: '<i class="bi-lightning-charge mr-2"></i>'. __('general.custom_content')); ?>

		</span>
	<div class="card-cover position-relative" style="background: url(<?php echo e(route('resize', ['path' => 'shop', 'file' => $product->previews[0]->name, 'size' => 480]), false); ?>) #efefef center center; background-size: cover; height:300px;">

		<span class="<?php echo \Illuminate\Support\Arr::toCssClasses(['price-shop', 'bg-danger' => $product->type == 'physical' && $product->quantity == 0]); ?>">
			<?php if($product->type == 'physical' && $product->quantity == 0): ?>
				<?php echo e(__('general.sold_out'), false); ?>

			<?php else: ?>
				<?php echo e(Helper::amountFormatDecimal($product->price), false); ?>

			<?php endif; ?>
		</span>
	</div>

	<div class="card-body">
			<h5 class="card-title mb-2 text-truncate-2"><?php echo e($product->name, false); ?></h5>
			<p class="my-2 text-muted card-text text-truncate-2"><?php echo e(Str::limit($product->description, 100, '...'), false); ?></p>
	</div><!-- card-body -->

	<div class="card-footer pt-0 bg-transparent border-top-0">
		<div class="d-flex align-items-end justify-content-between">
				<div class="d-flex align-items-center">
						<img class="rounded-circle mr-3" src="<?php echo e(Helper::getFile(config('path.avatar').$product->user()->avatar), false); ?>" width="40" height="40" alt="<?php echo e($product->user()->username, false); ?>">
						<div class="small">
								<div><strong><?php echo e('@'.$product->user()->username, false); ?></strong></div>
								<div class="text-muted"><?php echo e(Helper::formatDate($product->created_at), false); ?></div>
						</div>
				</div>
		</div>
</div>
</div><!-- End Card -->
</a>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/shop/listing-products.blade.php ENDPATH**/ ?>