

<?php $__env->startSection('content'); ?>
  <section class="section section-sm">
    <div class="container container-lg-3 pt-lg-5 pt-2">
      <div class="row">

        <div class="col-md-2">
          <?php echo $__env->make('includes.menu-sidebar-home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="col-md-6 p-0 second wrap-post">

          <?php if($stories->count() || $settings->story_status && auth()->user()->verified_id == 'yes'): ?>
          <div id="stories" class="storiesWrapper mb-2 p-2">
            <?php if($settings->story_status && auth()->user()->verified_id == 'yes'): ?>
            <div class="add-story" title="<?php echo e(__('general.add_story'), false); ?>">
              <a class="item-add-story" href="#" data-toggle="modal" data-target="#addStory">
                <span class="add-story-preview">
                  <img lazy="eager" width="100" src="<?php echo e(Helper::getFile(config('path.avatar').auth()->user()->avatar), false); ?>">
                </span>
                <span class="info py-3 text-center text-white bg-primary">
                  <strong class="name" style="text-shadow: none;"><i class="bi-plus-circle-dotted mr-1"></i> <?php echo e(__('general.add_story'), false); ?></strong>
                </span>
              </a>
            </div>
            <?php endif; ?>
          </div>
          <?php endif; ?>

        <?php if($settings->announcement != ''
            && $settings->announcement_show == 'creators'
            && auth()->user()->verified_id == 'yes'
            || $settings->announcement != ''
            && $settings->announcement_show == 'all'
            ): ?>
          <div class="alert alert-<?php echo e($settings->type_announcement, false); ?> announcements display-none card-border-0" role="alert">
            <button type="button" class="close" id="closeAnnouncements">
              <span aria-hidden="true">
                <i class="bi bi-x-lg"></i>
              </span>
            </button>

            <h4 class="alert-heading"><i class="bi bi-megaphone mr-2"></i> <?php echo e(__('general.announcements'), false); ?></h4>
            <p class="update-text">
              <?php echo $settings->announcement; ?>

            </p>
          </div><!-- end announcements -->
        <?php endif; ?>

          <?php if($payPerViewsUser != 0): ?>
            <div class="col-md-12 d-none">
              <ul class="list-inline">
                <li class="list-inline-item text-uppercase h5">
                  <a href="<?php echo e(url('/'), false); ?>" class="text-decoration-none <?php if(request()->is('/')): ?> link-border <?php else: ?> text-muted  <?php endif; ?>"><?php echo e(__('admin.home'), false); ?></a>
                </li>
                <li class="list-inline-item text-uppercase h5">
                  <a href="<?php echo e(url('my/purchases'), false); ?>" class="text-decoration-none <?php if(request()->is('my/purchases')): ?> link-border <?php else: ?> text-muted <?php endif; ?>" ><?php echo e(__('general.purchased'), false); ?></a>
                </li>
              </ul>
            </div>
          <?php endif; ?>

        <?php if(auth()->user()->verified_id == 'yes'): ?>
        
          <?php echo $__env->make('includes.modal-add-story', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <?php echo $__env->make('includes.form-post', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

          <?php if($updates->count() != 0): ?>
          <div class="grid-updates position-relative" id="updatesPaginator">
              <?php echo $__env->make('includes.updates', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>

        <?php else: ?>
          <div class="grid-updates position-relative" id="updatesPaginator"></div>

        <div class="my-5 text-center no-updates">
          <span class="btn-block mb-3">
            <i class="fa fa-photo-video ico-no-result"></i>
          </span>
        <h4 class="font-weight-light"><?php echo e(__('general.no_posts_posted'), false); ?></h4>

          <a href="<?php echo e(url('creators'), false); ?>" class="btn btn-primary mb-3 mt-2 px-5 d-lg-none">
            <?php echo e(__('general.explore_creators'), false); ?>

          </a>

          <a href="<?php echo e(url('explore'), false); ?>" class="btn btn-primary px-5 d-lg-none">
            <?php echo e(__('general.explore_posts'), false); ?>

          </a>
        </div>

        <?php endif; ?>
        </div><!-- end col-md-12 -->

        <div class="col-md-4 <?php if($users->count() != 0): ?> mb-4 <?php endif; ?> d-lg-block d-none">
          <div class="d-lg-block sticky-top">
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
                  						<?php echo e(auth()->user()->verified_id == 'yes' ? __('general.edit_my_page') : __('users.edit_profile'), false); ?>

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

            <?php if($users->count() != 0): ?>
                <?php echo $__env->make('includes.explore_creators', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <div class="d-lg-block d-none">
              <?php echo $__env->make('includes.footer-tiny', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
         </div><!-- sticky-top -->

        </div><!-- col-md -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<?php if(session('noty_error')): ?>
  <script type="text/javascript">
   swal({
     title: "<?php echo e(__('general.error_oops'), false); ?>",
     text: "<?php echo e(__('general.already_sent_report'), false); ?>",
     type: "error",
     confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
     });
     </script>
<?php endif; ?>

<?php if(session('noty_success')): ?>
<script type="text/javascript">
     swal({
       title: "<?php echo e(__('general.thanks'), false); ?>",
       text: "<?php echo e(__('general.reported_success'), false); ?>",
       type: "success",
       confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
       });
       </script>
 <?php endif; ?>

 <?php if(session('success_verify')): ?>
 <script type="text/javascript">
    swal({
      title: "<?php echo e(__('general.welcome'), false); ?>",
      text: "<?php echo e(__('users.account_validated'), false); ?>",
      type: "success",
      confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
      });
      </script>
   <?php endif; ?>

   <?php if(session('error_verify')): ?>
   <script type="text/javascript">
    swal({
      title: "<?php echo e(__('general.error_oops'), false); ?>",
      text: "<?php echo e(__('users.code_not_valid'), false); ?>",
      type: "error",
      confirmButtonText: "<?php echo e(__('users.ok'), false); ?>"
      });
      </script>
   <?php endif; ?>

   <?php if($settings->story_status && $stories->count()): ?>
       <script>
        let stories = new Zuck('stories', {
          skin: 'snapssenger',      // container class
          avatars: false,         // shows user photo instead of last story item preview
          list: false,           // displays a timeline instead of carousel
          openEffect: true,      // enables effect when opening story
          cubeEffect: false,     // enables the 3d cube effect when sliding story
          autoFullScreen: false, // enables fullscreen on mobile browsers
          backButton: true,      // adds a back button to close the story viewer
          backNative: false,     // uses window history to enable back button on browsers/android
          previousTap: true,     // use 1/3 of the screen to navigate to previous item when tap the story
          localStorage: true,    // set true to save "seen" position. Element must have a id to save properly.

          stories: [

          <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            {
            id: "<?php echo e($story->user->username, false); ?>",               // story id
            photo: "<?php echo e(Helper::getFile(config('path.avatar').$story->user->avatar), false); ?>",            // story photo (or user photo)
            name: "<?php echo e($story->user->hide_name == 'yes' ? $story->user->username : $story->user->name, false); ?>",             // story name (or user name)
            link: "<?php echo e(url($story->user->username), false); ?>",             // story link (useless on story generated by script)
            lastUpdated: <?php echo e($story->created_at->timestamp, false); ?>,      // last updated date in unix time format

            items: [
              // story item example

              <?php $__currentLoopData = $story->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              {
                id: "<?php echo e($story->user->username, false); ?>-<?php echo e($story->id, false); ?>",       // item id
                type: "<?php echo e($media->type, false); ?>",     // photo or video
                length: <?php echo e($media->type == 'photo' ? 5 : ($media->video_length ?: $settings->story_max_videos_length), false); ?>,    // photo timeout or video length in seconds - uses 3 seconds timeout for images if not set
                src: "<?php echo e(Helper::getFile(config('path.stories').$media->name), false); ?>",      // photo or video src
                preview: "<?php echo e($media->type == 'photo' ? route('resize', ['path' => 'stories', 'file' => $media->name, 'size' => 280]) : ($media->video_poster ? route('resize', ['path' => 'stories', 'file' => $media->video_poster, 'size' => 280]) : route('resize', ['path' => 'avatar', 'file' => $story->user->avatar, 'size' => 200])), false); ?>",  // optional - item thumbnail to show in the story carousel instead of the story defined image
                link: "",     // a link to click on story
                linkText: '<?php echo e($story->title, false); ?>', // link text
                time: <?php echo e($media->created_at->timestamp, false); ?>,     // optional a date to display with the story item. unix timestamp are converted to "time ago" format
                seen: false,   // set true if current user was read
                story: "<?php echo e($media->id, false); ?>",
                text: "<?php echo e($media->text, false); ?>",
                color: "<?php echo e($media->font_color, false); ?>",
                font: "<?php echo e($media->font, false); ?>",
              },
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ]
          },
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          ],

          callbacks:  {
            onView (storyId) {
              getItemStoryId(storyId);
            },

            onEnd (storyId, callback) {
              getItemStoryId(storyId);
              callback();  // on end story
            },

            onClose (storyId, callback) {
              getItemStoryId(storyId);
              callback();  // on close story viewer
            },

            onNavigateItem (storyId, nextStoryId, callback) {
              getItemStoryId(storyId);
              callback();  // on navigate item of story
            },
          },
        
          language: { // if you need to translate :)
            unmute: '<?php echo e(__("general.touch_unmute"), false); ?>',
            keyboardTip: 'Press space to see next',
            visitLink: 'Visit link',
            time: {
              ago:'<?php echo e(__("general.ago"), false); ?>', 
              hour:'<?php echo e(__("general.hour"), false); ?>', 
              hours:'<?php echo e(__("general.hours"), false); ?>', 
              minute:'<?php echo e(__("general.minute"), false); ?>', 
              minutes:'<?php echo e(__("general.minutes"), false); ?>', 
              fromnow: '<?php echo e(__("general.fromnow"), false); ?>', 
              seconds:'<?php echo e(__("general.seconds"), false); ?>', 
              yesterday: '<?php echo e(__("general.yesterday"), false); ?>', 
              tomorrow: 'tomorrow', 
              days:'days'
            }
          }
        });

        function getItemStoryId(storyId) {
          let userActive = '<?php echo e(auth()->user()->username, false); ?>';
          if (userActive !== storyId) {
            let itemId = $('#zuck-modal .story-viewer[data-story-id="'+storyId+'"]').find('.itemStory.active').data('id-story');
            insertViewStory(itemId);
          }
          insertTextStory();
        }

        insertTextStory();

        function insertTextStory() {
          $('.previewText').each(function() {
          let text = $(this).find('.items>li:first-child>a').data('text');
          let font = $(this).find('.items>li:first-child>a').data('font');
          let color = $(this).find('.items>li:first-child>a').data('color');
          $(this).find('.text-story-preview').css({fontFamily: font, color: color }).html(text);
        });
        }

        function insertViewStory(itemId) {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.post(URL_BASE+"/story/views/"+itemId+"");
        }

        $(document).on('click','.profilePhoto, .info>.name', function() {
          let element = $(this);
          let username = element.parents('.story-viewer').data('story-id');
          if (username) {
            window.location.href = URL_BASE+'/'+username;
          }
        });
       </script>
   <?php endif; ?>

 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/index/home-session.blade.php ENDPATH**/ ?>