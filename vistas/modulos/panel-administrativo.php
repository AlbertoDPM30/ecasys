<?php

  if(isset($_SESSION["iniciarSesion"]) != "ok" || $_SESSION["perfil"] != 1) {

    return header("Location: login");
  } 

?>


<div class="content-wrapper px-5 py-3 pb-5 text-bg-light contenedor-principal">

  <section class="content-header">

    <h2><b class="text-warning" style="text-shadow: 1px 1px 3px rgb(53, 53, 53);">Panel</b> Administrativo</h2>

  </section>

  <section class="content">

    <div class="row py-3 px-auto">

      <a href="usuarios" class="card col-md-2 col-sm-8 mx-3 text-reset text-decoration-none text-bg-success shadow">
        <div class="card-header text-center"><i class="fa-solid fa-user-tie iconos"></i></div>
        <div class="card-body fw-semibold text-center">Admin. Usuarios</div>
      </a>
      
      <a href="proveedores" class="card col-md-2 col-sm-8 mx-3 text-reset text-decoration-none text-bg-danger shadow">
        <div class="card-header text-center"><i class="fa-solid fa-truck iconos"></i></div>
        <div class="card-body fw-semibold text-center">Admin. Proveedores</div>
      </a>
      
      <a href="ventas" class="card col-md-2 col-sm-8 mx-3 text-reset text-decoration-none text-bg-warning shadow">
        <div class="card-header text-center"><i class="fa-solid fa-receipt iconos"></i></div>
        <div class="card-body fw-semibold text-center">Admin. Ventas</div>
      </a>
      
    </div>

  </section>

</div>
