const formulario = $('#formClientet');
//Registrar y editar cliente (envio de datos al servidor)
$(formulario).submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: base_url + "/registrar_clientes",
        data: new FormData(formulario[0]), //capturamos los datos del formulario para enviar al controlador
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false, //para que reconozca el ajax
        success: function (response) {
            if (response.error == "") {
                formulario[0].reset();
                $('#tableClientes').DataTable().ajax.reload(); //actualizamos la tabla
                swal.fire({
                    title: response.ok,
                    html: "¡Sigamos mejorando nuestra comunidad!",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false,
                });
                
                return false;
            } else {
                swal.fire({
                    title: "¡Error!",
                    html: response.error,
                    icon: "error",
                    showConfirmButton: true,
                });
            }
        },
        error: function () {
            swal.fire({
                title: '¡ERROR 500!',
                html: 'error de servidor interno',
                icon: 'error',
                showConfirmButton: true
            });
        }
    });

});
