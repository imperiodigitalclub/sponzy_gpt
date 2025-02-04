<?php $__env->startComponent('mail::message'); ?>

<?php if(! empty($greeting)): ?>
# <?php echo e($greeting, false); ?>

<?php else: ?>
# <?php echo app('translator')->get('emails.hello'); ?>
<?php endif; ?>


<?php $__currentLoopData = $introLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo e($line, false); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php if(isset($actionText)): ?>
<?php $__env->startComponent('mail::button', ['url' => $actionUrl]); ?>
<?php echo e($actionText, false); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>


<?php $__currentLoopData = $outroLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo e($line, false); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php if(! empty($salutation)): ?>
<?php echo e($salutation, false); ?>

<?php else: ?>
<?php echo app('translator')->get('emails.regards'); ?><br>
<?php echo e(config('app.name'), false); ?>

<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/vendor/notifications/email.blade.php ENDPATH**/ ?>