<?php $__env->startSection('title'); ?><?php echo e($user->hide_name == 'yes' ? $mediaTitle.$user->username : $mediaTitle.$user->name, false); ?> -<?php $__env->stopSection(); ?>
  <?php $__env->startSection('description_custom'); ?><?php echo e($mediaTitle.$user->username, false); ?> - <?php echo e(strip_tags($user->story), false); ?><?php $__env->stopSection(); ?>

  <?php $__env->startSection('css'); ?>

  <meta property="og:type" content="website" />
  <meta property="og:image:width" content="200"/>
  <meta property="og:image:height" content="200"/>

  <!-- Current locale and alternate locales -->
  <meta property="og:locale" content="en_US" />
  <meta property="og:locale:alternate" content="es_ES" />

  <!-- Og Meta Tags -->
  <link rel="canonical" href="<?php echo e(url($user->username.$media), false); ?>"/>
  <meta property="og:site_name" content="<?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?> - <?php echo e($settings->title, false); ?>"/>
  <meta property="og:url" content="<?php echo e(url($user->username.$media), false); ?>"/>
  <meta property="og:image" content="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>"/>

  <meta property="og:title" content="<?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?> - <?php echo e($settings->title, false); ?>"/>
  <meta property="og:description" content="<?php echo e(strip_tags($user->story), false); ?>"/>
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:image" content="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" />
  <meta name="twitter:title" content="<?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?>" />
  <meta name="twitter:description" content="<?php echo e(strip_tags($user->story), false); ?>"/>

  <script type="text/javascript">
      var profile_id = <?php echo e($user->id, false); ?>;
      var sort_post_by_type_media = "<?php echo $sortPostByTypeMedia; ?>";
  </script>
  <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="jumbotron jumbotron-cover-user home m-0 position-relative" style="padding: <?php if($user->cover != ''): ?> <?php if(request()->path() == $user->username): ?> 240px <?php else: ?> 125px <?php endif; ?> <?php else: ?> 125px <?php endif; ?> 0; background: #505050 <?php if($user->cover != ''): ?> url('<?php echo e(Helper::getFile(config('path.cover').$user->cover), false); ?>') no-repeat center center; background-size: cover; <?php endif; ?>">
  <?php if(auth()->check() && auth()->user()->status == 'active' && auth()->id() == $user->id): ?>
    <div class="progress-upload-cover"></div>

    <form action="<?php echo e(url('upload/cover'), false); ?>" method="POST" id="formCover" accept-charset="UTF-8" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
    <input type="file" name="image" id="uploadCover" accept="image/*" class="visibility-hidden">
  </form>

  <div class="flex justify-between wraper-cover-upload">
    <button class="btn btn-cover-upload p-lg-6 px-3" id="coverFile" onclick="$('#uploadCover').trigger('click');">
      <i class="fa fa-camera mr-lg-1"></i>  <span class="d-none d-lg-inline"><?php echo e(__('general.change_cover'), false); ?></span>
    </button>
  
    <button class="btn btn-cover-upload px-3 deleteCover">
      <i class="bi-trash3-fill"></i> 
    </button>
  </div>
