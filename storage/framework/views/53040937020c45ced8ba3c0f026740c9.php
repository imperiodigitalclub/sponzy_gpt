

<?php $__env->startSection('title'); ?> <?php echo e($response->title, false); ?> | <?php echo e(trans('general.blog'), false); ?> <?php $__env->stopSection(); ?>
  <?php $__env->startSection('description_custom'); ?><?php echo e(strip_tags($response->content), false); ?><?php $__env->stopSection(); ?>
    <?php $__env->startSection('keywords_custom'); ?><?php echo e($response->tags ? $response->tags.',' : null, false); ?><?php $__env->stopSection(); ?>

  <?php $__env->startSection('css'); ?>
    <meta property="og:type" content="website" />
    <meta property="og:image:width" content="650"/>
    <meta property="og:image:height" content="430"/>

    <!-- Current locale and alternate locales -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:locale:alternate" content="es_ES" />

    <!-- Og Meta Tags -->
    <link rel="canonical" href="<?php echo e(url()->current(), false); ?>"/>
    <meta property="og:site_name" content="<?php echo e($response->title, false); ?>"/>
    <meta property="og:url" content="<?php echo e(url()->current(), false); ?>"/>
    <meta property="og:image" content="<?php echo e(Helper::getFile(config('path.admin').$response->image), false); ?>"/>

    <meta property="og:title" content="<?php echo e($response->title, false); ?>"/>
    <meta property="og:description" content="<?php echo e(strip_tags($response->content), false); ?>"/>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="<?php echo e(Helper::getFile(config('path.admin').$response->image), false); ?>" />
    <meta name="twitter:title" content="<?php echo e($response->title, false); ?>" />
    <meta name="twitter:description" content="<?php echo e(strip_tags($response->content), false); ?>"/>
    <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="section section-sm">
    <div class="container">
      <div class="row">
            <div class="<?php if($blogs->count() == 0): ?> col-md-12 <?php else: ?> col-md-8 <?php endif; ?> py-5">
              <div class="row no-gutters border rounded flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="card-cover w-100 img-post" style="background: <?php if($response->image != ''): ?> url(<?php echo e(Helper::getFile(config('path.admin').$response->image), false); ?>)  <?php endif; ?> #505050 no-repeat center center; background-size: cover; "></div>
                <div class="col p-4 d-flex flex-column position-static">
                  <small class="d-inline-block mb-2"><?php echo e(trans('general.by'), false); ?> <?php echo e($response->user()->name, false); ?> </small>
                  <h3 class="mb-0"><?php echo e($response->title, false); ?></h3>
                  <div class="mb-3 text-muted"><?php echo e(Helper::formatDate($response->date), false); ?></div>
                  <div class="card-text mb-auto content-p"><?php echo $response->content; ?></div>

                  <div class="mt-4 justify-content-middle">
                    <hr>
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url()->current(), false); ?>" class="mr-2">
                      <i class="fab fa-facebook mr-1"></i> <?php echo e(trans('general.share'), false); ?>

                    </a>

                    <a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo e(url()->current(), false); ?>&text=<?php echo e($response->title, false); ?>">
                      <i class="bi-twitter-x mr-1"></i> Tweet
                    </a>
                  </div>

                </div>
              </div>
            </div>

            <?php if($blogs->count() != 0): ?>

              <div class="col-md-4 mb-4 py-lg-5">

              <h6 class="mb-3 text-muted font-weight-light"><?php echo e(trans('general.others_posts'), false); ?></h6>

              <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <a href="<?php echo e(url('blog/post', $response->id).'/'.$response->slug, false); ?>">
                <div class="w-100 d-block" style="background: <?php if($response->image != ''): ?> url(<?php echo e(Helper::getFile(config('path.admin').$response->image), false); ?>)  <?php endif; ?> #505050 center center; border-radius: 6px; background-size: cover;">

                  <div class="card-cover position-relative" style="height: 110px"></div>

                  <li class="list-group-item mb-2 border-0" style="background: rgba(0,0,0,.40);">
                         <div class="media">
                          <div class="media-body">
                            <h5 class="media-heading mb-1">
                              <a href="<?php echo e(url('blog/post', $response->id).'/'.$response->slug, false); ?>" class="stretched-link text-white">
                                <strong><?php echo e($response->title, false); ?></strong>
                              </a>
                              <small class="text-white w-100 d-block mb-2"><?php echo e('@'.$response->user()->name, false); ?> - <?php echo e(Helper::formatDate($response->date), false); ?></small>
                              <p class="text-white font-weight-light"><?php echo e(Str::limit(strip_tags($response->content), 60, '...'), false); ?></p>
                            </h5>
                          </div>
                      </div>
                  </li>
                	</div>
                  </a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </div><!-- end col-md-4 -->

              <?php endif; ?>


      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/index/post.blade.php ENDPATH**/ ?>