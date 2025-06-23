<?php

session_start();

?>

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ECA Sys</title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="public/logo.png">

  <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- CSS CUSTOM -->
  <link rel="stylesheet" href="vistas/css/style.css">
  <link rel="stylesheet" href="vistas/css/custom.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free-6.7.2/css/all.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link href="vistas/plugins/DataTables/datatables.min.css" rel="stylesheet">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3.7.1 -->
  <script src="vistas/plugins/jquery/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap 5.3 -->
  <script src="vistas/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetarlert2-11.15.10.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/plugins/DataTables/datatables.min.js"></script>

</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition overflow-x-hidden overflow-y-hidden" style="background: radial-gradient(circle, rgba(105,139,249,1) 0%, rgba(91,243,255,1) 35%, rgba(245,245,245,1) 100%);">

  <?php

  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

    echo '<div class="wrapper">';

    /*=============================================
    CABEZOTE
    =============================================*/

    include "modulos/cabezote.php";

    /*=============================================
    CONTENIDO
    =============================================*/

    if (isset($_GET["ruta"])) {

      if (

        /* ADMINISTRACION */
        // USUARIOS               
        $_GET["ruta"] == "login"                      ||                  
        $_GET["ruta"] == "salir"                      ||                  
        $_GET["ruta"] == "usuarios"                   ||                  
        /* GENERAL */
        $_GET["ruta"] == "panel-administrativo"       ||                  
        $_GET["ruta"] == "productos"                  ||                  
        // $_GET["ruta"] == "categorias"                 ||                  
        $_GET["ruta"] == "clientes"                   ||                  
        $_GET["ruta"] == "proveedores"                ||                  
        $_GET["ruta"] == "ventas"                     ||                  
        $_GET["ruta"] == "crear-venta"                ||                  
        $_GET["ruta"] == "inicio"
      ) {

        include "modulos/" . $_GET["ruta"] . ".php";
      } else {

        include "modulos/404.php";
      }
    } else {

      include "modulos/inicio.php";
    }

    /*=============================================
    FOOTER
    =============================================*/

    include "modulos/footer.php";

    echo '</div>';

  } else {

    include "modulos/login.php";

  }

  ?>

<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/productos.js"></script>
<script src="vistas/js/ventas.js"></script>
<script src="vistas/js/clientes.js"></script>
<script src="vistas/js/proveedores.js"></script>
<!--   MODULO DE USUARIOS   -->
<script src="vistas/js/roles.js"></script>
<script src="vistas/js/usuarios.js"></script>

</body>

</html>