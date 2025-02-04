<?php $__env->startSection('title'); ?> <?php echo e(__('general.my_posts'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="feather icon-feather mr-2"></i> <?php echo e(__('general.my_posts'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(__('general.all_post_created'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <div class="col-md-12 mb-5 mb-lg-0">

          <?php if(session('notify')): ?>
          <div class="alert alert-primary">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>

            <i class="bi-info-circle mr-1"></i> <?php echo e(session('notify'), false); ?>

          </div>
          <?php endif; ?>

          <?php if($posts->count() != 0): ?>
          <div class="btn-block mb-3 text-right">
            <span>
              <select class="ml-2 custom-select mb-2 mb-lg-0 w-auto filter">
                <option <?php if(!request('sort')): echo 'selected'; endif; ?> value="<?php echo e(url('my/posts'), false); ?>"><?php echo e(__('general.all'), false); ?></option>

                <?php if($settings->allow_scheduled_posts): ?>
                <option <?php if(request('sort') == 'scheduled'): echo 'selected'; endif; ?> value="<?php echo e(url('my/posts?sort=scheduled'), false); ?>">
                  <?php echo e(__('general.scheduled'), false); ?>

                </option> 
                <?php endif; ?>
                
                <option <?php if(request('sort') == 'pending'): echo 'selected'; endif; ?> value="<?php echo e(url('my/posts?sort=pending'), false); ?>">
                  <?php echo e(__('admin.pending'), false); ?>

                </option> 


                <option <?php if(request('sort') == 'ppv'): echo 'selected'; endif; ?> value="<?php echo e(url('my/posts?sort=ppv'), false); ?>">
                  <?php echo e(__('general.ppv'), false); ?>

                </option>
              </select>
            </span>
          </div>

          <div class="card shadow-sm mb-2">
          <div class="table-responsive">
            <table class="table table-striped m-0">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col"><?php echo e(__('admin.content'), false); ?></th>
                  <th scope="col"><?php echo e(__('admin.description'), false); ?></th>
                  <th scope="col"><?php echo e(__('admin.type'), false); ?></th>
                  <th scope="col"><?php echo e(__('general.price'), false); ?></th>
                  <th scope="col"><?php echo e(__('general.interactions'), false); ?></th>
                  <th scope="col"><?php echo e(__('admin.date'), false); ?></th>
                  <th scope="col"><?php echo e(__('admin.status'), false); ?></th>
                </tr>
              </thead>

              <tbody>

                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($post->id, false); ?></td>
                    <td>
                      <?php if($post->media_count): ?>
                      <?php echo e($post->media_count, false); ?> <?php echo e(trans_choice('general.files', $post->media_count ), false); ?>

                      <?php else: ?>
                      <?php echo e(__('general.text'), false); ?>

                      <?php endif; ?>
                    </td>

                    <td>
                    <a href="<?php echo e(url($post->creator->username, 'post').'/'.$post->id, false); ?>" target="_blank">
                      <?php echo e(str_limit($post->description, 20, '...'), false); ?> <i class="bi bi-box-arrow-up-right ml-1"></i>
                    </a>
                    </td>
                    <td>
                      <?php if($post->locked == 'yes'): ?>
                        <i class="feather icon-lock mr-1" title="<?php echo e(__('users.content_locked'), false); ?>"></i>
                      <?php else: ?>
                        <i class="iconmoon icon-WorldWide mr-1" title="<?php echo e(__('general.public'), false); ?>"></i>
                      <?php endif; ?>
                    </td>
                    <td><?php echo e(Helper::amountFormatDecimal($post->price), false); ?></td>
                    <td>
                      <i class="far fa-heart"></i> <?php echo e($post->likes_count, false); ?> 
                      <i class="far fa-comment ml-1"></i> <?php echo e(($post->comments_count + $post->replies_count), false); ?>

                      <i class="feather icon-bookmark ml-1"></i> <?php echo e($post->bookmarks_count, false); ?>

                    </td>
                    <td><?php echo e(Helper::formatDate($post->date), false); ?></td>
                    <td>
                      <?php if($post->status == 'active'): ?>
                        <span class="badge badge-pill badge-success text-uppercase"><?php echo e(__('general.active'), false); ?></span>
                      <?php elseif($post->status == 'schedule'): ?>
                      <span class="badge badge-pill badge-info text-uppercase"><?php echo e(__('general.scheduled'), false); ?></span>
                        <a tabindex="0" role="button" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="<?php echo e(__('general.date_schedule'), false); ?> <?php echo e(Helper::formatDateSchedule($post->scheduled_date), false); ?>">
                          <i class="far fa-question-circle"></i>
                        </a>
                        <?php else: ?>
                        <span class="badge badge-pill badge-warning text-uppercase"><?php echo e(__('general.pending'), false); ?></span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
          </div><!-- card -->

          <?php if($posts->hasPages()): ?>
  			    	<?php echo e($posts->onEachSide(0)->links(), false); ?>

  			    	<?php endif; ?>

        <?php else: ?>
          <div class="my-5 text-center">
            <span class="btn-block mb-3">
              <i class="feather icon-feather ico-no-result"></i>
            </span>
            <h4 class="font-weight-light"><?php echo e(__('general.not_post_created'), false); ?></h4>
          </div>
        <?php endif; ?>
        </div><!-- end col-md-6 -->

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/my_posts.blade.php ENDPATH**/ ?>