<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale()), false); ?>" data-bs-theme="<?php echo e(auth()->user()->dark_mode == 'on' ? 'dark' : 'light', false); ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">
    <link rel="shortcut icon" href="<?php echo e(url('public/img', $settings->favicon), false); ?>" />

    <title><?php echo e(__('admin.admin'), false); ?></title>

    <?php echo $__env->make('includes.css_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script type="text/javascript">
      var URL_BASE = "<?php echo e(url('/'), false); ?>";
      var url_file_upload = "<?php echo e(route('upload.image', ['_token' => csrf_token()]), false); ?>";
      var delete_confirm = "<?php echo e(__('general.delete_confirm'), false); ?>";
      var yes_confirm = "<?php echo e(__('general.yes_confirm'), false); ?>";
      var yes = "<?php echo e(__('general.yes'), false); ?>";
      var cancel_confirm = "<?php echo e(__('general.cancel_confirm'), false); ?>";
      var timezone = "<?php echo e(config('app.timezone'), false); ?>";
      var please_wait = "<?php echo e(__('general.please_wait'), false); ?>";
      var add_tag = "<?php echo e(__("general.add_tag"), false); ?>";
      var choose_image = '<?php echo e(__('general.choose_image'), false); ?>';
      var formats_available = "<?php echo e(__('general.formats_available_verification_form_w9', ['formats' => 'JPG, PNG, GIF, SVG']), false); ?>";
      var cancel_payment = "<?php echo __('general.confirm_cancel_payment'); ?>";
      var yes_cancel_payment = "<?php echo e(__('general.yes_cancel_payment'), false); ?>";
      var approve_confirm_verification = "<?php echo e(__('admin.approve_confirm_verification'), false); ?>";
      var yes_confirm_approve_verification = "<?php echo e(__('admin.yes_confirm_approve_verification'), false); ?>";
      var yes_confirm_verification = "<?php echo e(__('admin.yes_confirm_verification'), false); ?>";
      var delete_confirm_verification = "<?php echo e(__('admin.delete_confirm_verification'), false); ?>";
      var login_as_user_warning = "<?php echo e(__('general.login_as_user_warning'), false); ?>";
      var yes_confirm_reject_post = "<?php echo e(__('general.yes_confirm_reject_post'), false); ?>";
      var delete_confirm_post = "<?php echo e(__('general.delete_confirm_post'), false); ?>";
      var yes_confirm_approve_post = "<?php echo e(__('general.yes_confirm_approve_post'), false); ?>";
      var approve_confirm_post = "<?php echo e(__('general.approve_confirm_post'), false); ?>";
      var yes_confirm_refund = "<?php echo e(__('general.refund'), false); ?>";
     </script>

    <style>
     :root {
       --color-default: #000000;
    }
     </style>

    <?php echo $__env->yieldContent('css'); ?>
  </head>
  <body>
  <div class="overlay" data-bs-toggle="offcanvas" data-bs-target="#sidebar-nav"></div>
  <div class="popout font-default"></div>

    <main>

      <div class="offcanvas offcanvas-start sidebar bg-dark text-white" tabindex="-1" id="sidebar-nav" data-bs-keyboard="false" data-bs-backdrop="false">
      <div class="offcanvas-header">
          <h5 class="offcanvas-title"><img src="<?php echo e(url('public/img', $settings->logo), false); ?>" width="100" /></h5>
          <button type="button" class="btn-close btn-close-custom text-white toggle-menu d-lg-none" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
      </div>
      <div class="offcanvas-body px-0 scrollbar">
          <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start list-sidebar" id="menu">

              <?php if(auth()->user()->hasPermission('dashboard')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin')): ?> active <?php endif; ?>">
                      <i class="bi-speedometer2 me-2"></i> <?php echo e(__('admin.dashboard'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

              <?php if(auth()->user()->hasPermission('general')): ?>
              <li class="nav-item">
                  <a href="#settings" data-bs-toggle="collapse" class="nav-link text-truncate dropdown-toggle <?php if(request()->is(['panel/admin/settings', 'panel/admin/settings/limits', 'panel/admin/video/encoding'])): ?> active <?php endif; ?>" <?php if(request()->is(['panel/admin/settings', 'panel/admin/settings/limits', 'panel/admin/video/encoding'])): ?> aria-expanded="true" <?php endif; ?>>
                      <i class="bi-gear me-2"></i> <?php echo e(__('admin.general_settings'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

              <div class="collapse w-100 <?php if(request()->is(['panel/admin/settings', 'panel/admin/settings/limits', 'panel/admin/video/encoding'])): ?> show <?php endif; ?> ps-3" id="settings">
                <li>
                <a class="nav-link text-truncate w-100 <?php if(request()->is('panel/admin/settings')): ?> text-white <?php endif; ?>" href="<?php echo e(url('panel/admin/settings'), false); ?>">
                  <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('admin.general'), false); ?>

                  </a>
                </li>
                <li>
                <a class="nav-link text-truncate <?php if(request()->is('panel/admin/settings/limits')): ?> text-white <?php endif; ?>" href="<?php echo e(url('panel/admin/settings/limits'), false); ?>">
                  <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('admin.limits'), false); ?>

                  </a>

                  <a class="nav-link text-truncate <?php if(request()->is('panel/admin/video/encoding')): ?> text-white <?php endif; ?>" href="<?php echo e(url('panel/admin/video/encoding'), false); ?>">
                    <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('general.video_encoding'), false); ?>

                    </a>
                </li>
              </div><!-- /end collapse settings -->

              <?php if(auth()->user()->hasPermission('reports')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/reports'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/reports')): ?> active <?php endif; ?>">
                      <i class="bi-flag me-2"></i> 

                      <?php if($reports <> 0): ?>
                        <span class="badge rounded-pill bg-warning text-dark me-1"><?php echo e($reports, false); ?></span>
                      <?php endif; ?>
                      
                      <?php echo e(__('admin.reports'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('withdrawals')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/withdrawals'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/withdrawals')): ?> active <?php endif; ?>">
                      <i class="bi-bank me-2"></i>

                      <?php if($withdrawalsPendingCount <> 0): ?>
                        <span class="badge rounded-pill bg-warning text-dark me-1"><?php echo e($withdrawalsPendingCount, false); ?></span>
                      <?php endif; ?>

                      <?php echo e(__('general.withdrawals'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>
              
              <?php if(auth()->user()->hasPermission('verification_requests')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/verification/members'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/verification/members')): ?> active <?php endif; ?>">
                      <i class="bi-person-badge me-2"></i>

                      <?php if($verificationRequestsCount <> 0): ?>
                        <span class="badge rounded-pill bg-warning text-dark me-1"><?php echo e($verificationRequestsCount, false); ?></span>
                      <?php endif; ?>

                      <?php echo e(__('admin.verification_requests'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

            <?php if(auth()->user()->hasPermission('deposits')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/deposits'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/deposits')): ?> active <?php endif; ?>">
                      <i class="bi-cash-stack me-2"></i>

                      <?php if($depositsPendingCount <> 0): ?>
                        <span class="badge rounded-pill bg-warning text-dark me-1"><?php echo e($depositsPendingCount, false); ?></span>
                      <?php endif; ?>

                      <?php echo e(__('general.deposits'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('posts')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/posts'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/posts')): ?> active <?php endif; ?>">
                      <i class="bi-pencil-square me-2"></i>

                      <?php if($updatesPendingCount <> 0): ?>
                        <span class="badge rounded-pill bg-warning text-dark me-1"><?php echo e($updatesPendingCount, false); ?></span>
                      <?php endif; ?>

                      <?php echo e(__('general.posts'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('subscriptions')): ?>
            <li class="nav-item">
                <a href="<?php echo e(url('panel/admin/subscriptions'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/subscriptions')): ?> active <?php endif; ?>">
                    <i class="bi-arrow-repeat me-2"></i> <?php echo e(__('admin.subscriptions'), false); ?>

                </a>
            </li><!-- /end list -->
            <?php endif; ?>

              <?php if(auth()->user()->hasPermission('transactions')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/transactions'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/transactions')): ?> active <?php endif; ?>">
                      <i class="bi-receipt me-2"></i> <?php echo e(__('admin.transactions'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('members')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/members'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/members')): ?> active <?php endif; ?>">
                      <i class="bi-people me-2"></i> <?php echo e(__('admin.members'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('advertising')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/advertising'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/advertising')): ?> active <?php endif; ?>">
                      <i class="bi-badge-ad me-2"></i> <?php echo e(__('general.advertising'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('gifts')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/gifts'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/gifts')): ?> active <?php endif; ?>">
                      <i class="bi-gift me-2"></i> <?php echo e(__('general.gifts'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('comments_replies')): ?>
              <li class="nav-item">
                  <a href="#comments_replies" data-bs-toggle="collapse" class="nav-link text-truncate dropdown-toggle <?php if(request()->is(['panel/admin/comments', 'panel/admin/replies'])): ?> active <?php endif; ?>" <?php if(request()->is(['panel/admin/comments', 'panel/admin/replies'])): ?> aria-expanded="true" <?php endif; ?>>
                      <i class="bi-chat me-2"></i> <?php echo e(__('general.comments_replies'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

              <div class="collapse w-100 <?php if(request()->is(['panel/admin/comments', 'panel/admin/replies'])): ?> show <?php endif; ?> ps-3" id="comments_replies">
                <li>
                <a class="nav-link text-truncate w-100 <?php if(request()->is('panel/admin/comments')): ?> text-white <?php endif; ?>" href="<?php echo e(url('panel/admin/comments'), false); ?>">
                  <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('general.comments'), false); ?>

                  </a>
                </li>
                <li>
                <a class="nav-link text-truncate <?php if(request()->is('panel/admin/replies')): ?> text-white <?php endif; ?>" href="<?php echo e(url('panel/admin/replies'), false); ?>">
                  <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('general.replies'), false); ?>

                  </a>
                </li>
              </div><!-- /end collapse settings -->


              <?php if(auth()->user()->hasPermission('messages')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/messages'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/messages')): ?> active <?php endif; ?>">
                      <i class="bi-send me-2"></i> <?php echo e(__('general.messages'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('announcements')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/announcements'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/announcements')): ?> active <?php endif; ?>">
                      <i class="bi-megaphone me-2"></i> <?php echo e(__('general.announcements'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

              <?php if(auth()->user()->hasPermission('maintenance')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/maintenance/mode'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/maintenance/mode')): ?> active <?php endif; ?>">
                      <i class="bi bi-tools me-2"></i> <?php echo e(__('admin.maintenance_mode'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

            <?php if(auth()->user()->hasPermission('billing')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/billing'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/billing')): ?> active <?php endif; ?>">
                      <i class="bi-receipt-cutoff me-2"></i> <?php echo e(__('general.billing_information'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

                <?php if(auth()->user()->hasPermission('tax')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/tax-rates'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/tax-rates')): ?> active <?php endif; ?>">
                      <i class="bi-receipt me-2"></i> <?php echo e(__('general.tax_rates'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

            <?php if(auth()->user()->hasPermission('countries_states')): ?>
              <li class="nav-item">
                  <a href="#countriesStates" data-bs-toggle="collapse"  class="nav-link text-truncate dropdown-toggle <?php if(request()->is('panel/admin/countries') || request()->is('panel/admin/states')): ?> active <?php endif; ?>" <?php if(request()->is('panel/admin/countries') || request()->is('panel/admin/states')): ?> aria-expanded="true" <?php endif; ?>>
                      <i class="bi-globe me-2"></i> <?php echo e(__('general.countries_states'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <div class="collapse w-100 <?php if(request()->is('panel/admin/countries') || request()->is('panel/admin/states')): ?> show <?php endif; ?> ps-3" id="countriesStates">
                <li class="nav-item">
                    <a href="<?php echo e(url('panel/admin/countries'), false); ?>" class="nav-link text-truncate w-100 <?php if(request()->is('panel/admin/countries')): ?> text-white <?php endif; ?>">
                        <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('general.countries'), false); ?>

                    </a>
                </li><!-- /end list -->
                <li class="nav-item">
                    <a href="<?php echo e(url('panel/admin/states'), false); ?>" class="nav-link text-truncate w-100 <?php if(request()->is('panel/admin/states')): ?> text-white <?php endif; ?>">
                        <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('general.states'), false); ?>

                    </a>
                </li><!-- /end list -->
              </div><!-- /end collapse settings -->

              <?php if(auth()->user()->hasPermission('email')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/settings/email'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/settings/email')): ?> active <?php endif; ?>">
                      <i class="bi-at me-2"></i> <?php echo e(__('admin.email_settings'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('live_streaming')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/live-streaming'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/live-streaming')): ?> active <?php endif; ?>">
                      <i class="bi-camera-video me-2"></i> <?php echo e(__('general.live_streaming'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('live_streaming_private_requests')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/live-streaming-private-requests'), false); ?>" title="<?php echo e(__('general.live_streaming_private_requests'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/live-streaming-private-requests')): ?> active <?php endif; ?>">
                      <i class="bi-person-video3 me-2"></i> <?php echo e(__('general.live_streaming_private_requests'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('push_notifications')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/push-notifications'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/push-notifications')): ?> active <?php endif; ?>">
                      <i class="bi-app-indicator me-2"></i> <?php echo e(__('general.push_notifications'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('stories')): ?>
              <li class="nav-item">
                  <a href="#stories" data-bs-toggle="collapse" class="nav-link text-truncate dropdown-toggle <?php if(request()->is('panel/admin/stories/settings') || request()->is('panel/admin/stories/posts') || request()->is('panel/admin/stories/backgrounds')): ?> active <?php endif; ?>" <?php if(request()->is('panel/admin/stories/settings') || request()->is('panel/admin/stories/posts') || request()->is('panel/admin/stories/backgrounds') || request()->is('panel/admin/stories/fonts')): ?> aria-expanded="true" <?php endif; ?>>
                      <i class="bi-clock-history me-2"></i> <?php echo e(__('general.stories'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <div class="collapse w-100 <?php if(request()->is('panel/admin/stories/settings') || request()->is('panel/admin/stories/posts') || request()->is('panel/admin/stories/backgrounds') || request()->is('panel/admin/stories/fonts')): ?> show <?php endif; ?> ps-3" id="stories">
                <li class="nav-item">
                    <a href="<?php echo e(url('panel/admin/stories/settings'), false); ?>" class="nav-link text-truncate w-100 <?php if(request()->is('panel/admin/stories/settings')): ?> text-white <?php endif; ?>">
                        <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('general.settings'), false); ?>

                    </a>
                </li><!-- /end list -->
                <li class="nav-item">
                    <a href="<?php echo e(url('panel/admin/stories/posts'), false); ?>" class="nav-link text-truncate w-100 <?php if(request()->is('panel/admin/stories/posts')): ?> text-white <?php endif; ?>">
                        <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('general.posts'), false); ?>

                    </a>
                </li><!-- /end list -->
                <li class="nav-item">
                    <a href="<?php echo e(url('panel/admin/stories/backgrounds'), false); ?>" class="nav-link text-truncate w-100 <?php if(request()->is('panel/admin/stories/backgrounds')): ?> text-white <?php endif; ?>">
                        <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('general.backgrounds'), false); ?>

                    </a>
                </li><!-- /end list -->
                <li class="nav-item">
                    <a href="<?php echo e(url('panel/admin/stories/fonts'), false); ?>" class="nav-link text-truncate w-100 <?php if(request()->is('panel/admin/stories/fonts')): ?> text-white <?php endif; ?>">
                        <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('general.google_fonts'), false); ?>

                    </a>
                </li><!-- /end list -->
              </div><!-- /end collapse settings -->

              <?php if(auth()->user()->hasPermission('shop')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/shop'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/shop')): ?> active <?php endif; ?>">
                      <i class="bi-shop-window me-2"></i> <?php echo e(__('general.shop'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('products')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/products'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/products')): ?> active <?php endif; ?>">
                      <i class="bi-tag me-2"></i> <?php echo e(__('general.products'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('shop_categories')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/shop-categories'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/shop-categories')): ?> active <?php endif; ?>">
                      <i class="bi-list-ul me-2"></i> <?php echo e(__('general.shop_categories'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('sales')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/sales'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/sales')): ?> active <?php endif; ?>">
                      <i class="bi-cart me-2"></i> <?php echo e(__('general.sales'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('storage')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/storage'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/storage')): ?> active <?php endif; ?>">
                      <i class="bi-server me-2"></i> <?php echo e(__('admin.storage'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('theme')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/theme'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/theme')): ?> active <?php endif; ?>">
                      <i class="bi-brush me-2"></i> <?php echo e(__('admin.theme'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('custom_css_js')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/custom-css-js'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/custom-css-js')): ?> active <?php endif; ?>">
                      <i class="bi-code-slash me-2"></i> <?php echo e(__('general.custom_css_js'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('referrals')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/referrals'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/referrals')): ?> active <?php endif; ?>">
                      <i class="bi-person-plus me-2"></i> <?php echo e(__('general.referrals'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('languages')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/languages'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/languages')): ?> active <?php endif; ?>">
                      <i class="bi-translate me-2"></i> <?php echo e(__('admin.languages'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('categories')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/categories'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/categories')): ?> active <?php endif; ?>">
                      <i class="bi-list-stars me-2"></i> <?php echo e(__('admin.categories'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('pages')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/pages'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/pages')): ?> active <?php endif; ?>">
                      <i class="bi-file-earmark-text me-2"></i> <?php echo e(__('admin.pages'), false); ?>

                  </a>
              </li><!-- /end list -->
                <?php endif; ?>

                <?php if(auth()->user()->hasPermission('blog')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(url('panel/admin/blog'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/blog')): ?> active <?php endif; ?>">
                        <i class="bi-pencil me-2"></i> <?php echo e(__('general.blog'), false); ?>

                    </a>
                </li><!-- /end list -->
                  <?php endif; ?>

                <?php if(auth()->user()->hasPermission('payments')): ?>
              <li class="nav-item">
                  <a href="#payments" data-bs-toggle="collapse" class="nav-link text-truncate dropdown-toggle <?php if(request()->is('panel/admin/payments') || request()->is('panel/admin/payments/*')): ?> active <?php endif; ?>" <?php if(request()->is('panel/admin/payments') || request()->is('panel/admin/payments/*')): ?> aria-expanded="true" <?php endif; ?>>
                      <i class="bi-credit-card me-2"></i> <?php echo e(__('admin.payment_settings'), false); ?>

                  </a>
              </li><!-- /end list -->

              <div class="collapse w-100 ps-3 <?php if(request()->is('panel/admin/payments') || request()->is('panel/admin/payments/*')): ?> show <?php endif; ?>" id="payments">
                <li>
                <a class="nav-link text-truncate <?php if(request()->is('panel/admin/payments')): ?> text-white <?php endif; ?>" href="<?php echo e(url('panel/admin/payments'), false); ?>">
                  <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(__('admin.general'), false); ?>

                  </a>
                </li>

                <?php $__currentLoopData = $paymentsGateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                <a class="nav-link text-truncate <?php if(request()->is('panel/admin/payments/'.$key->id.'')): ?> text-white <?php endif; ?>" href="<?php echo e(url('panel/admin/payments', $key->id), false); ?>">
                  <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e($key->type == 'bank' ? __('general.bank_transfer') : $key->name, false); ?>

                  </a>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div><!-- /end collapse settings -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('profiles_social')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/profiles-social'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/profiles-social')): ?> active <?php endif; ?>">
                      <i class="bi-share me-2"></i> <?php echo e(__('admin.profiles_social'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('social_login')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/social-login'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/social-login')): ?> active <?php endif; ?>">
                      <i class="bi-facebook me-2"></i> <?php echo e(__('admin.social_login'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('google')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/google'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/google')): ?> active <?php endif; ?>">
                      <i class="bi-google me-2"></i> Google
                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('pwa')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/pwa'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/pwa')): ?> active <?php endif; ?>">
                      <i class="bi-phone me-2"></i> PWA
                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

          </ul>
      </div>
  </div>

  <header class="py-3 mb-3 shadow-custom">

    <div class="container-fluid d-grid gap-3 px-4 justify-content-end position-relative">

      <div class="d-flex align-items-center">

        <a class="text-dark ms-2 animate-up-2 me-4" href="<?php echo e(url('/'), false); ?>">
        <?php echo e(__('admin.view_site'), false); ?> <i class="bi-arrow-up-right"></i>
        </a>

        <div class="flex-shrink-0 dropdown">
          <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
           <img src="<?php echo e(Helper::getFile(config('path.avatar').auth()->user()->avatar), false); ?>" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-macos arrow-dm" aria-labelledby="dropdownUser2">
            <a class="dropdown-item" href="<?php echo e(url(auth()->user()->username), false); ?>">
              <i class="bi-person me-2"></i> <?php echo e(__('users.my_profile'), false); ?>

              </a>

              <a class="dropdown-item" href="<?php echo e(url('settings/page'), false); ?>">
                <i class="bi-pencil me-2"></i> <?php echo e(__('general.edit_my_page'), false); ?>

                </a>

                <hr class="dropdown-divider"></hr>

                <a class="dropdown-item" href="<?php echo e(url('logout'), false); ?>">
                  <i class="bi-box-arrow-in-right me-2"></i> <?php echo e(__('users.logout'), false); ?>

                  </a>
          </ul>
        </div>

        <a class="ms-4 toggle-menu d-block d-lg-none text-dark fs-3 position-absolute start-0" data-bs-toggle="offcanvas" data-bs-target="#sidebar-nav" href="#">
            <i class="bi-list"></i>
            </a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
      <div class="row">
          <div class="col min-vh-100 admin-container p-4">
              <?php echo $__env->yieldContent('content'); ?>
          </div>
      </div>
  </div>

  <footer class="admin-footer px-4 py-3 shadow-custom">
    &copy; <?php echo e($settings->title, false); ?> v<?php echo e($settings->version, false); ?> - <?php echo e(date('Y'), false); ?>

  </footer>

</main>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo e(asset('public/js/core.min.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
    <script src="<?php echo e(asset('public/admin/bootstrap.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('public/js/ckeditor/ckeditor.js'), false); ?>"></script>
    <script src="<?php echo e(asset('public/js/select2/select2.full.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('public/admin/admin-functions.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>

    <?php echo $__env->yieldContent('javascript'); ?>

    <?php if(session('success_update')): ?>
      <script type="text/javascript">
          swal({
            title: "<?php echo e(session('success_update'), false); ?>",
            type: "success",
            confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
            });
        </script>
    	 <?php endif; ?>

		 <?php if(session('unauthorized')): ?>
       <script type="text/javascript">
    		swal({
    			title: "<?php echo e(__('general.error_oops'), false); ?>",
    			text: "<?php echo e(session('unauthorized'), false); ?>",
    			type: "error",
    			confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
    			});
          </script>
   		 <?php endif; ?>
     </body>
</html>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/admin/layout.blade.php ENDPATH**/ ?>