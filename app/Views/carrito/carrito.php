<script src="https://www.paypal.com/sdk/js?client-id=AYJ4va2pFD3uGmMW0d4xUwXADUhCXO2FEF3G3aX-T9fsWKgLWSbNKOaCJ0ZjKPm-qe8QcNz03dCmjKja&currency=USD"></script>
<section class="bg-light py-5" id="cart_container">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h6 class="text-dark my-4">Artículos en el carrito</h6>
        <div id="cart_list">
        </div>
      </div>
      <div class="col-md-4">
        <h6 class="mb-3">Resumen</h6>
        <div class="d-flex justify-content-between">
          <p class="mb-2">Precio total:</p>
          <p class="mb-2 fw-bold" id="cart_total"></p>
        </div>
        <div class="d-flex justify-content-between">
          <p class="mb-2">Precio con igv:</p>
          <p class="mb-2 fw-bold" id="cart_igv"></p>
        </div>
        <div id="paypal-button-container"></div>
      </div>
    </div>
  </div>
  </div>
  </div>
</section>

<section id="cart_container_empty" style="min-height: 75vh">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="text-center mt-5">
          <h2>No hay elementos en tu carrito</h2>
          <p>Tu carrito está vacío en este momento.</p>
          <a href="/productost" class="btn btn-primary">Continuar comprando</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="checkout_completed" style="min-height: 75vh; display: none;">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="text-center mt-5">
          <h2>¡Gracias por tu compra!</h2>
          <p>Tu compra se ha realizado con éxito.</p>
          <a href="/productost" class="btn btn-primary">Continuar comprando</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- https://developer.paypal.com/docs/checkout/standard/integrate/ -->
<!-- https://developer.paypal.com/dashboard/dashboard/sandbox -->
<!-- https://developer.paypal.com/docs/api/orders/v2/#orders_get -->
<script>
  paypal.Buttons({
    // Order is created on the server and the order id is returned
    createOrder: async function() {
      try {
        let cart = new FormData();
        cart.append('cart', JSON.stringify(JSON.parse(localStorage.getItem('cart'))));

        const response = await fetch("/carrito/create-paypal-order", {
          method: 'POST',
          mode: 'no-cors',
          headers: {
            "Content-Type": "application/json"
          },
          body: cart
        });
        const order = await response.json();
        return order.id;

      } catch (error) {
        console.log("error", error);
      }
    },
    // Finalize the transaction on the server after payer approval
    onApprove: async function(data) {
      try {
        const response = await fetch("/carrito/authenticate", {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          },
        });

        const {
          access_token
        } = await response.json();

        const response2 = await fetch('https://api-m.sandbox.paypal.com/v2/checkout/orders/' + data.orderID + '/capture', {
          method: 'POST',
          headers: {
            'Authorization': 'Bearer ' + access_token,
            'Content-Type': 'application/json'
          }
        });
        const orderData = await response2.json();
        console.log (orderData);
        if (orderData.status === 'COMPLETED') {
          let postData = new FormData();
          postData.append('orderData', JSON.stringify(orderData));
          postData.append('clientId', JSON.parse(localStorage.getItem('user')).ID_Cliente);

          const store = await fetch('/carrito/store-checkout', {
            method: 'POST',
            mode: 'no-cors',
            headers: {
              "Content-Type": "application/json"
            },
            body: postData
          });
          const storeData = await store.json();
          const type = storeData[0].type;

          if (type === 'success') {
            const checkout_completed = document.getElementById('checkout_completed');
            const cart_container = document.getElementById('cart_container');
            cart_container.style.display = 'none';
            checkout_completed.style.display = 'block';
            localStorage.removeItem('cart');
          }
          //   const response3 = await fetch("/carrito/authenticate", {
          //   method: "GET",
          //   headers: {
          //     "Content-Type": "application/json",
          //   },
          // });

          // const {
          //   access_token
          // } = await response3.json();

          //   const transaction = await fetch('https://api-m.sandbox.paypal.com/v2/checkout/orders/' + orderData.id, {
          //     method: 'GET',
          //     headers: {
          //     'Authorization': 'Bearer ' + access_token,
          //     'Content-Type': 'application/json'
          //   }
          //   });

          //   const transactionData = await transaction.json();
          //   console.log(transactionData);

        }
        // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
        // const transaction = orderData.purchase_units[0].payments.captures[0];
        // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
      } catch (error) {
        console.error(error);
      }
    }
  }).render('#paypal-button-container');

  // function parseData(){
  //   const payload = {
  //     intent: "CAPTURE",
  //     purchase_units: {
  //       reference_id : Math.floor(Math.random() * 1000000).toString(),
  //       description: "Compra en tienda",
  //       custom_id: Math.floor(Math.random() * 1000000).toString(),
  //       invoice_id: Math.floor(Math.random() * 1000000).toString(),
  //       soft_descriptor: "Compra en tienda",
  //       items: [],
  //       amount: {
  //         currency_code: "PEN",
  //         value: "1.00",
  //       },
  //       payee: {
  //         email_address: "sb-6ktwc10544935@business.example.com",
  //         merchant_id: "98YFQZTNXDWHU",
  //       },
  //       shipping: {
  //         type: "SHIPPING",
  //         name: {
  //           given_name: JSON.parse(localStorage.getItem('user')).Nombre_Cliente + " " + JSON.parse(localStorage.getItem('user')).Apellido_Cliente,
  //           sur_name : JSON.parse(localStorage.getItem('user')).Apellido_Cliente,
  //         },
  //         address: {
  //           address_line_1: "2211 N First Street",
  //           address_line_2: "Building 17",
  //           admin_area_2: "San Jose",
  //           admin_area_1: "CA",
  //           postal_code: "95131",
  //           country_code: "US"
  //         }
  //       }
  //     }
  //   }

  //   const cart = JSON.parse(localStorage.getItem('cart'));

  //   cart.forEach(element => {
  //     payload.purchase_units.items.push({
  //       name: element.Nombre_Producto,
  //         quantity: element.quantity,
  //         description: element.Descripcion_Producto,
  //         sku: element.Stock_Producto,
  //         category: element.Marca_Producto,
  //         unit_amount: {
  //           currency_code: "PEN",
  //           value: element.Precio_Producto,
  //         },
  //       quantity: element.quantity
  //     })
  //   });
  //   return payload;

  // }
</script>