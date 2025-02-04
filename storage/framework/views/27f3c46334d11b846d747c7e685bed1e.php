<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<a href="<?php echo e(url($user->username), false); ?>">
<div class="w-100 h-100 d-block" style="background: <?php if($user->cover != ''): ?> url(<?php echo e(route('resize', ['path' => 'cover', 'file' => $user->cover, 'size' => 480]), false); ?>)  <?php endif; ?> #505050 center center; border-radius: 6px; background-size: cover;">

  <div class="card-cover position-relative" style="height: 50px">
    <?php if($user->free_subscription == 'yes'): ?>
    <span class="badge-free px-2 py-1 text-uppercase position-absolute rounded"><?php echo e(__('general.free'), false); ?></span>
  <?php endif; ?>
  </div>

  <li class="list-group-item mb-2 border-0" style="background: rgba(0,0,0,.35);">
         <div class="media">
          <div class="media-left mr-3">
              <img class="media-object rounded-circle avatar-user-home" src="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>"  width="95" height="95">
          </div>
          <div class="media-body text-truncate">
            <h5 class="media-heading mb-1">
              <a href="<?php echo e(url($user->username), false); ?>" class="stretched-link text-white">
                <strong><?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?></strong>
              </a>
               <?php if($user->verified_id == 'yes'): ?>
                 <small class="verified mr-1 text-white" title="<?php echo e(__('general.verified_account'), false); ?>"data-toggle="tooltip" data-placement="top">
                   <i class="bi bi-patch-check"></i>
                 </small>
               <?php endif; ?>

               <?php if($user->featured == 'yes'): ?>
              <small class="text-featured" title="<?php echo e(__('users.creator_featured'), false); ?>" data-toggle="tooltip" data-placement="top">
                <i class="fas fa fa-award"></i>
              </small>
              <?php endif; ?>

               <small class=" text-white w-100 d-block text-truncate"><?php echo e('@'.$user->username, false); ?></small>
            </h5>
          </div>
      </div>
  </li>
	</div><!-- cover -->
  </a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/listing-explore-creators.blade.php ENDPATH**/ ?>