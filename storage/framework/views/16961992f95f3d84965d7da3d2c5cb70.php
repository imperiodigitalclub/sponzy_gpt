<?php $__env->startSection('title'); ?> <?php echo e(trans('general.explore'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container container-lg-3 pt-lg-5 pt-3">
      <div class="row">

        <div class="col-md-2">
          <?php if(auth()->guard()->check()): ?>
            <?php echo $__env->make('includes.menu-sidebar-home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
        </div>

        <div class="col-md-6 p-0 second wrap-post">

          <?php if($updates->count() != 0): ?>

        <div class="d-lg-flex d-block justify-content-between align-items-center px-lg-0 px-4 mb-3 text-word-break">
            <!-- form -->
            <form class="position-relative mr-3 w-100 mb-lg-0 mb-2" role="search" autocomplete="off" action="<?php echo e(url('explore'), false); ?>" method="get" class="position-relative">
              <i class="bi bi-search btn-search bar-search"></i>
             <input type="text" minlength="3" required name="q" class="form-control pl-5" value="<?php echo e(request()->get('q'), false); ?>" placeholder="<?php echo e(__('general.search'), false); ?>">
          </form><!-- form -->

            <div class="w-lg-100">
              <select class="form-control custom-select w-100 pr-4" id="filter">
                  <option <?php if(! request()->get('sort')): ?> selected <?php endif; ?> value="<?php echo e(url()->current(), false); ?><?php echo e(request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')) : null, false); ?>"><?php echo e(trans('general.latest'), false); ?></option>
                  <option <?php if(request()->get('sort') == 'oldest'): ?> selected <?php endif; ?> value="<?php echo e(url()->current(), false); ?><?php echo e(request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')).'&' : '?', false); ?>sort=oldest"><?php echo e(trans('general.oldest'), false); ?></option>
                  <option <?php if(request()->get('sort') == 'unlockable'): ?> selected <?php endif; ?> value="<?php echo e(url()->current(), false); ?><?php echo e(request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')).'&' : '?', false); ?>sort=unlockable"><?php echo e(trans('general.unlockable'), false); ?></option>
                  <option <?php if(request()->get('sort') == 'free'): ?> selected <?php endif; ?> value="<?php echo e(url()->current(), false); ?><?php echo e(request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')).'&' : '?', false); ?>sort=free"><?php echo e(trans('general.free'), false); ?></option>
                </select>
          </div>
          </div><!--  end d-lg-flex -->

          <div class="grid-updates position-relative" id="updatesPaginator">
              <?php echo $__env->make('includes.updates', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>

        <?php else: ?>
          <div class="grid-updates position-relative" id="updatesPaginator"></div>

        <div class="my-5 text-center no-updates">
          <span class="btn-block mb-3">
            <i class="fa fa-photo-video ico-no-result"></i>
          </span>
        <h4 class="font-weight-light"><?php echo e(trans('general.no_posts_posted'), false); ?></h4>
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

          <div class="navbar-collapse collapse d-lg-block sticky-top" id="navbarUserHome">

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/index/explore.blade.php ENDPATH**/ ?>