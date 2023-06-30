<main class="app-content">
<div class="app-title">
        <div>
          <h1><i class="fa-solid fa-user-tag"></i> COMPRAS</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>inicio">Tienda Virtual</a></li>
        </ul>
      </div>
    <div class="mb-3">
        <a class="btn text-white bg-primary" href="<?php echo base_url() ?>/compras" style="border-radius: 10px;"><i class="fa fa-backward"></i> Regresar</a>
    </div>
    <div class="card shadow ml-6">
        <form class="needs-validation" id="form_compra" novalidate>
            <div class="card-body">
                <h5> REGISTRAR COMPRA </h5>
                <hr>
                <input type="hidden" id="id_compra" name="id_compra">

                <div class="row">
                <div class="form-group col-md-4">
                        <label for="codigo_compra">Código de Compra </label>
                        <input id="codigo_compra" class="form-control" name="codigo_compra" disabled style="background:rgba(112, 128, 144, 0.5);" value="<?=$generar_codigo;?>">

                        <div class="invalid-feedback">Este campo es requerido</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listUsuario">Usuario*</label>
                        <select class="form-control" data-live-search="true" id="listUsuario" name="listUsuario" required>
                            <option value="" selected>No seleccionado</option>
                            <?php foreach ($dato as $row) : ?>
                                <option value="<?= $row['ID_Usuario'] ?>"><?= $row['Nombre_Usuario'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_compra">Fecha</label>
                        <input type="date" id="fecha_compra" class="form-control" name="fecha_compra" required>

                        <div class="invalid-feedback">Este campo es requerido</div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="igv">IGV </label>
                        <input type="hidden"id="igv" name="igv" value="0.18" >
                        <input type="text" value="18%" class="form-control" disabled>

                        <div class="invalid-feedback">Este campo es requerido</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listEstado">Estado*</label>
                        <select class="form-control selectpicker" id="listEstado" name="listEstado" required>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                        <div class="invalid-feedback">Campo obligatorio</div>
                    </div>
                    
                </div>
                <input type="hidden" id="id_detalle_compra" name="id_detalle_compra">
                <hr>
                <br>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="hidden" id="nombre_producto" name="nombre_producto">
                        <label for="idProducto">Producto <span class="text-danger"></span></label>
                        <select id="idProducto" class="form-control select2 selectarticulos" style="width:100%" data-placeholder="--seleccionar--" name="idProducto">
                        <?php foreach ($prod as $row) : ?>
                            <option value="<?= $row['ID_Producto'] ?>"><?= $row['Nombre_Producto'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">Seleecione Producto</div>
                    </div> 

                    <div class="form-group col-md-4">
                        <input type="hidden" id="nombre_proveedor" name="nombre_proveedor">
                        <label for="idProveedor">Proveedor <span class="text-danger"></span></label>
                        <select id="idProveedor" class="form-control select2 selectarticulos" style="width:100%" data-placeholder="--seleccionar--" name="idProveedor">
                        <?php foreach ($prov as $row) : ?>
                            <option value="<?= $row['ID_Proveedor'] ?>"><?= $row['RazonSocial_Proveedor'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">Seleecione Proveedor</div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="cantidad">Cantidad <span class="text-danger">*</span></label>
                        <input type="number" step="1" id="cantidad" class="form-control" name="cantidad">
                        <div class="invalid-feedback">Este campo es requerido</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="precio_producto">Precio de Producto <span class="text-danger">*</span></label>
                        <input type="number" id="precio_producto" class="form-control" name="precio_producto" step="0.01">
                        <div class="invalid-feedback">Este campo es requerido</div>
                    </div>
    
                </div>


                <div class="row mt-4" style="display: flex; justify-content: right;">
                    <a class="btn btn-sm bg-primary text-white text-uppercase card__button" style="margin: auto;" onclick="AgregarCompra()">Agregar Compra</a>
                </div>
                <br>
           
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Proveedor</th>
                                    <th>Cantidad</th>
                                    <th>Precio producto</th>
                                    <th>Importe </th>
                                    <th>Opcion </th>
                                </tr>
                            </thead>
                            <tbody id="tbody_compras">

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
                                        <div class="text-danger" id="subtotal_compra">0</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="font-weight-bold">IGV (18%):</span>
                                    </td>
                                    <td>
                                        <input type="hidden" id="igv" class="igv" name="igv">
                                        <div style="display:flex">
                                        <span class="text-danger" id="mon_simbolo1">S/. </span>
                                        <div class="text-danger" id="igv_compra">0</div>
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
                                        <div class="text-danger" id="total_compra" >0</div>
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



<script src="<?php echo base_url() ?>/js/compras/compra.js"></script> 
<!--<script src="<?php echo base_url() ?>/recursos/js/bootstrap_validation.js"></script> -->
<!--<link rel="stylesheet" href="<?php echo base_url() ?>/recursos/css/table_buttons.css"> -->