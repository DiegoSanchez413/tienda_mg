<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa-solid fa-user-tag"></i> VENTAS</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>inicio">Tienda Virtual</a></li>
        </ul>
    </div>
    <div class="mb-3">
        <a class="btn text-white bg-primary" href="<?php echo base_url() ?>/ventas" style="border-radius: 10px;"><i class="fa fa-backward"></i> Regresar</a>
    </div>
    <div class="card shadow ml-6">
        <form class="needs-validation" id="form_venta" novalidate>
            <div class="card-body">
                <h5> REGISTRAR VENTA </h5>
                <hr>
                <input type="hidden" id="id_venta" name="id_venta">

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="codigo_venta">Código de Compra </label>
                        <input id="codigo_venta" class="form-control" name="codigo_venta" disabled value="<?= $generar_codigo; ?>">
                        <div class="invalid-feedback">Este campo es requerido</div>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="listCliente">Cliente<span class="text-danger">*</span></label>
                        <select class="form-control select2" style="width:100%" id="listCliente" name="listCliente" required>
                            <option value="" selected disabled>No seleccionado</option>
                            <?php foreach ($dato as $row) : ?>
                                <option value="<?= $row['ID_Cliente'] ?>"><?= $row['Nombre_Cliente'] . " " . $row['Apellido_Cliente'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                    <div class="form-group col-md-3">
                        <br>
                        <a class="btn form-control bg-primary text-white text-uppercase card__button" href="<?php echo base_url() ?>/clientes">Nuevo cliente</a>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="fecha">Fecha<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="txtFecha" name="txtFecha" required>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">IGV </label>
                        <input type="hidden" id="" name="" value="0.18">
                        <input type="text" value="18%" class="form-control" disabled>

                        <div class="invalid-feedback">Este campo es requerido</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="listEstado">Estado<span class="text-danger">*</span></label>
                        <select class="form-control selectpicker" id="listEstado" name="listEstado" required>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>


                </div>
                <input type="hidden" id="id_detalle_venta" name="id_detalle_venta">
                <hr>
                <br>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="hidden" id="nombre_producto" name="nombre_producto">
                        <label for="listProducto">Producto<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="listProducto" id="listProducto" style="width:100%" data-placeholder="---seleccionar---"></select>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtCantidad">Cantidad<span class="text-danger">*</span></label>
                        <input type="number" step="1" class="form-control" id="txtCantidad" name="txtCantidad" required>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtPrecio">Precio<span class="text-danger">*</span></label>
                        <input type="number" step="1" class="form-control" data-live-search="true" id="txtPrecio" name="txtPrecio" required>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                </div>
                <div class="row mt-4" style="display: flex; justify-content: right;">
                    <a class="btn btn-sm bg-primary text-white text-uppercase card__button" style="margin: auto;" onclick="AgregarVenta()">Agregar Venta</a>
                </div>
                <br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio producto</th>
                                    <th>Importe </th>
                                    <th>Opcion </th>
                                </tr>
                            </thead>
                            <tbody id="tbody_ventas">

                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-8 offset-md-4">
                        <table class="table text-right">
                            <tbody id="tbody_ejemplo">
                                <tr>
                                    <td><span class="font-weight-bold">SubTotal:</span>
                                    </td>
                                    <td>
                                        <input type="hidden" id="subtotal" class="subtotal" name="subtotal">
                                        <div style="display:flex">
                                            <span class="text-danger" id="mon_simbolo1">S/. </span>
                                            <div class="text-danger" id="subtotal_venta">0</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="font-weight-bold">Igv(18%):</span>
                                    </td>
                                    <td>
                                        <input type="hidden" id="igv" class="igv" name="igv">
                                        <div style="display:flex">
                                            <span class="text-danger">S/.</span>
                                            <div class="text-danger" id="igv_venta">0</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="font-weight-bold">Total :</span>
                                    </td>
                                    <td>
                                        <input type="hidden" id="total" class="total" name="total">
                                        <div style="display: flex;">
                                            <span class="text-danger" id="mon_simbolo3">S/. </span>
                                            <div class="text-danger" id="total_venta">0</div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <div class="card-footer bg-white">
                <button type="submit" class="btn bg-primary text-white float-right mb-2" id="button_add">Guardar</button>
            </div>
        </form>
    </div>
</main>



<script src="<?php echo base_url() ?>/js/ventas/ventas.js"></script>
<!--<script src="<?php echo base_url() ?>/recursos/js/bootstrap_validation.js"></script> -->
<!--<link rel="stylesheet" href="<?php echo base_url() ?>/recursos/css/table_buttons.css"> -->