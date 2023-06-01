//Listar
$(document).ready(function () {
    listar();

});

function listar() {
    $('#tableUsuarios').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
        "ajax": {
            url: base_url + '/listarUsuarios',
            type: "post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 5,
        "order": [[0, "desc"]],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de MAX registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "pagingType": "simple_numbers",
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    });

}

const formulario = $('#formUsuario');

function openModal() {
    $('#modalFormUsuario').modal('show'); //muestra el modal
    formulario[0].reset(); //para limpiar el formulario
    $("#txtPassword").attr("required", true);
    $("#idUsuario").val("");
    $("#nota_password").html("");
}

//Registrar y editar usuario (envio de datos al servidor)
$(formulario).submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: base_url + "/registrar_actualizar_usuarios",
        data: new FormData(formulario[0]), //capturamos los datos del formulario para enviar al controlador
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false, //para que reconozca el ajax
        success: function (response) {
            if (response.error == "") {
                formulario[0].reset();
                $('#tableUsuarios').DataTable().ajax.reload(); //actualizamos la tabla
                swal.fire({
                    title: response.ok,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                $('#modalFormUsuario').modal('hide');
                return false;
            }
            else {
                swal.fire({
                    title: '¡ERROR!',
                    html: response.error,
                    icon: 'error',
                    showConfirmButton: true
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

//pasar datos al modal
function EditarUsuario(id) {
    $("#txtPassword").attr("required", false); //quitarle el requerido del campo
    $.post(base_url + "/getUsuario-x-id", { id: id },
        function (data, textStatus, jqXHR) {
            $('#modalFormUsuario').modal('show'); //muestra el modal
            $("#nota_password").html("Nota: Si rellena este campo, la contraseña será cambiada para este miembro.");
            $("#idUsuario").val(data.data[0].ID_Usuario);
            $("#listRolid").val(data.data[0].ID_Rol);
            $("#txtNombre").val(data.data[0].Nombre_Usuario);
            $("#txtIdentificacion").val(data.data[0].DNI_Usuario);
            $("#txtEmail").val(data.data[0].Correo_Usuario);
            $("#listEstado").val(data.data[0].Estado_Usuario).trigger('change');
        },
        "json"
    ).fail(function (jqXHR, textStatus, errorThrown) {
        swal.fire({
            title: "¡ERROR!",
            html: "Error 500 Problemas en el servidor ",
            icon: "error",
            showConfirmButton: true,
        });
    });
}

function EliminarUsuario(id) {
    swal.fire({
        title: "¿Desea Eliminar el Registro?",
        text: "Una vez eliminido el registro no se podra recuperar",
        icon: "warning",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { //si responde si
        if (result.value) {
            $.post(base_url + "/eliminar_usuarios", { id: id },
                function (data, textStatus, jqXHR) {
                    if (data.error == "") {
                        $('#tableUsuarios').DataTable().ajax.reload(); //actualizamos la tabla
                        Swal.fire({
                            text: data.ok,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.error,
                            icon: 'error',
                            showConfirmButton: true,
                        });
                    }
                },
                "json"
            ).fail(function (jqXHR, textStatus, errorThrown) { //para ver si hay eerror en el servidor
                swal.fire({
                    title: "¡ERROR!",
                    html: "Error 500 Problemas en el servidor ",
                    icon: "error",
                    showConfirmButton: true,
                });
            });;
        }
    });
}
