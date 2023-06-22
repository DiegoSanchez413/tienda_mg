<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa-solid fa-dashboard"></i> Dashboard
      </h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>inicio">Tienda Virtual</a></li>
    </ul>
  </div>
  <div>
    Bienvenido al sistema <?=$_SESSION['nombre']?>
  </div>
  <div class="col-md-6">
  <canvas id="pie-chart" width="800" height="450"></canvas>
</div>
  <script>
  new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
      datasets: [{
        label: "Population (millions)",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
        data: [2478,5267,734,784,433]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Predicted world population (millions) in 2050'
      }
    }
});
</script>






</main>