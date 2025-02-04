<?php $__env->startSection('title'); ?> <?php echo e(trans('general.block_countries'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
  <link href="<?php echo e(asset('public/plugins/select2/select2.min.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi bi-eye-slash mr-2"></i> <?php echo e(trans('general.block_countries'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(trans('general.block_countries_info'), false); ?></p>
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
              <?php echo e(session('status'), false); ?>

            </div>
          <?php endif; ?>

          <form method="POST" action="<?php echo e(url('block/countries'), false); ?>">

            <?php echo csrf_field(); ?>

              <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-globe"></i></span>
              </div>

              <select name="countries[]" multiple class="form-control" id="select2Countries">
                <?php $__currentLoopData = Countries::orderBy('country_name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php if(in_array($country->country_code, auth()->user()->blockedCountries())): ?> selected="selected" <?php endif; ?> value="<?php echo e($country->country_code, false); ?>">
                        <?php echo e($country->country_name, false); ?>

                      </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>

              <button class="btn btn-1 btn-success btn-block" onClick="this.form.submit(); this.disabled=true; this.innerText='<?php echo e(trans('general.please_wait'), false); ?>';" type="submit"><?php echo e(trans('general.save_changes'), false); ?></button>
          </form>
        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('public/plugins/select2/select2.full.min.js'), false); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/plugins/select2/i18n/'.config('app.locale').'.js'), false); ?>" type="text/javascript"></script>

<script type="text/javascript">
$('#select2Countries').select2({
  tags: false,
  tokenSeparators: [','],
  placeholder: '<?php echo e(trans('general.block_countries'), false); ?>',
  language: {
    searching: function() {
      return "<?php echo e(trans('general.searching'), false); ?>";
    },
    noResults: function () {
          return '<?php echo e(trans('general.no_results'), false); ?>';
        }
  }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/block_countries.blade.php ENDPATH**/ ?>