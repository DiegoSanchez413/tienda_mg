<main class="app-content">
<div class="app-title">
        <div>
          <h1><i class="fa-solid fa-user-tag"></i>PERFIL</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>inicio">Tienda Virtual</a></li>
        </ul>
      </div>     
<div class="container-fluid">
<input id="id_usuario" type="hidden" name="id_usuario" value="<?php echo $_SESSION['id']?>">
    <div class="row">
        <div class="col-md-6">
            <div class="card border-left-success">
                <div class="card-header text-white bg-dark">
                    <h5 class="text-center" id="nombre_user"></h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div>
                            <p id="texto-perfil"></p>
                        </div>
                        <img class="rounded-circle img-thumbnail mb-4" id="perfil" alt="perfil">
                        <div>
                            <a href="#" onclick="actualizar_foto()"> Actualizar Perfil <i class="fa fa-camera "></i></a>
                        </div>
                    </div>
                    <br>
                    <form class="needs-validation" id="editardatos" novalidate>
                        <div class="form-group">
                            <label for="my-input">Nombre: <span class="text-danger">*</span></label>
                            <input id="nombre" class="form-control" type="text" name="nombre" required>
                            <div class="invalid-feedback">
                                Campo Obligatorio*
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="my-input">Correo: <span class="text-danger">*</span></label>
                            <input id="usuario" class="form-control" type="email" name="usuario" required>
                            <div class="invalid-feedback">
                                Campo Obligatorio*
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="my-input">Rol: <span class="text-danger">*</span></label>
                            <input id="rol" class="form-control" type="text" name="tol" disabled>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" type="submit">Guardar</button>
                </div>
                </form>
            </div>
            <br>
        </div>
        <div class="col-md-6">
            <div class="card border-left-primary">
                <div class="card-header text-white bg-dark">
                    <h5 class="text-center">Firma Digital</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div>
                            <p id="texto-firma"></p>
                        </div>
                        <img class="img-thumbnail" id="firma_digital" alt="Firma_digital">
                        <div>
                            <a href="#" onclick="actualizar_firma()"> Actualizar Firma Digital <i class="fa fa-camera "></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card border-left-warning">
                <div class="card-header text-white bg-dark">
                    <h5 class="text-center">Cambia tu contraseña</h5>
                </div>
                <div class="card-body">
                    <form class="needs-validation" id="form_password" novalidate>
                        <div class="form-group">
                            <label for="my-input">Contraseña anterior: <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="contraseña_anterior" required>
                            <div class="invalid-feedback">
                                Campo Obligatorio*
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="my-input">Nueva contraseña: <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="nueva_contraseña" required>
                            <div class="invalid-feedback">
                                Campo Obligatorio*
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="my-input">Repita la nueva contraseña: <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="repite_contraseña" required>
                            <div class="invalid-feedback">
                                Campo Obligatorio*
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" type="submit">Guardar</button>
                </div>
                </form>
            </div>
            <br>
        </div>
    </div>
</div>
</main>
<?php include 'modal.php'?>
<script src="<?php echo base_url() ?>/js/perfil/perfil.js"></script>
<style>
    .img-thumbnail  {
        width: 150px;
        height: 150px;
    }
</style>