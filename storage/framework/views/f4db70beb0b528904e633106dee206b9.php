<?php if($paginator->hasMorePages()): ?>
<a href="javascript:void(0)" data-url="<?php echo e($paginator->nextPageUrl(), false); ?>" rel="next" class="btn btn-primary btn-sm text-center my-2 w-100 paginatorMsg">
       	 <?php echo e(trans('general.loadmore'), false); ?> <i class="far fa-arrow-alt-circle-down"></i>
       	 	</a>
       	 	<?php endif; ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/vendor/pagination/loadmore.blade.php ENDPATH**/ ?>