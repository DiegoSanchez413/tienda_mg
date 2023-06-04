
<section class="mt-3">
  <div class="container">
    <div class="row">

      <div class="col-lg-3">
        <!-- Toggle button -->
        <button
                class="btn btn-outline-secondary mb-3 w-100 d-lg-none"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
          <span>Show filter</span>
        </button>
        <!-- Collapsible wrapper -->
        <div class="collapse card d-lg-block mb-5" id="navbarSupportedContent">
          <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button
                        class="accordion-button text-dark bg-light"
                        type="button"
                        data-mdb-toggle="collapse"
                        data-mdb-target="#panelsStayOpen-collapseOne"
                        aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne"
                        >
                   Categorias
                </button>
              </h2>
              <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                <div class="accordion-body">
                  <ul class="list-unstyled">
                    <li><a href="#" class="text-dark">Electronics </a></li>
                    <li><a href="#" class="text-dark">Home items </a></li>
                    <li><a href="#" class="text-dark">Books, Magazines </a></li>
                    <li><a href="#" class="text-dark">Men's clothing </a></li>
                    <li><a href="#" class="text-dark">Interiors items </a></li>
                    <li><a href="#" class="text-dark">Underwears </a></li>
                    <li><a href="#" class="text-dark">Shoes for men </a></li>
                    <li><a href="#" class="text-dark">Accessories </a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button
                        class="accordion-button text-dark bg-light"
                        type="button"
                        data-mdb-toggle="collapse"
                        data-mdb-target="#panelsStayOpen-collapseTwo"
                        aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseTwo"
                        >
                  Marca
                </button>
              </h2>
              <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
                <div class="accordion-body">
                  <div>
                    <!-- Checked checkbox -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" checked />
                      <label class="form-check-label" for="flexCheckChecked1">Mercedes</label>
                      <span class="badge badge-secondary float-end">120</span>
                    </div>
                    <!-- Checked checkbox -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2" checked />
                      <label class="form-check-label" for="flexCheckChecked2">Toyota</label>
                      <span class="badge badge-secondary float-end">15</span>
                    </div>
                    <!-- Checked checkbox -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked3" checked />
                      <label class="form-check-label" for="flexCheckChecked3">Mitsubishi</label>
                      <span class="badge badge-secondary float-end">35</span>
                    </div>
                    <!-- Checked checkbox -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked4" checked />
                      <label class="form-check-label" for="flexCheckChecked4">Nissan</label>
                      <span class="badge badge-secondary float-end">89</span>
                    </div>
                    <!-- Default checkbox -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                      <label class="form-check-label" for="flexCheckDefault">Honda</label>
                      <span class="badge badge-secondary float-end">30</span>
                    </div>
                    <!-- Default checkbox -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                      <label class="form-check-label" for="flexCheckDefault">Suzuki</label>
                      <span class="badge badge-secondary float-end">30</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button
                        class="accordion-button text-dark bg-light"
                        type="button"
                        data-mdb-toggle="collapse"
                        data-mdb-target="#panelsStayOpen-collapseThree"
                        aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseThree"
                        >
                  Precio
                </button>
              </h2>
              <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree">
                <div class="accordion-body">
                  <div class="range">
                    <input type="range" class="form-range" id="customRange1" />
                  </div>
                  <div class="row mb-3">
                    <div class="col-6">
                      <p class="mb-0">
                        Min
                      </p>
                      <div class="form-outline">
                        <input type="number" id="typeNumber" class="form-control" />
                        <label class="form-label" for="typeNumber">$0</label>
                      </div>
                    </div>
                    <div class="col-6">
                      <p class="mb-0">
                        Max
                      </p>
                      <div class="form-outline">
                        <input type="number" id="typeNumber" class="form-control" />
                        <label class="form-label" for="typeNumber">$1,0000</label>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-white w-100 border border-secondary">Aplicar</button>
                </div>
              </div>
            </div>
        
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button
                        class="accordion-button text-dark bg-light"
                        type="button"
                        data-mdb-toggle="collapse"
                        data-mdb-target="#panelsStayOpen-collapseFive"
                        aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseFive"
                        >
                  Puntuación
                </button>
              </h2>
              <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse show" aria-labelledby="headingThree">
                <div class="accordion-body">
                  <!-- Default checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked />
                    <label class="form-check-label" for="flexCheckDefault">
                      <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                    </label>
                  </div>
                  <!-- Default checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked />
                    <label class="form-check-label" for="flexCheckDefault">
                      <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-secondary"></i>
                    </label>
                  </div>
                  <!-- Default checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked />
                    <label class="form-check-label" for="flexCheckDefault">
                      <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-secondary"></i>
                      <i class="fas fa-star text-secondary"></i>
                    </label>
                  </div>
                  <!-- Default checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked />
                    <label class="form-check-label" for="flexCheckDefault">
                      <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-secondary"></i><i class="fas fa-star text-secondary"></i>
                      <i class="fas fa-star text-secondary"></i>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-9">
        <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
          <strong class="d-block py-2">32 Productos encontrados</strong>
          <div class="ms-auto">
            <select class="form-select d-inline-block w-auto border pt-1">
              <option value="0">Más recientes</option>
              <option value="1">Más vendidos</option>
              <option value="2">Menor precio</option>
              <option value="3">Mayor precio</option>
            </select>
            <div class="btn-group shadow-0 border">
              <a href="#" class="btn btn-light" title="List view">
                <i class="fa fa-bars fa-lg"></i>
              </a>
              <a href="#" class="btn btn-light active" title="Grid view">
                <i class="fa fa-th fa-lg"></i>
              </a>
            </div>
          </div>
        </header>

        <?php foreach ($productos as $producto): ?>
            <div class="row justify-content-center mb-3" >
                <div class="col-md-12">
                <div class="card shadow-0 border rounded-3 product" onCLick="location.href='<?= base_url() . 'producto/' . $producto['Nombre_Producto'] . '-' . $producto['ID_Producto']; ?>'">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                  <img src="<?= "img/productos/" . $producto['Imagen_Producto']; ?>" class="img-fluid text-center" style="max-height: 150px; object-fit: contain; width: 100%;"
                   />
                  <a href="#!">
                    <div class="hover-overlay">
                      <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-6">
                <h5> <?= $producto['Nombre_Producto']; ?></h5>
                <div class="d-flex flex-row">
                  <div class="text-danger mb-1 me-2">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                  <span>310</span>
                </div>
                <div class="mt-1 mb-0 text-muted small">
                  <span> Marca: <?= $producto['Nombre_Producto']; ?></span><br>
                  <!-- <span class="text-primary"> • </span>
                  <span>Light weight</span>
                  <span class="text-primary"> • </span>
                  <span>Best finish<br /></span> -->
                </div>
                <!-- <div class="mb-2 text-muted small">
                  <span>Unique design</span>
                  <span class="text-primary"> • </span>
                  <span>For men</span>
                  <span class="text-primary"> • </span>
                  <span>Casual<br /></span>
                </div> -->
                <p class="text-truncate mb-4 mb-md-0">
                <?= $producto['Descripcion_Producto']; ?>
                </p>
              </div>
              <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                <div class="d-flex flex-row align-items-center mb-1">
                  <h4 class="mb-1 me-1"> S/.<?= $producto['Precio_Producto']; ?></h4>
                  <span class="text-danger"><s>$20.99</s></span>
                </div>
                <h6 class="text-success">Free shipping</h6>
                <div class="d-flex flex-column mt-4">
                  <button class="btn btn-primary btn-sm" type="button">Detalles</button>
                  <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                     Agregar al carrito
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
                </div>
            </div>
        <?php endforeach; ?>


        <!-- Pagination -->
        <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-3">
          <ul class="pagination">
            <li class="page-item disabled">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- Pagination -->
      </div>
    </div>
  </div>
