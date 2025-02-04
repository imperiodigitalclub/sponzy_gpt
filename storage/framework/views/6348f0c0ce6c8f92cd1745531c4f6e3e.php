<?php $__env->startSection('content'); ?>
  <!-- jumbotron -->
  <div class="jumbotron homepage m-0 bg-gradient">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 second">
          <h1 class="display-4 pt-5 mb-3 text-white text-center-sm"><?php echo e(__('general.welcome_title'), false); ?></h1>
          <p class="text-white text-center-sm"><?php echo e(__('general.subtitle_welcome'), false); ?></p>
          <p>
            <a href="<?php echo e(url('creators'), false); ?>" class="btn btn-lg btn-main btn-outline-light btn-w-mb px-4 mr-2" role="button"><?php echo e(__('general.explore'), false); ?></a>

            <a class="btn btn-lg btn-main btn-light btn-w px-4 toggleRegister btn-arrow" href="<?php echo e($settings->registration_active == '1' ? url('signup') : url('login'), false); ?>">
              <?php echo e(__('general.getting_started'), false); ?></a>
          </p>
        </div>
        <div class="col-lg-8 first">
          <img src="<?php echo e(url('public/img', $settings->home_index), false); ?>" class="img-center img-fluid">
        </div>
      </div>
    </div>
  </div>
  <!-- ./ jumbotron -->

  <div class="section py-5 py-large">
    <div class="container">
        <div class="btn-block text-center mb-5">
          <h1 class="txt-black"><?php echo e(__('general.header_box_2'), false); ?></h1>
          <p>
            <?php echo e(__('general.desc_box_2'), false); ?>

          </p>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <div class="text-center">
                <img src="<?php echo e(url('public/img', $settings->img_1), false); ?>" class="img-center img-fluid" width="200">
                <h4 class="mt-1 txt-black"><?php echo e(__('general.card_1'), false); ?></h4>
                <p class="text-muted mt-1"><?php echo e(__('general.desc_card_1'), false); ?></p>
              </div>
          </div>

          <div class="col-lg-4">
            <div class="text-center">
              <img src="<?php echo e(url('public/img', $settings->img_2), false); ?>" class="img-center img-fluid" width="200">
              <h4 class="mt-1 txt-black"><?php echo e(__('general.card_2'), false); ?></h4>
              <p class="text-muted mt-1"><?php echo e(__('general.desc_card_2'), false); ?></p>
            </div>
        </div>

        <div class="col-lg-4">
          <div class="text-center">
            <img src="<?php echo e(url('public/img', $settings->img_3), false); ?>" class="img-center img-fluid" width="200">
            <h4 class="mt-1 txt-black"><?php echo e(__('general.card_3'), false); ?></h4>
            <p class="text-muted mt-1"><?php echo e(__('general.desc_card_3'), false); ?></p>
          </div>
      </div>

      </div>
    </div>
  </div>

  <!-- Create profile -->
  <div class="section py-5 py-large">
    <div class="container">
      <div class="row align-items-center">
      <div class="col-12 col-lg-7 text-center mb-3">
        <img src="<?php echo e(url('public/img', $settings->img_4), false); ?>" alt="User" class="img-fluid">
      </div>
      <div class="col-12 col-lg-5">
        <h1 class="m-0 card-profile txt-black"><?php echo e(__('general.header_box_3'), false); ?></h1>
        <div class="col-lg-9 col-xl-8 p-0">
          <p class="py-4 m-0 text-muted"><?php echo e(__('general.desc_box_3'), false); ?></p>
        </div>
        <a href="<?php echo e($settings->registration_active == '1' ? url('signup') : url('login'), false); ?>" class="btn-arrow btn btn-lg btn-main btn-outline-primary btn-w px-4">
          <?php echo e(__('general.getting_started'), false); ?>

        </a>
      </div>
    </div>
    </div><!-- End Container -->
  </div><!-- End Section -->

