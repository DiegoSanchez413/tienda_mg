$(document).ready(function () {
    reporte_ventas()
    reporte_sumaventas()
    reporte_usuarios()
    reporte_clientes()
    reporte_rotacion_productos()
    reporte_ventas_por_mes
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

/*
function reporte_ventas_por_mes() {
    $.post(base_url + "/reporteVentas", {},
        function (data) {
            var meses = [];
            var cantidades = [];
            for (var i = 0; i < data.length; i++) {
                meses.push(data[i].mes);
                cantidades.push(data[i].cantidad);
            }
            // Crear el gráfico de barras
            var datos = {
                labels: meses,
                datasets: [{
                    data: cantidades,
                    backgroundColor: [
                        "#1BAFBF",
                        "#038C73",
                        "#29A63C",
                        "#F2A007",
                        "#4CFFEA",
                        "#a6b1b7",
                    ],
                    label: 'Cantidad de Ventas por Mes', // para la leyenda
                }],
            };
            var ctx = $("#grafico-ventas-por-mes");
            new Chart(ctx, {
                type: 'bar',
                data: datos,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Ajusta el tamaño del intervalo en el eje y según sea necesario
                            }
                        }
                    }
                }
            });
        },
        "json"
    );
}*/

