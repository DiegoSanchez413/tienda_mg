$(document).ready(function () {
    combo_productos()
    listar()
});

//COMBO PRODUCTOS
function combo_productos() {
    $.post(base_url + "/comboProducto",
        function (data, textStatus, jqXHR) {
            $('#listProducto').html(data);
        },
    );
}

//buscar producto por ID
$("#listProducto").change(function (e) {
    if ($(this).val()) {
        e.preventDefault();
        $.post(base_url + "/getProducto-x-id", { id: $(this).val() },
            function (data, textStatus, jqXHR) {
                $("#nombre_producto").val(data.data[0].Nombre_Producto);
                $("#txtStock").val(data.data[0].Stock_Producto);
            },
            "JSON"
        );
    }
});

//REGISTRAR MOVIMIENTO
const formulario = $('form_kardex');
$(formulario).submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: base_url + "/registro_kardex",
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
                $('#tableMovimientos').DataTable().ajax.reload();
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
//listar
function listar() {
    $('#tableMovimientos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
        "ajax": {
            url: base_url + '/listarMovimientos',
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