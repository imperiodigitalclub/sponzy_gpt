<?php $__env->startSection('title'); ?> <?php echo e(__('admin.dashboard'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi bi-speedometer2 mr-2"></i> <?php echo e(__('admin.dashboard'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(__('general.dashboard_desc'), false); ?></p>
        </div>
      </div>
      <div class="row">

        <div class="col-lg-12 mb-5 mb-lg-0">

          <div class="content">
            <div class="row">
              <div class="col-lg-4 mb-2">
                <div class="card">
                  <div class="card-body overflow-hidden position-relative">
                    <h4><i class="fas fa-hand-holding-usd mr-2 text-primary icon-dashboard"></i> <?php echo e(Helper::amountFormatDecimal($earningNetUser), false); ?></h4>
                    <small><?php echo e(__('admin.earnings_net'), false); ?></small>

                    <span class="icon-wrap icon--dashboard"><i class="fas fa-hand-holding-usd"></i></span>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-4 mb-2">
                <div class="card">
                  <div class="card-body overflow-hidden position-relative">
                    <h4><i class="fas fa-wallet mr-2 text-primary icon-dashboard"></i> <?php echo e(Helper::amountFormatDecimal(auth()->user()->balance), false); ?></h4>
                    <small><?php echo e(__('general.balance'), false); ?>

                      <?php if(auth()->user()->balance >= $settings->amount_min_withdrawal): ?>
                      <a href="<?php echo e(url('settings/withdrawals'), false); ?>" class="link-border"> <?php echo e(__('general.make_withdrawal'), false); ?></a>
                    <?php endif; ?>
                    </small>

                    <span class="icon-wrap icon--dashboard"><i class="fas fa-wallet"></i></span>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-4 mb-2">
                <div class="card">
                  <div class="card-body overflow-hidden position-relative">
                    <h4><i class="fas fa-users mr-2 text-primary icon-dashboard"></i> <span title="<?php echo e($subscriptionsActive, false); ?>"><?php echo e(Helper::formatNumber($subscriptionsActive), false); ?></span></h4>
                    <small><?php echo e(__('general.subscriptions_active'), false); ?></small>

                    <span class="icon-wrap icon--dashboard"><i class="fas fa-users"></i></span>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-4 mb-2">
                <div class="card">
                  <div class="card-body overflow-hidden position-relative">
                    <h4><i class="bi-arrow-repeat mr-2 text-primary icon-dashboard-2"></i> <?php echo e(Helper::amountFormatDecimal($earningNetSubscriptions), false); ?></h4>
                    <small><?php echo e(__('general.earnings_net_subscriptions'), false); ?></small>

                    <span class="icon-wrap icon--dashboard"><i class="bi-arrow-repeat"></i></span>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-4 mb-2">
                <div class="card">
                  <div class="card-body overflow-hidden position-relative">
                    <h4><i class="bi-coin mr-2 text-primary icon-dashboard-2"></i> <?php echo e(Helper::amountFormatDecimal($earningNetTips), false); ?></h4>
                    <small><?php echo e(__('general.earnings_net_tips'), false); ?></small>

                    <span class="icon-wrap icon--dashboard"><i class="bi-coin"></i></span>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-4 mb-2">
                <div class="card">
                  <div class="card-body overflow-hidden position-relative">
                    <h4><i class="bi-lock mr-2 text-primary icon-dashboard-2"></i> <?php echo e(Helper::amountFormatDecimal($earningNetPPV), false); ?></h4>
                    <small><?php echo e(__('general.earnings_net_ppv'), false); ?></small>

                    <span class="icon-wrap icon--dashboard"><i class="bi-lock"></i></span>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-4 mb-2">
                <div class="card">
                  <div class="card-body overflow-hidden position-relative">
                    <h6 class="<?php echo e($stat_revenue_today > 0 ? 'text-success' : 'text-danger', false); ?> text-revenue">
                      <?php echo e(Helper::amountFormatDecimal($stat_revenue_today), false); ?>

                      <small class="float-right ml-2">
                        <i class="bi bi-question-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.compared_yesterday'), false); ?>"></i>
                      </small>
                        <?php echo Helper::PercentageIncreaseDecrease($stat_revenue_today, $stat_revenue_yesterday); ?>

                    </h6>
                    <small><?php echo e(__('general.revenue_today'), false); ?></small>

                    <span class="icon-wrap icon--dashboard"><i class="bi bi-graph-up-arrow"></i></span>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-4 mb-2">
                <div class="card">
                  <div class="card-body overflow-hidden position-relative">
                    <h6 class="<?php echo e($stat_revenue_week > 0 ? 'text-success' : 'text-danger', false); ?> text-revenue">
                      <?php echo e(Helper::amountFormatDecimal($stat_revenue_week), false); ?>

                      <small class="float-right ml-2">
                        <i class="bi bi-question-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.compared_last_week'), false); ?>"></i>
                      </small>
                        <?php echo Helper::PercentageIncreaseDecrease($stat_revenue_week, $stat_revenue_last_week); ?>

                    </h6>
                    <small><?php echo e(__('general.revenue_week'), false); ?></small>

                    <span class="icon-wrap icon--dashboard"><i class="bi bi-graph-up-arrow"></i></span>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-4 mb-2">
                <div class="card">
                  <div class="card-body overflow-hidden position-relative">
                    <h6 class="<?php echo e($stat_revenue_month > 0 ? 'text-success' : 'text-danger', false); ?> text-revenue">
                      <?php echo e(Helper::amountFormatDecimal($stat_revenue_month), false); ?>

                      <small class="float-right ml-2">
                        <i class="bi bi-question-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.compared_last_month'), false); ?>"></i>
                      </small>
                        <?php echo Helper::PercentageIncreaseDecrease($stat_revenue_month, $stat_revenue_last_month); ?>

                    </h6>
                    <small><?php echo e(__('general.revenue_month'), false); ?></small>

                    <span class="icon-wrap icon--dashboard"><i class="bi bi-graph-up-arrow"></i></span>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-12 mt-3 py-4">
                 <div class="card">
                   <div class="card-body">

                    <div class="d-lg-flex d-block justify-content-between align-items-center mb-4">
                      <h4 class="mb-4 mb-lg-0"><?php echo e(__('general.earnings'), false); ?></h4>

                     <select class="custom-select mb-4 mb-lg-0 w-auto d-block filterEarnings">
                      <option selected="" value="month"><?php echo e(__('general.this_month'), false); ?></option>
                      <option value="last-month"><?php echo e(__('general.last_month'), false); ?></option>
                      <option value="year"><?php echo e(__('general.this_year'), false); ?></option>       
                    </select>
                    </div>
                     
                     <div class="d-block position-relative" style="height: 350px">
                        <div class="blocked display-none" id="loadChart">
                          <span class="d-flex justify-content-center align-items-center text-center w-100 h-100">
                           <i class="spinner-border spinner-border-sm mr-2 text-primary"></i> <?php echo e(__('general.loading'), false); ?>

                          </span>
                      </div>
                      <canvas id="Chart"></canvas>
                    </div>
                   </div>
                 </div>
              </div>
          
            <div class="col-md-6 mb-5 mb-lg-0">
              <div class="card shadow-sm">
                <div class="card-body pb-0">
                  <h6><?php echo e(__('admin.recent_subscriptions'), false); ?></h6>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped m-0">
                    <thead>
                      <tr>
                        <th scope="col"><?php echo e(__('general.subscriber'), false); ?></th>
                        <th scope="col"><?php echo e(__('admin.date'), false); ?></th>
                        <th scope="col"><?php echo e(__('admin.status'), false); ?></th>
                      </tr>
                    </thead>
            
                    <tbody>
            
                      <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td>
                          <?php if(! isset($subscription->subscriber->username)): ?>
                          <?php echo e(__('general.no_available'), false); ?>

                          <?php else: ?>
                          <a href="<?php echo e(url($subscription->subscriber->username), false); ?>" class="mr-1">
                            <img src="<?php echo e(Helper::getFile(config('path.avatar').$subscription->subscriber->avatar), false); ?>" width="35"
                              height="35" class="rounded-circle mr-2">
            
                            <?php echo e($subscription->subscriber->hide_name == 'yes' ? $subscription->subscriber->username :
                            $subscription->subscriber->name, false); ?>

                          </a>
            
                          <a href="<?php echo e(url('messages/'.$subscription->subscriber->id, $subscription->subscriber->username), false); ?>"
                            title="<?php echo e(__('general.message'), false); ?>">
                            <i class="feather icon-send mr-1 mr-lg-0"></i>
                          </a>
                          <?php endif; ?>
                        </td>
                        <td><?php echo e(Helper::formatDate($subscription->created_at), false); ?></td>
                        </td>            
                        <td>
                          <?php if($subscription->stripe_id == ''
                          && strtotime($subscription->ends_at) > strtotime(now()->format('Y-m-d H:i:s'))
                          && $subscription->cancelled == 'no'
                          || $subscription->stripe_id != '' && $subscription->stripe_status == 'active'
                          || $subscription->stripe_id == '' && $subscription->free == 'yes'
                          ): ?>
                          <span class="badge badge-pill badge-success text-uppercase"><?php echo e(__('general.active'), false); ?></span>
                          <?php elseif($subscription->stripe_id != '' && $subscription->stripe_status == 'incomplete'): ?>
                          <span class="badge badge-pill badge-warning text-uppercase"><?php echo e(__('general.incomplete'), false); ?></span>
                          <?php else: ?>
                          <span class="badge badge-pill badge-danger text-uppercase"><?php echo e(__('general.cancelled'), false); ?></span>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      <?php if($subscriptions->isEmpty()): ?>
                      <tr>
                        <td colspan="12" class="text-center"><?php echo e(__('users.not_subscribers'), false); ?></td>
                      </tr>
                      <?php endif; ?>

                    </tbody>
                  </table>
                </div>

                <?php if($subscriptions->isNotEmpty()): ?>
                <div class="card-footer">
                  <a href="<?php echo e(url('my/subscribers'), false); ?>" class="text-muted font-weight-medium d-flex align-items-center justify-content-center arrow">
                    <?php echo e(__('general.view_all'), false); ?>

                  </a>
                </div>
                <?php endif; ?>
              </div><!-- card -->
            </div><!-- end col-md-6 -->

            <div class="col-md-6 mb-5 mb-lg-0">
              <div class="card shadow-sm">
                <div class="card-body pb-0">
                  <h6><?php echo e(__('general.payments_received'), false); ?></h6>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped m-0">
                    <thead>
                      <tr>
                        <th scope="col"><?php echo e(__('admin.date'), false); ?></th>
                        <th scope="col"><?php echo e(__('admin.amount'), false); ?></th>
                        <th scope="col"><?php echo e(__('admin.type'), false); ?></th>
                        <th scope="col"><?php echo e(__('general.earnings'), false); ?></th>
                      </tr>
                    </thead>
            
                    <tbody>
            
                      <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e(Helper::formatDate($transaction->created_at), false); ?></td>
                        <td><?php echo e(Helper::amountFormatDecimal($transaction->amount), false); ?></td>
                        <td>
                          <?php echo e(__('general.'.$transaction->type), false); ?>


                          <?php if(isset($transaction->gift->id) && request()->is('my/payments/received')): ?>
                          <span class="d-block mt-2">
                            <img src="<?php echo e(url('public/img/gifts', $transaction->gift->image), false); ?>" width="25">
                          </span>
                          <?php endif; ?>
                      </td>
                      <td>
                        <?php echo e(Helper::amountFormatDecimal($transaction->earning_net_user), false); ?>

  
                        <?php if($transaction->percentage_applied): ?>
                          <a tabindex="0" role="button" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="<?php echo e(trans('general.percentage_applied'), false); ?> <?php echo e($transaction->percentage_applied, false); ?> <?php echo e(trans('general.platform'), false); ?> <?php if($transaction->direct_payment): ?> (<?php echo e(__('general.direct_payment'), false); ?>) <?php endif; ?>">
                            <i class="far fa-question-circle"></i>
                          </a>
                        <?php endif; ?>
                        
                      </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      <?php if($transactions->isEmpty()): ?>
                      <tr>
                        <td colspan="12" class="text-center"><?php echo e(__('general.not_payment_received'), false); ?></td>
                      </tr>
                      <?php endif; ?>

                    </tbody>
                  </table>
                </div>

                <?php if($transactions->isNotEmpty()): ?>
                <div class="card-footer">
                  <a href="<?php echo e(url('my/payments/received'), false); ?>" class="text-muted font-weight-medium d-flex align-items-center justify-content-center arrow">
                    <?php echo e(__('general.view_all'), false); ?>

                  </a>
                </div>
                <?php endif; ?>

              </div><!-- card -->
            </div><!-- end col-md-6 -->

            </div><!-- end row -->
          </div><!-- end content -->

        </div><!-- end col-lg-12 -->

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
  <script src="<?php echo e(asset('public/js/Chart.min.js'), false); ?>"></script>

  <script type="text/javascript">

function decimalFormat(nStr)
{
  <?php if($settings->decimal_format == 'dot'): ?>
	 $decimalDot = '.';
	 $decimalComma = ',';
	 <?php else: ?>
	 $decimalDot = ',';
	 $decimalComma = '.';
	 <?php endif; ?>

   switch ('<?php echo e($settings->currency_position, false); ?>') {
     case 'left':
     var currency_symbol_left = '<?php echo e($settings->currency_symbol, false); ?>';
     var currency_symbol_right = '';
     break;

     case 'left_space':
     var currency_symbol_left = '<?php echo e($settings->currency_symbol, false); ?> ';
     var currency_symbol_right = '';
     break;

     case 'right':
     var currency_symbol_right = '<?php echo e($settings->currency_symbol, false); ?>';
     var currency_symbol_left = '';
     break;

     case 'right_space':
     var currency_symbol_right = ' <?php echo e($settings->currency_symbol, false); ?>';
     var currency_symbol_left = '';
     break;

     default:
     var currency_symbol_right = '<?php echo e($settings->currency_symbol, false); ?>';
     var currency_symbol_left = '';
     break;
   }// End switch

    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? $decimalDot + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + $decimalComma + '$2');
    }
    return currency_symbol_left + x1 + x2 + currency_symbol_right;
  }

  function transparentize(color, opacity) {
			var alpha = opacity === undefined ? 0.5 : 1 - opacity;
			return Color(color).alpha(alpha).rgbString();
		}

  var init = document.getElementById("Chart").getContext('2d');

  const gradient = init.createLinearGradient(0, 0, 0, 300);
                    gradient.addColorStop(0, '<?php echo e($settings->color_default, false); ?>');
                    gradient.addColorStop(1, '<?php echo e($settings->color_default, false); ?>2b');

  const lineOptions = {
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        hitRadius: 5,
                        pointHoverBorderWidth: 3
                    }

  var ChartArea = new Chart(init, {
      type: 'line',
      data: {
          labels: [<?php echo $label; ?>],
          datasets: [{
              label: '<?php echo e(__('general.earnings'), false); ?>',
              backgroundColor: gradient,
              borderColor: '<?php echo e($settings->color_default, false); ?>',
              data: [<?php echo $data; ?>],
              borderWidth: 2,
              fill: true,
              lineTension: 0.4,
              ...lineOptions
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                    min: 0, // it is for ignoring negative step.
                     display: true,
                      maxTicksLimit: 8,
                      padding: 10,
                      beginAtZero: true,
                      callback: function(value, index, values) {
                          return '<?php if($settings->currency_position == 'left'): ?><?php echo e($settings->currency_symbol, false); ?><?php elseif($settings->currency_position == 'left_space'): ?><?php echo e($settings->currency_symbol, false); ?> <?php endif; ?>' + value + '<?php if($settings->currency_position == 'right'): ?><?php echo e($settings->currency_symbol, false); ?><?php elseif($settings->currency_position == 'right_space'): ?><?php echo e(' '.$settings->currency_symbol, false); ?><?php endif; ?>';
                      }
                  }
              }],
              xAxes: [{
                gridLines: {
                  display:false
                },
                display: true,
                ticks: {
                  maxTicksLimit: 15,
                  padding: 5,
                }
              }]
          },
          tooltips: {
            mode: 'index',
            intersect: false,
            reverse: true,
            backgroundColor: '#000',
            xPadding: 16,
            yPadding: 16,
            cornerRadius: 4,
            caretSize: 7,
              callbacks: {
                  label: function(t, d) {
                      var xLabel = d.datasets[t.datasetIndex].label;
                      var yLabel = t.yLabel == 0 ? decimalFormat(t.yLabel) : decimalFormat(t.yLabel.toFixed(2));
                      return xLabel + ': ' + yLabel;
                  }
              },
          },
          hover: {
            mode: 'index',
            intersect: false
          },
          legend: {
              display: false
          },
          responsive: true,
          maintainAspectRatio: false
      }
  });

//<<======= Get data Earnings Dashboard Creator
$(document).on('change','.filterEarnings', function(e) {
  var range = $(this).val();

  $(this).blur();
  
  $('#loadChart').show();

  $.ajax({
    url: URL_BASE+'/get/earnings/creator/' + range,
    success: function(data) {
      // Empty any previous chart data
      ChartArea.data.labels = [];
      ChartArea.data.datasets[0].data = [];
      
      ChartArea.data.labels = data.labels;
      ChartArea.data.datasets.forEach((dataset) => {
          dataset.data = data.datasets;
      });

      // Re-render the chart
      ChartArea.update();

      $('#loadChart').hide();
    }
  }).fail(function(jqXHR, ajaxOptions, thrownError) {
	  $('.popout').addClass('popout-error').html(error_reload_page).slideDown('500').delay('5000').slideUp('500');
    $('#loadChart').hide();
  });

});
  </script>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/dashboard.blade.php ENDPATH**/ ?>