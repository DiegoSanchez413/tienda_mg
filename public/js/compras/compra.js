//AGREGAR COMPRA

let cant_compras = 0;
let cont_id = 0;
let sumaImportes = 0;
let sumaImportes_mod = 0;
let total = 0
let igv = 0.18;

function AgregarCompra() {
    let producto_compra = document.getElementById("idProducto").value;
    let proveedor_compra = document.getElementById("idProveedor").value;
    let cantidad_compra = document.getElementById("cantidad").value;

    let precio_Compra = document.getElementById("precio_producto").value;
    let importe_Compra = parseFloat(cantidad_compra) * parseFloat(precio_Compra);

    let fecha_Compra = document.getElementById("fecha_compra").value;
    let usuario_Compra = document.getElementById("listUsuario").value;

    let estado_Compra = document.getElementById("listEstado").value;

    let nombre_producto = document.getElementById("nombre_producto").value;
    let nombre_proveedor = document.getElementById("nombre_proveedor").value;


    if (proveedor_compra != "" && producto_compra != "" && cantidad_compra != "" && precio_Compra != "" && importe_Compra != "" && usuario_Compra != ""
        && fecha_Compra != "" && estado_Compra != "") {


        let id_row = 'row' + cant_compras;
        let fila = `<tr id="${id_row}">
                                        <td><input type="hidden" value="${cant_compras + 1}" name="cant_compras[]">${cant_compras + 1}</td>
                                        <td><input type="hidden" value="${producto_compra}" name="productoid[]">${nombre_producto}</td>
                                        <td><input type="hidden" value="${proveedor_compra}" name="proveedorid[]">${nombre_proveedor}</td>
                                        <td><input type="hidden" value="${cantidad_compra}" name="cantidad[]">${cantidad_compra}</td>
                                        <td><input type="hidden" value="${precio_Compra}" name="precio[]">${precio_Compra}</td>
                                        <td><input type="hidden" value="${importe_Compra}" name="importe_det[]">${importe_Compra}</td>
                                        <td><a href="#" onclick="eliminar_compra('${id_row}',${cant_compras});" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><i class="fa fa-solid fa-trash"></i></a></td>
                                    </tr>`;

        //SUBTOTAL
        sumaImportes = sumaImportes + parseFloat(importe_Compra);
        let sumaconComas = sumaImportes.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $('#subtotal_compra').html(sumaconComas);
        //IGV
        let impuesto = parseFloat(sumaImportes * igv);
        let impuestoconComas = impuesto.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $('#igv_compra').html(impuestoconComas);
        //TOTAL
        total = sumaImportes + impuesto;
        let totalConComas = total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $('#total_compra').html(totalConComas);

        $('#total').val(total.toFixed(2));
        $('#subtotal').val(sumaImportes.toFixed(2));
        $('#igv').val(impuesto.toFixed(2));
        $('#tbody_compras').append(fila);              //Agrega Fila a la Tabla
        $('#idProducto').val("").trigger('change');   //Limpia los select
        $('#idProveedor').val("");            //Limpian campos
        $('#cantidad').val("");
        $('#precio_producto').val("");
        $('#importe').val("");
        cant_compras++;
    } else {
        Swal.fire({
            html: 'Advertencia: No se admite campos vacios',
            icon: 'warning',
        })
    }

}

//Esto sucede si se elimina una fila, se restan los datos ingresados de la fila eliminada
function eliminar_compra(id_row, row) {
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
            $('#tbody_compras tr').each(function () {
                sumaImportes += parseFloat($(this).find('input[name="importe_det[]"]').val());
            });

            $('#subtotal_compra').html(sumaImportes.toFixed(2));

            let impuesto = parseFloat(sumaImportes * igv);
            $('#igv_compra').html(impuesto.toFixed(2));

            total = sumaImportes + impuesto;
            $('#total_compra').html(total.toFixed(2));

            $('#total').val(total.toFixed(2));
            $('#subtotal').val(sumaImportes.toFixed(2));
            $('#igv').val(impuesto.toFixed(2));

            cant_compras--;
            $('#idProducto').val('').focus();

        }
    });
}


//BUSCAR PRODUCRRTO X ID
$("#idProducto").change(function (e) {
    e.preventDefault();
    $.post(base_url + "/getProducto-x-id", { id: $(this).val() },
        function (data, textStatus, jqXHR) {
            if (data && data.data && data.data.length > 0) {
                $('#nombre_producto').val(data.data[0].Nombre_Producto);

            }
        },
        'json'
    );
});

//BUSCAR PROVEEDOR POR ID

$("#idProveedor").change(function (e) {
    e.preventDefault();
    $.post(base_url + "/getProveedor-x-id", { id: $(this).val() },
        function (data, textStatus, jqXHR) {
            if (data && data.data && data.data.length > 0) {
                $('#nombre_proveedor').val(data.data[0].RazonSocial_Proveedor);

            }
        },
        'json'
    );
});

const formulario = $('#form_compra');

$(formulario).submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: base_url + "/RegistrarCompra",
        data: new FormData(formulario[0]),
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.error == "") {
                formulario[0].reset();
                swal.fire({
                    title: response.ok,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                location.href = base_url + '/compras'
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



$(document).ready(function () {
    listar();

});

function listar() {
    $('#tableCompras').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
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
            url: base_url + "/listarCompras",
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

function mostrar_compras(id) {
    $("#modaldetalle").modal("show");
    $("#lbltitulo").html("Lista Compras");
    listar_detalle_compras(id);
}

function listar_detalle_compras(id) {
    $('#tabla_detalle').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
        "ajax": {
            url: base_url + "/listarDetalle",
            type: "post",
            data: {
                //nombre de campo controlar/dato que paso
                id: id
            }
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

//PDF
function pdf(id) {
    $('#pdf_generar').modal('show');
    $('#frame').attr('src', base_url + "/pdf/" + id);
    $('#descargar').attr('href', base_url + "/pdf/" + id);
}
