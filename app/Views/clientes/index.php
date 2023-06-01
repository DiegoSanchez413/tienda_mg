<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa-solid fa-user-tag"></i>CLIENTES
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
                <table class="table table-hover table-bordered" id="tableClientes">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>DNI</th>
                      <th>Telefono</th>
                      <th>Correo</th>
                      <th>Direccion</th>
                      <th>Estado</th>
                      <th>Acciones</th>  
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>
      </div>
    </main>
    <?php include "modal.php" ?> <!-- llamar al modal (incluir)  -->
    <script src="<?= base_url()?>/js/clientes/clientes.js"></script>
    