<div>
    <!-- Logotipo -->
    <div class="text-center pt-2 pb-3">
        <img src="/public/img/payments/mercadopago.png" alt="MercadoPago" width="150">
    </div>

    <!-- Abas de seleção -->
    <ul class="nav nav-pills mb-3 d-flex" id="paymentTab" role="tablist">
        <li class="nav-item w-100 pr-0">
            <a class="nav-link active rounded-0 text-center font-bold" id="pix-tab" data-toggle="pill" href="#pix"
                role="tab" aria-controls="pix" aria-selected="false">
                <svg data-testid="bank_transfer" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <!-- Ícone do Pix -->
                    <path
                        d="M15.7559 15.3002C14.9713 15.3002 14.2333 14.9947 13.6784 14.4401L10.6786 11.4404C10.468 11.2292 10.1009 11.2298 9.89038 11.4404L6.87965 14.4511C6.32477 15.0057 5.58675 15.3112 4.8021 15.3112H4.21094L8.01026 19.1103C9.19676 20.2968 11.1206 20.2968 12.3071 19.1103L16.1173 15.3002H15.7559Z"
                        fill="#4AB7A8"></path>
                    <path
                        d="M4.80193 4.68893C5.58658 4.68893 6.3246 4.99444 6.87948 5.54903L9.89021 8.5602C10.107 8.77712 10.4611 8.77793 10.6784 8.55995L13.6782 5.56001C14.2331 5.00542 14.9711 4.69991 15.7558 4.69991H16.1171L12.3071 0.889914C11.1204 -0.296638 9.19659 -0.296638 8.01009 0.889914L4.21094 4.68894L4.80193 4.68893Z"
                        fill="#4AB7A8"></path>
                    <path
                        d="M19.1101 7.85061L16.8077 5.54823C16.757 5.56853 16.7021 5.5812 16.6441 5.5812H15.5973C15.056 5.5812 14.5262 5.80072 14.1438 6.18342L11.1441 9.18309C10.8634 9.4638 10.4945 9.60425 10.126 9.60425C9.75714 9.60425 9.38854 9.4638 9.10791 9.18336L6.0969 6.17246C5.71446 5.78967 5.18466 5.57024 4.64343 5.57024H3.35621C3.3013 5.57024 3.25 5.5573 3.20156 5.53906L0.889942 7.85061C-0.296647 9.03716 -0.296647 10.9608 0.889942 12.1474L3.20147 14.4588C3.24999 14.4406 3.3013 14.4276 3.35621 14.4276H4.64343C5.18466 14.4276 5.71446 14.2082 6.0969 13.8255L9.10763 10.8149C9.65182 10.2712 10.6005 10.271 11.1441 10.8151L14.1438 13.8145C14.5262 14.1972 15.056 14.4168 15.5973 14.4168H16.6441C16.7021 14.4168 16.757 14.4294 16.8077 14.4497L19.1101 12.1473C20.2966 10.9608 20.2966 9.03715 19.1101 7.8506"
                        fill="#4AB7A8"></path>
                </svg> Pix
            </a>
        </li>
    </ul>


    <!-- Conteúdo das abas -->
    <div class="tab-content" id="paymentTabContent">
        <!-- Aba de Cartão de Crédito -->
        <div class="tab-pane fade" id="creditCard" role="tabpanel" aria-labelledby="creditCard-tab">
            <form id="form-checkout">
                <div class="form-group">
                    <label for="cardNumber">Número do cartão</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="cardNumber" id="cardNumber" maxlength="19" />
                        <span class="input-group-text px-3 py-0" id="basic-addon1">
                            <i class="fas fa-credit-card" id="icon-card"></i>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="expiry">Validade</label>
                        <input type="text" class="form-control" name="expirationDate" id="expirationDate" maxlength="5"
                            autocomplete="off" inputmode="numeric" placeholder="MM/YY" required>
                    </div>
                    <div class="col-6">
                        <label for="securityCode">CVV</label>
                        <input type="text" class="form-control" name="securityCode" id="securityCode" maxlength="4"
                            autocomplete="off" inputmode="numeric" required>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="cardHolderName">Nome completo</label>
                    <input type="text" class="form-control" id="cardHolderName" placeholder="Mária López" required>
                </div>
                <div class="form-group mt-3">
                    <label for="cardholderID">Documento</label>
                    <select class="form-control" id="cardholderID" required>
                        <option value="cpf">CPF</option>
                        <option value="cnpj">CNPJ</option>
                    </select>
                    <input type="text" class="form-control mt-2" id="cardholderIdNumber" placeholder="454.545.454-54"
                        value="{{auth()->user()->cpf}}" required>
                </div>

                <div class="form-group mt-3">
                    <label for="installments">Parcelas</label>
                    <select name="installments" class="form-control" id="installments">
                        <option>Selecionar</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="form-mp-email" placeholder="example@email.com"
                        value="{{auth()->user()->email}}" required>
                </div>

                <input name="expirationYear" id="expirationYear" maxlength="4" autocomplete="off" hidden
                    inputmode="numeric">
                <input name="expirationMonth" id="expirationMonth" maxlength="2" autocomplete="off" hidden
                    inputmode="numeric">
                <input type="hidden" name="creator_id" value="{{ $creator_id }}">
                <input type="hidden" name="plan_id" value="{{ $plan_id }}">
                <input type="hidden" name="price" value="{{ $price }}">
                <input type="hidden" name="interval" value="{{ $interval }}">

                <div hidden>
                    <select name="form-mp-issuer" class="form-control" id="form-mp-issuer">
                        <option>Selecionar</option>
                    </select>
                </div>

                <div class="btn-block text-center mt-2">
                    <small><i class="fa fa-lock text-success mr-1"></i> {{ trans('general.info_payment_card') }}</small>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Pagar</button>
                </div>
            </form>
        </div>

        <!-- Aba Pix -->
        <div class="tab-pane fade show active" id="pix" role="tabpanel" aria-labelledby="pix-tab">
            <p>Escaneie o QRCode para realizar o pagamento:</p>
            <input type="hidden" name="plan_id" value="{{ $plan_id }}">
            <input type="hidden" name="interval" value="{{ $interval }}">
            <div id="loadingPix" class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Gerando PIX...</span>
                </div>
                <p>Gerando PIX, aguarde...</p>
            </div>
            <div id="pixContainer" class="text-center" style="display: none;">
                <div class="card-body">
                    <h5>Pix para pagamento</h5>
                    <div>
                        <img id="qrcodeImage" style="width: 75%;" alt="QR Code do Pix">
                    </div>
                    <div class="mt-3">
                        <input type="text" id="pixCode" class="form-control text-center" readonly>
                        <button class="btn btn-outline-primary mt-2" id="copyPixCodeBtn" onclick="copiarTexto()">Copiar Chave PIX</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center">
            <button type="button" class="btn e-none p-0" data-dismiss="modal">Cancelar</button>
        </div>

    </div>
