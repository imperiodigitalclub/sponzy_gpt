<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media  only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>



<body style="margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;" align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <!-- Logo -->
                    <tr>
                        <td style="padding: 25px 0; text-align: center;">
                            <a style="font-family: Arial, &#039;Helvetica Neue&#039;, Helvetica, sans-serif; font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;" href="http://localhost/gostock" target="_blank">
                              <?php echo e($settings->title, false); ?>

                            </a>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td style="width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;" width="100%">
                            <table style="width: auto; max-width: 570px; margin: 0 auto; padding: 0;" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="font-family: Arial, &#039;Helvetica Neue&#039;, Helvetica, sans-serif; padding: 35px;">
                                        <!-- Greeting -->
                                        <h1 style="margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;">
                                            <?php echo e(trans('emails.hello'), false); ?>

                                          </h1>

                                        <!-- Intro -->
                                          <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                                <?php echo e(trans('emails.password_reset_msg'), false); ?>

                                            </p>

                                        <!-- Action Button -->
                                      <table style="width: 100%; margin: 30px auto; padding: 0; text-align: center;" align="center" width="100%" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td align="center">

                                                        <a href="<?php echo e(url('password/reset', $token), false); ?>"
                                                            style="font-family: Arial, &#039;Helvetica Neue&#039;, Helvetica, sans-serif; display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3869D4;"
                                                            class="button"
                                                            target="_blank">
                                                            <?php echo e(trans('emails.password_reset'), false); ?>

                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>

                                        <!-- Outro -->
                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                          <?php echo e(trans('emails.password_reset_msg_2'), false); ?>

                                            </p>

                                        <!-- Salutation -->
                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                            <?php echo e(trans('emails.regards'), false); ?><br><?php echo e($settings->title, false); ?>

                                        </p>

                                        <!-- Sub Copy -->
                                        <table style="margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;">
                                                <tr>
                                                    <td style="font-family: Arial, &#039;Helvetica Neue&#039;, Helvetica, sans-serif;">
                                                        <p style="margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;">
                                                            <?php echo e(trans('emails.password_reset_msg_3'), false); ?>

                                                        </p>

                                                        <p style="margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;">
                                                            <a style="color: #3869D4;" href="<?php echo e(url('password/reset', $token), false); ?>" target="_blank">
                                                                <?php echo e(url('password/reset', $token), false); ?>

                                                            </a>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                      </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td>
                            <table style="width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="font-family: Arial, &#039;Helvetica Neue&#039;, Helvetica, sans-serif; color: #AEAEAE; padding: 35px; text-align: center;">
                                        <p style="margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;">
                                            &copy; <?php echo date('Y'); ?>
                                            <a style="color: #3869D4;" href="<?php echo e(url('/'), false); ?>" target="_blank"><?php echo e($settings->title, false); ?></a>.
                                            <?php echo e(trans('emails.rights_reserved'), false); ?>

                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/emails/password_reset.blade.php ENDPATH**/ ?>