</section>

<style>
    .product{
        cursor: pointer;
    }
    .product:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap');

    html,
    body {
        height: 100%
    }

    body {
        display: grid;
        background: #fff;
        font-family: 'Manrope', sans-serif
    }

    .mydiv {
        margin-top: 50px;
        margin-bottom: 50px
    }

    .cross {
        font-size: 10px
    }

    .padding-0 {
        padding-right: 5px;
        padding-left: 5px
    }

    .img-style {
        margin-left: -11px;
        box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        max-width: 104% !important
    }

    .m-t-20 {
        margin-top: 20px
    }

    .bbb_background {
        background-color: #E0E0E0 !important
    }

    .ribbon {
        width: 150px;
        height: 150px;
        overflow: hidden;
        position: absolute
    }

    .ribbon span {
        position: absolute;
        display: block;
        width: 34px;
        border-radius: 50%;
        padding: 8px 0;
        background-color: #3498db;
        box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
        color: #fff;
        font: 100 18px/1 'Lato', sans-serif;
        text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
        text-transform: uppercase;
        text-align: center
    }

    .ribbon-top-right {
        top: -10px;
        right: -10px
    }

    .ribbon-top-right::before,
    .ribbon-top-right::after {
        border-top-color: transparent;
        border-right-color: transparent
    }

    .ribbon-top-right::before {
        top: 0;
        left: 17px
    }

    .ribbon-top-right::after {
        bottom: 17px;
        right: 0
    }

    .sold_stars i {
        color: orange
    }

    .ribbon-top-right span {
        right: 17px;
        top: 17px
    }

    div {
        display: block;
        position: relative;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box
    }

    .bbb_deals_featured {
        width: 100%
    }

    .bbb_deals {
        width: 100%;
        margin-right: 7%;
        padding-top: 80px;
        padding-left: 25px;
        padding-right: 25px;
        padding-bottom: 34px;
        box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        margin-top: 0px
    }

    .bbb_deals_title {
        position: absolute;
        top: 10px;
        left: 22px;
        font-size: 18px;
        font-weight: 500;
        color: #000000
    }

    .bbb_deals_slider_container {
        width: 100%
    }

    .bbb_deals_item {
        width: 100% !important
    }

    .bbb_deals_image {
        width: 100%
    }

    .bbb_deals_image img {
        width: 100%
    }

    .bbb_deals_content {
        margin-top: 33px
    }

    .bbb_deals_item_category a {
        font-size: 14px;
        font-weight: 400;
        color: rgba(0, 0, 0, 0.5)
    }

    .bbb_deals_item_price_a {
        font-size: 14px;
        font-weight: 400;
        color: rgba(0, 0, 0, 0.6)
    }

    .bbb_deals_item_price_a strike {
        color: red
    }

    .bbb_deals_item_name {
        font-size: 24px;
        font-weight: 400;
        color: #000000
    }

    .bbb_deals_item_price {
        font-size: 24px;
        font-weight: 500;
        color: #6d6e73
    }

    .available {
        margin-top: 19px
    }

    .available_title {
        font-size: 16px;
        color: rgba(0, 0, 0, 0.5);
        font-weight: 400
    }

    .available_title span {
        font-weight: 700
    }

    @media only screen and (max-width: 991px) {
        .bbb_deals {
            width: 100%;
            margin-right: 0px
        }
    }

    @media only screen and (max-width: 575px) {
        .bbb_deals {
            padding-left: 15px;
            padding-right: 15px
        }

        .bbb_deals_title {
            left: 15px;
            font-size: 16px
        }

        .bbb_deals_slider_nav_container {
            right: 5px
        }

        .bbb_deals_item_name,
        .bbb_deals_item_price {
            font-size: 20px
        }
    }

    .product-links {
        text-align: right;
    }

    .product-links a {
        display: inline-block;
        margin-left: 5px;
        color: #e1e1e1;
        transition: 0.3s;
        font-size: 17px;
    }

    .product-links a:hover {
        color: #fbb72c;
    }
</style>
<script src="js\tienda\producto.js"> </script>