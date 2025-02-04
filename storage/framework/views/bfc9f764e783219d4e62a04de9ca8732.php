<!-- FOOTER -->
<div class="py-5 <?php if(auth()->guard()->check()): ?> d-none d-lg-block <?php endif; ?> <?php if(auth()->check() && auth()->user()->dark_mode == 'off' || auth()->guest()): ?> footer_background_color footer_text_color <?php else: ?> bg-white <?php endif; ?> <?php if(auth()->check() && auth()->user()->dark_mode == 'off' && $settings->footer_background_color == '#ffffff' || auth()->guest() && $settings->footer_background_color == '#ffffff' ): ?> border-top <?php endif; ?>">
<footer class="container">
  <div class="row">
    <div class="col-md-3">
      <a href="<?php echo e(url('/'), false); ?>">
        <?php if(auth()->check() && auth()->user()->dark_mode == 'on'): ?>
          <img src="<?php echo e(url('public/img', $settings->logo), false); ?>" alt="<?php echo e($settings->title, false); ?>" class="max-w-125">
        <?php else: ?>
          <img src="<?php echo e(url('public/img', $settings->logo_2), false); ?>" alt="<?php echo e($settings->title, false); ?>" class="max-w-125">
      <?php endif; ?>
      </a>
      <?php if($settings->facebook != ''
          || $settings->twitter != ''
          || $settings->instagram != ''
          || $settings->pinterest != ''
          || $settings->youtube != ''
          || $settings->github != ''
          || $settings->tiktok != ''
          || $settings->snapchat != ''
          || $settings->telegram != ''
          || $settings->reddit != ''
          || $settings->linkedin != ''
          || $settings->threads != ''
          ): ?>
      <div class="w-100">
        <span class="w-100"><?php echo e(trans('general.keep_connect_with_us'), false); ?> <?php echo e(trans('general.follow_us_social'), false); ?></span>
        <ul class="list-inline list-social m-0">
          <?php if($settings->twitter != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->twitter, false); ?>" target="_blank" class="ico-social"><i class="bi-twitter-x"></i></a></li>
        <?php endif; ?>

        <?php if($settings->facebook != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->facebook, false); ?>" target="_blank" class="ico-social"><i class="fab fa-facebook"></i></a></li>
          <?php endif; ?>

          <?php if($settings->instagram != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->instagram, false); ?>" target="_blank" class="ico-social"><i class="fab fa-instagram"></i></a></li>
        <?php endif; ?>

          <?php if($settings->pinterest != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->pinterest, false); ?>" target="_blank" class="ico-social"><i class="fab fa-pinterest"></i></a></li>
          <?php endif; ?>

          <?php if($settings->youtube != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->youtube, false); ?>" target="_blank" class="ico-social"><i class="fab fa-youtube"></i></a></li>
          <?php endif; ?>

          <?php if($settings->github != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->github, false); ?>" target="_blank" class="ico-social"><i class="fab fa-github"></i></a></li>
          <?php endif; ?>

          <?php if($settings->tiktok != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->tiktok, false); ?>" target="_blank" class="ico-social"><i class="bi-tiktok"></i></a></li>
          <?php endif; ?>

          <?php if($settings->snapchat != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->snapchat, false); ?>" target="_blank" class="ico-social"><i class="bi-snapchat"></i></a></li>
          <?php endif; ?>

          <?php if($settings->telegram != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->telegram, false); ?>" target="_blank" class="ico-social"><i class="bi-telegram"></i></a></li>
          <?php endif; ?>

          <?php if($settings->reddit != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->reddit, false); ?>" target="_blank" class="ico-social"><i class="bi-reddit"></i></a></li>
          <?php endif; ?>

          <?php if($settings->linkedin != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->linkedin, false); ?>" target="_blank" class="ico-social"><i class="bi-linkedin"></i></a></li>
          <?php endif; ?>

          <?php if($settings->threads != ''): ?>
          <li class="list-inline-item"><a href="<?php echo e($settings->threads, false); ?>" target="_blank" class="ico-social"><i class="bi-threads"></i></a></li>
          <?php endif; ?>
        </ul>
      </div>
    <?php endif; ?>

    <li>
      <div id="installContainer" class="display-none">
        <button class="btn btn-primary w-100 rounded-pill mb-4 mt-3" id="butInstall" type="button">
          <i class="bi-phone mr-1"></i> <?php echo e(__('general.install_web_app'), false); ?>

        </button>
      </div>
    </li>

    </div>
    <div class="col-md-3">
      <h6 class="text-uppercase"><?php echo app('translator')->get('general.about'); ?></h6>
      <ul class="list-unstyled">
        <?php $__currentLoopData = Helper::pages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

      <?php if($page->access == 'all'): ?>
          <li>
            <a class="link-footer" href="<?php echo e(url('/p', $page->slug), false); ?>">
              <?php echo e($page->title, false); ?>

            </a>
        </li>

      <?php elseif($page->access == 'creators' && auth()->check() && auth()->user()->verified_id == 'yes'): ?>
          <li>
            <a class="link-footer" href="<?php echo e(url('/p', $page->slug), false); ?>">
              <?php echo e($page->title, false); ?>

            </a>
        </li>

      <?php elseif($page->access == 'members' && auth()->check()): ?>
          <li>
            <a class="link-footer" href="<?php echo e(url('/p', $page->slug), false); ?>">
              <?php echo e($page->title, false); ?>

            </a>
        </li>
      <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <?php if(! $settings->disable_contact): ?>
        <li><a class="link-footer" href="<?php echo e(url('contact'), false); ?>"><?php echo e(trans('general.contact'), false); ?></a></li>
      <?php endif; ?>


        <?php if($blogsCount != 0): ?>
          <li><a class="link-footer" href="<?php echo e(url('blog'), false); ?>"><?php echo e(trans('general.blog'), false); ?></a></li>
        <?php endif; ?>
      </ul>
    </div>
    <?php if(!$settings->disable_creators_section): ?>
      <?php if($categoriesCount != 0): ?>
      <div class="col-md-3">
        <h6 class="text-uppercase"><?php echo app('translator')->get('general.categories'); ?></h6>
        <ul class="list-unstyled">
          <?php $__currentLoopData = $categoriesFooter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
            <a class="link-footer" href="<?php echo e(url('category', $category->slug), false); ?>">
              <?php echo e(Lang::has('categories.' . $category->slug) ? __('categories.' . $category->slug) : $category->name, false); ?>

            </a>
          </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <?php if($categoriesCount > 6): ?>
            <li><a class="link-footer btn-arrow" href="<?php echo e(url('creators'), false); ?>"><?php echo e(trans('general.explore'), false); ?></a></li>
            <?php endif; ?>
        </ul>
      </div>
      <?php endif; ?>
    <?php endif; ?>
    <div class="col-md-3">
      <h6 class="text-uppercase"><?php echo app('translator')->get('general.links'); ?></h6>
      <ul class="list-unstyled">
      <?php if(auth()->guard()->guest()): ?>
        <li><a class="link-footer" href="<?php echo e($settings->home_style == 0 ? url('login') : url('/'), false); ?>"><?php echo e(trans('auth.login'), false); ?></a></li><li>
          <?php if($settings->registration_active == '1'): ?>
        <li><a class="link-footer" href="<?php echo e($settings->home_style == 0 ? url('signup') : url('/'), false); ?>"><?php echo e(trans('auth.sign_up'), false); ?></a></li><li>
        <?php endif; ?>
        <?php else: ?>
          <li><a class="link-footer url-user" href="<?php echo e(url(auth()->User()->username), false); ?>"><?php echo e(auth()->user()->verified_id == 'yes' ? trans('general.my_page') : trans('users.my_profile'), false); ?></a></li><li>
          <li><a class="link-footer" href="<?php echo e(url('settings/page'), false); ?>"><?php echo e(auth()->user()->verified_id == 'yes' ? trans('general.edit_my_page') : trans('users.edit_profile'), false); ?></a></li><li>
          <li><a class="link-footer" href="<?php echo e(url('my/subscriptions'), false); ?>"><?php echo e(trans('users.my_subscriptions'), false); ?></a></li><li>
          <li><a class="link-footer" href="<?php echo e(url('logout'), false); ?>"><?php echo e(trans('users.logout'), false); ?></a></li><li>
      <?php endif; ?>

      <?php if(auth()->guard()->guest()): ?>
        <?php if($languages->count() > 1): ?>
        <li class="dropdown mt-1">
          <a class="btn btn-outline-secondary rounded-pill mt-2 dropdown-toggle px-4 dropdown-toggle text-decoration-none" href="javascript:;" data-toggle="dropdown">
            <i class="feather icon-globe mr-1"></i>
            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($language->abbreviation == config('app.locale') ): ?> <?php echo e($language->name, false); ?>  <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </a>

        <div class="dropdown-menu">
          <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a <?php if($language->abbreviation != config('app.locale')): ?> href="<?php echo e(url('change/lang', $language->abbreviation), false); ?>" <?php endif; ?> class="dropdown-item mb-1 dropdown-lang <?php if( $language->abbreviation == config('app.locale') ): ?> active text-white <?php endif; ?>">
            <?php if($language->abbreviation == config('app.locale')): ?> <i class="fa fa-check mr-1"></i> <?php endif; ?> <?php echo e($language->name, false); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        </li>
      <?php endif; ?>
    <?php endif; ?>

      </ul>
    </div>
  </div>
</footer>
</div>

<footer class="py-3 <?php if(auth()->check() && auth()->user()->dark_mode == 'off' || auth()->guest() ): ?> footer_background_color <?php endif; ?> text-center">
  <div class="container">
    <div class="row">
    <?php if(auth()->guard()->check()): ?>
      <div class="d-lg-none d-block pb-5 mb-2">
        <?php echo $__env->make('includes.footer-tiny', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    <?php endif; ?>
      <div class="col-md-12 copyright <?php if(auth()->guard()->check()): ?> d-none d-lg-block <?php endif; ?>">
        &copy; <?php echo e(date('Y'), false); ?> <?php echo e($settings->title, false); ?>, <?php echo e(__('emails.rights_reserved'), false); ?>


        <?php if($settings->show_address_company_footer): ?>
        <small class="ml-2">
          <?php echo e($settings->company, false); ?> - <?php echo e(__('general.address'), false); ?>: <?php echo e($settings->address, false); ?> <?php echo e($settings->city, false); ?> <?php echo e($settings->country, false); ?>

        </small>
        <?php endif; ?>
      </div>
    </div>
  </div>
</footer>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/footer.blade.php ENDPATH**/ ?>