<?php if($settings->widget_creators_featured == 'on'): ?>

    <?php if($users->count() != 0): ?>
    <!-- Users -->
    <div class="section py-5 py-large">
      <div class="container">
        <div class="btn-block text-center mb-5">
          <h1 class="txt-black"><?php echo e(__('general.creators_featured'), false); ?></h1>
          <p>
            <?php echo e(__('general.desc_creators_featured'), false); ?>

          </p>
        </div>
        <div class="row">

          <div class="owl-carousel owl-theme">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php echo $__env->make('includes.listing-creators', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <?php if(!$settings->disable_creators_section): ?>
            <?php if($usersTotal > $users->total()): ?>
            <div class="w-100 text-center mt-4 px-lg-0 px-3">
              <a href="<?php echo e(url('creators'), false); ?>" class="btn-arrow btn btn-lg btn-main btn-outline-primary btn-w px-4">
                <?php echo e(__('general.view_all_creators'), false); ?>

              </a>
            </div>
            <?php endif; ?>
          <?php endif; ?>
        </div><!-- End Row -->
      </div><!-- End Container -->
    </div><!-- End Section -->
  <?php endif; ?>
<?php endif; ?>

  <?php if($settings->show_counter == 'on'): ?>
  <!-- Counter -->
  <div class="section py-2 bg-gradient text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="d-flex py-3 my-1 my-lg-0 justify-content-center">
            <span class="mr-3 display-4"><i class="bi bi-people align-baseline"></i></span>
            <div>
              <h3 class="mb-0"><?php echo Helper::formatNumbersStats($usersTotal); ?></h3>
              <h5><?php echo e(__('general.creators'), false); ?></h5>
            </div>
          </div>

        </div>
        <div class="col-md-4">
          <div class="d-flex py-3 my-1 my-lg-0 justify-content-center">
            <span class="mr-3 display-4"><i class="bi bi-images align-baseline"></i></span>
            <div>
              <h3 class="mb-0"><?php echo Helper::formatNumbersStats(Updates::count()); ?></h3>
              <h5 class="font-weight-light"><?php echo e(__('general.content_created'), false); ?></h5>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex py-3 my-1 my-lg-0 justify-content-center">
            <span class="mr-3 display-4"><i class="bi bi-cash-coin align-baseline"></i></span>
            <div>
              <h3 class="mb-0"><?php if($settings->currency_position == 'left'): ?> <?php echo e($settings->currency_symbol, false); ?><?php endif; ?><?php echo Helper::formatNumbersStats(Transactions::whereApproved('1')->sum('earning_net_user')); ?><?php if($settings->currency_position == 'right'): ?><?php echo e($settings->currency_symbol, false); ?> <?php endif; ?></h3>
              <h5 class="font-weight-light"><?php echo e(__('general.earnings_of_creators'), false); ?></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if($settings->earnings_simulator == 'on'): ?>
<!-- Earnings simulator -->
<div class="section py-5 py-large">
  <div class="container mb-4">
    <div class="btn-block text-center">
      <h1 class="txt-black"><?php echo e(__('general.earnings_simulator'), false); ?></h1>
      <p>
        <?php echo e(__('general.earnings_simulator_subtitle'), false); ?>

      </p>
    </div>
    <div class="row">
      <div class="col-md-6">
        <label for="rangeNumberFollowers" class="w-100">
          <?php echo e(__('general.number_followers'), false); ?>

          <i class="feather icon-facebook mr-1"></i>
          <i class="feather icon-twitter mr-1"></i>
          <i class="feather icon-instagram"></i>
          <span class="float-right">
            #<span id="numberFollowers">1000</span>
          </span>
        </label>
        <input type="range" class="custom-range" value="0" min="1000" max="1000000" id="rangeNumberFollowers" onInput="$('#numberFollowers').html($(this).val())">
      </div>

      <div class="col-md-6">
        <label for="rangeMonthlySubscription" class="w-100"><?php echo e(__('general.monthly_subscription_price'), false); ?>

          <span class="float-right">
            <?php echo e($settings->currency_position == 'left' ? $settings->currency_symbol : null, false); ?><span id="monthlySubscription"><?php echo e($settings->min_subscription_amount, false); ?></span><?php echo e($settings->currency_position == 'right' ? $settings->currency_symbol : null, false); ?>

        </span>
        </label>
        <input type="range" class="custom-range" value="0" onInput="$('#monthlySubscription').html($(this).val())" min="<?php echo e($settings->min_subscription_amount, false); ?>" max="<?php echo e($settings->max_subscription_amount, false); ?>" id="rangeMonthlySubscription">
      </div>

      <div class="col-md-12 text-center mt-4">
        <h3 class="font-weight-light"><?php echo e(__('general.earnings_simulator_subtitle_2'), false); ?>

          <span class="font-weight-bold"><span id="estimatedEarn"></span> <small><?php echo e($settings->currency_code, false); ?></small></span>
          <?php echo e(__('general.per_month'), false); ?>*</h3>
        <p class="mb-1">
          * <?php echo e(__('general.earnings_simulator_subtitle_3'), false); ?>

        </p>
        <?php if($settings->fee_commission != 0): ?>
          <small class="w-100 d-block">* <?php echo e(__('general.include_platform_fee', ['percentage' => $settings->fee_commission]), false); ?></small>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

    <div class="jumbotron m-0 text-white text-center bg-gradient">
      <div class="container position-relative">
        <h1><?php echo e(__('general.head_title_bottom'), false); ?></h1>
        <p><?php echo e(__('general.head_title_bottom_desc'), false); ?></p>
        <p>
          <a href="<?php echo e(url('creators'), false); ?>" class="btn btn-lg btn-main btn-outline-light btn-w-mb px-4 mr-2" role="button"><?php echo e(__('general.explore'), false); ?></a>
          <a class="btn-arrow btn btn-lg btn-main btn-light btn-w px-4 toggleRegister" href="<?php echo e($settings->registration_active == '1' ? url('signup') : url('login'), false); ?>" role="button">
          <?php echo e(__('general.getting_started'), false); ?>

        </a>
        </p>
      </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

  <?php if($settings->earnings_simulator == 'on'): ?>
  <script type="text/javascript">

  function decimalFormat(nStr)
  {
    <?php if($settings->decimal_format == 'dot'): ?>
     var $decimalDot = '.';
     var $decimalComma = ',';
     <?php else: ?>
     var $decimalDot = ',';
     var $decimalComma = '.';
     <?php endif; ?>

     <?php if($settings->currency_position == 'left'): ?>
     var currency_symbol_left = '<?php echo e($settings->currency_symbol, false); ?>';
     var currency_symbol_right = '';
     <?php else: ?>
     var currency_symbol_right = '<?php echo e($settings->currency_symbol, false); ?>';
     var currency_symbol_left = '';
     <?php endif; ?>

      nStr += '';
      var x = nStr.split('.');
      var x1 = x[0];
      var x2 = x.length > 1 ? $decimalDot + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
          var x1 = x1.replace(rgx, '$1' + $decimalComma + '$2');
      }
      return currency_symbol_left + x1 + x2 + currency_symbol_right;
    }

    function earnAvg() {
      var fee = <?php echo e($settings->fee_commission, false); ?>;
      <?php if($settings->currency_code == 'JPY'): ?>
       $decimal = 0;
      <?php else: ?>
       $decimal = 2;
      <?php endif; ?>

      var monthlySubscription = parseFloat($('#rangeMonthlySubscription').val());
      var numberFollowers = parseFloat($('#rangeNumberFollowers').val());

      var estimatedFollowers = (numberFollowers * 5 / 100)
      var followersAndPrice = (estimatedFollowers * monthlySubscription);
      var percentageAvgFollowers = (followersAndPrice * fee / 100);
      var earnAvg = followersAndPrice - percentageAvgFollowers;

      return decimalFormat(earnAvg.toFixed($decimal));
    }
   $('#estimatedEarn').html(earnAvg());

   $("#rangeNumberFollowers, #rangeMonthlySubscription").on('change', function() {

     $('#estimatedEarn').html(earnAvg());

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/index/home.blade.php ENDPATH**/ ?>