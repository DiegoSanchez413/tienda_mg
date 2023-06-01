


//AGREGAR COMPRA

let cant_compras = 0;
let cont_id = 0;
let sumaImportes = 0;
let sumaImportes_mod = 0;
let total = 0
let igv= 0.18;

let contadorArticulos = {};

function AgregarCompra() {
    let producto_compra = document.getElementById("idProducto").value;
    let proveedor_compra = document.getElementById("idProveedor").value;
    let cantidad_compra = document.getElementById("cantidad").value;

    let precio_Compra = document.getElementById("precio_producto").value;
    let importe_Compra = parseFloat(cantidad_compra)*parseFloat(precio_Compra);

    let fecha_Compra = document.getElementById("fecha_compra").value;
    let usuario_Compra = document.getElementById("listUsuario").value;
    
    let estado_Compra= document.getElementById("listEstado").value;

    let nombre_producto = document.getElementById("nombre_producto").value;
    let nombre_proveedor = document.getElementById("nombre_proveedor").value;


    if (proveedor_compra != "" && producto_compra != "" && cantidad_compra != "" && precio_Compra != "" && importe_Compra != "" && usuario_Compra != "" 
        && fecha_Compra != "" && estado_Compra != "") {

     /*   $.post(ruta + "/getProducto-x-id", { id: producto_compra },
            function (data, textStatus, jqXHR) {
                    if (contadorProducto[producto_compra] && contadorProducto[producto_compra] >= 1) {
                        Swal.fire({
                            html: 'No se admite registrar 2 veces el mismo producto - Intente en la próxima compra',
                            icon: 'warning',
                        }) 
                    }else { */
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

                        

                       
                        
                        sumaImportes = sumaImportes+ parseFloat(importe_Compra);
                        $('#subtotal_compra').html(sumaImportes.toFixed(2));

                        let impuesto = parseFloat(sumaImportes*igv);
                        total = sumaImportes+impuesto;
                        $('#total_compra').html(total.toFixed(2));
                        $('#total').val(total.toFixed(2));
                        $('#subtotal').val(sumaImportes.toFixed(2));
                        $('#tbody_compras').append(fila);              //Agrega Fila a la Tabla
                        $('#idProducto').val("").trigger('change');   //Limpia los select
                        $('#idProveedor').val("");            //Limpian campos
                        $('#cantidad').val("");
                        $('#precio_producto').val("");
                        $('#importe').val("");
                        cant_compras++;//ids de la tabla por cada fila agregada + id del row(id)
                        //let valor_subtotal = parseFloat($('#subtotal_compra').text());
                        /*let valor_unitario = cant_compras*importe_Compra;
                        console.log(importe_Compra);
                        $('#subtotal_compra').html(valor_subtotal+valor_unitario);
                        
                        let valor_total = parseFloat($('#total_compra').text());
                        let valor_unitario_igv=valor_unitario+(valor_unitario*igv_Compra);
                        $('#total_compra').html(valor_total+valor_unitario_igv);
                        console.log(valor_unitario,valor_unitario_igv);*/
                          
                /*} 
                
            },
            'json'
        ); */
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
            cant_compras--;
            //focus despues de agregar  el cursos se queda alli
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

$(formulario).submit(function (e){
    e.preventDefault();
    $.ajax({
        type: "post",
        url: base_url + "/RegistrarCompra",
        data: new FormData(formulario[0]),
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
            if(response.error == ""){
                formulario[0].reset();
                swal.fire({
                    title: response.ok,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                location.href= base_url+'/compras'
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
