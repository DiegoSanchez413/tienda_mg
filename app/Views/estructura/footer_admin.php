<style>
    body {
        min-height: 100vh;
        margin: 0; /* Asegura que no haya margen alrededor del body */
        padding-bottom: 60px; /* Añade un espacio al final del contenido para evitar que el footer se superponga */
        position: relative; /* Establece el cuerpo como posición relativa */
    }

    .content {
        flex: 1;
    }

    footer {
        background-color: #114f74;
        padding:9px 30px;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        color: white; /* Cambia el color del texto a blanco */
        line-height: 0.5; /* Ajusta el espacio entre líneas según tus preferencias */
        text-align: center; /* Centra el texto */
        font-size: 12px; /* Ajusta el tamaño de la letra según tus preferencias */
        margin-top: 10px;
    }
</style>

<body>
  
    <footer class="text-center">
        <div class="container">
            <p>MG NETWORKS E.I.R.L</p>
            <p>Av. San Martin De Porres Nro. 1320 Dpto. 504 int. S</p>
        </div>
    </footer>
</body>
  
  <!-- Essential javascripts for application to work-->
  <script src="<?= base_url(); ?>/js/popper.min.js"></script>
  <script src="<?= base_url(); ?>/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>/js/main.js"></script>
  <script src="<?= base_url(); ?>/js/fontawesome.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="<?= base_url(); ?>/js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->

  <!-- Data table plugin-->
  <script type="text/javascript" src="<?= base_url(); ?>/js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>/js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>/js/plugins/bootstrap-select.min.js"></script>
 


  <!--Datatables-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" />


  <!--Archivos JavaScript-->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/vfs_fonts.js"></script>
  </body>

  </html>