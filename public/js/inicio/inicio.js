$(document).ready(function () {
    reporte_ventas()
    reporte_sumaventas()
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

function reporte_sumaventas() {
    $.post(base_url + "/suma_ventas",
        function (response) {
            // Mostrar los datos en tu vista
            document.getElementById("sumaVentas").textContent = response.sumaVentas;
        }, "json"
    );
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