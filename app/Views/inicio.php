<main class="app-content">

  <div class="app-title">
    <div>
      <h1><i class="fa-solid fa-dashboard"></i> Dashboard
      </h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>inicio">Tienda Virtual</a></li>
    </ul>
  </div>
  <div class="container">
    <div>
      <h3> Bienvenido al sistema <?= $_SESSION['nombre'] ?></h3>
    </div>
    <br>
  </div>
  <div class="row">


    <!-- CARD CANTIDAD DE Ventas -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Cantidad Ventas</div>
              <h1 id="totalVentas"></h1>
            </div>
            <div class="col-auto">
              <i class="fa fa-line-chart fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CARD SumaVentas -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-success text-uppercase mb-1">
                Ganancias</div>
              <h1 id="sumaVentas"></h1>
            </div>
            <div class="col-auto">
              <h1 class="text-gray-300">S/.</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CARD Clientes -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                clientes</div>
              <h1 id="totalClientes"></h1>
            </div>
            <div class="col-auto">
              <h1 class="fa fa-users text-gray-300"></h1>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>

  <div class="row">
    <!-----PRODUCTOS-------->

    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Cantidad de productos</div>
              <h1><?= $CantInventario ?></h1>
            </div>
            <div class="col-auto">
              <i class="fas fa-box fa-4x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Usuarios -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Usuarios
              </div>
              <h1 id="totalUsuarios"></h1>
            </div>
            <div class="col-auto">
              <i class="fa fa-users fa-2x text-gray-300"></i>
            </div>

          </div>
        </div>
      </div>
    </div>



    <!------ROTACIÓN DE PRODUCTOS-------->

    <div class="col-md-6 mb-4">
      <div class="card card-style border-left-primary">
        <div class="card-body">
          <h6 class="text-xs text-center font-weight-bold text-primary text-uppercase mb-1">Productos mas vendidos</h6>
          <canvas id="reporte_rotacion_productos" height="200" width="400"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6 mb-4">
      <div class="card card-style border-left-primary">
        <div class="card-body">
          <h6 class="text-center text-gray-800">VENTAS POR MES</h6>
          <canvas id="grafica" height="200" width="400"></canvas>
        </div>
      </div>
    </div>


    <div>
      <canvas id=""></canvas>

    </div>

  </div>







  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="<?= base_url() ?>/js/chart/Chart.min.js"></script>
  <script src="<?= base_url() ?>/js/inicio/inicio.js"></script>



</main>