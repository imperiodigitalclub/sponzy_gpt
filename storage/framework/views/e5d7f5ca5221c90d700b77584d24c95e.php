<?php $__env->startSection('title'); ?> <?php echo e(trans('general.bookmarks'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container container-lg-3 pt-lg-5 pt-2">
      <div class="row">

        <div class="col-md-2">
          <?php echo $__env->make('includes.menu-sidebar-home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="col-md-6 p-0 second wrap-post">

          <?php if($updates->count() != 0): ?>
          <div class="grid-updates position-relative" id="updatesPaginator">
              <?php echo $__env->make('includes.updates', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>

        <?php else: ?>
          <div class="grid-updates position-relative" id="updatesPaginator"></div>

        <div class="my-5 text-center no-updates">
          <span class="btn-block mb-3">
            <i class="far fa-bookmark ico-no-result"></i>
          </span>
        <h4 class="font-weight-light"><?php echo e(trans('general.no_bookmarks'), false); ?></h4>
        </div>

        <?php endif; ?>
        </div><!-- end col-md-6 -->

        <div class="col-md-4 mb-4 d-lg-block d-none">

          <?php if($users->count() == 0): ?>
          <div class="panel panel-default panel-transparent mb-4 d-lg-block d-none">
        	  <div class="panel-body">
        	    <div class="media none-overflow">
        			  <div class="d-flex my-2 align-items-center">
        			      <img class="rounded-circle mr-2" src="<?php echo e(Helper::getFile(config('path.avatar').auth()->user()->avatar), false); ?>" width="60" height="60">

        						<div class="d-block">
        						<strong><?php echo e(auth()->user()->name, false); ?></strong>


        							<div class="d-block">
        								<small class="media-heading text-muted btn-block margin-zero">
                          <a href="<?php echo e(url('settings/page'), false); ?>">
                						<?php echo e(auth()->user()->verified_id == 'yes' ? trans('general.edit_my_page') : trans('users.edit_profile'), false); ?>

                            <small class="pl-1"><i class="fa fa-long-arrow-alt-right"></i></small>
                          </a>
                        </small>
        							</div>
        						</div>
        			  </div>
        			</div>
        	  </div>
        	</div>
        <?php endif; ?>

          <div class="d-lg-block sticky-top" id="navbarUserHome">

            <?php if($users->count() != 0): ?>
                <?php echo $__env->make('includes.explore_creators', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <div class="d-lg-block d-none">
              <?php echo $__env->make('includes.footer-tiny', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

         </div><!-- navbarUserHome -->

        </div><!-- col-md -->

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/bookmarks.blade.php ENDPATH**/ ?>