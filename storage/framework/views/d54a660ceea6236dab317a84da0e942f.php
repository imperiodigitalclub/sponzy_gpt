<?php $__env->startSection('title'); ?> <?php echo e(__('general.referrals'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi bi-person-plus mr-2"></i> <?php echo e(__('general.referrals'), false); ?></h2>

          <?php if($settings->referral_system == 'on'): ?>

            <p class="lead text-muted mt-0">
              <?php echo e(__('general.referrals_welcome_desc', ['percentage' => $settings->percentage_referred]), false); ?>

              <small class="d-block">
                <?php if($settings->referral_transaction_limit <> 'unlimited'): ?>
                  * <?php echo e(trans_choice('general.total_transactions_per_referral', $settings->referral_transaction_limit, ['percentage' => $settings->percentage_referred, 'total' => $settings->referral_transaction_limit]), false); ?>

                <?php else: ?>
                  * <?php echo e(__('general.total_transactions_referral_unlimited', ['percentage' => $settings->percentage_referred]), false); ?>

                <?php endif; ?>

              </small>
            </p>

            <button class="d-none copy-url" id="copyLink" data-clipboard-text="<?php echo e(url(auth()->user()->username.'?ref='.auth()->user()->id), false); ?>"></button>
            <span>
              <span class="text-muted"><?php echo e(__('general.your_referral_link'), false); ?></span>

              <span class="text-break"><strong><?php echo e(url(auth()->user()->username.'?ref='.auth()->user()->id), false); ?></strong></span>

              <button class="btn btn-link e-none p-1 text-decoration-none" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('general.copy_link'), false); ?>" onclick="$('#copyLink').trigger('click')">
  							<i class="far fa-clone"></i>
  						</button>
            </span>
          <?php else: ?>
          <div class="alert alert-danger mt-3">
          <span class="alert-inner--text">
            <i class="fa fa-exclamation-triangle mr-1"></i> <?php echo e(__('general.referral_system_disabled'), false); ?>

          </span>
        </div>
          <?php endif; ?>

        </div>
      </div>
      <div class="row">

        <div class="col-lg-12 mb-5 mb-lg-0">

          <div class="content">
            <div class="row">
              <div class="col-lg-3 mb-2">
                <div class="card">
                  <div class="card-body">
                    <h5>
                      <i class="fas fa-hand-holding-usd mr-2 text-primary icon-dashboard"></i> <?php echo e(Helper::amountFormatDecimal(auth()->user()->balance), false); ?>

                    </h5>
                    <small><?php echo e(__('general.balance'), false); ?></small>
                    <?php if(auth()->user()->balance >= $settings->amount_min_withdrawal): ?>
                    <a href="<?php echo e(url('settings/withdrawals'), false); ?>" class="link-border color-link"> <?php echo e(__('general.make_withdrawal'), false); ?></a>

                    <?php else: ?>
                    <a href="javascript:;" class="link-border color-link text-muted" data-toggle="tooltip" title="<?php echo e(__('general.amount_min_withdrawal'), false); ?> <?php echo e(Helper::amountWithoutFormat($settings->amount_min_withdrawal), false); ?> <?php echo e($settings->currency_code, false); ?>">
                       <?php echo e(__('general.make_withdrawal'), false); ?>

                      </a>
                  <?php endif; ?>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-3 mb-2">
                <div class="card">
                  <div class="card-body">
                    <h5><i class="fas fa-users mr-2 text-primary icon-dashboard"></i> <?php echo e(number_format(auth()->user()->referrals()->count()), false); ?></h5>
                    <small><?php echo e(__('general.total_registered_users'), false); ?></small>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-3 mb-2">
                <div class="card">
                  <div class="card-body">
                    <h5><i class="fa fa-receipt mr-2 text-primary icon-dashboard"></i> <?php echo e(number_format(auth()->user()->referralTransactions()->count()), false); ?></h5>
                    <small><?php echo e(__('general.total_transactions'), false); ?></small>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-3 mb-2">
                <div class="card">
                  <div class="card-body">
                    <h5><i class="fas fa-hand-holding-usd mr-2 text-primary icon-dashboard"></i> <?php echo e(Helper::amountFormatDecimal(auth()->user()->referralTransactions()->sum('earnings')), false); ?></h5>
                    <small><?php echo e(__('general.earnings_total'), false); ?></small>
                  </div>
                </div><!-- card 1 -->
              </div><!-- col-lg-4 -->

              <div class="col-lg-12 mt-3 py-4">
                 <div class="card">
                   <div class="card-body">
                     <h4 class="mb-4"><?php echo e(__('admin.transactions'), false); ?></h4>

                     <div class="table-responsive">
                       <table class="table table-striped m-0">
                         <thead>
                           <tr>
                             <th scope="col"><?php echo e(__('admin.type'), false); ?></th>
                             <th scope="col"><?php echo e(__('admin.date'), false); ?></th>
                             <th scope="col"><?php echo e(__('general.earnings'), false); ?></th>
                           </tr>
                         </thead>

                         <tbody>

                        <?php if($transactions->count() != 0): ?>
                           <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referred): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <tr>
                               <td><?php echo e(__('general.'.$referred->type), false); ?></td>
                               <td><?php echo e(Helper::formatDate($referred->created_at), false); ?></td>
                               <td><?php echo e(Helper::amountFormatDecimal($referred->earnings), false); ?></td>
                             </tr>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         <?php else: ?>
                           <tr>
                             <td colspan="12" class="text-center"><?php echo e(__('general.no_transactions_yet'), false); ?></td>
                           </tr>
                          <?php endif; ?>

                         </tbody>
                       </table>
                     </div>
                   </div>
                 </div><!-- card -->

                 <?php if($transactions->hasPages()): ?>
         			    	<?php echo e($transactions->links(), false); ?>

         			    	<?php endif; ?>

              </div><!-- col-lg-12 -->

            </div><!-- end row -->
          </div><!-- end content -->

        </div><!-- end col-md-6 -->

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/referrals.blade.php ENDPATH**/ ?>