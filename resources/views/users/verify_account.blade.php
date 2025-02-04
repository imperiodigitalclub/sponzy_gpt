@extends('layouts.app')

@section('title') {{trans('general.verify_account')}} -@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('public/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('public/plugins/select2/select2.min.css') }}?v={{$settings->version}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="feather icon-check-circle mr-2"></i> {{trans('general.verify_account')}}</h2>
          <p class="lead text-muted mt-0">{{Auth::user()->verified_id != 'yes' ? trans('general.verified_account_desc') : trans('general.verified_account')}}</p>
        </div>
      </div>
      <div class="row">

        @include('includes.cards-settings')

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          @if (session('status'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                			<span aria-hidden="true">×</span>
                			</button>

                    {{ session('status') }}
                  </div>
                @endif

          @include('errors.errors-forms')

        @if ($settings->requests_verify_account == 'on'
            && auth()->user()->verified_id != 'yes'
            && auth()->user()->verificationRequests() != 1
            && auth()->user()->verified_id != 'reject')

          <div class="alert alert-warning mr-1">
          <span class="alert-inner--text"><i class="fa fa-exclamation-triangle"></i> {{trans('general.warning_verification_info')}}</span>
        </div>

        <form method="POST" id="formVerify" action="{{ url('settings/verify/account') }}" accept-charset="UTF-8" enctype="multipart/form-data">
          @csrf

          <!-- Step 1: Informações Básicas do Perfil -->
          <div id="step1" class="step" style="display: none;">
              <h4>Informações Básicas do Perfil</h4>

              <!-- Avatar Upload -->
              @if (auth()->user()->avatar == $settings->avatar)
                    <div class="mb-4 text-center previewImageVerification">
                        <h6 class="text-muted">{{ trans('general.avatar') }}</h6>
                        <input type="file" name="avatar" id="avatarUpload" accept="image/*" class="fileVerifiyAccount visibility-hidden">
                        <button class="btn btn-1 w-100 btn-outline-primary mb-2 border-dashed btnFilePhoto" type="button" id="btnAvatarUpload">{{ trans('general.upload_image') }} (JPG, PNG, GIF) - {{ trans('general.maximum') }}: {{ Helper::formatBytes($settings->file_size_allowed_verify_account * 1024) }}</button>
                        <span class="btn-block mb-2 previewImage" id="avatarPreview"></span>
                    </div>
                @endif

                <!-- Cover Upload -->
                @if (auth()->user()->cover == '' || auth()->user()->cover == $settings->cover_default)
                    <div class="mb-4 text-center previewImageVerification">
                        <h6 class="text-muted">{{ trans('general.cover') }}</h6>
                        <input type="file" name="cover" id="coverUpload" accept="image/*" class="fileVerifiyAccount visibility-hidden">
                        <button class="btn btn-1 w-100 btn-outline-primary mb-2 border-dashed btnFilePhoto" type="button" id="btnCoverUpload">{{ trans('general.upload_image') }} (JPG, PNG, GIF) - {{ trans('general.maximum') }}: {{ Helper::formatBytes($settings->file_size_allowed_verify_account * 1024) }}</button>
                        <span class="btn-block mb-2 previewImage" id="coverPreview"></span>
                    </div>
                @endif

                <!-- Birthdate Input -->
                @if (auth()->user()->birthdate == '')
                    <div class="mb-4 text-center">
                        <h6 class="text-muted">{{ trans('general.birthdate') }}</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                            </div>
                            <input class="form-control" id="birthdate" name="birthdate" placeholder="{{ trans('general.birthdate') }} *" 
                                value="{{ auth()->user()->birthdate }}" autocomplete="off" type="text" minlength="10" maxlength="10"
                                @if (auth()->user()->birthdate_changed == 'yes') disabled @endif>
                        </div>
                        <small class="form-text text-muted mb-4">
                            {{ trans('general.valid_formats') }} <strong>{{ now()->subYears(18)->format('d/m/Y') }}</strong> --
                            <strong>({{ trans('general.birthdate_changed_info') }})</strong>
                        </small>
                    </div>
                @endif

              <div class="text-right">
                <button type="button" class="btn btn-primary" onclick="nextStep(2)">Próxima</button>
              </div>
          </div>

          <!-- Step 2: Redes Sociais -->
          <div id="step2" class="step" style="display: none;">
              <h4>Redes Sociais</h4>

              <!-- Instagram Input -->
              @if (auth()->user()->instagram == '')
                    <div class="mb-4 text-center">
                        <h6 class="text-muted">Instagram</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                            </div>
                            <input class="form-control" id="instagram" name="instagram" placeholder="@Instagram *" value="{{ auth()->user()->instagram }}" type="text" required oninput="this.value = this.value.replace(/\s+/g, '')">
                        </div>
                    </div>
                @endif

                <!-- WhatsApp Input -->
                @if (auth()->user()->whatsapp == '')
                    <div class="mb-4 text-center">
                        <h6 class="text-muted">WhatsApp</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                            </div>
                            <input class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp *" value="{{ auth()->user()->whatsapp }}" type="text" minlength="14" required>
                        </div>
                    </div>
                @endif

                <div class="text-right">
                  <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Voltar</button>
                  <button type="button" class="btn btn-primary" onclick="nextStep(3)">Próxima</button>
                </div>
          </div>

          <!-- Step 3: Documentos -->
          <div id="step3" class="step" style="display: none;">
              <h4>Documentos</h4>

              <!-- CPF Input -->
              @if (auth()->user()->cpf == '')
                    <div class="mb-4 text-center">
                        <h6 class="text-muted">CPF</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-id-badge"></i></span>
                            </div>
                            <input class="form-control" id="cpf" name="cpf" placeholder="CPF *" value="{{ auth()->user()->cpf }}" type="text" required minlength="14">
                        </div>
                    </div>
                @endif

                <!-- Documento Input -->
                @if (auth()->user()->document == '')
                    <div class="mb-4 text-center">
                        <h6 class="text-muted">Documento</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                            </div>
                            <input class="form-control" maxlength="50" id="document" name="document" placeholder="Documento (RG / CNH / Passaporte) *" value="{{ auth()->user()->document }}" type="text" required>
                        </div>
                    </div>
                @endif

              <!-- Image Front -->
              <div class="mb-5 text-center previewImageVerification">
                  <h6 class="text-muted">{{trans('general.info_verification_user')}}</h6>
                    <input type="file" name="image" id="fileVerifiyAccount" accept="image/*" class="fileVerifiyAccount visibility-hidden">
                    <button class="btn btn-1 w-100 btn-outline-primary mb-2 border-dashed btnFilePhoto" type="button" id="btnFilePhoto">{{trans('general.upload_image')}} (JPG, PNG, GIF) - {{trans('general.maximum')}}: {{Helper::formatBytes($settings->file_size_allowed_verify_account * 1024)}}</button>
                    <span class="btn-block mb-2 previewImage" id="previewImage"></span>
                </div>

                <!-- Image Reverse -->
                <div class="mb-5 text-center previewImageVerification">
                  <h6 class="text-muted">{{trans('general.info_verification_user_reverse_id')}}</h6>
                    <input type="file" name="image_reverse" id="fileVerifiyAccount" accept="image/*" class="fileVerifiyAccount visibility-hidden">
                    <button class="btn btn-1 w-100 btn-outline-primary mb-2 border-dashed btnFilePhoto" type="button" id="btnFilePhoto">{{trans('general.upload_image')}} (JPG, PNG, GIF) - {{trans('general.maximum')}}: {{Helper::formatBytes($settings->file_size_allowed_verify_account * 1024)}}</button>
                    <span class="btn-block mb-2 previewImage" id="previewImage"></span>
                </div>

                <!-- Image Selfie -->
                <div class="mb-3 text-center previewImageVerification">
                  <h6 class="text-muted">{{trans('general.info_verification_user_selfie', ['sitename' => $settings->title])}}</h6>
                    <input type="file" name="image_selfie" id="fileVerifiyAccount" accept="image/*" class="fileVerifiyAccount visibility-hidden">
                    <button class="btn btn-1 w-100 btn-outline-primary mb-2 border-dashed btnFilePhoto" type="button" id="btnFilePhoto">{{trans('general.upload_image')}} (JPG, PNG, GIF) - {{trans('general.maximum')}}: {{Helper::formatBytes($settings->file_size_allowed_verify_account * 1024)}}</button>
                    <span class="btn-block mb-2 previewImage" id="previewImage"></span>
                </div>

                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" required id="agreeTermsPrivacy" name="agree_terms_privacy" type="checkbox">
                  <label class="custom-control-label" for="agreeTermsPrivacy">
                    <span>{{__('general.i_agree_with')}} 
                      <a href="{{$settings->link_terms}}" target="_blank">{{__('admin.terms_conditions')}}</a>
                      {{ __('general.and') }}
                        <a href="{{$settings->link_privacy}}" target="_blank">{{__('admin.privacy_policy')}}</a>
                    </span>
                  </label>
                </div>

                <button class="btn btn-1 btn-success btn-block mt-5" id="sendData">{{trans('general.send_approval')}}</button>
          </div>
      </form>
        @elseif (auth()->user()->verificationRequests() == 1)
          <div class="alert alert-primary alert-dismissible text-center fade show" role="alert">
            <span class="alert-inner--icon mr-2"><i class="fa fa-info-circle"></i></span>
          <span class="alert-inner--text">{{trans('admin.pending_request_verify')}}</span>
        </div>
      @elseif (auth()->user()->verified_id == 'reject')
        <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
          <span class="alert-inner--icon mr-2"><i class="fa fa-info-circle"></i></span>
        <span class="alert-inner--text">{{trans('admin.rejected_request')}}</span>
      </div>
    @elseif (auth()->user()->verified_id != 'yes' && $settings->requests_verify_account == 'off')
      <div class="alert alert-primary alert-dismissible text-center fade show" role="alert">
        <span class="alert-inner--icon mr-2"><i class="fa fa-info-circle"></i></span>
      <span class="alert-inner--text">{{trans('general.info_receive_verification_requests')}}</span>
    </div>

        @else
          <div class="alert alert-success alert-dismissible text-center fade show" role="alert">
            <span class="alert-inner--icon mr-2"><i class="feather icon-check-circle"></i></span>
          <span class="alert-inner--text">{{trans('general.verified_account_success')}}</span>
        </div>

        @endif

        </div><!-- end col-md-6 -->
      </div>
    </div>
  </section>
@endsection

@section('javascript')
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
    @if (auth()->user()->birthdate == '' || auth()->user()->cover == '' || auth()->user()->cover == $settings->cover_default || auth()->user()->avatar == $settings->avatar)
        showStep(1);    
    @elseif (auth()->user()->instagram == '' || auth()->user()->whatsapp == '')
        showStep(2);    
    @elseif (auth()->user()->document == '' || auth()->user()->cpf == '')
        showStep(3);    
    @endif
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
@endsection