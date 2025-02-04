<?php $__env->startSection('title'); ?> <?php echo e(auth()->user()->verified_id == 'yes' ? trans('general.edit_my_page') : trans('users.edit_profile'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('public/plugins/datepicker/datepicker3.css'), false); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo e(asset('public/plugins/select2/select2.min.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi-pencil mr-2"></i> <?php echo e(auth()->user()->verified_id == 'yes' ? trans('general.edit_my_page') : trans('users.edit_profile'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans('users.settings_page_desc'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <?php echo $__env->make('includes.cards-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          <?php if(session('status')): ?>
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                			<span aria-hidden="true">×</span>
                			</button>

                    <?php echo e(trans('admin.success_update'), false); ?>

                  </div>
                <?php endif; ?>

          <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <?php echo $__env->make('includes.alert-payment-disabled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <form method="POST" action="<?php echo e(url('settings/page'), false); ?>" id="formEditPage" accept-charset="UTF-8" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>

            <input type="hidden" id="featured_content" name="featured_content" value="<?php echo e(auth()->user()->featured_content, false); ?>">

          <div class="form-group">
            <label><?php echo e(trans('auth.full_name'), false); ?> *</label>
            <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="far fa-user"></i></span>
            </div>
                <input class="form-control" name="full_name" placeholder="<?php echo e(trans('auth.full_name'), false); ?>" value="<?php echo e(auth()->user()->name, false); ?>"  type="text">
            </div>
          </div><!-- End form-group -->

          <div class="form-group">
            <label><?php echo e(trans('auth.username'), false); ?> *</label>
            <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text pr-0"><?php echo e(Helper::removeHTPP(url('/')), false); ?>/</span>
            </div>
                <input class="form-control" name="username" maxlength="25" placeholder="<?php echo e(trans('auth.username'), false); ?>" value="<?php echo e(auth()->user()->username, false); ?>"  type="text">
            </div>
            <div class="text-muted btn-block">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="hide_name" value="yes" <?php if(auth()->user()->hide_name == 'yes'): ?> checked <?php endif; ?> id="customSwitch1">
                <label class="custom-control-label switch" for="customSwitch1"><?php echo e(trans('general.hide_name'), false); ?></label>
              </div>
            </div>
          </div><!-- End form-group -->

          <div class="form-group">
                <input class="form-control" placeholder="<?php echo e(trans('auth.email'), false); ?> *" <?php echo auth()->user()->isSuperAdmin() ? 'name="email"' : 'disabled'; ?> value="<?php echo e(auth()->user()->email, false); ?>" type="text">
            </div><!-- End form-group -->

          <div class="row form-group mb-0">
            <div class="col-md-6">
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user-tie"></i></span>
                  </div>
                  <input class="form-control" name="profession" placeholder="<?php echo e(trans('users.profession_ocupation'), false); ?>" value="<?php echo e(auth()->user()->profession, false); ?>" type="text">
                </div>
              </div><!-- ./col-md-6 -->

              <div class="col-md-6">
                <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-language"></i></span>
                </div>
                <select name="language" class="form-control custom-select">
                  <option <?php if(auth()->user()->language == ''): ?> selected="selected" <?php endif; ?> value="">(<?php echo e(trans('general.language'), false); ?>) <?php echo e(__('general.not_specified'), false); ?></option>
                  <?php $__currentLoopData = Languages::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if(auth()->user()->language == $languages->abbreviation): ?> selected="selected" <?php endif; ?> value="<?php echo e($languages->abbreviation, false); ?>"><?php echo e($languages->name, false); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  </div>
                </div><!-- ./col-md-6 -->
            </div><!-- End Row Form Group -->

              <div class="row form-group mb-0">
                  <div class="col-md-6">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                        </div>
                        <input class="form-control datepicker" <?php if(auth()->user()->birthdate_changed == 'yes'): ?> disabled  <?php endif; ?> name="birthdate" placeholder="<?php echo e(trans('general.birthdate'), false); ?> *"  value="<?php echo e(auth()->user()->birthdate ?? date(Helper::formatDatepicker(), strtotime(auth()->user()->birthdate)), false); ?>" autocomplete="off" type="text">
                      </div>
                      <small class="form-text text-muted mb-4"><?php echo e(trans('general.valid_formats'), false); ?> <strong><?php echo e(now()->subYears(18)->format(Helper::formatDatepicker()), false); ?></strong> --
                        <strong>(<?php echo e(trans('general.birthdate_changed_info'), false); ?>)</strong>
                      </small>
                    </div><!-- ./col-md-6 -->

                    <div class="col-md-6">
                      <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-venus-mars"></i></span>
                      </div>
                      <select name="gender" class="form-control custom-select">
                        <option <?php if(auth()->user()->gender == '' ): ?> selected="selected" <?php endif; ?> value="">(<?php echo e(trans('general.gender'), false); ?>) <?php echo e(__('general.not_specified'), false); ?></option>
                        <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option <?php if(auth()->user()->gender == $gender): ?> selected="selected" <?php endif; ?> value="<?php echo e($gender, false); ?>"><?php echo e(__('general.'.$gender), false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                      </div><!-- ./col-md-6 -->
                    </div><!-- End Row Form Group -->

              <div class="row form-group mb-0">

                <?php if(auth()->user()->verified_id == 'yes'): ?>
                    <div class="col-md-12">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-link"></i></span>
                          </div>
                          <input class="form-control" name="website" placeholder="<?php echo e(trans('users.website'), false); ?>"  value="<?php echo e(auth()->user()->website, false); ?>" type="text">
                        </div>
                      </div><!-- ./col-md-12 -->

                      <div class="col-md-12" id="billing">
                        <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-lightbulb"></i></span>
                        </div>
                        <select name="categories_id[]" multiple class="form-control categoriesMultiple" >
                              <?php $__currentLoopData = Categories::where('mode','on')->orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if(in_array($category->id, $categories)): ?> selected="selected" <?php endif; ?> value="<?php echo e($category->id, false); ?>"><?php echo e(Lang::has('categories.' . $category->slug) ? __('categories.' . $category->slug) : $category->name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              </div>
                        </div><!-- ./col-md-12 -->

                    <?php endif; ?>

                <div class="col-lg-12 py-2">
                  <h6 class="text-muted">-- <?php echo e(trans('general.billing_information'), false); ?></h6>
                </div>

                <div class="col-lg-12">
                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                      </div>
                      <input class="form-control" name="company" placeholder="<?php echo e(trans('general.company'), false); ?>"  value="<?php echo e(auth()->user()->company, false); ?>" type="text">
                    </div>
                  </div><!-- ./col-md-6 -->

                <div class="col-md-6">
                  <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-globe"></i></span>
                  </div>
                  <select name="countries_id" class="form-control custom-select">
                    <option value=""><?php echo e(trans('general.select_your_country'), false); ?> *</option>
                        <?php $__currentLoopData = Countries::orderBy('country_name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option <?php if(auth()->user()->countries_id == $country->id ): ?> selected="selected" <?php endif; ?> value="<?php echo e($country->id, false); ?>"><?php echo e($country->country_name, false); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                  </div><!-- ./col-md-6 -->

                  <div class="col-md-6">
                      <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-map-pin"></i></span>
                        </div>
                        <input class="form-control" name="city" placeholder="<?php echo e(trans('general.city'), false); ?>"  value="<?php echo e(auth()->user()->city, false); ?>" type="text">
                      </div>
                    </div><!-- ./col-md-6 -->

                    <div class="col-md-6 <?php if(auth()->user()->verified_id == 'no'): ?> scrollError <?php endif; ?>">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map-marked-alt"></i></span>
                          </div>
                          <input class="form-control" name="address" placeholder="<?php echo e(trans('general.address'), false); ?>"  value="<?php echo e(auth()->user()->address, false); ?>" type="text">
                        </div>
                      </div><!-- ./col-md-6 -->

                      <div class="col-md-6">
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                            </div>
                            <input class="form-control" name="zip" placeholder="<?php echo e(trans('general.zip'), false); ?>"  value="<?php echo e(auth()->user()->zip, false); ?>" type="text">
                          </div>
                        </div><!-- ./col-md-6 -->

              </div><!-- End Row Form Group -->

              <?php if(auth()->user()->verified_id == 'yes'): ?>
              <div class="row form-group mb-0">
                <div class="col-lg-12 py-2">
                  <h6 class="text-muted">-- <?php echo e(trans('admin.profiles_social'), false); ?></h6>
                </div>

                  <div class="col-md-6">
                      <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                        </div>
                        <input class="form-control" name="facebook" placeholder="https://facebook.com/username"  value="<?php echo e(auth()->user()->facebook, false); ?>" type="text">
                      </div>
                    </div><!-- ./col-md-6 -->

                    <div class="col-md-6">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi-twitter-x"></i></span>
                          </div>
                          <input class="form-control" name="twitter" placeholder="https://twitter.com/username"  value="<?php echo e(auth()->user()->twitter, false); ?>" type="text">
                        </div>
                      </div><!-- ./col-md-6 -->
                    </div><!-- End Row Form Group -->

                    <div class="row form-group mb-0">
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                              </div>
                              <input class="form-control" name="instagram" placeholder="https://instagram.com/username"  value="<?php echo e(auth()->user()->instagram, false); ?>" type="text">
                            </div>
                          </div><!-- ./col-md-6 -->

                          <div class="col-md-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                </div>
                                <input class="form-control" name="youtube" placeholder="https://youtube.com/username"  value="<?php echo e(auth()->user()->youtube, false); ?>" type="text">
                              </div>
                            </div><!-- ./col-md-6 -->
                          </div><!-- End Row Form Group -->

                          <div class="row form-group mb-0">
                              <div class="col-md-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fab fa-pinterest-p"></i></span>
                                    </div>
                                    <input class="form-control" name="pinterest" placeholder="https://pinterest.com/username"  value="<?php echo e(auth()->user()->pinterest, false); ?>" type="text">
                                  </div>
                                </div><!-- ./col-md-6 -->

                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-github"></i></span>
                                      </div>
                                      <input class="form-control" name="github" placeholder="https://github.com/username"  value="<?php echo e(auth()->user()->github, false); ?>" type="text">
                                    </div>
                                  </div><!-- ./col-md-6 -->
                            </div><!-- End Row Form Group -->

                            <div class="row form-group mb-0">
                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="bi-snapchat"></i></span>
                                      </div>
                                      <input class="form-control" name="snapchat" placeholder="https://www.snapchat.com/add/username"  value="<?php echo e(auth()->user()->snapchat, false); ?>" type="text">
                                    </div>
                                  </div><!-- ./col-md-6 -->

                                  <div class="col-md-6">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="bi-tiktok"></i></span>
                                        </div>
                                        <input class="form-control" name="tiktok" placeholder="https://www.tiktok.com/@username"  value="<?php echo e(auth()->user()->tiktok, false); ?>" type="text">
                                      </div>
                                    </div><!-- ./col-md-6 -->
                              </div><!-- End Row Form Group -->

                              <div class="row form-group mb-0">
                                  <div class="col-md-6">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="bi-telegram"></i></span>
                                        </div>
                                        <input class="form-control" name="telegram" placeholder="https://t.me/username"  value="<?php echo e(auth()->user()->telegram, false); ?>" type="text">
                                      </div>
                                    </div><!-- ./col-md-6 -->

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi-twitch"></i></span>
                                          </div>
                                          <input class="form-control" name="twitch" placeholder="https://www.twitch.tv/username"  value="<?php echo e(auth()->user()->twitch, false); ?>" type="text">
                                        </div>
                                      </div><!-- ./col-md-6 -->
                                </div><!-- End Row Form Group -->

                                <div class="row form-group mb-0">
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi-discord"></i></span>
                                          </div>
                                          <input class="form-control" name="discord" placeholder="https://discord.gg/username"  value="<?php echo e(auth()->user()->discord, false); ?>" type="text">
                                        </div>
                                      </div><!-- ./col-md-6 -->

                                      <div class="col-md-6">
                                          <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fab fa-vk"></i></span>
                                            </div>
                                            <input class="form-control" name="vk" placeholder="https://vk.com/username"  value="<?php echo e(auth()->user()->vk, false); ?>" type="text">
                                          </div>
                                        </div><!-- ./col-md-6 -->
                                  </div><!-- End Row Form Group -->

                                  <div class="row form-group mb-0">
                                      <div class="col-md-6">
                                          <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="bi-reddit"></i></span>
                                            </div>
                                            <input class="form-control" name="reddit" placeholder="https://reddit.com/user/username"  value="<?php echo e(auth()->user()->reddit, false); ?>" type="text">
                                          </div>
                                        </div><!-- ./col-md-6 -->

                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi-spotify"></i></span>
                                              </div>
                                              <input class="form-control" name="spotify" placeholder="https://spotify.com/username"  value="<?php echo e(auth()->user()->spotify, false); ?>" type="text">
                                            </div>
                                          </div><!-- ./col-md-6 -->

                                          <div class="col-md-6">
                                            <div class="input-group mb-4">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi-threads"></i></span>
                                              </div>
                                              <input class="form-control" name="threads" placeholder="https://threads.net/username"  value="<?php echo e(auth()->user()->threads, false); ?>" type="text">
                                            </div>
                                          </div><!-- ./col-md-6 -->

                                          <div class="col-md-6">
                                            <div class="input-group mb-4">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-kickstarter"></i></span>
                                              </div>
                                              <input class="form-control" name="kick" placeholder="https://kick.com/username"  value="<?php echo e(auth()->user()->kick, false); ?>" type="text">
                                            </div>
                                          </div><!-- ./col-md-6 -->
                                    </div><!-- End Row Form Group -->

                                    

                          <div class="form-group">
                            <label class="w-100"><i class="fa fa-bullhorn text-muted"></i> <?php echo e(trans('users.your_story'), false); ?> *
                              <span id="the-count" class="float-right d-inline">
                                <span id="current"></span>
                                <span id="maximum">/ <?php echo e($settings->story_length, false); ?></span>
                              </span>
                            </label>
                            <textarea name="story" id="story" rows="5" cols="40" class="form-control textareaAutoSize scrollError"><?php echo e(auth()->user()->story ? auth()->user()->story : old('story'), false); ?></textarea>

                          </div><!-- End Form Group -->
                        <?php endif; ?>

                          <!-- Alert -->
                          <div class="alert alert-danger my-3 display-none" id="errorUdpateEditPage">
                           <ul class="list-unstyled m-0" id="showErrorsUdpatePage"><li></li></ul>
                         </div><!-- Alert -->

                          <button class="btn btn-1 btn-success btn-block" data-msg-success="<?php echo e(trans('admin.success_update'), false); ?>" id="saveChangesEditPage" type="submit"><i></i> <?php echo e(trans('general.save_changes'), false); ?></button>
                  </form>
                </div><!-- end col-md-6 -->
              </div>
            </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
  <script src="<?php echo e(asset('public/plugins/datepicker/bootstrap-datepicker.js'), false); ?>"></script>
  <?php if(config('app.locale') != 'en'): ?>
    <script src="<?php echo e(asset('public/plugins/datepicker/locales/bootstrap-datepicker.'.config('app.locale').'.js'), false); ?>"></script>
  <?php endif; ?>

  <script src="<?php echo e(asset('public/plugins/select2/select2.full.min.js'), false); ?>" type="text/javascript"></script>
  <script src="<?php echo e(asset('public/plugins/select2/i18n/'.config('app.locale').'.js'), false); ?>" type="text/javascript"></script>

<script type="text/javascript">

<?php if(auth()->user()->verified_id == 'yes'): ?>
$('#current').html($('#story').val().length);
<?php endif; ?>

$('.categoriesMultiple').select2({
  tags: false,
  tokenSeparators: [','],
  maximumSelectionLength: <?php echo e($settings->limit_categories, false); ?>,
  placeholder: '<?php echo e(trans('admin.categories'), false); ?>',
  language: {
    maximumSelected: function() {
      return "<?php echo e(trans('general.maximum_selected_categories', ['limit' => $settings->limit_categories]), false); ?>";
    },
    searching: function() {
      return "<?php echo e(trans('general.searching'), false); ?>";
    },
    noResults: function () {
          return '<?php echo e(trans('general.no_results'), false); ?>';
        }
  }
});

$('.datepicker').datepicker({
    format: '<?php echo e(Helper::formatDatepicker(true), false); ?>',
    startDate: '01/01/1920',
    endDate: '<?php echo e(now()->subYears(18)->format(Helper::formatDatepicker()), false); ?>',
    language: '<?php echo e(config('app.locale'), false); ?>'
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/edit_my_page.blade.php ENDPATH**/ ?>