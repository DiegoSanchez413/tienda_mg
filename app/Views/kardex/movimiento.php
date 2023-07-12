<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa-solid fa-user-tag"></i> KARDEX</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>inicio">Tienda Virtual</a></li>
        </ul>
    </div>
    <div class="card shadow ml-6">
        <form class="needs-validation" id="form_kardex" novalidate>
            <div class="card-body">
                <h5> REGISTRO MOVIMIENTOS </h5>
                <hr>
                <input type="hidden" id="id_kardex" name="id_kardex">

                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="hidden" id="nombre_producto" name="nombre_producto">
                        <label for="listProducto">Producto<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="listProducto" id="listProducto" style="width:100%" data-placeholder="---seleccionar---"></select>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtStock">Stock<span class="text-danger">*</span></label>
                        <input type="number" step="1" class="form-control" data-live-search="true" id="txtStock" name="txtStock" required>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tipo_movimiento">Tipo de movimiento<span class="text-danger">*</span></label>
                        <select class="form-control selectpicker" id="tipo_movimiento" name="tipo_movimiento" required>
                            <option value="" selected>---seleccionar---</option>
                            <option value="1">Compra</option>
                            <option value="2">Venta</option>
                        </select>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="txtCantidad">Cantidad de producto<span class="text-danger">*</span></label>
                        <input type="number" step="1" class="form-control" data-live-search="true" id="txtCantidad" name="txtCantidad" required>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha">Fecha<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="txtFecha" name="txtFecha" required>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <button type="submit" class="btn bg-primary text-white float-right mb-2" >Guardar</button>
                </div>
            </div>
        </form>
    </div>
    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tle-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableMovimientos">
                            <thead>
                                <h5> MOVIMIENTOS </h5>
                                <hr>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Producto</th>
                                    <th>Stock </th>
                                    <th>Tipo de movimiento</th>
                                    <th>Cantidad</th>
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




<script src="<?php echo base_url() ?>/js/kardex/kardex.js"></script>
<!--<script src="<?php echo base_url() ?>/recursos/js/bootstrap_validation.js"></script> -->
<!--<link rel="stylesheet" href="<?php echo base_url() ?>/recursos/css/table_buttons.css"> -->