@extends('layouts.app')

@section('title') {{trans('general.payment_card')}} -@endsection

@section('css')
<script type="text/javascript">
  console.log("checkout mp")
</script>
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script src="https://sdk.mercadopago.com/js/v2"></script>
@endsection

@section('content')
<section class="section section-sm">
  <div class="container">
    <div class="row justify-content-center text-center mb-sm">
      <div class="col-lg-8 pt-5 pb-4">
        <h2 class="mb-0 font-montserrat"><i class="feather icon-credit-card mr-2"></i> {{trans('general.payment_card')}}
        </h2>
        <p class="lead text-muted mt-0">{{trans('general.payment_card_subtitle')}}</p>
      </div>
    </div>
    <div class="row" hidden>

      <div class="col-md-8 mx-auto mb-lg-0">

        <div class="bg-white rounded-lg shadow-sm p-5">

          <div class="alert alert-success display-none" id="success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>

            {{ trans('general.payment_card_success') }}
          </div>

          @php
      switch (auth()->user()->pm_type) {
        case 'amex':
        $paymentDefault = '<img src="' . asset('public/img/payments/brands/amex.svg') . '"> •••• •••• •••• ' . auth()->user()->pm_last_four;
        break;

        case 'diners':
        $paymentDefault = '<img src="' . asset('public/img/payments/brands/diners.svg') . '"> •••• •••• •••• ' . auth()->user()->pm_last_four;
        break;

        case 'discover':
        $paymentDefault = '<img src="' . asset('public/img/payments/brands/discover.svg') . '"> •••• •••• •••• ' . auth()->user()->pm_last_four;
        break;

        case 'jcb':
        $paymentDefault = '<img src="' . asset('public/img/payments/brands/jcb.svg') . '"> •••• •••• •••• ' . auth()->user()->pm_last_four;
        break;

        case 'mastercard':
        $paymentDefault = '<img src="' . asset('public/img/payments/brands/mastercard.svg') . '"> •••• •••• •••• ' . auth()->user()->pm_last_four;
        break;

        case 'unionpay':
        $paymentDefault = '<img src="' . asset('public/img/payments/brands/unionpay.svg') . '"> •••• •••• •••• ' . auth()->user()->pm_last_four;
        break;

        case 'visa':
        $paymentDefault = '<img src="' . asset('public/img/payments/brands/visa.svg') . '"> •••• •••• •••• ' . auth()->user()->pm_last_four;
        break;

        default:
        $paymentDefault = trans('general.not_card_added');
        break;
      }
    @endphp

          <h5 class="text-center mb-2">Selecione a forma de pagamento</h5>
          <!-- TODO - Botão pix irá avançar e gerar pix  -->
          <!-- TODO - Botão cartão irá avançar para form checkout  -->
          <!-- TODO - Containers pix e form checkout-->
          <div class="card border-0" style="margin-top: 5%;">
            <div class="card-body">
              <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary w-100" onclick="cartaoModal()" data-toggle="button"
                  aria-pressed="false" autocomplete="off" style="margin: 0px 15px 0px 15px;">
                  <i class="fas fa-credit-card d-block mb-2"></i> <!-- Ícone acima do texto -->
                  Cartão
                </button>
                <button type="button" class="btn btn-primary w-100" onclick="pixModal()" data-toggle="button"
                  aria-pressed="false" autocomplete="off" style="margin: 0px 15px 0px 15px;">
                  <i class="fas fa-piggy-bank d-block mb-2"></i> <!-- Ícone acima do texto -->
                  PIX
                </button>
              </div>
            </div>

            <form id="form-checkout" class="row m-5" hidden>
              <div class="text-center">
                <div class="col-12 mb-3">
                  <div class="display-6">
                    <p>Checkout Transparente</p>
                    <img src="./img/mercadopago.png" alt="" style="width: 25%;">
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-9 form-group mb-3">
                <label>Número do cartão</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="cardNumber" id="form-checkout__cardNumber" />
                  <span class="input-group-text" id="basic-addon1">
                    <i class="fas fa-credit-card" id="icon-card"></i>
                  </span>
                </div>
              </div>
              <div class="col-12 col-md-3 form-group mb-3">
                <label>CVV</label>
                <input type="text" class="form-control" name="securityCode" id="form-checkout__securityCode" />
              </div>
              <div class="col-12 col-md-6 form-group mb-3">
                <label>Vencimento</label>
                <input type="text" class="form-control" name="expirationDate" id="form-checkout__expirationDate" />
              </div>
              <div class="col-12 col-md-6 form-group mb-3">
                <label>Parcelas</label>
                <select name="installments" class="form-control" id="form-checkout__installments">
                  <option>Selecionar</option>
                </select>
              </div>
              <hr>
              <div class="col-12 col-md-6 form-group mb-3">
                <label>Nome Completo</label>
                <input type="text" class="form-control" name="cardholderName" id="form-checkout__cardholderName" />
              </div>
              <div class="col-12 col-md-6 form-group mb-3">
                <label>CPF</label>
                <input type="text" class="form-control" name="identificationNumber"
                  id="form-checkout__identificationNumber" />
              </div>
              <hr>
              <div class="col-12 col-md-6 form-group mb-3">
                <label>Banco Emissor</label>
                <select name="issuer" class="form-control" id="form-checkout__issuer">
                  <option>Selecionar</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary w-100" id="form-checkout__submit">Pagar</button>
            </form>

            <div id="pix" class="text-center" hidden>
              <div class="card-body">
                <h5>Pix para pagamento</h5>
                <div class="wrapper" id="loadingPix">
                  <h1 class="brand">
                    <span>Gerando PIX</span>
                  </h1>
                  <div class="loading-bar"></div>
                </div>
                <div>
                  <div id="qrcode"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-2 text-center">
            <a href="{{ url()->previous() }}"><i class="fa fa-long-arrow-alt-left"></i>
              {{ trans('general.go_back') }}</a>
          </div>
        </div>

        <div class="btn-block text-center mt-2">
          <small><i class="fa fa-lock text-success mr-1"></i> {{ trans('general.info_payment_card') }}</small>
        </div>

      </div><!-- end col-md-8 -->

    </div>
  </div>