</div>

<script>
    /*
    const KEY = 'TODO'
    const mp = new MercadoPago(KEY);
    (function (win, doc) {
        const cardForm = mp.cardForm({
            amount: '{{ $price }}',
            autoMount: true,
            form: {
                id: "form-checkout",
                cardholderName: {
                    id: "cardHolderName",
                    placeholder: "Titular do cartão",
                },
                cardholderEmail: {
                    id: "form-mp-email",
                    placeholder: "E-mail",
                },
                cardNumber: {
                    id: "cardNumber",
                    placeholder: "Número do cartão",
                },
                cardExpirationMonth: {
                    id: "expirationMonth",
                    placeholder: "Mês de vencimento",
                },
                cardExpirationYear: {
                    id: "expirationYear",
                    placeholder: "Ano de vencimento",
                },
                securityCode: {
                    id: "securityCode",
                    placeholder: "Cod. de segurança",
                },
                installments: {
                    id: "installments",
                    placeholder: "Parcelas",
                },
                identificationType: {
                    id: "cardholderID",
                    placeholder: "Tipo de documento",
                },
                identificationNumber: {
                    id: "cardholderIdNumber",
                    placeholder: "Número do documento",
                },
                issuer: {
                    id: "form-mp-issuer",
                    placeholder: "Banco emissor",
                },
            },
            callbacks: {
                //você pode ver todos os retornos de chamada em https://github.com/mercadopago/sdk-js
                onFormMounted: error => {
                    //verificando se o formulário existe
                    if (error) return console.warn("Form Mounted handling error: ", error);
                    //console.log("Form mounted");
                },
                onPaymentMethodsReceived: (error, paymentMethods) => {
                    //verificando a bandeira do cartão e colocando o logotipo correspondente
                    if (error) return console.warn('paymentMethods handling error: ', error);
                    const span = doc.getElementById('basic-addon1');
                    const icon_card = doc.getElementById('icon-card');
                    let img = span.querySelector('img');

                    if (!img) {
                        img = doc.createElement('img');
                        img.style.height = "25px";
                        img.height = 25;
                        span.appendChild(img);
                    }

                    img.src = paymentMethods[0].thumbnail;
                    icon_card.style.display = "none";
                },
                onCardTokenReceived: (error, token) => {
                    if (error) return console.warn('Token handling error: ', error)
                    //console.log('Token available: ', token)
                },
                onSubmit: event => {
                    event.preventDefault();

                    // Agora, obter os dados do formulário
                    const {
                        paymentMethodId: payment_method_id,
                        issuerId: issuer_id,
                        cardholderEmail: email,
                        amount,
                        token,
                        installments,
                        identificationNumber,
                        identificationType,
                    } = cardForm.getCardFormData();
            },
        });
    })(window, document);
    */

    $(document).ready(function () {
        // Formatação do número do cartão (xxxx xxxx xxxx xxxx)
        /*
        $('#cardNumber').on('input', function () {
            let cardNumber = $(this).val().replace(/\D/g, '');
            if (cardNumber.length <= 16) {
                cardNumber = cardNumber.replace(/(\d{4})(\d{1,4})/, '$1 $2');
                cardNumber = cardNumber.replace(/(\d{4})(\d{1,4})(\d{1,4})/, '$1 $2 $3');
                $(this).val(cardNumber);
            }
        });

        // Formatação da data de expiração (MM/YY)
        $('#expirationDate').on('input', function () {
            let expiration = $(this).val().replace(/\D/g, '');
            if (expiration.length <= 4) {
                expiration = expiration.replace(/(\d{2})(\d{1,2})/, '$1/$2');
                $(this).val(expiration);

                if (expiration.length === 5) {
                    $('#expirationMonth').val(expiration.substring(0, 2));
                    $('#expirationYear').val('20' + expiration.substring(3));
                }
            }
        });

        // Formatação do código de segurança (CVV) - máximo de 4 dígitos
        $('#securityCode').on('input', function () {
            let code = $(this).val().replace(/\D/g, '').slice(0, 4);
            $(this).val(code);
        });
        */

        // Gera pix
        if ($('#qrcodeImage').attr('src')) {
            $('#loadingPix').hide();
            $('#pixContainer').show();
            return;
        }

        $('#loadingPix').show();
        $('#pixContainer').hide();

        const plan_id = $('input[name="plan_id"]').val();
        const interval = $('input[name="interval"]').val();

        // Define the intervals in milliseconds
        const intervals = [2000, 5000, 10000, 15000, 20000, 30000, 35000, 40000, 50000, 60000, 120000, 480000];
        let currentIntervalIndex = 0;

        // Function to ping the checkPix endpoint
        function checkPix(transactionId) {
            $.ajax({
                url: 'mp/checkpix',
                type: 'POST',
                data: {
                    transaction_id: transactionId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status === 'success') {
                        if (response.payment_status === 'approved') {
                            setTimeout(() => {
                                location.reload();
                            }, 2500);
                        }
                    } else {
                        console.error('Erro ao verificar Pix:', response.message);
                    }
                },
                error: function () {
                    console.error('Erro ao processar a requisição de verificação.');
                }
            });
        }

        // Function to handle the timing logic
        function startPixPolling(transactionId) {
            // Function to ping the server at the next interval
            function pingNext() {
                if (currentIntervalIndex < intervals.length) {
                    setTimeout(() => {
                        checkPix(transactionId);
                        currentIntervalIndex++;
                        pingNext();
                    }, intervals[currentIntervalIndex]);
                } else {
                    // Loop at the last interval
                    loopInterval = setInterval(() => {
                        checkPix(transactionId);
                    }, intervals[intervals.length - 1]);
                }
            }

            // Start the pinging process
            pingNext();
        }

        // Triggering Pix generation and starting the polling
        $.ajax({
            url: 'mp/generatepix',
            type: 'POST',
            data: {
                plan_id: plan_id,
                interval: interval,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('#qrcodeImage').attr('src', 'data:image/png;base64,' + response.qr_code_base64);
                    $('#pixCode').val(response.qr_code);
                    $('#loadingPix').hide();
                    $('#pixContainer').show();
                    document.getElementById('copyPixCodeBtn').scrollIntoView({ behavior: 'smooth' });

                    // Start polling for payment status
                    console.log(response);
                    startPixPolling(response.id);
                } else {
                    alert('Erro ao gerar o Pix: ' + response.message);
                    $('#loadingPix').hide();
                }
            },
            error: function () {
                alert('Erro ao processar a requisição. Tente novamente.');
                $('#loadingPix').hide();
            }
        });
    });

    function copiarTexto() {
        var copyText = document.getElementById("pixCode");
        copyText.select();
        document.execCommand("copy");
        alert("Chave PIX copiada para a área de transferência!"); // TODO - Alerta proprio do app
    }
</script>