<?php $__env->startSection('title'); ?> <?php echo e(trans('general.verify_account'), false); ?> -<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('public/plugins/datepicker/datepicker3.css'), false); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo e(asset('public/plugins/select2/select2.min.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="feather icon-check-circle mr-2"></i> <?php echo e(trans('general.verify_account'), false); ?></h2>
          <p class="lead text-muted mt-0"><?php echo e(Auth::user()->verified_id != 'yes' ? trans('general.verified_account_desc') : trans('general.verified_account'), false); ?></p>
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

          <?php echo $__env->make('errors.errors-forms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if($settings->requests_verify_account == 'on'
            && auth()->user()->verified_id != 'yes'
            && auth()->user()->verificationRequests() != 1
            && auth()->user()->verified_id != 'reject'): ?>

          <div class="alert alert-warning mr-1">
          <span class="alert-inner--text"><i class="fa fa-exclamation-triangle"></i> <?php echo e(trans('general.warning_verification_info'), false); ?></span>
        </div>

        <form method="POST" id="formVerify" action="<?php echo e(url('settings/verify/account'), false); ?>" accept-charset="UTF-8" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>

          <!-- Step 1: Informações Básicas do Perfil -->
          <div id="step1" class="step" style="display: none;">
              <h4>Informações Básicas do Perfil</h4>

              <!-- Avatar Upload -->
              <?php if(auth()->user()->avatar == $settings->avatar): ?>
                    <div class="mb-4 text-center previewImageVerification">
                        <h6 class="text-muted"><?php echo e(trans('general.avatar'), false); ?></h6>
                        <input type="file" name="avatar" id="avatarUpload" accept="image/*" class="fileVerifiyAccount visibility-hidden">
                        <button class="btn btn-1 w-100 btn-outline-primary mb-2 border-dashed btnFilePhoto" type="button" id="btnAvatarUpload"><?php echo e(trans('general.upload_image'), false); ?> (JPG, PNG, GIF) - <?php echo e(trans('general.maximum'), false); ?>: <?php echo e(Helper::formatBytes($settings->file_size_allowed_verify_account * 1024), false); ?></button>
                        <span class="btn-block mb-2 previewImage" id="avatarPreview"></span>
                    </div>
                <?php endif; ?>

                <!-- Cover Upload -->
                <?php if(auth()->user()->cover == '' || auth()->user()->cover == $settings->cover_default): ?>
                    <div class="mb-4 text-center previewImageVerification">
                        <h6 class="text-muted"><?php echo e(trans('general.cover'), false); ?></h6>
                        <input type="file" name="cover" id="coverUpload" accept="image/*" class="fileVerifiyAccount visibility-hidden">
                        <button class="btn btn-1 w-100 btn-outline-primary mb-2 border-dashed btnFilePhoto" type="button" id="btnCoverUpload"><?php echo e(trans('general.upload_image'), false); ?> (JPG, PNG, GIF) - <?php echo e(trans('general.maximum'), false); ?>: <?php echo e(Helper::formatBytes($settings->file_size_allowed_verify_account * 1024), false); ?></button>
                        <span class="btn-block mb-2 previewImage" id="coverPreview"></span>
                    </div>
                <?php endif; ?>

                <!-- Birthdate Input -->
                <?php if(auth()->user()->birthdate == ''): ?>
                    <div class="mb-4 text-center">
                        <h6 class="text-muted"><?php echo e(trans('general.birthdate'), false); ?></h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                            </div>
                            <input class="form-control" id="birthdate" name="birthdate" placeholder="<?php echo e(trans('general.birthdate'), false); ?> *" 
                                value="<?php echo e(auth()->user()->birthdate, false); ?>" autocomplete="off" type="text" minlength="10" maxlength="10"
                                <?php if(auth()->user()->birthdate_changed == 'yes'): ?> disabled <?php endif; ?>>
                        </div>
                        <small class="form-text text-muted mb-4">
                            <?php echo e(trans('general.valid_formats'), false); ?> <strong><?php echo e(now()->subYears(18)->format('d/m/Y'), false); ?></strong> --
                            <strong>(<?php echo e(trans('general.birthdate_changed_info'), false); ?>)</strong>
                        </small>
                    </div>
                <?php endif; ?>

              <div class="text-right">
                <button type="button" class="btn btn-primary" onclick="nextStep(2)">Próxima</button>
              </div>
          </div>

          <!-- Step 2: Redes Sociais -->
          <div id="step2" class="step" style="display: none;">
              <h4>Redes Sociais</h4>

              <!-- Instagram Input -->
              <?php if(auth()->user()->instagram == ''): ?>
                    <div class="mb-4 text-center">
                        <h6 class="text-muted">Instagram</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                            </div>
                            <input class="form-control" id="instagram" name="instagram" placeholder="@Instagram *" value="<?php echo e(auth()->user()->instagram, false); ?>" type="text" required oninput="this.value = this.value.replace(/\s+/g, '')">
                        </div>
                    </div>
                <?php endif; ?>

                <!-- WhatsApp Input -->
                <?php if(auth()->user()->whatsapp == ''): ?>
                    <div class="mb-4 text-center">
                        <h6 class="text-muted">WhatsApp</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                            </div>
                            <input class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp *" value="<?php echo e(auth()->user()->whatsapp, false); ?>" type="text" minlength="14" required>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="text-right">
                  <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Voltar</button>
                  <button type="button" class="btn btn-primary" onclick="nextStep(3)">Próxima</button>
                </div>
          </div>

          <!-- Step 3: Documentos -->
          <div id="step3" class="step" style="display: none;">
              <h4>Documentos</h4>

              <!-- CPF Input -->
              <?php if(auth()->user()->cpf == ''): ?>
                    <div class="mb-4 text-center">
                        <h6 class="text-muted">CPF</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-id-badge"></i></span>
                            </div>
                            <input class="form-control" id="cpf" name="cpf" placeholder="CPF *" value="<?php echo e(auth()->user()->cpf, false); ?>" type="text" required minlength="14">
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Documento Input -->
                <?php if(auth()->user()->document == ''): ?>
                    <div class="mb-4 text-center">
                        <h6 class="text-muted">Documento</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                            </div>
                            <input class="form-control" maxlength="50" id="document" name="document" placeholder="Documento (RG / CNH / Passaporte) *" value="<?php echo e(auth()->user()->document, false); ?>" type="text" required>
                        </div>
                    </div>
                <?php endif; ?>

              <!-- Image Front -->
              <div class="mb-5 text-center previewImageVerification">
                  <h6 class="text-muted"><?php echo e(trans('general.info_verification_user'), false); ?></h6>
                    <input type="file" name="image" id="fileVerifiyAccount" accept="image/*" class="fileVerifiyAccount visibility-hidden">
                    <button class="btn btn-1 w-100 btn-outline-primary mb-2 border-dashed btnFilePhoto" type="button" id="btnFilePhoto"><?php echo e(trans('general.upload_image'), false); ?> (JPG, PNG, GIF) - <?php echo e(trans('general.maximum'), false); ?>: <?php echo e(Helper::formatBytes($settings->file_size_allowed_verify_account * 1024), false); ?></button>
                    <span class="btn-block mb-2 previewImage" id="previewImage"></span>
                </div>

                <!-- Image Reverse -->
                <div class="mb-5 text-center previewImageVerification">
                  <h6 class="text-muted"><?php echo e(trans('general.info_verification_user_reverse_id'), false); ?></h6>
                    <input type="file" name="image_reverse" id="fileVerifiyAccount" accept="image/*" class="fileVerifiyAccount visibility-hidden">
                    <button class="btn btn-1 w-100 btn-outline-primary mb-2 border-dashed btnFilePhoto" type="button" id="btnFilePhoto"><?php echo e(trans('general.upload_image'), false); ?> (JPG, PNG, GIF) - <?php echo e(trans('general.maximum'), false); ?>: <?php echo e(Helper::formatBytes($settings->file_size_allowed_verify_account * 1024), false); ?></button>
                    <span class="btn-block mb-2 previewImage" id="previewImage"></span>
                </div>

                <!-- Image Selfie -->
                <div class="mb-3 text-center previewImageVerification">
                  <h6 class="text-muted"><?php echo e(trans('general.info_verification_user_selfie', ['sitename' => $settings->title]), false); ?></h6>
                    <input type="file" name="image_selfie" id="fileVerifiyAccount" accept="image/*" class="fileVerifiyAccount visibility-hidden">
                    <button class="btn btn-1 w-100 btn-outline-primary mb-2 border-dashed btnFilePhoto" type="button" id="btnFilePhoto"><?php echo e(trans('general.upload_image'), false); ?> (JPG, PNG, GIF) - <?php echo e(trans('general.maximum'), false); ?>: <?php echo e(Helper::formatBytes($settings->file_size_allowed_verify_account * 1024), false); ?></button>
                    <span class="btn-block mb-2 previewImage" id="previewImage"></span>
                </div>

                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" required id="agreeTermsPrivacy" name="agree_terms_privacy" type="checkbox">
                  <label class="custom-control-label" for="agreeTermsPrivacy">
                    <span><?php echo e(__('general.i_agree_with'), false); ?> 
                      <a href="<?php echo e($settings->link_terms, false); ?>" target="_blank"><?php echo e(__('admin.terms_conditions'), false); ?></a>
                      <?php echo e(__('general.and'), false); ?>

                        <a href="<?php echo e($settings->link_privacy, false); ?>" target="_blank"><?php echo e(__('admin.privacy_policy'), false); ?></a>
                    </span>
                  </label>
                </div>

                <button class="btn btn-1 btn-success btn-block mt-5" id="sendData"><?php echo e(trans('general.send_approval'), false); ?></button>
          </div>
      </form>
        <?php elseif(auth()->user()->verificationRequests() == 1): ?>
          <div class="alert alert-primary alert-dismissible text-center fade show" role="alert">
            <span class="alert-inner--icon mr-2"><i class="fa fa-info-circle"></i></span>
          <span class="alert-inner--text"><?php echo e(trans('admin.pending_request_verify'), false); ?></span>
        </div>
      <?php elseif(auth()->user()->verified_id == 'reject'): ?>
        <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
          <span class="alert-inner--icon mr-2"><i class="fa fa-info-circle"></i></span>
        <span class="alert-inner--text"><?php echo e(trans('admin.rejected_request'), false); ?></span>
      </div>
    <?php elseif(auth()->user()->verified_id != 'yes' && $settings->requests_verify_account == 'off'): ?>
      <div class="alert alert-primary alert-dismissible text-center fade show" role="alert">
        <span class="alert-inner--icon mr-2"><i class="fa fa-info-circle"></i></span>
      <span class="alert-inner--text"><?php echo e(trans('general.info_receive_verification_requests'), false); ?></span>
    </div>

        <?php else: ?>
          <div class="alert alert-success alert-dismissible text-center fade show" role="alert">
            <span class="alert-inner--icon mr-2"><i class="feather icon-check-circle"></i></span>
          <span class="alert-inner--text"><?php echo e(trans('general.verified_account_success'), false); ?></span>
        </div>

        <?php endif; ?>

        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
const whatsappInput = document.getElementById('whatsapp');
const cpfInput = document.getElementById('cpf');
const birthdateInput = document.getElementById('birthdate');

if (whatsappInput) {
    whatsappInput.addEventListener('input', (evt) => {
        const inputValue = evt.target.value;
        const formattedValue = formatPhoneNumberInput(inputValue);
        evt.target.value = formattedValue;
    });
}

if (cpfInput) {
    cpfInput.addEventListener('input', (evt) => {
        const inputValue = evt.target.value;
        const formattedValue = formatCPFInput(inputValue);
        evt.target.value = formattedValue;
    });
}

if (birthdateInput) {
    birthdateInput.addEventListener('input', (evt) => {
        const inputValue = evt.target.value;
        const formattedValue = formatDateInput(inputValue);
        evt.target.value = formattedValue;
    });
}

function formatPhoneNumberInput(inputValue) {
    const numericValue = inputValue.replace(/\D/g, '');
    const maxLength = 11;
    const limitedValue = numericValue.substring(0, maxLength);

    let formattedValue = '';

    if (limitedValue.length > 2) {
        const ddd = limitedValue.substring(0, 2);
        formattedValue += `(${ddd})`;

        if (limitedValue.length > 2) {
            const phoneNumber = limitedValue.substring(2);

            if (phoneNumber.length > 4) {
                const part1 = phoneNumber.substring(0, phoneNumber.length - 4);
                const part2 = phoneNumber.substring(phoneNumber.length - 4);
                formattedValue += ` ${part1}-${part2}`;
            } else {
                formattedValue += ` ${phoneNumber}`;
            }
        }
    } else {
        formattedValue = limitedValue;
    }

    return formattedValue;
}

function formatCPFInput(inputValue) {
    const numericValue = inputValue.replace(/\D/g, '');
    const maxLength = 11;
    const limitedValue = numericValue.substring(0, maxLength);

    let formattedValue = '';
    if (limitedValue.length > 3) {
        formattedValue += limitedValue.substring(0, 3) + '.';

        if (limitedValue.length > 6) {
            formattedValue += limitedValue.substring(3, 6) + '.';

            if (limitedValue.length > 9) {
                formattedValue += limitedValue.substring(6, 9) + '-';
                formattedValue += limitedValue.substring(9);
            } else {
                formattedValue += limitedValue.substring(6);
            }
        } else {
            formattedValue += limitedValue.substring(3);
        }
    } else {
        formattedValue = limitedValue;
    }

    return formattedValue;
}

function formatDateInput(inputValue) {
    const numericValue = inputValue.replace(/\D/g, '');
    const maxLength = 8; // DDMMYYYY
    const limitedValue = numericValue.substring(0, maxLength);

    let formattedValue = '';

    // Validação do dia
    if (limitedValue.length > 0) {
        let day = limitedValue.substring(0, 2);
        if (parseInt(day) > 31) {
            day = '31';
        }
        formattedValue += day.length === 2 ? `${day}/` : day;
    }

    // Validação do mês
    if (limitedValue.length > 2) {
        let month = limitedValue.substring(2, 4);
        if (parseInt(month) > 12) {
            month = '12';
        }
        formattedValue += month.length === 2 ? `${month}/` : month;
    }

    // Validação do ano
    if (limitedValue.length > 4) {
        let year = limitedValue.substring(4, 8);
        const currentYear = new Date().getFullYear() - 18;
        const yearNumber = parseInt(year);

        if (yearNumber > currentYear) {
            year = currentYear.toString();
        }
        formattedValue += year;
    }

    return formattedValue;
}

window.onload = function() {
    <?php if(auth()->user()->birthdate == '' || auth()->user()->cover == '' || auth()->user()->cover == $settings->cover_default || auth()->user()->avatar == $settings->avatar): ?>
        showStep(1);    
    <?php elseif(auth()->user()->instagram == '' || auth()->user()->whatsapp == ''): ?>
        showStep(2);    
    <?php elseif(auth()->user()->document == '' || auth()->user()->cpf == ''): ?>
        showStep(3);    
    <?php endif; ?>
};

function showStep(step) {
    document.querySelectorAll('.step').forEach(function (element) {
        element.style.display = 'none';
    });
    document.getElementById('step' + step).style.display = 'block';
}

function nextStep(step) {
    const currentStep = document.getElementById('step' + (step - 1));
    const requiredFields = currentStep.querySelectorAll('input');

    for (let field of requiredFields) {
        const minLength = field.getAttribute('minlength');

        if (!field.value.trim()) {
            showAlertBelowField(field);
            field.focus();
            return;
        }

        if (minLength && field.value.length < minLength) {
            showAlertBelowField(field);
            field.focus();
            return;
        }
    }

    showStep(step);
}

function prevStep(step) {
    showStep(step);
}

function showAlertBelowField(field) {
    // Cria o elemento HTML de alerta
    const alert = document.createElement('div');
    alert.className = 'alert alert-dark mt-2 d-block w-100';
    alert.innerHTML = `
        <span class="alert-inner--text">
            <i class="fa fa-exclamation-triangle"></i> Por favor, preencha todos os campos corretamente.
        </span>
    `;

    field.parentNode.insertBefore(alert, field.nextSibling);
    setTimeout(() => { alert.remove() }, 2600);
}

document.getElementById('sendData').addEventListener('click', function(event) {
    event.preventDefault();
    const currentStep = document.getElementById('step3');
    const requiredFields = currentStep.querySelectorAll('input');

    for (let field of requiredFields) {
        const minLength = field.getAttribute('minlength');

        if (!field.value.trim()) {
            showAlertBelowField(field);
            field.focus();
            return;
        }

        if (minLength && field.value.length < minLength) {
            showAlertBelowField(field);
            field.focus();
            return;
        }
    }

    // Envia formulário
    document.querySelector("#formVerify").submit();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/users/verify_account.blade.php ENDPATH**/ ?>