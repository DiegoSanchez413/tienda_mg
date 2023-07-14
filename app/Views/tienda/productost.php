<div class="bg-gradient-primary">
<section class="mt-3">
  <div class="container">
    <div class="row">

      <div class="col-lg-3">
        <div class="collapse card d-lg-block mb-5" id="navbarSupportedContent">
        <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Marca
                  </button>
                </h2>
                <!-- Marca -->
                <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo" >
                  <div class="accordion-body">
                    <div id="brand-list">
                    </div>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header" id="categoria-collapse">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse" aria-expanded="false" aria-controls="flush-collapse">
                    Categorias
                  </button>
                </h2>
                <!-- Categorias -->
                <div id="flush-collapse" class="accordion-collapse collapse show" aria-labelledby="categoria-collapse" >
                  <div class="accordion-body">
                    <div id="category-list">
                    </div>
                  </div>
                </div>
              </div>
              <!-- Rango -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Precio
                  </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse show" aria-labelledby="flush-headingThree" >
                  <div class="accordion-body">
                      <div class="range">
                        <input type="range" class="form-range" id="product-list-range"  value="0" min="0" max="10000" step="1" />
                      </div>
                      <div class="row mb-3">
                        <div class="col-6">
                          <p class="mb-0">
                            Min
                          </p>
                          <div class="form-outline">
                            <input type="number" id="min-range" class="form-control"  value="0"/>
                            <!-- <label class="form-label" for="typeNumber">$0</label> -->
                          </div>
                        </div>
                        <div class="col-6">
                          <p class="mb-0">
                            Max
                          </p>
                          <div class="form-outline">
                            <input type="number" id="max-range" class="form-control" value="5000"/>
                            <!-- <label class="form-label" for="typeNumber">$1,0000</label> -->
                          </div>
                        </div>
                      </div>
                      <button type="button" class="btn btn-white w-100 border border-secondary" onclick="filterByPrice()"
                      >Aplicar</button>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>

      <div class="col-lg-9">
        <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
          <strong class="d-block py-2" id="total-product-list"></strong>
          <div class="ms-auto">
            <select class="form-select d-inline-block w-auto border pt-1" id="sort-by">
              <option value="0">Más recientes</option>
              <option value="1">Más vendidos</option>
              <option value="2">Menor precio</option>
              <option value="3">Mayor precio</option>
            </select>
            <!-- <div class="btn-group shadow-0 border">
              <a href="#" class="btn btn-light" title="List view">
                <i class="fa fa-bars fa-lg"></i>
              </a>
              <a href="#" class="btn btn-light active" title="Grid view">
                <i class="fa fa-th fa-lg"></i>
              </a>
            </div> -->
          </div>
        </header>

      <div id="product-list" style="overflow-y: scroll; height: 500px; overflow-x: hidden;">></div>



        <!-- Pagination -->
        <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-3">
          <ul class="pagination" id="pagination">
            <!-- <li class="page-item disabled">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li> -->
            <!-- <li class="page-item active"><a class="page-link" data-page="1">1</a></li>
            <li class="page-item"><a class="page-link" data-page="2">2</a></li>
            <li class="page-item"><a class="page-link" data-page="3">3</a></li>
            <li class="page-item"><a class="page-link" data-page="4">4</a></li> -->
            <!-- <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li> -->
          </ul>
        </nav>
        <!-- Pagination -->
      </div>
    </div>
  </div>
</section>
</div>
<style>
  .bg-gradient-primary {
    background-color: #a1c2c6;
    background-image: linear-gradient(180deg, #3C9BA6 10%, #a1c2c6 100%);
    background-size: cover
}
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