<?php endif; ?>
</div>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="w-100 text-center py-4 img-profile-user">

          <div <?php if(Helper::isCreatorLive($getCurrentLiveCreators, $user->id) && auth()->check() && auth()->id() != $user->id): ?> data-url="<?php echo e(url('live', $user->username), false); ?>" <?php endif; ?> class="text-center position-relative <?php if(Helper::isCreatorLive($getCurrentLiveCreators, $user->id) && auth()->check() && auth()->id() != $user->id): ?> avatar-wrap-live liveLink <?php else: ?> avatar-wrap <?php endif; ?> shadow <?php if(auth()->check() && auth()->id() != $user->id && Cache::has('is-online-' . $user->id) && $user->active_status_online == 'yes' || auth()->guest() && Cache::has('is-online-' . $user->id) && $user->active_status_online == 'yes'): ?> user-online-profile overflow-visible <?php elseif(auth()->check() && auth()->id() != $user->id && !Cache::has('is-online-' . $user->id) && $user->active_status_online == 'yes' || auth()->guest() && !Cache::has('is-online-' . $user->id) && $user->active_status_online == 'yes'): ?> user-offline-profile overflow-visible <?php endif; ?>">

            <?php if(auth()->check() && auth()->id() != $user->id && Helper::isCreatorLive($getCurrentLiveCreators, $user->id)): ?>
              <span class="live-span"><?php echo e(__('general.live'), false); ?></span>
              <div class="live-pulse"></div>
            <?php endif; ?>


            <div class="progress-upload">0%</div>

            <?php if(auth()->check() && auth()->user()->status == 'active' && auth()->id() == $user->id): ?>

              <form action="<?php echo e(url('upload/avatar'), false); ?>" method="POST" id="formAvatar" accept-charset="UTF-8" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
              <input type="file" name="avatar" id="uploadAvatar" accept="image/*" class="visibility-hidden">
            </form>

            <a href="javascript:;" class="position-absolute button-avatar-upload" id="avatar_file">
              <i class="fa fa-camera"></i>
            </a>
          <?php endif; ?>
            <img src="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" width="150" height="150" alt="<?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?>" class="rounded-circle img-user mb-2 avatarUser <?php if(auth()->check() && auth()->id() != $user->id && Helper::isCreatorLive($getCurrentLiveCreators, $user->id)): ?> border-0 <?php endif; ?>">
          </div><!-- avatar-wrap -->

          <div class="media-body">
            <h4 class="mt-1">
              <?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?>


              <?php if($user->verified_id == 'yes'): ?>
              <small class="verified" title="<?php echo e(__('general.verified_account'), false); ?>" data-toggle="tooltip" data-placement="top">
                <i class="bi-patch-check-fill"></i>
              </small>
            <?php endif; ?>

            <?php if($user->featured == 'yes'): ?>
              <small class="text-featured" title="<?php echo e(__('users.creator_featured'), false); ?>" data-toggle="tooltip" data-placement="top">
              <i class="fas fa fa-award"></i>
            </small>
          <?php endif; ?>
          </h4>

            <p>
            <span>
              <?php if(! Cache::has('is-online-' . $user->id) && $user->hide_last_seen == 'no'): ?>
              <span class="w-100 d-block">
                <small><?php echo e(__('general.active'), false); ?></small>
                <small class="timeAgo"data="<?php echo e(date('c', strtotime($user->last_seen ?? $user->date)), false); ?>"></small>
               </span>
               <?php endif; ?>

              <?php if($user->profession != '' && $user->verified_id == 'yes'): ?>
                <?php echo e($user->profession, false); ?>

              <?php endif; ?>
          </span>
            </p>

            <div class="btn-container">
            <?php if(auth()->check() && auth()->id() == $user->id): ?>
              <a href="<?php echo e(url('settings/page'), false); ?>" class="btn btn-primary btn-profile mr-1"><i class="fa fa-pencil-alt mr-2"></i> <?php echo e(auth()->user()->verified_id == 'yes' ? __('general.edit_my_page') : __('users.edit_profile'), false); ?></a>
            <?php endif; ?>

              <?php if($userPlanMonthlyActive
                  && $user->verified_id == 'yes'
                  || $user->free_subscription == 'yes'
                  && $user->verified_id == 'yes'): ?>

              <?php if(auth()->check() && auth()->id() != $user->id
                  && ! $checkSubscription
                  && ! $paymentIncomplete
                  && $user->free_subscription == 'no'
                  && $totalPosts != 0
                  ): ?>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#subscriptionForm" class="btn btn-primary btn-profile mr-1 btn-block mb-2">
                  <i class="feather icon-unlock mr-1"></i> <?php echo e(__('general.subscribe_month', ['price' => Helper::formatPrice($user->getPlan('monthly', 'price'))]), false); ?>

                </a>
              <?php elseif(auth()->check() && auth()->id() != $user->id && ! $checkSubscription && $paymentIncomplete): ?>
                <a href="<?php echo e(route('cashier.payment', $paymentIncomplete->last_payment), false); ?>" class="btn btn-warning btn-profile mr-1">
                  <i class="fa fa-exclamation-triangle"></i> <?php echo e(__('general.confirm_payment'), false); ?>

                </a>
              <?php elseif(auth()->check() && auth()->id() != $user->id && $checkSubscription): ?>

                <?php if($checkSubscription->stripe_status == 'active' && $checkSubscription->stripe_id != ''): ?>
                <?php echo Form::open([
                  'method' => 'POST',
                  'url' => "subscription/cancel/$checkSubscription->stripe_id",
                  'class' => 'd-inline formCancel'
                ]); ?>


                <?php echo Form::button('<i class="feather icon-user-check mr-1"></i> '.__('general.your_subscribed'), ['data-expiration' => __('general.subscription_expire').' '.Helper::formatDate(auth()->user()->subscription('main', $checkSubscription->stripe_price)->asStripeSubscription()->current_period_end, true), 'class' => 'btn btn-success btn-profile mr-1 cancelBtn subscriptionActive']); ?>

                <?php echo Form::close(); ?>


              <?php elseif($checkSubscription->stripe_id == '' && $checkSubscription->free == 'yes'): ?>
                <?php echo Form::open([
                  'method' => 'POST',
                  'url' => "subscription/free/cancel/$checkSubscription->id",
                  'class' => 'd-inline formCancel'
                ]); ?>


                <?php echo Form::button('<i class="feather icon-user-check mr-1"></i> '.__('general.your_subscribed'), ['data-expiration' => __('general.confirm_cancel_subscription'), 'class' => 'btn btn-success btn-profile mr-1 cancelBtn subscriptionActive']); ?>

                <?php echo Form::close(); ?>


              <?php elseif($paymentGatewaySubscription == 'Paystack' && $checkSubscription->cancelled == 'no'): ?>
                <?php echo Form::open([
                  'method' => 'POST',
                  'url' => "subscription/paystack/cancel/$checkSubscription->subscription_id",
                  'class' => 'd-inline formCancel'
                ]); ?>


                <?php echo Form::button('<i class="feather icon-user-check mr-1"></i> '.__('general.your_subscribed'), ['data-expiration' => __('general.subscription_expire').' '.Helper::formatDate($checkSubscription->ends_at), 'class' => 'btn btn-success btn-profile mr-1 cancelBtn subscriptionActive']); ?>

                <?php echo Form::close(); ?>


              <?php elseif($paymentGatewaySubscription == 'Wallet' && $checkSubscription->cancelled == 'no'): ?>
                <?php echo Form::open([
                  'method' => 'POST',
                  'url' => "subscription/wallet/cancel/$checkSubscription->id",
                  'class' => 'd-inline formCancel'
                ]); ?>


                <?php echo Form::button('<i class="feather icon-user-check mr-1"></i> '.__('general.your_subscribed'), ['data-expiration' => __('general.subscription_expire').' '.Helper::formatDate($checkSubscription->ends_at), 'class' => 'btn btn-success btn-profile mr-1 cancelBtn subscriptionActive']); ?>

                <?php echo Form::close(); ?>


              <?php elseif($paymentGatewaySubscription == 'PayPal' && $checkSubscription->cancelled == 'no'): ?>
                <?php echo Form::open([
                  'method' => 'POST',
                  'url' => "subscription/paypal/cancel/$checkSubscription->id",
                  'class' => 'd-inline formCancel'
                ]); ?>


                <?php echo Form::button('<i class="feather icon-user-check mr-1"></i> '.__('general.your_subscribed'), ['data-expiration' => __('general.subscription_expire').' '.Helper::formatDate($checkSubscription->ends_at), 'class' => 'btn btn-success btn-profile mr-1 cancelBtn subscriptionActive']); ?>

                <?php echo Form::close(); ?>


              <?php elseif($paymentGatewaySubscription == 'CCBill' && $checkSubscription->cancelled == 'no'): ?>
                <?php echo Form::open([
                  'method' => 'POST',
                  'url' => "subscription/ccbill/cancel/$checkSubscription->id",
                  'class' => 'd-inline formCancel'
                ]); ?>


                <?php echo Form::button('<i class="feather icon-user-check mr-1"></i> '.__('general.your_subscribed'), ['data-expiration' => __('general.subscription_expire').' '.Helper::formatDate($checkSubscription->ends_at), 'class' => 'btn btn-success btn-profile mr-1 cancelBtn subscriptionActive']); ?>

                <?php echo Form::close(); ?>


              <?php elseif($checkSubscription->cancelled == 'yes' || $checkSubscription->stripe_status == 'canceled'): ?>
                <a href="javascript:void(0);" class="btn btn-success btn-profile mr-1 disabled">
                  <i class="feather icon-user-check mr-1"></i> <?php echo e(__('general.subscribed_until'), false); ?> <?php echo e(Helper::formatDate($checkSubscription->ends_at), false); ?>

                </a>
              <?php endif; ?>

              <?php elseif(auth()->check() && auth()->id() != $user->id && $user->free_subscription == 'yes' && $totalPosts != 0): ?>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#subscriptionFreeForm" class="btn btn-primary btn-profile mr-1">
                  <i class="feather icon-user-plus mr-1"></i> <?php echo e(__('general.subscribe_for_free'), false); ?>

                </a>
              <?php elseif(auth()->guest() && $totalPosts != 0): ?>
                <a href="<?php echo e(url('login'), false); ?>" data-toggle="modal" data-target="#loginFormModal" class="toggleRegister btn btn-primary btn-profile mr-1">
                  <?php if($user->free_subscription == 'yes'): ?>
                    <i class="feather icon-user-plus mr-1"></i> <?php echo e(__('general.subscribe_for_free'), false); ?>

                  <?php else: ?>
                  <i class="feather icon-unlock mr-1"></i> <?php echo e(__('general.subscribe_month', ['price' => Helper::formatPrice($user->getPlan('monthly', 'price'))]), false); ?>

                <?php endif; ?>
                </a>
            <?php endif; ?>

            <?php endif; ?>
            
          <style>
            .btn-container .btn-block {
                width: 100%;
            }

            .btn-container .btn-group {
                display: flex !important;
                flex-wrap: wrap !important;
                justify-content: space-between;
                align-items: center;
            }

            .btn-container .btn-group .btn {
                flex: 1 !important;
                margin: 0 5px;
                max-width: 180px;
            }

            @media (max-width: 768px) {
                .btn-container .btn-group .btn {
                    max-width: 100%;
                    margin-bottom: 10px;
                    padding: .3125rem .625rem;
                }

                .btn-container .btn-group {
                  flex-direction: row;
                }
                
                .btn-container .btn-group a, .btn-container .btn-group button {
                    font-size: 0.65em !important;
                    height: 50px;
                }

                .btn-container .btn-group i {
                    font-size: 1.65em !important;
                }
            }
          </style>

            <!-- (presentes, mimos, mensagem, compartilhar) -->
              <div class="btn-group">
                <?php if(auth()->check() && auth()->id() != $user->id && $totalPosts <> 0 && $settings->disable_tips == 'off' && $user->verified_id == 'yes'): ?>
                  <a href="javascript:void(0);" data-toggle="modal" title="<?php echo e(__('general.tip'), false); ?>" data-target="#tipForm" class="btn btn-google btn-profile mr-1" data-cover="<?php echo e(Helper::getFile(config('path.cover').$user->cover), false); ?>" data-avatar="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" data-name="<?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?>" data-userid="<?php echo e($user->id, false); ?>">
                    <i class="bi-coin d-block"></i> <?php echo e(__('general.tip'), false); ?>

                  </a>
                <?php elseif(auth()->guest() && $totalPosts <> 0): ?>
                  <a href="<?php echo e(url('login'), false); ?>" data-toggle="modal" data-target="#loginFormModal" class="toggleRegister btn btn-google btn-profile mr-1" title="<?php echo e(__('general.tip'), false); ?>">
                    <i class="bi-coin d-block"></i> <?php echo e(__('general.tip'), false); ?>

                  </a>
                <?php endif; ?>
            
                <?php if(auth()->check() && auth()->id() != $user->id && $totalPosts <> 0 && $settings->gifts && $user->verified_id == 'yes'): ?>
                  <a href="javascript:void(0);" data-toggle="modal" title="<?php echo e(__('general.gifts'), false); ?>" data-target="#giftsForm" class="btn btn-google btn-profile mr-1">
                    <i class="bi-gift d-block"></i> <?php echo e(__('general.gifts'), false); ?>

                  </a>
                <?php elseif(auth()->guest() && $totalPosts <> 0): ?>
                  <a href="javascript:void(0);" data-toggle="modal" title="<?php echo e(__('general.gifts'), false); ?>" data-target="#loginFormModal" class="toggleRegister btn btn-google btn-profile mr-1">
                    <i class="bi-gift d-block"></i> <?php echo e(__('general.gifts'), false); ?>

                  </a>
                <?php endif; ?>
            
                <?php if(auth()->guest() && $user->verified_id == 'yes' || auth()->check() && auth()->id() != $user->id && $user->verified_id == 'yes'): ?>
                  <button <?php if(auth()->guard()->guest()): ?> data-toggle="modal" data-target="#loginFormModal" <?php else: ?> id="sendMessageUser" <?php endif; ?> data-url="<?php echo e(url('messages/'.$user->id, $user->username), false); ?>" title="<?php echo e(__('general.message'), false); ?>" class="toggleRegister btn btn-google btn-profile mr-1">
                    <i class="feather icon-send mr-1 mr-lg-0 d-block"></i> <span class=""><?php echo e(__('general.message'), false); ?></span>
                  </button>
                <?php endif; ?>
            
                <?php if($user->verified_id == 'yes'): ?>
                  <button class="btn btn-profile btn-google" title="<?php echo e(__('general.share'), false); ?>" id="dropdownUserShare" role="button" data-toggle="modal" data-target=".share-modal">
                    <i class="feather icon-share mr-1 mr-lg-0 d-block"></i> <span class=""><?php echo e(__('general.share'), false); ?></span>
                  </button>
                <?php endif; ?>
              </div>

            <?php if($user->verified_id == 'yes'): ?>
            <!-- Share modal -->
          <div class="modal fade share-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
          		<div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <button type="button" class="close close-inherit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="bi-x-lg"></i></span>
                  </button>
                </div>
                <div class="modal-body">

                  <?php if($settings->generate_qr_code): ?>
                  <div class="d-block w-100 text-center mb-5">
                    <div id="QrCode" class="d-block w-100 text-center mb-3"></div>

                    <div class="d-block w-100 text-center">
                      <a class="btn btn-primary" id="downloadQr" href="javascript:;">
                      <i class="bi-download mr-1"></i>  <?php echo e(__('general.download'), false); ?>

                      </a>
                    </div>
                  </div>
                <?php endif; ?>
                
          				<div class="container-fluid">
          					<div class="row">
          						<div class="col-md-4 col-6 mb-3">
          							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url($user->username).Helper::referralLink(), false); ?>" title="Facebook" target="_blank" class="social-share text-muted d-block text-center h6">
          								<i class="fab fa-facebook-square facebook-btn"></i>
          								<span class="btn-block mt-3">Facebook</span>
          							</a>
          						</div>
          						<div class="col-md-4 col-6 mb-3">
          							<a href="https://twitter.com/intent/tweet?url=<?php echo e(url($user->username).Helper::referralLink(), false); ?>&text=<?php echo e(e( $user->hide_name == 'yes' ? $user->username : $user->name ), false); ?>" data-url="<?php echo e(url($user->username), false); ?>" class="social-share text-muted d-block text-center h6" target="_blank" title="Twitter">
          								<i class="bi-twitter-x text-dark"></i> <span class="btn-block mt-3">Twitter</span>
          							</a>
          						</div>
          						<div class="col-md-4 col-6 mb-3">
          							<a href="whatsapp://send?text=<?php echo e(url($user->username).Helper::referralLink(), false); ?>" data-action="share/whatsapp/share" class="social-share text-muted d-block text-center h6" title="WhatsApp">
          								<i class="fab fa-whatsapp btn-whatsapp"></i> <span class="btn-block mt-3">WhatsApp</span>
          							</a>
          						</div>

          						<div class="col-md-4 col-6 mb-3">
          							<a href="mailto:?subject=<?php echo e(e( $user->hide_name == 'yes' ? $user->username : $user->name ), false); ?>&amp;body=<?php echo e(url($user->username).Helper::referralLink(), false); ?>" class="social-share text-muted d-block text-center h6" title="<?php echo e(__('auth.email'), false); ?>">
          								<i class="far fa-envelope"></i> <span class="btn-block mt-3"><?php echo e(__('auth.email'), false); ?></span>
          							</a>
          						</div>
          						<div class="col-md-4 col-6 mb-3">
          							<a href="sms:?&body=<?php echo e(__('general.check_this'), false); ?> <?php echo e(url($user->username).Helper::referralLink(), false); ?>" class="social-share text-muted d-block text-center h6" title="<?php echo e(__('general.sms'), false); ?>">
          								<i class="fa fa-sms"></i> <span class="btn-block mt-3"><?php echo e(__('general.sms'), false); ?></span>
          							</a>
          						</div>
          						<div class="col-md-4 col-6 mb-3">
          							<a href="javascript:void(0);" id="btn_copy_url" class="social-share text-muted d-block text-center h6 link-share" title="<?php echo e(__('general.copy_link'), false); ?>">
          							<i class="fas fa-link"></i> <span class="btn-block mt-3"><?php echo e(__('general.copy_link'), false); ?></span>
          						</a>
                      <input type="hidden" readonly="readonly" id="copy_link" class="form-control" value="<?php echo e(url($user->username).Helper::referralLink(), false); ?>">
          					</div>
          					</div>

          				</div>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>

          </div><!-- d-flex-user -->

            <?php if(auth()->check() && auth()->id() != $user->id): ?>
            <div class="text-center">
              <button type="button" class="btn e-none btn-link text-danger p-0 mr-2" data-toggle="modal" data-target="#reportCreator">
                <small><i class="fas fa-flag mr-1"></i> <?php echo e(__('general.report_user'), false); ?></small>
              </button>

              <?php if(auth()->user()->isRestricted($user->id)): ?>
                <button type="button" class="btn e-none btn-link text-danger removeRestriction p-0" data-user="<?php echo e($user->id, false); ?>" id="restrictUser">
                  <small><i class="fas fa-ban mr-1"></i> <?php echo e(__('general.remove_restriction'), false); ?></small>
                </button>

              <?php else: ?>
                <button type="button" class="btn e-none btn-link text-danger p-0" data-user="<?php echo e($user->id, false); ?>" id="restrictUser">
                  <small><i class="fas fa-ban mr-1"></i> <?php echo e(__('general.restrict'), false); ?></small>
                </button>
              <?php endif; ?>

            </div>
          <?php endif; ?>

          </div><!-- media-body -->
        </div><!-- media -->

        <?php if($user->verified_id == 'yes'): ?>
        <ul class="nav nav-profile justify-content-center nav-fill">

          <li class="nav-link <?php if(request()->path() == $user->username): ?>active <?php endif; ?> navbar-user-mobile">
            <small class="btn-block sm-btn-size"><?php echo e($totalPosts, false); ?></small>
              <a href="<?php echo e(request()->path() == $user->username ? 'javascript:;' : url($user->username), false); ?>" title="<?php echo e(__('general.posts'), false); ?>"><i class="feather icon-file-text"></i> <span class="d-lg-inline-block d-none"><?php echo e(__('general.posts'), false); ?></span></a>
            </li>

            <li class="nav-link <?php if(request()->path() == $user->username.'/photos'): ?>active <?php endif; ?> navbar-user-mobile">
              <small class="btn-block sm-btn-size"><?php echo e($totalPhotos, false); ?></small>
              <a href="<?php echo e(request()->path() == $user->username.'/photos' ? 'javascript:;' : url($user->username, 'photos'), false); ?>" title="<?php echo e(__('general.photos'), false); ?>"><i class="feather icon-image"></i> <span class="d-lg-inline-block d-none"><?php echo e(__('general.photos'), false); ?></span></a>
            </li>

            <li class="nav-link <?php if(request()->path() == $user->username.'/videos'): ?>active <?php endif; ?> navbar-user-mobile">
              <small class="btn-block sm-btn-size"><?php echo e($totalVideos, false); ?></small>
              <a href="<?php echo e(request()->path() == $user->username.'/videos' ? 'javascript:;' : url($user->username, 'videos'), false); ?>" title="<?php echo e(__('general.video'), false); ?>"><i class="feather icon-video"></i> <span class="d-lg-inline-block d-none"><?php echo e(__('general.videos'), false); ?></span></a>
              </li>

            <li class="nav-link <?php if(request()->path() == $user->username.'/audio'): ?>active <?php endif; ?> navbar-user-mobile">
              <small class="btn-block sm-btn-size"><?php echo e($totalMusic, false); ?></small>
              <a href="<?php echo e(request()->path() == $user->username.'/audio' ? 'javascript:;' : url($user->username, 'audio'), false); ?>" title="<?php echo e(__('general.audio'), false); ?>"><i class="feather icon-mic"></i> <span class="d-lg-inline-block d-none"><?php echo e(__('general.audio'), false); ?></span></a>
            </li>

            <?php if($settings->shop || ! $settings->shop && $userProducts->count() != 0): ?>
                <li class="nav-link <?php if(request()->path() == $user->username.'/shop'): ?>active <?php endif; ?> navbar-user-mobile">
                  <small class="btn-block sm-btn-size"><?php echo e($user->products()->whereStatus('1')->count(), false); ?></small>
                  <a href="<?php echo e(request()->path() == $user->username.'/shop' ? 'javascript:;' : url($user->username, 'shop'), false); ?>" title="<?php echo e(__('general.shop'), false); ?>"><i class="feather icon-shopping-bag"></i> <span class="d-lg-inline-block d-none"><?php echo e(__('general.shop'), false); ?></span></a>
                </li>
          <?php endif; ?>

          <?php if($totalFiles != 0): ?>
            <li class="nav-link <?php if(request()->path() == $user->username.'/files'): ?>active <?php endif; ?> navbar-user-mobile">
              <small class="btn-block sm-btn-size"><?php echo e($totalFiles, false); ?></small>
              <a href="<?php echo e(request()->path() == $user->username.'/files' ? 'javascript:;' : url($user->username, 'files'), false); ?>" title="<?php echo e(__('general.files'), false); ?>"><i class="far fa-file-archive"></i> <span class="d-lg-inline-block d-none"><?php echo e(__('general.files'), false); ?></span></a>
            </li>
          <?php endif; ?>

          <?php if($totalEpub != 0): ?>
            <li class="nav-link <?php if(request()->path() == $user->username.'/epub'): ?>active <?php endif; ?> navbar-user-mobile">
              <small class="btn-block sm-btn-size"><?php echo e($totalEpub, false); ?></small>
              <a href="<?php echo e(request()->path() == $user->username.'/epub' ? 'javascript:;' : url($user->username, 'epub'), false); ?>" title="<?php echo e(__('general.epub'), false); ?>"><i class="feather icon-book-open"></i> <span class="d-lg-inline-block d-none"><?php echo e(__('general.epub'), false); ?></span></a>
            </li>
          <?php endif; ?>

        </ul>
      <?php endif; ?>

      </div><!-- col-lg-12 -->
    </div><!-- row -->
  </div><!-- container -->

  
  <?php if($user->verified_id == 'yes' && request('media') != 'shop'): ?>
  <div class="container py-4 pb-5">
    <div class="row">
      <div class="col-lg-4 mb-3">

        <button type="button" class="btn-arrow-expand btn btn-outline-primary btn-block mb-2 d-lg-none text-word-break font-weight-bold" type="button" data-toggle="collapse" data-target="#navbarUserHome" aria-controls="navbarCollapse" aria-expanded="false">
      		<?php echo e(__('users.about_me'), false); ?> <i class="fas fa-chevron-down ml-2"></i>
      	</button>

      <div class="sticky-top navbar-collapse collapse d-lg-block" id="navbarUserHome">
        <div class="card mb-3 rounded-large shadow-large">
          <div class="card-body">
            <h6 class="card-title"><?php echo e(__('users.about_me'), false); ?></h6>
            <p class="card-text position-relative">

              <?php if($likeCount != 0 || $subscriptionsActive != 0): ?>
              <span class="btn-block">
                <?php if($likeCount != 0): ?>
                <small class="mr-2"><i class="far fa-heart mr-1"></i> <?php echo e($likeCount, false); ?> <?php echo e(__('general.likes'), false); ?></small>
                <?php endif; ?>

                <?php if($subscriptionsActive != 0 && $user->hide_count_subscribers == 'no'): ?>
                    <small><i class="feather icon-users mr-1"></i> <?php echo e(Helper::formatNumber($subscriptionsActive), false); ?> <?php echo e(trans_choice('general.subscribers', $subscriptionsActive), false); ?></small>
                <?php endif; ?>
              </span>
            <?php endif; ?>

              <?php if(isset($user->country()->country_name) && $user->hide_my_country == 'no'): ?>
              <small class="btn-block">
                <i class="feather icon-map-pin mr-1"></i> <?php echo e($user->country()->country_name, false); ?>

              </small>
              <?php endif; ?>

              <small class="btn-block m-0 mb-1">
                <i class="far fa-user-circle mr-1"></i> <?php echo e(__('general.member_since'), false); ?> <?php echo e(Helper::formatDate($user->date), false); ?>

              </small>

              <?php if($user->show_my_birthdate == 'yes'): ?>
                <small class="btn-block m-0 mb-1">
                  <i class="far fa-calendar-alt mr-1"></i> <?php echo e(__('general.birthdate'), false); ?> <?php echo e(Helper::formatDate($user->birthdate), false); ?> (<?php echo e(\Carbon\Carbon::parse($user->birthdate)->age, false); ?> <?php echo e(__('general.years'), false); ?>)
                </small>
              <?php endif; ?>


            <?php if($user->verified_id == 'yes'): ?>
                  <div class="truncated">
                    <?php echo Helper::checkText($user->story); ?>

                  </div>
                  <a href="javascript:void(0);" class="display-none link-border"><?php echo e(__('general.view_all'), false); ?></a>
            <?php endif; ?>
            </p>

              <?php if($user->website != ''): ?>
                <div class="d-block mb-1 text-truncate">
                  <a href="<?php echo e($user->website, false); ?>" title="<?php echo e($user->website, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="fa fa-link mr-1"></i> <?php echo e(Helper::removeHTPP($user->website), false); ?></a>
                </div>
              <?php endif; ?>

              <?php if($user->facebook != ''): ?>
                <a href="<?php echo e($user->facebook, false); ?>" title="<?php echo e($user->facebook, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="bi-facebook mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->twitter != ''): ?>
                <a href="<?php echo e($user->twitter, false); ?>" title="<?php echo e($user->twitter, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="bi-twitter-x mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->instagram != ''): ?>
                <a href="<?php echo e($user->instagram, false); ?>" title="<?php echo e($user->instagram, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="fab fa-instagram mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->youtube != ''): ?>
                <a href="<?php echo e($user->youtube, false); ?>" title="<?php echo e($user->youtube, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="fab fa-youtube mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->pinterest != ''): ?>
                <a href="<?php echo e($user->pinterest, false); ?>" title="<?php echo e($user->pinterest, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="fab fa-pinterest-p mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->github != ''): ?>
                <a href="<?php echo e($user->github, false); ?>" title="<?php echo e($user->github, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="fab fa-github mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->snapchat != ''): ?>
                <a href="<?php echo e($user->snapchat, false); ?>" title="<?php echo e($user->snapchat, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="bi-snapchat mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->tiktok != ''): ?>
                <a href="<?php echo e($user->tiktok, false); ?>" title="<?php echo e($user->tiktok, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="bi-tiktok mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->telegram != ''): ?>
                <a href="<?php echo e($user->telegram, false); ?>" title="<?php echo e($user->telegram, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="bi-telegram mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->twitch != ''): ?>
                <a href="<?php echo e($user->twitch, false); ?>" title="<?php echo e($user->twitch, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="bi-twitch mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->discord != ''): ?>
                <a href="<?php echo e($user->discord, false); ?>" title="<?php echo e($user->discord, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="bi-discord mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->vk != ''): ?>
                <a href="<?php echo e($user->vk, false); ?>" title="<?php echo e($user->vk, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="fab fa-vk mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->reddit != ''): ?>
                <a href="<?php echo e($user->reddit, false); ?>" title="<?php echo e($user->reddit, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="bi-reddit mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->spotify != ''): ?>
                <a href="<?php echo e($user->spotify, false); ?>" title="<?php echo e($user->spotify, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="bi-spotify mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->threads != ''): ?>
                <a href="<?php echo e($user->threads, false); ?>" title="<?php echo e($user->threads, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="bi-threads mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->kick != ''): ?>
                <a href="<?php echo e($user->kick, false); ?>" title="<?php echo e($user->kick, false); ?>" target="_blank" class="text-muted share-btn-user"><i class="fab fa-kickstarter mr-2"></i></a>
              <?php endif; ?>

              <?php if($user->categories_id != '0' && $user->categories_id != '' && $user->verified_id == 'yes'): ?>
              <div class="w-100 mt-2">

              <?php $__currentLoopData = Categories::where('mode','on')->orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryKey): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($categoryKey == $category->id): ?>
                  <a href="<?php echo e(url('category', $category->slug), false); ?>" class="button-white-sm mb-2">
                    #<?php echo e(Lang::has('categories.' . $category->slug) ? __('categories.' . $category->slug) : $category->name, false); ?>

                  </a>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </div>
            <?php endif; ?>
          </div><!-- card-body -->
        </div><!-- card -->

        <div class="d-lg-block d-none">
        <?php echo $__env->make('includes.footer-tiny', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>

        </div><!-- navbar-collapse -->
      </div><!-- col-lg-4 -->

      <div class="col-lg-8 wrap-post">

        <?php if(auth()->check()
            && auth()->id() == $user->id
            && ! $userPlanMonthlyActive
            && auth()->user()->free_subscription == 'no'
            ): ?>
        <div class="alert alert-danger mb-3">
                 <ul class="list-unstyled m-0">
                   <li><i class="fa fa-exclamation-triangle"></i> <?php echo e(__('general.alert_not_subscription'), false); ?> <a href="<?php echo e(url('settings/subscription'), false); ?>" class="text-white link-border"><?php echo e(__('general.activate'), false); ?></a></li>
                 </ul>
               </div>
               <?php endif; ?>

        <?php if(auth()->check()
            && auth()->id() == $user->id
            && request()->path() == $user->username
            && auth()->user()->verified_id != 'reject'
            ): ?>
          <?php echo $__env->make('includes.form-post', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if($updates->count() == 0 || $updates->count() == 0 && $media): ?>
            <div class="grid-updates"></div>

            <div class="my-5 text-center no-updates">
              <span class="btn-block mb-3">
                <i class="fa fa-photo-video ico-no-result"></i>
              </span>
            <h4 class="font-weight-light"><?php echo e(__('general.no_posts_posted'), false); ?></h4>
            </div>
          <?php else: ?>

            <?php if(! request()->get('sort') && $totalPosts > $settings->number_posts_show || request()->get('sort')): ?>
            <div class="w-100 d-flex justify-content-end align-items-center mb-3 px-lg-0 px-3">

              <?php if(auth()->guest() && $user->posts_privacy || auth()->check()): ?>
              <div>
                <i class="bi-filter-right mr-1"></i>

                <select class="<?php if($settings->button_style == 'rounded'): ?>rounded-pill <?php endif; ?> custom-select w-auto px-4" id="filter">
                    <option <?php if(! request()->get('sort')): ?> selected <?php endif; ?> value="<?php echo e(url()->current(), false); ?><?php echo e(request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')) : null, false); ?>"><?php echo e(__('general.latest'), false); ?></option>
                    <option <?php if(request()->get('sort') == 'oldest'): ?> selected <?php endif; ?> value="<?php echo e(url()->current(), false); ?><?php echo e(request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')).'&' : '?', false); ?>sort=oldest"><?php echo e(__('general.oldest'), false); ?></option>
                    <option <?php if(request()->get('sort') == 'unlockable'): ?> selected <?php endif; ?> value="<?php echo e(url()->current(), false); ?><?php echo e(request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')).'&' : '?', false); ?>sort=unlockable"><?php echo e(__('general.unlockable'), false); ?></option>
                    <option <?php if(request()->get('sort') == 'free'): ?> selected <?php endif; ?> value="<?php echo e(url()->current(), false); ?><?php echo e(request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')).'&' : '?', false); ?>sort=free"><?php echo e(__('general.free'), false); ?></option>
                  </select>
              </div>
              <?php endif; ?>

          </div>
        <?php endif; ?>

        <?php if(auth()->guest() && !$user->posts_privacy): ?>
        <div class="my-5 text-center no-updates">
          <span class="btn-block mb-3">
            <i class="fa fa-lock ico-no-result"></i>
          </span>
        <h4 class="font-weight-light"><?php echo e(__('general.alert_posts_privacy', ['user' => '@'.$user->username]), false); ?></h4>
        </div>

        <?php else: ?>

        <div class="grid-updates position-relative" id="updatesPaginator">
          <?php echo $__env->make('includes.updates', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php endif; ?>   

          <?php endif; ?>
      </div>
      </div><!-- row -->
    </div><!-- container -->
  <?php endif; ?>

  <?php if($user->verified_id == 'yes' && request('media') == 'shop'): ?>
    <div class="container py-5">

      <?php if($userProducts->count() != 0): ?>
      <div class="<?php if(auth()->check() && auth()->user()->verified_id == 'yes' && $user->id == auth()->id()): ?>d-flex justify-content-between align-items-center <?php else: ?> d-block <?php endif; ?> mb-3 text-right">

        <?php if(auth()->check() && auth()->user()->verified_id == 'yes' && $user->id == auth()->id()): ?>
        <div>
          <?php if($settings->digital_product_sale && ! $settings->custom_content): ?>
            <a class="btn btn-primary" href="<?php echo e(url('add/product'), false); ?>">
              <i class="bi-plus"></i> <span class="d-lg-inline-block d-none"><?php echo e(__('general.add_product'), false); ?></span>
            </a>

          <?php elseif(! $settings->digital_product_sale && $settings->custom_content): ?>
            <a class="btn btn-primary" href="<?php echo e(url('add/custom/content'), false); ?>">
              <i class="bi-plus"></i> <span class="d-lg-inline-block d-none"><?php echo e(__('general.add_custom_content'), false); ?></span>
            </a>

          <?php else: ?>
            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addItemForm">
              <i class="bi-plus"></i> <span class="d-lg-inline-block d-none"><?php echo e(__('general.add_new'), false); ?></span>
            </a>
          <?php endif; ?>
        </div>
      <?php endif; ?>

        <div>
          <select class="ml-2 custom-select mb-2 mb-lg-0 w-auto" id="filter">
              <option <?php if(! request()->get('sort')): ?> selected <?php endif; ?> value="<?php echo e(url($user->username).'/shop', false); ?>"><?php echo e(__('general.latest'), false); ?></option>
              <option <?php if(request()->get('sort') == 'oldest'): ?> selected <?php endif; ?> value="<?php echo e(url($user->username).'/shop?sort=oldest', false); ?>"><?php echo e(__('general.oldest'), false); ?></option>
              <option <?php if(request()->get('sort') == 'priceMin'): ?> selected <?php endif; ?> value="<?php echo e(url($user->username).'/shop?sort=priceMin', false); ?>"><?php echo e(__('general.lowest_price'), false); ?></option>
              <option <?php if(request()->get('sort') == 'priceMax'): ?> selected <?php endif; ?> value="<?php echo e(url($user->username).'/shop?sort=priceMax', false); ?>"><?php echo e(__('general.highest_price'), false); ?></option>
              <?php if($settings->physical_products): ?>
              <option <?php if(request()->get('sort') == 'physical'): ?> selected <?php endif; ?> value="<?php echo e(url($user->username).'/shop?sort=physical', false); ?>"><?php echo e(__('general.physical_products'), false); ?></option>
              <?php endif; ?>
              <option <?php if(request()->get('sort') == 'digital'): ?> selected <?php endif; ?> value="<?php echo e(url($user->username).'/shop?sort=digital', false); ?>"><?php echo e(__('general.digital_products'), false); ?></option>
              <option <?php if(request()->get('sort') == 'custom'): ?> selected <?php endif; ?> value="<?php echo e(url($user->username).'/shop?sort=custom', false); ?>"><?php echo e(__('general.custom_content'), false); ?></option>
            </select>

            <?php if($shopCategories->count()): ?>
              <select class="ml-2 custom-select mb-2 mb-lg-0 w-auto filter">
                  <option <?php if(! request()->get('cat')): ?> selected <?php endif; ?> value="<?php echo e(url($user->username, 'shop'), false); ?>"><?php echo e(__('general.all_categories'), false); ?></option>

                    <?php $__currentLoopData = $shopCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php if(request()->get('cat') == $category->slug): ?> selected <?php endif; ?> value="<?php echo e(url($user->username, 'shop'), false); ?><?php echo e('?cat='.$category->slug, false); ?>">
                        <?php echo e(Lang::has('shop-categories.' . $category->slug) ? __('shop-categories.' . $category->slug) : $category->name, false); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>
            <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

      <div class="row">

        <?php if($userProducts->count() != 0): ?>

          <?php $__currentLoopData = $userProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-4 mb-4">
            <?php echo $__env->make('shop.listing-products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div><!-- end col-md-4 -->
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <?php if($userProducts->hasPages()): ?>
            <div class="w-100 d-block">
              <?php echo e($userProducts->onEachSide(0)->appends(['sort' => request('sort')])->links(), false); ?>

            </div>
          <?php endif; ?>

        <?php else: ?>

          <div class="my-5 text-center no-updates w-100">
            <span class="btn-block mb-3">
              <i class="feather icon-shopping-bag ico-no-result"></i>
            </span>
          <h4 class="font-weight-light"><?php echo e(__('general.no_results_found'), false); ?></h4>

        <?php if(auth()->check() && auth()->user()->verified_id == 'yes' && auth()->id() == $user->id): ?>
          <div class="mt-3">
            <?php if($settings->digital_product_sale && ! $settings->custom_content && ! $settings->physical_products): ?>
              <a class="btn btn-primary" href="<?php echo e(url('add/product'), false); ?>">
                <i class="bi-plus"></i> <?php echo e(__('general.add_product'), false); ?>

              </a>

            <?php elseif(! $settings->digital_product_sale && $settings->custom_content && ! $settings->physical_products): ?>
              <a class="btn btn-primary" href="<?php echo e(url('add/custom/content'), false); ?>">
                <i class="bi-plus"></i> <?php echo e(__('general.add_custom_content'), false); ?>

              </a>

            <?php elseif(! $settings->digital_product_sale && $settings->physical_products && ! $settings->custom_content): ?>
              <a class="btn btn-primary" href="<?php echo e(url('add/physical/product'), false); ?>">
                <i class="bi-plus"></i> <?php echo e(__('general.add_physical_product'), false); ?>

              </a>

            <?php else: ?>
              <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addItemForm">
                <i class="bi-plus"></i> <?php echo e(__('general.add_new'), false); ?>

              </a>
            <?php endif; ?>
          </div>
        <?php endif; ?>

          </div>

        <?php endif; ?>
      </div>
    </div><!-- container -->

    <?php echo $__env->renderWhen(auth()->check() && auth()->user()->verified_id == 'yes', 'shop.modal-add-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

  <?php endif; ?>


    <?php if(auth()->check() && auth()->id() != $user->id): ?>
    <div class="modal fade modalReport" id="reportCreator" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-danger modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title font-weight-light" id="modal-title-default"><i class="fas fa-flag mr-1"></i> <?php echo e(__('general.report_user'), false); ?></h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
            </button>
          </div>
     <!-- form start -->
     <form method="POST" action="<?php echo e(url('report/creator', $user->id), false); ?>" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo csrf_field(); ?>
          <!-- Start Form Group -->
          <div class="form-group">
            <label><?php echo e(__('admin.please_reason'), false); ?></label>
              <select name="reason" class="form-control custom-select">
               <option value="spoofing"><?php echo e(__('admin.spoofing'), false); ?></option>
                  <option value="copyright"><?php echo e(__('admin.copyright'), false); ?></option>
                  <option value="privacy_issue"><?php echo e(__('admin.privacy_issue'), false); ?></option>
                  <option value="violent_sexual"><?php echo e(__('admin.violent_sexual_content'), false); ?></option>
                  <option value="spam"><?php echo e(__('general.spam'), false); ?></option>
                  <option value="fraud"><?php echo e(__('general.fraud'), false); ?></option>
                  <option value="under_age"><?php echo e(__('general.under_age'), false); ?></option>
                </select>

                <textarea name="message" rows="" cols="40" maxlength="200" placeholder="<?php echo e(__('general.message'), false); ?> (<?php echo e(__('general.optional'), false); ?>)" class="form-control mt-2 textareaAutoSize"></textarea>
                
                </div><!-- /.form-group-->
            </div><!-- Modal body -->

           <div class="modal-footer">
             <button type="button" class="btn border text-white" data-dismiss="modal"><?php echo e(__('admin.cancel'), false); ?></button>
             <button type="submit" class="btn btn-xs btn-white sendReport ml-auto"><i></i> <?php echo e(__('general.report_user'), false); ?></button>
           </div>

           </form>
          </div><!-- Modal content -->
        </div><!-- Modal dialog -->
      </div><!-- Modal reportCreator -->
    <?php endif; ?>

    <?php if(auth()->check() && auth()->id() != $user->id && ! $checkSubscription  && $user->verified_id == 'yes'): ?>

    <?php if($user->free_subscription == 'no'): ?>
    <div class="modal fade" id="subscriptionForm" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white shadow border-0">
              <div class="card-header pb-2 border-0 position-relative" style="height: 100px; background: <?php echo e($settings->color_default, false); ?> <?php if($user->cover != ''): ?>  url('<?php echo e(Helper::getFile(config('path.cover').$user->cover), false); ?>') no-repeat center center <?php endif; ?>; background-size: cover;">

              </div>
              <div class="card-body px-lg-5 py-lg-5 position-relative">

                <div class="text-muted text-center mb-3 position-relative modal-offset">
                  <img src="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" width="100" alt="<?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?>" class="avatar-modal rounded-circle mb-1">
                  <h6 class="font-weight-light">
                    <?php echo __('general.subscribe_month', ['price' => '<span class="font-weight-bold">'.Helper::formatPrice($user->getPlan('monthly', 'price'), true).'</span>']); ?> <?php echo e(__('general.unlocked_content'), false); ?> <?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?>


                    <small class="w-100 d-block font-12">* <?php echo e(__('general.in_currency', ['currency_code' => $settings->currency_code]), false); ?></small>
                  </h6>
                </div>

                <?php if($totalPosts == 0): ?>
                  <div class="alert alert-warning fade show small" role="alert">
                    <i class="fa fa-exclamation-triangle mr-1"></i> <?php echo e($user->first_name, false); ?> <?php echo e(__('general.not_posted_any_content'), false); ?>

                  </div>
                <?php endif; ?>

                <div class="text-center text-muted mb-2">
                  <h5><?php echo e(__('general.what_will_you_get'), false); ?></h5>
                </div>

                <ul class="list-unstyled">
                  <li><i class="fa fa-check mr-2 <?php if(auth()->user()->dark_mode == 'on'): ?> text-white <?php else: ?> text-primary <?php endif; ?>"></i> <?php echo e(__('general.full_access_content'), false); ?></li>
                  <li><i class="fa fa-check mr-2 <?php if(auth()->user()->dark_mode == 'on'): ?> text-white <?php else: ?> text-primary <?php endif; ?>"></i> <?php echo e(__('general.direct_message_with_this_user'), false); ?></li>
                  <li><i class="fa fa-check mr-2 <?php if(auth()->user()->dark_mode == 'on'): ?> text-white <?php else: ?> text-primary <?php endif; ?>"></i> <?php echo e(__('general.cancel_subscription_any_time'), false); ?></li>
                </ul>

                <div class="text-center text-muted mb-2 <?php if($allPayment->count() == 1): ?> d-none <?php endif; ?>">
                  <small><i class="far fa-credit-card mr-1"></i> <?php echo e(__('general.choose_payment_gateway'), false); ?></small>
                </div>

                <form method="post" action="<?php echo e(url('buy/subscription'), false); ?>" id="formSubscription">
                  <?php echo csrf_field(); ?>

                  <input type="hidden" name="id" value="<?php echo e($user->id, false); ?>"  />
                  <input name="interval" value="monthly" id="plan-monthly" class="d-none" type="radio">

                  <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input name="interval" value="<?php echo e($plan->interval, false); ?>" id="plan-<?php echo e($plan->interval, false); ?>" class="d-none" type="radio">
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  <?php $__currentLoopData = $allPayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php

                    if ($payment->name == 'Mercadopago') {
                      $recurrent = '<br><small>Formas de pagamento: Cartão e Pix</small>';
                    } else if ($payment->recurrent == 'no') {
                      $recurrent = '<br><small>'.__('general.non_recurring').'</small>';
                    } else if ($payment->id == 1) {
                      $recurrent = '<br><small>'.__('general.redirected_to_paypal_website').'</small>';
                    } else {
                      $recurrent = '<br><small>'.__('general.automatically_renewed').' ('.$payment->name.')</small>';
                    }

                    if ($payment->type == 'card' ) {
                      $paymentName = '<i class="far fa-credit-card mr-1"></i> '.__('general.debit_credit_card').$recurrent;
                    } else if ($payment->id == 1) {
                      $paymentName = '<img src="'.url('public/img/payments', auth()->user()->dark_mode == 'off' ? $payment->logo : 'paypal-white.png').'" width="70"/> <small class="w-100 d-block">'.__('general.redirected_to_paypal_website').'</small>';
                    } else {
                      $paymentName = '<img src="'.url('public/img/payments', $payment->logo).'" width="70"/>'.$recurrent;
                    }

                    ?>

                    <div class="custom-control custom-radio mb-3">
                      <input name="payment_gateway" required value="<?php echo e($payment->name, false); ?>" id="radio<?php echo e($payment->name, false); ?>" <?php if($allPayment->count() == 1 && Helper::userWallet('balance') == 0): ?> checked <?php endif; ?> class="custom-control-input" type="radio">
                      <label class="custom-control-label" for="radio<?php echo e($payment->name, false); ?>">
                        <span><strong><?php echo $paymentName; ?></strong></span>
                      </label>
                    </div>

                    <?php if($payment->name == 'Stripe' && ! auth()->user()->pm_type != ''): ?>
                      <div id="stripeContainer" class="<?php if($allPayment->count() == 1 && $payment->name == 'Stripe'): ?>d-block <?php else: ?> display-none <?php endif; ?>">
                      <a href="<?php echo e(url('settings/payments/card'), false); ?>" class="btn btn-secondary btn-sm mb-3 w-100">
                        <i class="far fa-credit-card mr-2"></i>
                        <?php echo e(__('general.add_payment_card'), false); ?>

                      </a>
                      </div>
                    <?php endif; ?>

                    <?php if($payment->name == 'Paystack' && ! auth()->user()->paystack_authorization_code): ?>
                      <div id="paystackContainer" class="<?php if($allPayment->count() == 1 && $payment->name == 'Paystack'): ?>d-block <?php else: ?> display-none <?php endif; ?>">
                      <a href="<?php echo e(url('my/cards'), false); ?>" class="btn btn-secondary btn-sm mb-3 w-100">
                        <i class="far fa-credit-card mr-2"></i>
                        <?php echo e(__('general.add_payment_card'), false); ?>

                      </a>
                      </div>
                    <?php endif; ?>

                    <?php if($payment->name == 'Mercadopago'): ?>
                      <div id="mpContainer" class="<?php if($allPayment->count() == 1 && $payment->name == 'Mercadopago'): ?>d-block <?php else: ?> display-none <?php endif; ?>">
                      </div>
                    <?php endif; ?>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  <?php if($settings->disable_wallet == 'on' && Helper::userWallet('balance') != 0 || $settings->disable_wallet == 'off'): ?>
                  <div class="custom-control custom-radio mb-3">
                    <input name="payment_gateway" required <?php if(Helper::userWallet('balance') == 0): ?> disabled <?php endif; ?> value="wallet" id="radio0" class="custom-control-input" type="radio">
                    <label class="custom-control-label" for="radio0">
                      <span>
                        <strong>
                        <i class="fas fa-wallet mr-1 icon-sm-radio"></i> <?php echo e(__('general.wallet'), false); ?>

                        <span class="w-100 d-block font-weight-light">
                          <?php echo e(__('general.available_balance'), false); ?>: <span class="font-weight-bold mr-1"><?php echo e(Helper::userWallet(), false); ?></span>

                          <?php if(Helper::userWallet('balance') != 0 && $settings->wallet_format != 'real_money'): ?>
                            <i class="bi-info-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?php echo e(Helper::equivalentMoney($settings->wallet_format), false); ?>"></i>
                          <?php endif; ?>

                          <?php if(Helper::userWallet('balance') == 0): ?>
                          <a href="<?php echo e(url('my/wallet'), false); ?>" class="link-border"><?php echo e(__('general.recharge'), false); ?></a>
                        <?php endif; ?>
                        </span>
                        <span class="w-100 d-block small"><?php echo e(__('general.automatically_renewed_wallet'), false); ?></span>
                      </strong>
                      </span>
                    </label>
                  </div>
                <?php endif; ?>

                  <div class="alert alert-danger display-none" id="error">
                      <ul class="list-unstyled m-0" id="showErrors"></ul>
                    </div>

                  <div class="custom-control custom-control-alternative custom-checkbox">
                    <input class="custom-control-input" required id=" customCheckLogin" name="agree_terms" type="checkbox">
                    <label class="custom-control-label" for=" customCheckLogin">
                      <span><?php echo e(__('general.i_agree_with'), false); ?> <a href="<?php echo e($settings->link_terms, false); ?>" target="_blank"><?php echo e(__('admin.terms_conditions'), false); ?></a></span>
                    </label>
                  </div>

                  <?php if($taxRatesCount != 0 && auth()->user()->isTaxable()->count()): ?>
                  <ul class="list-group list-group-flush border-dashed-radius mt-3">
                  	<?php $__currentLoopData = auth()->user()->isTaxable(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  		<li class="list-group-item py-1 list-taxes">
                  	    <div class="row">
                  	      <div class="col">
                  	        <small><?php echo e($tax->name, false); ?> <?php echo e($tax->percentage, false); ?>% <?php echo e(__('general.applied_price'), false); ?></small>
                  	      </div>
                  	    </div>
                  	  </li>
                  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                <?php endif; ?>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4 w-100 subscriptionBtn" onclick="$('#plan-monthly').trigger('click');">
                      <i></i> <?php echo e(__('general.subscribe_month', ['price' => Helper::formatPrice($user->getPlan('monthly', 'price'), true)]), false); ?>

                    </button>

                    <?php if($plans->count()): ?>
                      <a class="d-block my-3 btn-arrow-expand-bi" data-toggle="collapse" href="#collapseSubscriptionBundles" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi-box mr-1"></i> <?php echo e(__('general.subscription_bundles'), false); ?> <i class="bi-chevron-down transition-icon"></i>
                      </a>

                      <div class="collapse" id="collapseSubscriptionBundles">
                        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <button type="submit" class="btn btn-primary mt-2 w-100 subscriptionBtn" onclick="$('#plan-<?php echo e($plan->interval, false); ?>').trigger('click');">
                            <i></i> <?php echo e(__('general.subscribe_'.$plan->interval, ['price' => Helper::formatPrice($plan->price, true)]), false); ?>

                          </button>

                          <?php if(Helper::calculateSubscriptionDiscount($plan->interval, $user->getPlan('monthly', 'price'), $plan->price) > 0): ?>
                            <small class="<?php if(auth()->user()->dark_mode == 'on'): ?> text-white <?php else: ?> text-success <?php endif; ?> subscriptionDiscount">
                              <em><?php echo e(Helper::calculateSubscriptionDiscount($plan->interval, $user->getPlan('monthly', 'price'), $plan->price), false); ?>% <?php echo e(__('general.discount'), false); ?>  </em>
                            </small>
                          <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>

                    <?php endif; ?>

                    <div class="w-100 mt-2">
                      <button type="button" class="btn e-none p-0" data-dismiss="modal"><?php echo e(__('admin.cancel'), false); ?></button>
                    </div>
                  </div>

                  <?php echo $__env->make('includes.site-billing-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Modal Subscription -->
    <?php endif; ?>

    <!-- Subscription Free -->
    <div class="modal fade" id="subscriptionFreeForm" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white shadow border-0">
              <div class="card-header pb-2 border-0 position-relative" style="height: 100px; background: <?php echo e($settings->color_default, false); ?> <?php if($user->cover != ''): ?>  url('<?php echo e(Helper::getFile(config('path.cover').$user->cover), false); ?>') no-repeat center center <?php endif; ?>; background-size: cover;">

              </div>
              <div class="card-body px-lg-5 py-lg-5 position-relative">

                <div class="text-muted text-center mb-3 position-relative modal-offset">
                  <img src="<?php echo e(Helper::getFile(config('path.avatar').$user->avatar), false); ?>" width="100" alt="<?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?>" class="avatar-modal rounded-circle mb-1">
                  <h6 class="font-weight-light">
                    <?php echo e(__('general.subscribe_free_content'), false); ?> <?php echo e($user->hide_name == 'yes' ? $user->username : $user->name, false); ?>

                  </h6>
                </div>

                <?php if($totalPosts == 0): ?>
                  <div class="alert alert-warning fade show small" role="alert">
                    <i class="fa fa-exclamation-triangle mr-1"></i> <?php echo e($user->first_name, false); ?> <?php echo e(__('general.not_posted_any_content'), false); ?>

                  </div>
                <?php endif; ?>

                <div class="text-center text-muted mb-2">
                  <h5><?php echo e(__('general.what_will_you_get'), false); ?></h5>
                </div>

                <ul class="list-unstyled">
                  <li><i class="fa fa-check mr-2 text-primary"></i> <?php echo e(__('general.full_access_content'), false); ?></li>
                  <li><i class="fa fa-check mr-2 text-primary"></i> <?php echo e(__('general.direct_message_with_this_user'), false); ?></li>
                  <li><i class="fa fa-check mr-2 text-primary"></i> <?php echo e(__('general.cancel_subscription_any_time'), false); ?></li>
                </ul>

                <div class="w-100 text-center">
                  <a href="javascript:void(0);" data-id="<?php echo e($user->id, false); ?>" id="subscribeFree" class="btn btn-primary btn-profile mr-1">
                    <i class="feather icon-user-plus mr-1"></i> <?php echo e(__('general.subscribe_for_free'), false); ?>

                  </a>
                  <div class="w-100 mt-2">
                    <button type="button" class="btn e-none p-0" data-dismiss="modal"><?php echo e(__('admin.cancel'), false); ?></button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Modal Subscription Free -->
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<?php if(auth()->check() && auth()->id() == $user->id): ?>
<script src="<?php echo e(asset('public/js/upload-avatar-cover.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<?php endif; ?>

<script src="<?php echo e(asset('public/js/qrcode.min.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>

<script type="text/javascript">

<?php if($settings->generate_qr_code && $user->verified_id == 'yes'): ?>
new QRCode(document.getElementById("QrCode"), "<?php echo e(url($user->username).Helper::referralLink(), false); ?>");

const downloadQR = () => {
let link = document.createElement('a');
link.download = "QR <?php echo e('@'.$user->username, false); ?>.png";
link.href = document.querySelector('#QrCode canvas').toDataURL()
link.click();
}

$(document).on('click','#downloadQr', function(e) {
  downloadQR()
});
<?php endif; ?>

<?php if(auth()->guard()->check()): ?>
$('.subsCCBill').on('click', function() {

  $(this).blur();
  var expiration = $(this).attr('data-expiration');
  swal({
    html: true,
    title: "<?php echo e(__('general.unsubscribe'), false); ?>",
    text: "<?php echo __('general.cancel_subscription_ccbill', ['ccbill' => '<a href=\'https://support.ccbill.com/\' target=\'_blank\'>https://support.ccbill.com</a>']); ?> " + expiration,
    type: "info",
    confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
    });
});
<?php endif; ?>

 <?php if(session('noty_error')): ?>
   		swal({
   			title: "<?php echo e(__('general.error_oops'), false); ?>",
   			text: "<?php echo e(__('general.already_sent_report'), false); ?>",
   			type: "error",
   			confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
   			});
  		 <?php endif; ?>

  <?php if(session('noty_success')): ?>
   		swal({
   			title: "<?php echo e(__('general.thanks'), false); ?>",
   			text: "<?php echo e(__('general.reported_success'), false); ?>",
   			type: "success",
   			confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
   			});
  <?php endif; ?>

  $('.dropdown-menu.d-menu').on({
      "click":function(e){
        e.stopPropagation();
      }
  });

  <?php if(session('subscription_success')): ?>
     swal({
       html:true,
       title: "<?php echo e(__('general.congratulations'), false); ?>",
       text: "<?php echo session('subscription_success'); ?>",
       type: "success",
       confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
       });
    <?php endif; ?>

    <?php if(session('subscription_cancel')): ?>
     swal({
       title: "<?php echo e(__('general.canceled'), false); ?>",
       text: "<?php echo e(session('subscription_cancel'), false); ?>",
       type: "error",
       confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
       });
    <?php endif; ?>

    <?php if(session('success_verify')): ?>
    	swal({
    		title: "<?php echo e(__('general.welcome'), false); ?>",
    		text: "<?php echo e(__('users.account_validated'), false); ?>",
    		type: "success",
    		confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
    		});
    	 <?php endif; ?>

    	 <?php if(session('error_verify')): ?>
    	swal({
    		title: "<?php echo e(__('general.error_oops'), false); ?>",
    		text: "<?php echo e(__('users.code_not_valid'), false); ?>",
    		type: "error",
    		confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
    		});
    	 <?php endif; ?>

       <?php if(session('error_cancel')): ?>
    	swal({
    		title: "<?php echo e(__('general.error_oops'), false); ?>",
    		text: "<?php echo e(__('general.payment_card_error'), false); ?>",
    		type: "error",
    		confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
    		});
    	 <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>
<?php session()->forget('subscription_cancel') ?>
<?php session()->forget('subscription_success') ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/profile.blade.php ENDPATH**/ ?>