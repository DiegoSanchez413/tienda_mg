<script src="https://www.paypal.com/sdk/js?client-id=AYJ4va2pFD3uGmMW0d4xUwXADUhCXO2FEF3G3aX-T9fsWKgLWSbNKOaCJ0ZjKPm-qe8QcNz03dCmjKja&currency=USD"></script>
<section class="bg-light py-5" id="cart_container">
  <div class="container">
    <div class="row">
      <div class="col-xl-8 col-lg-8 mb-4">
        <!-- <div class="card mb-4 border shadow-0">
          <div class="p-4 d-flex justify-content-between">
            <div class="">
              <h5>Have an account?</h5>
              <p class="mb-0 text-wrap ">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
            </div>
            <div class="d-flex align-items-center justify-content-center flex-column flex-md-row">
              <a href="#" class="btn btn-outline-primary me-0 me-md-2 mb-2 mb-md-0 w-100">Register</a>
              <a href="#" class="btn btn-primary shadow-0 text-nowrap w-100">Sign in</a>
            </div>
          </div>
        </div> -->

        <div class="card shadow-0 border">
          <div class="p-4">
            <h5 class="card-title mb-3">Información de contacto</h5>
            <div class="row">
              <div class="col-6 mb-3">
                <p class="mb-0">Nombre</p>
                <div class="form-outline">
                  <input type="text" id="typeText" placeholder="Escribe aquí" class="form-control" />
                </div>
              </div>

              <div class="col-6">
                <p class="mb-0">Apellido</p>
                <div class="form-outline">
                  <input type="text" id="typeText" placeholder="Escribe aquí" class="form-control" />
                </div>
              </div>

              <div class="col-6 mb-3">
                <p class="mb-0">Teléfono</p>
                <div class="form-outline">
                  <input type="tel" id="typePhone" value="+51 " class="form-control" />
                </div>
              </div>

              <div class="col-6 mb-3">
                <p class="mb-0">Correo electrónico</p>
                <div class="form-outline">
                  <input type="email" id="typeEmail" placeholder="ejemplo@gmail.com" class="form-control" />
                </div>
              </div>
            </div>

            <hr class="my-4" />

            <h5 class="card-title mb-3">Información de envío</h5>

            <div class="row mb-3">
              <div class="col-lg-4 mb-3">
                <!-- Opción de envío express seleccionada por defecto -->
                <div class="form-check h-100 border rounded-3">
                  <div class="p-3">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked />
                    <label class="form-check-label" for="flexRadioDefault1">
                      Envío exprés <br />
                      <small class="text-muted">3-4 días mediante Fedex</small>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <!-- Opción de envío por correo seleccionada por defecto -->
                <div class="form-check h-100 border rounded-3">
                  <div class="p-3">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                    <label class="form-check-label" for="flexRadioDefault2">
                      Envío por correo <br />
                      <small class="text-muted">20-30 días por correo</small>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <!-- Opción de recoger en tienda seleccionada por defecto -->
                <div class="form-check h-100 border rounded-3">
                  <div class="p-3">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" />
                    <label class="form-check-label" for="flexRadioDefault3">
                      Recoger en tienda <br />
                      <small class="text-muted">Ven a nuestra tienda</small>
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-8 mb-3">
                <p class="mb-0">Dirección</p>
                <div class="form-outline">
                  <input type="text" id="typeText" placeholder="Escribe aquí" class="form-control" />
                </div>
              </div>

              <div class="col-sm-4 mb-3">
                <p class="mb-0">Ciudad</p>
                <div class="form-outline">
                  <input type="text" id="typeText" placeholder="Escribe aquí" class="form-control" />
                </div>
              </div>

              <div class="col-sm-4 mb-3">
                <p class="mb-0">Casa</p>
                <div class="form-outline">
                  <input type="text" id="typeText" placeholder="Escribe aquí" class="form-control" />
                </div>
              </div>

              <div class="col-sm-4 col-6 mb-3">
                <p class="mb-0">Código postal</p>
                <div class="form-outline">
                  <input type="text" id="typeText" class="form-control" />
                </div>
              </div>

              <div class="col-sm-4 col-6 mb-3">
                <p class="mb-0">Código ZIP</p>
                <div class="form-outline">
                  <input type="text" id="typeText" class="form-control" />
                </div>
              </div>
            </div>

            <!-- <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                <label class="form-check-label" for="flexCheckDefault1">Guardar esta dirección</label>
                </div> -->
            <!-- 
                <div class="mb-3">
                <p class="mb-0">Mensaje al vendedor</p>
                <div class="form-outline">
                    <textarea class="form-control" id="textAreaExample1" rows="2"></textarea>
                </div>
                </div> -->

            <div class="float-end">
              <!-- <button class="btn btn-light border">Cancelar</button> -->
              <button class="btn btn-success shadow-0 border">Continuar</button>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
        <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
          <h6 class="mb-3">Resumen</h6>
          <!-- <div class="d-flex justify-content-between"> -->
          <!-- <p class="mb-2">Precio total:</p>
            <p class="mb-2" id="cart_total">$195.90</p>
            </div>
            <div class="d-flex justify-content-between">
            <p class="mb-2">Descuento:</p>
            <p class="mb-2 text-danger">- $60.00</p>
            </div>
            <div class="d-flex justify-content-between">
            <p class="mb-2">Costo de envío:</p>
            <p class="mb-2">+ $14.00</p>
            </div>
            <hr /> -->
          <div class="d-flex justify-content-between">
            <p class="mb-2">Precio total:</p>
            <p class="mb-2 fw-bold" id="cart_total"></p>
          </div>

          <!-- <div class="input-group mt-3 mb-4">
            <input type="text" class="form-control border" name="" placeholder="Código promocional" />
            <button class="btn btn-light text-primary border">Aplicar</button>
            </div> -->

          <!-- <hr /> -->
          <h6 class="text-dark my-4">Artículos en el carrito</h6>

          <div id="cart_list">
          </div>

          <div class="row">
            <div class="col-md-12">
              <div id="paypal-button-container"></div>
            </div>
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