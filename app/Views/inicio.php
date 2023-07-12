<main class="app-content">

  <div class="app-title">
    <div>
      <h1><i class="fa fa-home fa-sm mr-1"> </i> Inicio
      </h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">

      <li class="breadcrumb-item"><a href="<?= base_url(); ?>inicio">Tienda Virtual</a></li>
    </ul>
  </div>

  <div class="col-md-12 mb-4">
    <div class="card border-left-success shadow h-100 py-0">
      <div class="card-body">
        <h2>Bienvenido al sistema " <?= $_SESSION['nombre'] ?> "</h2>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- CARD CANTIDAD DE Ventas -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
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
      <div class="card border-left-success shadow h-100 py-2">
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
      <div class="card border-left-success shadow h-100 py-2">
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
      <div class="card card-style border-left-success">
        <div class="card-body">
          <h3 class="text-xs text-center font-weight-bold text-primary text-uppercase mb-1">Productos más vendidos</h3>
          <canvas id="reporte_rotacion_productos" height="200" width="400"></canvas>
        </div>
      </div>
    </div>

<!------INVENTARIO BAJO-------->
<?php $cant = 5; ?>
  <div class="col-md-6 mb-4">
    <div class="card card-style border-left-success">
      <div class="card-body">
        <h3 class="text-center font-weight-bold text-uppercase">PRODUCTOS CON BAJO STOCK</h3> <br>
        <span>PRODUCTOS CON MENOR CANTIDAD A -----------------> </span>
        <select id="select_cant" class="float-right ">
          <?php
          for ($i = 0; $i <= 100; $i++) {
            $selected = ($i == $cant) ? 'selected' : '';
            echo "
                            <option value='" . $i . "' " . $selected . ">" . $i . "</option>";
          }
          ?>
        </select>
        <canvas id="reporte_menos_productos" height="200" width="400"></canvas>
      </div>
    </div>
  </div>

  </div>

  

  <!--STYLE LOGIN-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>//css/inicio.css" type="text/css">

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="<?= base_url() ?>/js/chart/Chart.min.js"></script>
  <script src="<?= base_url() ?>/js/inicio/inicio.js"></script>



</main>