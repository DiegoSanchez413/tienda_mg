<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa-solid fa-user-tag"></i> RESUMEN DE COMPRAS </h1>
            <br>
            <a class="btn btn-sm  bg-primary text-white text-uppercase card__button" href="<?php echo base_url() ?>/RegistrarCompra">Nueva Compra</a>
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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>