$(document).ready(function () {
    reporte_ventas()
    reporte_sumaventas()
    reporte_usuarios()
    reporte_clientes()
    //reporte_productos()
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
        success: function(response) {
            // Formatear el valor de la suma de las ventas con puntos y decimales
            var sumaVentasFormatted = response.sumaVentas.toLocaleString(undefined, {minimumFractionDigits: 2,
                useGrouping: true});


            // Actualizar el contenido del elemento <h1> con el valor formateado
            document.getElementById("sumaVentas").textContent = sumaVentasFormatted;
        },
        error: function() {
            console.log('Error al obtener la suma de las ventas.');
        }
    });
}

function reporte_productos() {
    $.post(base_url + "/reporte_productos", 
    function (response) {
        var ctx = document.getElementById("grafico");
        var labels = [];
        var data = [];

        for (var i = 0; i < response.length; i++) {
            labels.push(response[i].Nombre_Producto);
            data.push(parseInt(response[i].Stock_Producto));
        }

        console.log("Labels:", labels);
        console.log("Data:", data);

        
        const chartData = {
            labels: labels,
            datasets: [{
                label: 'grafico',
                data: data,
                backgroundColor: [
                    'rgb(0, 0, 153)',
                    'rgb(75, 192, 192)',
                    'rgb(0, 204, 0)',
                    'rgb(204, 0, 0)'
                ]
            }]
        };

        new Chart(ctx, {
            type: 'polarArea',
            data: chartData,
            options: {}
        });
    },
    "json"
);
}