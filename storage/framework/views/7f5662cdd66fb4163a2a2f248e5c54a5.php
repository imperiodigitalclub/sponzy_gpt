<?php if(! request()->get('q') || request()->get('q') && strlen(request()->get('q')) <= 2): ?>

  <button type="button" class="btn-menu-expand btn btn-primary btn-block mb-4 d-lg-none" type="button" data-toggle="collapse" data-target="#navbarFilters" aria-controls="navbarCollapse" aria-expanded="false">
      <i class="bi bi-filter-right mr-2"></i> <?php echo e(trans('general.filter_by'), false); ?>

    </button>

<div class="navbar-collapse collapse d-lg-block" id="navbarFilters">
<div class="btn-block mb-3">
  <span>

    <span class="category-filter d-lg-block d-none">
    <i class="bi bi-filter-right mr-2"></i> <?php echo e(trans('general.filter_by'), false); ?>

    </span>

    <a class="text-muted btn btn-sm bg-white border mb-2 e-none btn-category <?php if(request()->is('creators') || isset($isCategory) && request()->is('category/'.$slug.'')): ?>active-category <?php endif; ?>" href="<?php echo e(isset($isCategory) ? url('category', $slug) : url('creators'), false); ?>">
      <img src="<?php echo e(url('public/img/popular.png'), false); ?>" class="mr-2" width="30" /> <?php echo e(trans('general.popular'), false); ?>

    </a>

    <a class="text-muted btn btn-sm bg-white border mb-2 e-none btn-category <?php if(request()->is('creators/featured') || isset($isCategory) && request()->is('category/'.$slug.'/featured')): ?>active-category <?php endif; ?>" href="<?php echo e(isset($isCategory) ? url('category/'.$slug.'','featured') : url('creators/featured'), false); ?>">
      <img src="<?php echo e(url('public/img/featured.png'), false); ?>" class="mr-2" width="30" /> <?php echo e(trans('general.featured_creators'), false); ?>

    </a>

    <a class="text-muted btn btn-sm bg-white border mb-2 e-none btn-category <?php if(request()->is('creators/more-active') || isset($isCategory) && request()->is('category/'.$slug.'/more-active')): ?>active-category <?php endif; ?>" href="<?php echo e(isset($isCategory) ? url('category/'.$slug.'','more-active') : url('creators/more-active'), false); ?>">
      <img src="<?php echo e(url('public/img/more-active.png'), false); ?>" class="mr-2" width="30" /> <?php echo e(trans('general.more_active'), false); ?>

    </a>

    <a class="text-muted btn btn-sm bg-white border mb-2 e-none btn-category <?php if(request()->is('creators/new') || isset($isCategory) && request()->is('category/'.$slug.'/new')): ?>active-category <?php endif; ?>" href="<?php echo e(isset($isCategory) ? url('category/'.$slug.'','new') : url('creators/new'), false); ?>">
      <img src="<?php echo e(url('public/img/creators.png'), false); ?>" class="mr-2" width="30" />  <?php echo e(trans('general.new_creators'), false); ?>

    </a>

    <a class="text-muted btn btn-sm bg-white border mb-2 e-none btn-category <?php if(request()->is('creators/free') || isset($isCategory) && request()->is('category/'.$slug.'/free')): ?>active-category <?php endif; ?>" href="<?php echo e(isset($isCategory) ? url('category/'.$slug.'','free') : url('creators/free'), false); ?>">
      <img src="<?php echo e(url('public/img/unlock.png'), false); ?>" class="mr-2" width="30" /> <?php echo e(trans('general.free_subscription'), false); ?>

    </a>

    <?php if($settings->search_creators_genders): ?>
    <a class="text-muted btn btn-sm bg-white border mb-2 e-none btn-category" href="javascript:;" data-toggle="modal" data-target="#filterGendersAge">
      <img src="<?php echo e(url('public/img/genders.png'), false); ?>" class="mr-2" width="30" /> <?php echo e(trans('general.gender_age'), false); ?>

    </a>
  <?php endif; ?>

    <?php if($settings->live_streaming_status == 'on'): ?>
      <a class="text-muted btn btn-sm bg-white border mb-2 e-none btn-category <?php if(request()->is('explore/creators/live')): ?>active-category <?php endif; ?>" href="<?php echo e(url('explore/creators/live'), false); ?>">
        <img src="<?php echo e(url('public/img/live.png'), false); ?>" class="mr-2" width="30" /> <?php echo e(trans('general.live'), false); ?>

      </a>
    <?php endif; ?>
  </span>
</div>
</div>

<?php if($settings->search_creators_genders): ?>
<div class="modal fade" id="filterGendersAge" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-white shadow border-0">

          <div class="card-body px-lg-5 py-lg-5">

            <div class="mb-3">
              <h6 class="position-relative"><?php echo e(trans('general.filter_by_gender_age'), false); ?>

                <small data-dismiss="modal" class="btn-cancel-msg"><i class="bi bi-x-lg"></i></small>
              </h6>
            </div>

            <form method="GET" action="<?php echo e(url()->current(), false); ?>">

              <div class="row">
                <div class="col-md-12">
                  <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-venus-mars"></i></span>
                  </div>
                  <select name="gender" class="form-control custom-select">
                    <option selected="selected" value="all"><?php echo e(__('general.all_genders'), false); ?></option>
                    <?php $__currentLoopData = $genders = explode(',', $settings->genders); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php if(request('gender') == $gender): ?> selected="selected" <?php endif; ?> value="<?php echo e($gender, false); ?>"><?php echo e(__('general.'.$gender), false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                  </div><!-- ./col-md-12 -->
              </div><!-- row -->

              <div class="row form-group mb-0">
                <div class="col-6">
                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="bi-dash-lg"></i></span>
                      </div>
                      <input class="form-control" min="18" name="min_age" placeholder="<?php echo e(trans('general.min_age'), false); ?>"  value="<?php echo e(request('min_age'), false); ?>" type="number">
                    </div>
                  </div><!-- ./col-md-6 -->

                  <div class="col-6">
                      <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi-plus-lg"></i></span>
                        </div>
                        <input class="form-control" name="max_age" placeholder="<?php echo e(trans('general.max_age'), false); ?>"  value="<?php echo e(request('max_age'), false); ?>" type="number">
                      </div>
                    </div><!-- ./col-md-6 -->
                  </div><!-- row -->

              <button type="submit" class="btn btn-primary btn-sm mt-3 w-100">
                <?php echo e(trans('general.search'), false); ?>

              </button>

          </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- End Modal Filter by genders -->
<?php endif; ?>

<?php endif; ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/menu-filters-creators.blade.php ENDPATH**/ ?>