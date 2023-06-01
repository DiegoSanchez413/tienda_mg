<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa-solid fa-user-tag"></i> PROVEEDORES
          <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fa-solid fa-circle-plus">
          </i> Nuevo</button>
          </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>inicio">Tienda Virtual</a></li>
        </ul>
      </div>
        <div class="row">
          <div class="col-md-12">
          <div class="tile">
            <div class="tle-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableProveedor">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Ruc</th>
                      <th>Razón Social</th>
                      <th>Teléfono</th>
                      <th>Correo</th>
                      <th>Dirección</th>
                      <th>Acciones</th>          

                    </tr>
                  </thead>
                 
                </table>
              </div>
            </div>
          </div>
          </div>
      </div>
    </main>

    <?php include "modal.php" ?>
    <script src="<?= base_url()?>/js/proveedores/proveedor.js"></script>
 
   