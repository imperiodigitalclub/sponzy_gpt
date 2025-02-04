<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo e(__('error.error_404'), false); ?></title>
	<link href="<?php echo e(asset('public/css/core.min.css'), false); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('public/css/bootstrap.min.css'), false); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('public/css/styles.css'), false); ?>" rel="stylesheet">
	<link rel="shortcut icon" href="<?php echo e(url('public/img', config('settings.favicon')), false); ?>" />
</head>

<body>
	<div class="wrap-center">
		<div class="container">
			<div class="row">
				<div class="col-md-12 error-page text-center parallax-fade-top" style="top: 0px; opacity: 1;">
					<h1 class="text-break">404</h1>
					<p class="mt-3 mb-5 text-break"><?php echo e(__('error.error_404_subdescription'), false); ?></p>
					<a href="javascript:history.back();" class="error-link mt-5">
						<i class="fa fa-long-arrow-alt-left mr-2"></i> <?php echo e(__('auth.back'), false); ?>

					</a>
					<br>
					<a href="<?php echo e(url('/'), false); ?>" class="error-link mt-5"><?php echo e(__('error.go_home'), false); ?></a>
				</div>
			</div>
		</div>
	</div>
</body>
</html><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/errors/404.blade.php ENDPATH**/ ?>