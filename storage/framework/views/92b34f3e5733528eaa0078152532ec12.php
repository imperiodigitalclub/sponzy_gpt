<div class="card border-0 bg-transparent">
  <div class="card-body p-0">
    <small class="text-muted">
      &copy; <?php echo e(date('Y'), false); ?> <?php echo e($settings->title, false); ?>, <?php echo e(__('emails.rights_reserved'), false); ?>


      <?php if($settings->show_address_company_footer): ?>
          <?php echo e($settings->company, false); ?> - <?php echo e(__('general.address'), false); ?>: <?php echo e($settings->address, false); ?> <?php echo e($settings->city, false); ?> <?php echo e($settings->country, false); ?>

        <?php endif; ?>
    </small>

    <ul class="list-inline mb-0 small">

      <?php $__currentLoopData = Helper::pages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($page->access == 'all'): ?>

          <li class="list-inline-item">
            <a class="link-footer footer-tiny" href="<?php echo e(url('/p', $page->slug), false); ?>">
              <?php echo e($page->title, false); ?>

            </a>
          </li>

        <?php elseif($page->access == 'creators' && auth()->check() && auth()->user()->verified_id == 'yes'): ?>
          <li class="list-inline-item">
            <a class="link-footer footer-tiny" href="<?php echo e(url('/p', $page->slug), false); ?>">
              <?php echo e($page->title, false); ?>

            </a>
          </li>

        <?php elseif($page->access == 'members' && auth()->check()): ?>
          <li class="list-inline-item">
            <a class="link-footer footer-tiny" href="<?php echo e(url('/p', $page->slug), false); ?>">
              <?php echo e($page->title, false); ?>

            </a>
          </li>
        <?php endif; ?>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <?php if(! $settings->disable_contact): ?>
        <li class="list-inline-item"><a class="link-footer footer-tiny" href="<?php echo e(url('contact'), false); ?>"><?php echo e(trans('general.contact'), false); ?></a></li>
    <?php endif; ?>

      <?php if($blogsCount != 0): ?>
      <li class="list-inline-item"><a class="link-footer footer-tiny" href="<?php echo e(url('blog'), false); ?>"><?php echo e(trans('general.blog'), false); ?></a></li>
    <?php endif; ?>

    <?php if(auth()->guard()->guest()): ?>
      <?php if($languages->count() > 1): ?>
    <div class="btn-group dropup d-inline">
      <li class="list-inline-item">
        <a class="link-footer dropdown-toggle text-decoration-none footer-tiny" href="javascript:;" data-toggle="dropdown">
          <i class="feather icon-globe"></i>
          <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if( $language->abbreviation == config('app.locale') ): ?> <?php echo e($language->name, false); ?>  <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </a>

      <div class="dropdown-menu">
        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a <?php if($language->abbreviation != config('app.locale')): ?> href="<?php echo e(url('change/lang', $language->abbreviation), false); ?>" <?php endif; ?> class="dropdown-item mb-1 <?php if( $language->abbreviation == config('app.locale') ): ?> active text-white <?php endif; ?>">
          <?php if($language->abbreviation == config('app.locale')): ?> <i class="fa fa-check mr-1"></i> <?php endif; ?> <?php echo e($language->name, false); ?>

          </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      </li>
    </div><!-- dropup -->
      <?php endif; ?>
    <?php endif; ?>

    <li class="list-inline-item">
      <div id="installContainer" class="display-none">
        <a class="link-footer footer-tiny" id="butInstall" href="javascript:void(0);">
          <i class="bi-phone"></i> <?php echo e(__('general.install_web_app'), false); ?>

        </a>
      </div>
    </li>
    </ul>
  </div>
</div>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/footer-tiny.blade.php ENDPATH**/ ?>