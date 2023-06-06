const purchase_detail = $('#tablaPurchasesDetail');
let purchase_id = document.getElementById('idPurchase');

$(document).ready(function () {

});


// handle if modalListPurchaseDetail is open
$('#modalListPurchaseDetail').on('shown.bs.modal', function (e) {
    listPurchaseDetail();
});



function listPurchaseDetail() {
    purchase_detail.DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
        "ajax": {
            url: base_url + 'mis-compras/detalle/' + purchase_id.value,
            type: "get",
            dataType: "json",
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 5,
        "order": [[0, "asc"]],
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

// function checkDetail(purchaseId) {
//     $.get(base_url + "/mis-compras/detalle/ " + purchaseId,
//         function (data, textStatus, jqXHR) {
//             console.log(data);
//             $('#modalListPurchaseDetail').modal('show'); //muestra el modal
//             // $("#idCliente").val(data.data[0].ID_Cliente);
//             // $("#txtNombre").val(data.data[0].Nombre_Cliente);
//             // $("#txtApellido").val(data.data[0].Apellido_Cliente);
//             // $("#txtIdentificacion").val(data.data[0].Dni_Cliente);
//             // $("#txtTelefono").val(data.data[0].Telefono_Cliente);
//             // $("#txtEmail").val(data.data[0].Correo_Cliente);
//             // $("#txtDireccion").val(data.data[0].Direccion_Cliente);

//         },
//         "json"
//     ).fail(function (jqXHR, textStatus, errorThrown) {
//         swal.fire({
//             title: "¡ERROR!",
//             html: "Error 500 Problemas en el servidor ",
//             icon: "error",
//             showConfirmButton: true,
//         });
//     });
// }