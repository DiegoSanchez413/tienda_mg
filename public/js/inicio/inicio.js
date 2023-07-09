$(document).ready(function () {
    reporte_ventas()
    reporte_sumaventas()
    reporte_usuarios()
    reporte_clientes()
    reporte_mes_venta()
    reporte_rotacion_productos()
    reporte_menos_productos()

});


function reporte_ventas() {
    $.post(base_url + "/reporte_ventas",
        function (response) {

            // Mostrar los datos en tu vista
            document.getElementById("totalVentas").textContent = response.totalVentas;
        }, "json"
    );

}

function reporte_usuarios() {
    $.post(base_url + "/reporte_usuarios",
        function (response) {

            // Mostrar los datos en tu vista
            document.getElementById("totalUsuarios").textContent = response.totalUsuarios;
        }, "json"
    );

}

function reporte_clientes() {
    $.post(base_url + "/reporte_clientes",
        function (response) {

            // Mostrar los datos en tu vista
            document.getElementById("totalClientes").textContent = response.totalClientes;
        }, "json"
    );

}

function reporte_sumaventas() {
    $.ajax({
        url: base_url + '/suma_ventas',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Formatear el valor de la suma de las ventas con puntos y decimales
            var sumaVentasFormatted = response.sumaVentas.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                useGrouping: true
            });


            // Actualizar el contenido del elemento <h1> con el valor formateado
            document.getElementById("sumaVentas").textContent = sumaVentasFormatted;
        },
        error: function () {
            console.log('Error al obtener la suma de las ventas.');
        }
    });
}

function reporte_mes_venta() {

    $.post(base_url + "/reporte_venta_mes", {},
        function (data) {
            var meses = [];
            var ventas = [];
            for (var i = 0; i < data.data.length; i++) {
                meses.push(parseFloat(data.data[i]['MONTH']));
                ventas.push(data.data[i]['COUNT']);
            }
            var datos = {
                datasets: [{
                    label: 'Ventas por mes',
                    data: ventas,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)', // Color de fondo de las barras
                    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras
                    borderWidth: 1
                }],
                labels: meses,
            };
            var ctx = $("#ventaspormes");

            new Chart(ctx, {
                data: datos,
                type: 'bar',
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
        "json"
    );
}


function reporte_rotacion_productos() {
    $.post(base_url + "/reporterotacion", {},
        function (data) {
            //console.log(data.data[0]['DESCRIPCION'])
            //console.log(data)
            var array_datos = [];
            var array_cantidad = [];
            for (var i = 0; i < data.data.length; i++) {
                array_cantidad.push(parseFloat(data.data[i]['CANTIDAD']));
                array_datos.push(data.data[i]['DESCRIPCION']);
            }
            //grafico polar
            var datos = {
                datasets: [{
                    data: array_cantidad,
                    backgroundColor: [
                        "#1BAFBF",
                        "#038C73",
                        "#29A63C",
                        "#F2A007",
                        "#4CFFEA",
                        "#a6b1b7",
                    ],
                    label: 'My dataset', // for legend
                }],
                labels: array_datos,
            };
            var ctx = $("#reporte_rotacion_productos");
            new Chart(ctx, {
                data: datos,
                type: 'polarArea',
                options: {
                    legend: {
                        display: true,
                    },
                    scale: {
                        display: true,
                    }
                }
            });
        },
        "json"
    );
}

function reporte_productos_cantidades(productos_nombres, productos_cantidades) {
    $.post(base_url + "/reportecantidad", {},

        function (data) {// Crea la instancia de Chart.js y configura la gráfica de barras
            var ctx = document.getElementById('grafica').getContext('2d');
            var grafica = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: productos_nombres,
                    datasets: [{
                        label: 'Cantidad',
                        data: productos_cantidades,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
}

//MENOS PRODUCTOS

$(function () {
    $('#select_cant').change(function () {
        var cant = $(this).val();
        reporte_menos_productos(cant);
    });
});

function reporte_menos_productos(cant) {
    $.post(base_url + "/menos_productos", { cant: cant },
        function (data) {
            var productos = [];
            var cantidad = [];
            for (var c = 0; c < data.data.length; c++) {
                productos.push(data.data[c]['Nombre_Producto']);
                cantidad.push(parseFloat(data.data[c]['Stock_Producto']));
            }
            var ctx = document.getElementById("reporte_menos_productos");
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: productos,
                    datasets: [{
                        label: '# Total de productos',
                        data: cantidad,
                        backgroundColor:
                            'rgb(6, 141, 169)',

                        borderColor:
                            'rgb(6, 141, 169)',

                        borderWidth: 2,
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },
        "json"
    );
}