@extends('frontend.app' , ['bussines'=> $bussines, 'users', $users])
@section('content')


<div id="titlebar" style="padding: 39px 0;margin-bottom: 0;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Check out</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="/">Principal</a></li>
						<li>Check out</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<div class="container margin-bottom-45">


      <div>
          <form action="/procesar_pago" method="post" id="pay" name="pay" >
            @csrf
              <fieldset>
                <div class="row">
                  <div class="col-md-6">
                  <p>
                      <label for="description">Descripción</label>
                      <input type="text" name="description" id="description" value="Ítem seleccionado"/>
                  </p>
                  <p>
                      <label for="transaction_amount">Monto a pagar</label>
                      <input name="transaction_amount" id="transaction_amount" value="100"/>
                  </p>
                  <p>
                      <label for="cardNumber">Número de la tarjeta</label>
                      <input type="text" id="cardNumber" data-checkout="cardNumber" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off />
                  </p>
                  <p>
                      <label for="cardholderName">Nombre y apellido</label>
                      <input type="text" id="cardholderName" data-checkout="cardholderName" />
                  </p>
                  <p>
                      <label for="cardExpirationMonth">Mes de vencimiento</label>
                      <input type="text" id="cardExpirationMonth" data-checkout="cardExpirationMonth" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off />
                  </p>
                  <p>
                      <label for="cardExpirationYear">Año de vencimiento</label>
                      <input type="text" id="cardExpirationYear" data-checkout="cardExpirationYear" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off />
                  </p>

                  </div>
                  <div class="col-md-6">
                  <p>
                      <label for="securityCode">Código de seguridad</label>
                      <input type="text" id="securityCode" data-checkout="securityCode" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off />
                  </p>
                  <p>
                     <label for="installments">Cuotas</label>
                     <select id="installments" class="form-control" name="installments"></select>
                  </p>
                  <p>
                      <label for="docType">Tipo de documento</label>
                      <select id="docType" data-checkout="docType"></select>
                  </p>
                  <p>
                      <label for="docNumber">Número de documento</label>
                      <input type="text" id="docNumber" data-checkout="docNumber"/>
                  </p>
                  <p>
                      <label for="email">E-mail</label>
                      <input type="email" id="email" name="email" value="test@test.com"/>
                  </p>
                  <input type="hidden" name="payment_method_id" id="payment_method_id"/>

                  <input type="submit" value="Pagar"/>
                </div>
              </div>

              </fieldset>
          </form>
      </div>

</div>
	<!-- Incluye Culqi Checkout en tu sitio web-->




@endsection

@section('after-scripts')
  <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>

  <script>
      window.Mercadopago.setPublishableKey("TEST-cf487c35-1a0f-49e1-84cd-08f06a4c2cf0");

      window.Mercadopago.getIdentificationTypes();

      document.getElementById('cardNumber').addEventListener('keyup', guessPaymentMethod);
      document.getElementById('cardNumber').addEventListener('change', guessPaymentMethod);

      function guessPaymentMethod(event) {
          let cardnumber = document.getElementById("cardNumber").value;

          if (cardnumber.length >= 6) {
              let bin = cardnumber.substring(0,6);
              window.Mercadopago.getPaymentMethod({
                  "bin": bin
              }, setPaymentMethod);
          }
      };

      function setPaymentMethod(status, response) {
          if (status == 200) {
              let paymentMethodId = response[0].id;
              let element = document.getElementById('payment_method_id');
              element.value = paymentMethodId;
              getInstallments();
          } else {
              alert(`payment method info error: ${response}`);
          }
      }

      function getInstallments(){
          window.Mercadopago.getInstallments({
              "payment_method_id": document.getElementById('payment_method_id').value,
              "amount": parseFloat(document.getElementById('transaction_amount').value)

          }, function (status, response) {
              if (status == 200) {
                  document.getElementById('installments').options.length = 0;
                  response[0].payer_costs.forEach( installment => {
                      let opt = document.createElement('option');
                      opt.text = installment.recommended_message;
                      opt.value = installment.installments;
                      document.getElementById('installments').appendChild(opt);
                  });
              } else {
                  alert(`installments method info error: ${response}`);
              }
          });
      }

      doSubmit = false;
      document.querySelector('#pay').addEventListener('submit', doPay);

      function doPay(event){
          event.preventDefault();
          if(!doSubmit){
              var $form = document.querySelector('#pay');

              window.Mercadopago.createToken($form, sdkResponseHandler);

              return false;
          }
      };

        function sdkResponseHandler(status, response) {
            if (status != 200 && status != 201) {
                alert("verify filled data");
            }else{
                var form = document.querySelector('#pay');
                var card = document.createElement('input');
                card.setAttribute('name', 'token');
                card.setAttribute('type', 'hidden');
                card.setAttribute('value', response.id);
                form.appendChild(card);
                doSubmit=true;
                form.submit();
            }
        };
  </script>

@endsection
