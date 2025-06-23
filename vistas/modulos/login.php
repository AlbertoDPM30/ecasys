<?php

if(isset($_SESSION["iniciarSesion"]) == "ok") {

    echo '<script> window.location = "inicio"; </script>';

    return;
} 
?>

<section class="container d-flex justify-content-center align-items-center" style="height: 100vh;">

    <form method="post" role="form" class="w-25 mx-auto d-flex flex-column justify-contente-center align-items-center rounded px-5 py-3 shadow text-bg-primary ">

        <img src="public/logo.png" alt="logo" height="150" width="150">

        <h5 class="text-center text-wrap mb-4">Bienvenido/a a ECA Sys</h5>

        <div class="input-group my-2">

            <span class="input-group-text bg-info-subtle fw-semibold"><i class="fa-solid fa-at"></i></span>

            <input type="text" name="ingUsuario" aria-label="nombre usuario" placeholder="usuario" class="form-control form-control-lg">

        </div>

        <div class="input-group my-2">

            <span class="input-group-text bg-info-subtle"><i class="fa-solid fa-key"></i></span>

            <input type="password" name="ingPassword" aria-label="password" placeholder="Contraseña" class="form-control form-control-lg">

        </div>

        <div class="input-group my-3 w-100">
            
            <button class="btn btn-danger mx-auto">Iniciar sesión&nbsp;<i class="fa-solid fa-right-to-bracket"></i></button>
        
        </div>

    </form>

    <?php

    $iniciarsesion = new ControladorUsuarios();
    $iniciarsesion->ctrIngresoUsuario();
    
    ?>

</section>