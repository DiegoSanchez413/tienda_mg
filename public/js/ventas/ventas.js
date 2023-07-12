$(document).ready(function () {
    listar()
    combo_productos();

    //$('.select2').select2();
});
function mostrar_ventas(id) {
    $("#modaldetalle").modal("show");
    $("#lbltitulo").html("Lista Ventas");
    listar_detalle_venta(id);
}
function listar() {
    $('#tableVentas').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom:"<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12'i><'col-sm-12'p>>",
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'Exportar a PDF',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    },
                    orientation: 'portrait',
                },
                {
                    extend: 'excelHtml5',
                    text: 'Exportar a Excel',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    },
                },
                {
                    extend: 'csvHtml5',
                    text: 'Exportar a CSV',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
            ],
        "ajax": {
            url: base_url + '/listarVenta',
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
            },


        },
        "pagingType": "simple_numbers",
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],


    });
}

function listar_detalle_venta(id) {
    $('#tabla_detalle').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
        "ajax": {
            url: base_url + "/listarDetalleVenta",
            type: "post",
            data: {
                //nombre de campo controlar/dato que paso
                id: id
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 4,
        "order": [[0, "desc"]],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
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
//buscar producto por ID
$("#listProducto").change(function (e) {
    if ($(this).val()) {
        e.preventDefault();
        $.post(base_url + "/getProducto-x-id", { id: $(this).val() },
            function (data, textStatus, jqXHR) {

                $("#nombre_producto").val(data.data[0].Nombre_Producto);
                $("#txtPrecio").val(data.data[0].Precio_Producto);


            },
            "JSON"
        );
    }


});


//agregar venta
let igv = 0.18;
let cant_ventas = 0;
let sumaImportes = 0;
let total = 0;
function AgregarVenta() {
    let cliente_venta = document.getElementById("listCliente").value;
    let producto_venta = document.getElementById("listProducto").value;

    let fecha_venta = document.getElementById("txtFecha").value;
    let estado_venta = document.getElementById("listEstado").value;

    let cantidad_venta = document.getElementById("txtCantidad").value;
    let precio_venta = document.getElementById("txtPrecio").value;

    let importe_venta = parseFloat(cantidad_venta) * parseFloat(precio_venta);

    let nombre_producto = document.getElementById("nombre_producto").value;

    // Verificar si el producto ya existe en la tabla
    let existeProducto = false;
    $('#tbody_ventas tr').each(function () {
        let productoExistente = $(this).find('input[name="productoid[]"]').val();
        if (productoExistente === producto_venta) {
            existeProducto = true;
            return false; // Salir del bucle each() si se encuentra el producto
        }
    });

    if (cliente_venta != "" && estado_venta != "" && fecha_venta != "" && producto_venta != "" && cantidad_venta != "" && precio_venta != "" && importe_venta != "" && nombre_producto != "") {
        if (existeProducto) {
            Swal.fire({
                html: 'El producto ya existe en la tabla',
                icon: 'warning',
            });
            return; // Salir de la función si el producto ya existe
        }

        let id_row = 'row' + cant_ventas;
        let fila = `<tr id="${id_row}">
            <td><input type="hidden" value="${cant_ventas + 1}" name="cant_ventas[]">${cant_ventas + 1}</td>
            <td><input type="hidden" value="${producto_venta}" name="productoid[]">${nombre_producto}</td>
            <td><input type="hidden" value="${cantidad_venta}" name="cantidad[]">${cantidad_venta}</td>
            <td><input type="hidden" value="${precio_venta}" name="precio[]">${precio_venta}</td>
            <td><input type="hidden" value="${importe_venta}" name="importe_det[]">${importe_venta}</td>
            <td><a href="#" onclick="eliminar_venta('${id_row}',${cant_ventas});" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><i class="fa fa-solid fa-trash"></i></a></td>
            </tr>`;

        //subtotal
        sumaImportes = sumaImportes + parseFloat(importe_venta);
        let sumaconComas = sumaImportes.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $('#subtotal_venta').html(sumaconComas);
        //igv
        let impuesto = parseFloat(sumaImportes * igv);
        let impuestoconComas = impuesto.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $('#igv_venta').html(impuestoconComas);
        //total
        total = sumaImportes + impuesto;
        let totalConComas = total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $('#total_venta').html(totalConComas);

        $('#total').val(total.toFixed(2));
        $('#subtotal').val(sumaImportes.toFixed(2));
        $('#igv').val(impuesto.toFixed(2));
        $('#tbody_ventas').append(fila);
        $('#listProducto').val("").trigger('change');
        $('#cantidad').val("");
        $('#precio').val("");
        $('#importe').val("");

        cant_ventas++;
    } else {
        Swal.fire({
            html: 'Advertencia: No se admiten campos vacíos',
            icon: 'warning',
        });
    }
}


//Esto sucede si se elimina una fila, se restan los datos ingresados de la fila eliminada
function eliminar_venta(id_row, row) {
    Swal.fire({
        title: '¿Desea eliminar esta fila?',
        showCancelButton: true,
        confirmButtonText: `Eliminar`,
        confirmButtonColor: "#FF0000",
        icon: "warning",
    }).then((result) => {
        if (result.isConfirmed) {
            $("#row" + row).remove();
            Swal.fire({
                html: 'Fila eliminada!',
                timer: 1000,
                icon: 'success',
                showConfirmButton: false
            });

            // Recalcular subtotal, IGV y total
            sumaImportes = 0;
            $('#tbody_ventas tr').each(function () {
                sumaImportes += parseFloat($(this).find('input[name="importe_det[]"]').val());
            });

            $('#subtotal_venta').html(sumaImportes.toFixed(2));

            let impuesto = parseFloat(sumaImportes * igv);
            $('#igv_venta').html(impuesto.toFixed(2));

            total = sumaImportes + impuesto;
            $('#total_venta').html(total.toFixed(2));

            $('#total').val(total.toFixed(2));
            $('#subtotal').val(sumaImportes.toFixed(2));

            cant_compras--;
            $('#idProducto').val('').focus();
        }
    });
}



const formulario = $('#form_venta');
$(formulario).submit(function (e) {

    //Registrar y editar cliente (envio de datos al servidor)
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: base_url + "/RegistrarVenta",
        data: new FormData(formulario[0]), //capturamos los datos del formulario para enviar al controlador
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false, //para que reconozca el ajax
        success: function (response) {
            if (response.error == '') {
                formulario[0].reset();
                swal.fire({
                    title: response.ok,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                location.href = base_url + '/ventas'
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

function combo_productos() {
    $.post(base_url + "/comboProducto",
        function (data, textStatus, jqXHR) {
            $('#listProducto').html(data);
        },

    );

}

function EditarVenta(id) {

    $.post(base_url + "/getVenta-x-id", { id: id },
        function (data, textStatus, jqXHR) {
            $('#modalFormVenta').modal('show'); //muestra el modal
            $("#idVenta").val(data.data[0].ID_Venta);
            $("#listCliente").val(data.data[0].ID_Cliente);
            $("#txtFecha").val(data.data[0].Fecha_Venta);
            $("#listEstado").val(data.data[0].Estado_Venta);
            $("#txtIgv").val(data.data[0].Igv_Venta);
            $("#txtTotalventa").val(data.data[0].Total_Venta);
            $("#txtSubtotal").val(data.data[0].SubTtotal_Venta);

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

//funcion para eliminar cliente

function EliminarVenta(id) {
    swal.fire({
        title: "¿Desea Eliminar el Registro?",
        text: "Una vez eliminado el registro no se podra recuperar",
        icon: "warning",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { //si responde si
        if (result.value) {
            $.post(base_url + "/eliminar_ventas", { id: id },
                function (data, textStatus, jqXHR) {
                    if (data.error == "") {
                        $('#tableVentas').DataTable().ajax.reload(); //actualizamos la tabla
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

//PDF
function pdf(id) {
    $('#pdf_generar2').modal('show');
    $('#frame2').attr('src', base_url + "/pdf2/" + id);
    $('#descargar').attr('href', base_url + "/pdf2/" + id);
}

