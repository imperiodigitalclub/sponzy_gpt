<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Installer</title>
    <link href="<?php echo e(asset('public/css/core.min.css'), false); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/bootstrap.min.css'), false); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/styles.css'), false); ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo e(url('public/img/favicon.png'), false); ?>" />
  </head>
  <body class="bg-primary">
  		<main role="main">
        <div class="jumbotron m-0 bg-primary" style="padding: 40px 0">
          <div class="container pt-lg-md">
            <div class="row justify-content-center">
              <div class="col-lg-5">
                <div class="card bg-light shadow border-0">

                <div class="card-header bg-white py-4">
                  <h4 class="text-center mb-0 font-weight-bold">
                    Welcome to Installer
                  </h4>
                  <small class="btn-block text-center mt-2">Server Requirements</small>
                </div>

                  <div class="card-body px-lg-5 py-lg-5">

                    <div class="card shadow-sm">
                  			<div class="list-group list-group-sm list-group-flush">

                          <div class="list-group-item d-flex justify-content-between">
                							<div>
                									<span>PHP Version: <?php echo e(phpversion(), false); ?>

                                    <small class="w-100 d-block">Version required: <?php echo e($minVersionPHP, false); ?></small>
                                  </span>
                							</div>
                							<div>
                									<i class="fas fa-<?php echo e($versionPHP ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
                							</div>
                					</div><!--- ./ list-group-item -->

									<div class="list-group-item d-flex justify-content-between">
										<div>
												<span>Ctype</span>
										</div>
										<div>
												<i class="fas fa-<?php echo e($Ctype ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
										</div>
								</div><!--- ./ list-group-item -->

								<div class="list-group-item d-flex justify-content-between">
									<div>
											<span>cURL</span>
									</div>
									<div>
											<i class="fas fa-<?php echo e($curl ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
									</div>
							</div><!--- ./ list-group-item -->

                          <div class="list-group-item d-flex justify-content-between">
                							<div>
                									<span>DOM</span>
                							</div>
                							<div>
                									<i class="fas fa-<?php echo e($dom ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
                							</div>
                					</div><!--- ./ list-group-item -->

                          

                          <div class="list-group-item d-flex justify-content-between">
                							<div>
                									<span>Fileinfo</span>
                							</div>
                							<div>
                									<i class="fas fa-<?php echo e($Fileinfo ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
                							</div>
                					</div><!--- ./ list-group-item -->

									<div class="list-group-item d-flex justify-content-between">
										<div>
												<span>Filter</span>
										</div>
										<div>
												<i class="fas fa-<?php echo e($filter ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
										</div>
								</div><!--- ./ list-group-item -->

								<div class="list-group-item d-flex justify-content-between">
									<div>
											<span>Hash</span>
									</div>
									<div>
											<i class="fas fa-<?php echo e($hash ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
									</div>
							</div><!--- ./ list-group-item -->

							<div class="list-group-item d-flex justify-content-between">
								<div>
										<span>Mbstring</span>
								</div>
								<div>
										<i class="fas fa-<?php echo e($mbstring ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
								</div>
						</div><!--- ./ list-group-item -->

                          <div class="list-group-item d-flex justify-content-between">
                							<div>
                									<span>Openssl</span>
                							</div>
                							<div>
                									<i class="fas fa-<?php echo e($openssl ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
                							</div>
                					</div><!--- ./ list-group-item -->

									<div class="list-group-item d-flex justify-content-between">
										<div>
												<span>PCRE</span>
										</div>
										<div>
												<i class="fas fa-<?php echo e($pcre ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
										</div>
								</div><!--- ./ list-group-item -->

                          <div class="list-group-item d-flex justify-content-between">
                							<div>
                									<span>PDO</span>
                							</div>
                							<div>
                									<i class="fas fa-<?php echo e($pdo ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
                							</div>
                					</div><!--- ./ list-group-item -->

									<div class="list-group-item d-flex justify-content-between">
										<div>
												<span>Session</span>
										</div>
										<div>
												<i class="fas fa-<?php echo e($session ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
										</div>
								</div><!--- ./ list-group-item -->

                          <div class="list-group-item d-flex justify-content-between">
                							<div>
                									<span>Tokenizer</span>
                							</div>
                							<div>
                									<i class="fas fa-<?php echo e($tokenizer ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
                							</div>
                					</div><!--- ./ list-group-item -->

                          <div class="list-group-item d-flex justify-content-between">
                							<div>
                									<span>XML</span>
                							</div>
                							<div>
                									<i class="fas fa-<?php echo e($xml ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
                							</div>
                					</div><!--- ./ list-group-item -->

                          <div class="list-group-item d-flex justify-content-between">
                							<div>
                									<span>GD</span>
                							</div>
                							<div>
                									<i class="fas fa-<?php echo e($gd ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
                							</div>
                					</div><!--- ./ list-group-item -->

                          <div class="list-group-item d-flex justify-content-between">
                							<div>
                									<span>Exif</span>
                							</div>
                							<div>
                									<i class="fas fa-<?php echo e($exif ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
                							</div>
                					</div><!--- ./ list-group-item -->

                          <div class="list-group-item d-flex justify-content-between">
                							<div>
                									<span>Allow_url_fopen</span>
                							</div>
                							<div>
                									<i class="fas fa-<?php echo e($allow_url_fopen ? 'check-circle text-success' : 'times-circle text-danger', false); ?>"></i>
                							</div>
                					</div><!--- ./ list-group-item -->

                        </div>
                      </div>

                      <?php if($versionPHP
                          && $dom
                          && $Ctype
                          && $Fileinfo
                          && $openssl
                          && $pdo
                          && $mbstring
                          && $tokenizer
                          && $hash
                          && $xml
                          && $curl
                          && $gd
                          && $exif
						  && $session
						  && $filter
                          && $allow_url_fopen
						  && $pcre
                          ): ?>
                          <a href="<?php echo e(url('install/script/database'), false); ?>" class="d-none btn btn-primary my-4 w-100">Setup Database and App <i class="fa fa-long-arrow-alt-right ml-1"></i></a>
                        <?php else: ?>
                          <div class="alert alert-danger mt-3" role="alert">
                            <i class="fa fa-exclamation-triangle"></i> You must meet all the requirements to be able to install, enable or install the extensions marked in red or update your PHP version
                          </div>
                      <?php endif; ?>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
  </body>
</html>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/installer/requirements.blade.php ENDPATH**/ ?>