<!DOCTYPE html>

<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
</head>

<body>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AYg_ZRCdvvHZsYmkJz8g52jPecqw53mSdAsjZUfmEkeUDZU7N8TsQ_-zLjM-IQmrYuSVu7ee8EvpU0dg&currency=USD"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
						env:'production',
						client:{
							sandbox: 'AX8EVyFc1JuBRVw0wP80QzZY1ziLbaC7zMuV5vAAREjOZEIE2jF3FSOpTSMjEKAUc2UnYLrmU9xwYvA5',
							// production: 'AYg_ZRCdvvHZsYmkJz8g52jPecqw53mSdAsjZUfmEkeUDZU7N8TsQ_-zLjM-IQmrYuSVu7ee8EvpU0dg'
						},
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '5.0',
														// currency: 'MXN'
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    // alert('Transaction completed by ' + details.payer.name.given_name + '!');
										console.log(data);
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>