</section>
@endsection

@section('javascript')
<script src="{{ asset('public/js/mp-add-payment-card.js') }}"></script>
<script>
  function cartaoModal() {
    document.getElementById('pix').hidden = true;
    document.getElementById("form-checkout").hidden = false;
  }

  function pixModal() {
    document.getElementById('pix').hidden = false;
    document.getElementById('form-checkout').hidden = true;
    gerarPix(); // Adapte o gerador de Pix para sua lógica.
  }

  function gerarPix() {
    // Sua lógica para gerar o código QR do Pix aqui
    // Exemplo: gerar o QR code com alguma biblioteca externa
    document.getElementById("loadingPix").style.display = 'none';
    document.getElementById("qrcode").style.display = 'block';
    // Implementar o código de geração de QR
  }

  const KEY = 'APP_USR-69d585fa-6c2a-478a-96ef-58ed889179e9';
  const mp = new MercadoPago(KEY);

  (function (win, doc) {
    const cardForm = mp.cardForm({
      amount: "100.00", //valor do produto
      autoMount: true,
      form: {
        id: "form-checkout",
        cardholderName: {
          id: "form-checkout__cardholderName",
          placeholder: "Titular do cartão",
        },
        cardNumber: {
          id: "form-checkout__cardNumber",
          placeholder: "Número do cartão",
        },
        expirationDate: {
          id: "form-checkout__expirationDate",
          placeholder: "Data de vencimento (MM/AA)",
        },
        securityCode: {
          id: "form-checkout__securityCode",
          placeholder: "Código de segurança",
        },
        installments: {
          id: "form-checkout__installments",
          placeholder: "Parcelas",
        },
        identificationType: {
          id: "form-checkout__identificationType",
          placeholder: "Tipo de documento",
        },
        identificationNumber: {
          id: "form-checkout__identificationNumber",
          placeholder: "Número do CPF",
        },
        issuer: {
          id: "form-checkout__issuer",
          placeholder: "Banco emissor",
        },
      },
      callbacks: {
        // Callback para quando o formulário é montado
        onFormMounted: error => {
          if (error) return console.warn("Form Mounted handling error: ", error);
        },

        // Callback para quando os métodos de pagamento são recebidos
        onPaymentMethodsReceived: (error, paymentMethods) => {
          if (error) return console.warn('paymentMethods handling error: ', error);

          const span = doc.getElementById('basic-addon1');
          const icon_card = doc.getElementById('icon-card');
          const img = doc.createElement('img');
          icon_card.style.display = "none";
          img.src = paymentMethods[0].thumbnail;
          img.style.height = 30;
          img.className = "img-thumbnail";
          span.appendChild(img);
        },

        // Callback para quando o formulário for enviado
        onSubmit: event => {
          event.preventDefault();

          const {
            paymentMethodId: payment_method_id,
            issuerId: issuer_id,
            cardholderName,
            amount,
            token,
            installments,
            identificationNumber,
            identificationType,
          } = cardForm.getCardFormData();

          // Envio dos dados para o backend
          fetch("/mercadopago-test/controllers/cardController.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              token, // Token do cartão
              issuer_id, // ID do emissor
              payment_method_id, // Bandeira do cartão
              transaction_amount: Number(amount), // Valor do produto
              installments: Number(installments), // Número de parcelas
              description: "Produto 001", // Descrição do produto
              payer: {
                name: cardholderName, // Nome do titular
                identification: {
                  type: "CPF", // Tipo de documento
                  number: identificationNumber, // Número do CPF
                },
              },
            }),
          })
            .then(response => response.text())
            .then(result => {
              const response = JSON.parse(result);
              console.log(response.id);
              document.getElementById('mensagens_sistema_body').innerHTML = response.mensagem;
              document.getElementById('button_click').click();
            })
            .catch(error => console.log('Error:', error));
        },
      },
    });
  })(window, document);

</script>
@endsection