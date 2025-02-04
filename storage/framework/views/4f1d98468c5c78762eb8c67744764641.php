<!-- Start Modal liveStreamingForm -->
<div class="modal fade" id="modalSchedulePost" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-white shadow border-0">

                    <div class="card-body px-lg-5 py-lg-5 position-relative">

                        <div class="mb-3">
                            <i class="bi-calendar mr-1"></i> <strong><?php echo e(__('general.schedule'), false); ?></strong>
                        </div>

                        <form action="javascript:void(0);">

                        <div class="form-group">
                            <input type="datetime-local" id="datetime" autocomplete="off" required value="" min="<?php echo e(now()->tomorrow()->addHours(8), false); ?>" max="<?php echo e(now()->addYear(), false); ?>" class="form-control" name="date" placeholder="<?php echo e(__('admin.date'), false); ?> *">

                            <small class="form-text display-none text-danger" id="scheduleAlert">
                                <i class="bi-exclamation-triangle-fill mr-1"></i> <strong><?php echo e(__('general.error_post_schedule'), false); ?></strong>
                            </small>
                        </div><!-- End form-group -->

                        <div class="text-center">
                            <button type="button" class="btn e-none mt-4"
                                data-dismiss="modal"><?php echo e(__('admin.cancel'), false); ?></button>
                            <button type="submit" class="btn btn-primary mt-4" id="btnSubmitSchedule"><i></i>
                                <?php echo e(__('general.confirm'), false); ?>

                            </button>
                        </div>

                        <div class="w-100 d-block text-center mt-3">
                            <small class="d-block w-100"><?php echo e(__('general.server_time_zone'), false); ?>: 
                                <a href="https://www.google.com/search?q=time+<?php echo e(str_replace('_', ' ', config('app.timezone')), false); ?>" target="_blank">
                                    <?php echo e(str_replace('_', ' ', config('app.timezone')), false); ?> <i class="bi-box-arrow-up-right ml-1"></i>
                                </a>
                            </small>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Modal liveStreamingForm --><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/includes/modal-scheduled-posts.blade.php ENDPATH**/ ?>