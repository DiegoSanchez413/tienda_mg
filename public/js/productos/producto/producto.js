// Abrir Modal
const formulario = $('#formProducto');

function openModal(){
    $('#modalFormProducto').modal('show');
    formulario[0].reset();
    $("#idProducto").val("");
    $("#titleModal").html("Nuevo Registro");
}

//REGISTRAR Y EDITAR PRODUCTO
$(formulario).submit(function (e){
    e.preventDefault();
    $.ajax({
        type: "post",
        url: base_url + "/registrar_actualizar_productos",
        data: new FormData(formulario[0]),
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
            if(response.error == ""){
                formulario[0].reset();
                $('#tableProductos').DataTable().ajax.reload();
                swal.fire({
                    title: response.ok,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                $('#modalFormProducto').modal('hide');
                return false;
            }
            else{
                swal.fire({
                    title: '¡ERROR!',
                    html: response.error,
                    icon:'error',
                    showConfirmButton: true
                });
            }
        },

        error: function (){
            swal.fire({
                title: '¡ERROR 500!',
                html: 'error de servidor interno',
                icon: 'error',
                showConfirmButton: true
            });
        }
    });

});

//listar productos

$(document).ready(function () {
    listar();
   
});

function listar() {
    $('#tableProductos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
        "ajax": {
            url: base_url + '/listarProductos',
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

const formulariofoto = $('#formImagen');
function cargar_foto(id){

    $('#modalFormImagen').modal('show');
    $('#idImagen').val(id);
}


//registrar foto

$(formulariofoto).submit(function (e){
    e.preventDefault();
    $.ajax({
        type: "post",
        url: base_url + "/registrar_foto",
        data: new FormData(formulariofoto[0]),
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
            if(response.error == ""){
                formulariofoto[0].reset();
                $('#tableProductos').DataTable().ajax.reload();
                swal.fire({
                    title: response.ok,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                $('#mmodalFormImagen').modal('hide');
                return false;
            }
            else{
                swal.fire({
                    title: '¡ERROR!',
                    html: response.error,
                    icon:'error',
                    showConfirmButton: true
                });
            }
        },

        error: function (){
            swal.fire({
                title: '¡ERROR 500!',
                html: 'error de servidor interno',
                icon: 'error',
                showConfirmButton: true
            });
        }
    });

});

function EditarProducto(id){
  
    $.post(base_url + "/getProducto-x-id", { id: id },
        function (data, textStatus, jqXHR) {
            
            $('#modalFormProducto').modal('show'); //muestra el modal
            $("#titleModal").html("Actualizar Registro");
            $("#idProducto").val(data.data[0].ID_Producto);
            $("#listCatid").val(data.data[0].ID_Categoria);
            $("#txtProducto").val(data.data[0].Codigo_Producto);
            $("#txtNombre").val(data.data[0].Nombre_Producto);
            $("#txtStock").val(data.data[0].Stock_Producto);
            $("#txtPrecio").val(data.data[0].Precio_Producto);
            $("#txtMarca").val(data.data[0].Marca_Producto);
            $("#listEstado").val(data.data[0].Estado_Producto).trigger('change');
            $("#txtDescripcion").val(data.data[0].Descripcion_Producto);
           
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


function EliminarProducto(id) {
    swal.fire({
        title: "¿Desea Eliminar el Registro?",
        text: "Una vez eliminido el registro no se podra recuperar",
        icon: "warning",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { //si responde si
        if (result.value) {
            $.post(base_url + "/eliminar_productos", { id: id },
                function (data, textStatus, jqXHR) {
                    if (data.error == "") {
                        $('#tableProductos').DataTable().ajax.reload(); //actualizamos la tabla
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
