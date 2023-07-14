<style>
  .color a {
    font-weight: bold;
  }

  .bg-gradient-primary {
    background-color: #a1c2c6;
    background-image: linear-gradient(180deg, #3C9BA6 10%, #a1c2c6 100%);
    background-size: cover
  }
</style>
<div class="bg-gradient-primary">
<section class="py-5">
  

    <div class="container">
      <div class="row gx-1 col-lg-1">
        <span class="btn btn-secondary " onclick="history.back()">
          <i class="fa fa-arrow-left"></i>
        </span>
      </div>
      <br>
      <div class="row gx-5">
        <aside class="col-lg-6">
          <div class="border rounded-4 mb-5 d-flex justify-content-center" style="background-color: white; ">
            <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp">
              <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?= base_url() . "img/productos/" . $producto['Imagen_Producto']; ?>" />
            </a>
          </div>
        </aside>
        <main class="col-lg-6" style="background-color: white;position: relative; width: 50%; ">
          <div class="ps-lg-3">
            <br />
            <h4 class="title text-dark text-uppercase"> <?= $producto['Nombre_Producto']; ?> <br />
            </h4>
            <div class="d-flex flex-row my-3">
              <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i> <?= $producto['Stock_Producto']; ?></span>
              <span class="text-success ms-2 text-uppercase">En stock</span>
            </div>

            <div class="mb-3">
              <span class="h5">S/. <?= $producto['Precio_Producto']; ?></span>
            </div>

            <div class="row">
              <dt class="col-3">Marca:</dt>
              <dd class="col-9 text-uppercase"> <?= $producto['Marca_Producto']; ?></dd>
            </div>

            <p class="text-uppercase">
              <?= $producto['Descripcion_Producto']; ?>
            </p>
            <hr />

            <div class="row mb-4">
              <div class="col-md-4 col-6 mb-3">
                <label class="mb-2 d-block">Cantidad</label>
                <div class="input-group mb-3" style="width: 170px;">
                  <button class="btn btn-white border border-secondary px-3" type="button" id="decrease" onClick="decreaseQuantity()" data-mdb-ripple-color="dark">
                    <i class="fas fa-minus"></i>
                  </button>

                  <input type="text" class="form-control text-center border border-secondary" placeholder="1" value="1" id="quantity" />

                  <button class="btn btn-white border border-secondary px-3" type="button" id="increase" onClick="increaseQuantity()" data-mdb-ripple-color="dark">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
            </div>
            <!-- redirect to cart -->
            <a href="#" class="btn btn-primary shadow-0" id="buy" onClick="addToCart()"> <i class="me-1 fa fa-shopping-basket"></i> Añadir al carrito </a>
            <!-- <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa fa-heart fa-lg"></i> Save </a> -->
          </div>
          <br />
        </main>
      </div>
    </div>

</section>
  </div>

<script>
  function increaseQuantity() {
    var quantity = document.getElementById('quantity');
    quantity.value = parseInt(quantity.value) + 1;
  }

  function decreaseQuantity() {
    var quantity = document.getElementById('quantity');
    if (parseInt(quantity.value) > 1) {
      quantity.value = parseInt(quantity.value) - 1;
    }
  }

  function addToCart() {
    const producto = <?php echo json_encode($producto); ?>;
    const quantity = document.getElementById('quantity').value;
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    producto.quantity = quantity;
    checkIfExistProduct(producto);
  }

  function checkIfExistProduct(producto) {
    // if product exists sum quantity previus and new
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const productExist = cart.find(product => product.ID_Producto == producto.ID_Producto);
    if (productExist) {
      productExist.quantity = parseInt(productExist.quantity) + parseInt(producto.quantity);
      localStorage.setItem('cart', JSON.stringify(cart));
    } else {
      cart.push(producto);
      localStorage.setItem('cart', JSON.stringify(cart));
    }

  }
</script>