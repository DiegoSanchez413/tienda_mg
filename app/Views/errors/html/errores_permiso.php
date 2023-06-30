<div class="container-fluid">
    <SCript>
        $(document).ready(function() {
            Swal.fire({
                title: 'ACCESO DENEGADO!',
                html: "No tiene permisos para acceder a este modulo",
                icon: 'error',
                showConfirmButton: true,
            })
            setTimeout(function () {
                    location.href = base_url + "/inicio";
                }, 1800)
        });
    </SCript>
</div>
