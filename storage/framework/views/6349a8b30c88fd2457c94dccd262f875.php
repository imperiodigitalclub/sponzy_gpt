<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale()), false); ?>">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">
  <meta name="description" content="<?php echo $__env->yieldContent('description_custom'); ?><?php if(!Request::route()->named('seo') && !Request::route()->named('profile')): ?><?php echo e(trans('seo.description'), false); ?><?php endif; ?>">
  <meta name="keywords" content="<?php echo $__env->yieldContent('keywords_custom'); ?><?php echo e(trans('seo.keywords'), false); ?>" />
  <meta name="theme-color" content="<?php echo e(auth()->check() && auth()->user()->dark_mode == 'on' ? '#303030' : $settings->color_default, false); ?>">
  <title><?php echo e(auth()->check() && User::notificationsCount() ? '('.User::notificationsCount().') ' : '', false); ?><?php $__env->startSection('title'); ?><?php echo $__env->yieldSection(); ?> <?php echo e($settings->title.' - '.__('seo.slogan'), false); ?></title>
  <!-- Favicon -->
  <link href="<?php echo e(url('public/img', $settings->favicon), false); ?>" rel="icon">

  <?php if($settings->google_tag_manager_head != ''): ?>
  <?php echo $settings->google_tag_manager_head; ?>

  <?php endif; ?>

  <?php echo $__env->make('includes.css_general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php if($settings->status_pwa): ?>
    <?php $config = (new \LaravelPWA\Services\ManifestService)->generate(); echo $__env->make( 'laravelpwa::meta' , ['config' => $config])->render(); ?>
  <?php endif; ?>

  <?php echo $__env->yieldContent('css'); ?>

 <?php if($settings->google_analytics != ''): ?>
  <?php echo $settings->google_analytics; ?>

  <?php endif; ?>
</head>

<body>
  <?php if($settings->google_tag_manager_body != ''): ?>
  <?php echo $settings->google_tag_manager_body; ?>

  <?php endif; ?>

  <?php if($settings->disable_banner_cookies == 'off'): ?>
  <div class="btn-block text-center showBanner padding-top-10 pb-3 display-none">
    <i class="fa fa-cookie-bite"></i> <?php echo e(trans('general.cookies_text'), false); ?>

    <?php if($settings->link_cookies != ''): ?>
      <a href="<?php echo e($settings->link_cookies, false); ?>" class="mr-2 text-white link-border" target="_blank"><?php echo e(trans('general.cookies_policy'), false); ?></a>
    <?php endif; ?>
    <button class="btn btn-sm btn-primary" id="close-banner"><?php echo e(trans('general.go_it'), false); ?>

    </button>
  </div>
<?php endif; ?>

  <div id="mobileMenuOverlay" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"></div>

  <?php if(auth()->guard()->check()): ?>
    <?php if(! request()->is('messages/*') && ! request()->is('live/*')): ?>
    <?php echo $__env->make('includes.menu-mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  <?php endif; ?>

  <?php if($settings->alert_adult == 'on'): ?>
    <div class="modal fade" tabindex="-1" id="alertAdult">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body p-4">
          <p><?php echo e(__('general.alert_content_adult'), false); ?></p>
        </div>
        <div class="modal-footer border-0 pt-0">
          <a href="https://google.com" class="btn e-none p-0 mr-3"><?php echo e(trans('general.leave'), false); ?></a>
          <button type="button" class="btn btn-primary" id="btnAlertAdult"><?php echo e(trans('general.i_am_age'), false); ?></button>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>


  <div class="popout popout-error font-default"></div>

<?php if(auth()->guest() && request()->path() == '/' && $settings->home_style == 0
    || auth()->guest() && request()->path() != '/' && $settings->home_style == 0
    || auth()->guest() && request()->path() != '/' && $settings->home_style == 1
    || auth()->check()
    ): ?>
  <?php echo $__env->make('includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <main <?php if(request()->is('messages/*') || request()->is('live/*')): ?> class="h-100" <?php endif; ?> role="main">
    <?php echo $__env->yieldContent('content'); ?>

    <?php if(auth()->guest() 
          && ! request()->route()->named('profile')
          && ! request()->is(['creators', 'category/*', 'creators/*'])
          || auth()->check()
          && request()->path() != '/'
          && ! request()->route()->named('profile')
          && ! request()->is([
            'my/bookmarks', 
            'my/likes', 
            'my/purchases', 
            'explore', 
            'messages', 
            'messages/*', 
            'creators', 
            'category/*', 
            'creators/*', 
            'live/*'
            ])          
          ): ?>

          <?php if(auth()->guest() && request()->path() == '/' && $settings->home_style == 0
                || auth()->guest() && request()->path() != '/' && $settings->home_style == 0
                || auth()->guest() && request()->path() != '/' && $settings->home_style == 1
                || auth()->check()
                  ): ?>

                  <?php if(auth()->guest() && $settings->who_can_see_content == 'users'): ?>
                    <div class="text-center py-3 px-3">
                      <?php echo $__env->make('includes.footer-tiny', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  <?php else: ?>
                    <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php endif; ?>

          <?php endif; ?>

  <?php endif; ?>

  <?php if(auth()->guard()->guest()): ?>

  <?php if(Helper::showLoginFormModal()): ?>
      <?php echo $__env->make('includes.modal-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

  <?php endif; ?>

  <?php if(auth()->guard()->check()): ?>

    <?php if($settings->disable_tips == 'off'): ?>
     <?php echo $__env->make('includes.modal-tip', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <?php endif; ?>

   <?php if($settings->gifts): ?>
     <?php echo $__env->make('includes.modal-gifts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <?php endif; ?>

    <?php echo $__env->make('includes.modal-payperview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($settings->live_streaming_status == 'on'): ?>
      <?php echo $__env->make('includes.modal-live-stream', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if($settings->allow_scheduled_posts): ?>
      <?php echo $__env->make('includes.modal-scheduled-posts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    
  <?php endif; ?>

  <?php if(auth()->guard()->guest()): ?>
    <?php echo $__env->make('includes.modal-2fa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
</main>

  <?php echo $__env->make('includes.javascript_general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->yieldContent('javascript'); ?>

<?php if(auth()->guard()->check()): ?>
  <div id="bodyContainer"></div>
<?php endif; ?>
</body>
</html>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/layouts/app.blade.php ENDPATH**/ ?>