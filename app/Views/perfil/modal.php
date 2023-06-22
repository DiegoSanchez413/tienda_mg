<!-- Modal foto digital --->
<div id="modal_foto" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog  modal-dialog-centered " role="document">
        <div class="modal-content bd-0">
            <div id="head" class="modal-header pd-y-20 pd-x-25 text-white bg-dark">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Actualizar Foto: </h6>
            </div>
            <div class="modal-body">
                <form class="needs-validation" id="form_foto" novalidate >
                    <div class="form-group">
                        <label for="my-input">Foto: <span class="text-danger">*</span></label>
                        <input id="foto" class="form-control" type="file" name="foto" required>
                        <div class="invalid-feedback">
                            Campo Obligatorio*
                        </div>
                    </div>
                    <div class="text-center" id="prev_foto"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar </button>
                <button type="reset" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>