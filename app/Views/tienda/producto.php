<section class="py-5">
  <div class="container">
    <div class="row gx-5">
      <aside class="col-lg-6">
        <div class="border rounded-4 mb-5 d-flex justify-content-center">
          <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp">
            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?= base_url() . "img/productos/" . $producto['Imagen_Producto']; ?>" />
          </a>
        </div>
        <!-- <div class="d-flex justify-content-center mb-3">
          <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big1.webp" class="item-thumb">
            <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big1.webp" />
          </a>
          <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big2.webp" class="item-thumb">
            <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big2.webp" />
          </a>
          <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big3.webp" class="item-thumb">
            <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big3.webp" />
          </a>
          <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big4.webp" class="item-thumb">
            <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big4.webp" />
          </a>
          <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp" class="item-thumb">
            <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp" />
          </a>
        </div> -->
      </aside>
      <main class="col-lg-6">
        <div class="ps-lg-3">
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
            <!-- <div class="col-md-4 col-6">
              <label class="mb-2">Size</label>
              <select class="form-select border border-secondary" style="height: 35px;">
                <option>Small</option>
                <option>Medium</option>
                <option>Large</option>
              </select>
            </div> -->

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
          <a href="#" class="btn btn-warning shadow-0"> Comprar ahora </a>
          <a href="#" class="btn btn-primary shadow-0" id="buy" onClick="addToCart()"> <i class="me-1 fa fa-shopping-basket"></i> Añadir al carrito </a>
          <!-- <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa fa-heart fa-lg"></i> Save </a> -->
        </div>
      </main>
    </div>
  </div>
</section>


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