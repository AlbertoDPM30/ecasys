<?php

  if(isset($_SESSION["iniciarSesion"]) != "ok" || $_SESSION["perfil"] != 1) {

    return header("Location: login");
  } 

?>


<div class="content-wrapper px-5 py-3 pb-5 text-bg-light contenedor-principal" style="background: linear-gradient(to top, #FFFFFF,rgba(231, 100, 144, 0.26));">

  <section class="content-header">

    <h3><b class="text-danger" >Administrar</b> Proveedores</h3>

  </section>

  <section class="content py-3">

    <form role="form" method="post">

      <div class="container-fluid">

        <h5 class="h5">Nuevo proveedor</h5>

        <div class="d-flex gap-3">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-danger ancho d-flex justify-content-center"><i class="fa-solid fa-user"></i></span>
            
            <input type="text" name="nuevoProveedor" aria-label="Nombre del Proveedor" placeholder="Nombre del Proveedor" class="form-control shadow-sm" required>

          </div>

        </div>

        <div class="d-flex gap-3">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-danger ancho d-flex justify-content-center"><i class="fa-solid fa-address-card"></i></span>
            
            <input type="text" name="nuevoTelefono" id="nuevoTelefono" aria-label="Telefono" placeholder="Telefono: 04241234567" class="form-control shadow-sm" required>

          </div>

        </div>

        <div>

          <button type="submit" id="btnRegistrarProveedor" class="btn btn-danger d-flex align-items-center ms-auto shadow-sm"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Registrar</button>
          
        </div>
            
        <div>

          <div id="alerta" class="alert alert-warning my-2 d-none"></div>
          
        </div>

      </div>

    </form>

    <?php

      $nuevoProveedor = new ControladorProveedores();
      $nuevoProveedor->ctrCrearProveedor();

    ?> 

  </section>

  <section class="content py-3">

    <div class="container-fluid">

      <h5 class="h5">Consultar Proveedor</h5>

      <table class="table table-bordered table-striped dt-responsive table-sm table-hover align-middle DataTable" width="100%">         

        <thead>         

          <tr class="table-danger">           

            <th style="width:50px">#</th>
            <th>Nombre del Proveedor</th>
            <th>Telefono</th>
            <th>Fecha Creación</th>
            <th>Acciones</th>

          </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

          foreach ($proveedores as $key => $value) { 
            
            $fecha = date('d/m/Y H:i:s', strtotime($value["fecha"]));

            echo '<tr>

              <td class="text-end">'.($key+1).'</td>

              <td>'.$value["proveedor"].'</td>
              
              <td>'.$value["telefono"].'</td>

              <td>'.$fecha.'</td>

              <td class="text-center">';

                  if(isset($_SESSION["iniciarSesion"]) != "ok" || $_SESSION["perfil"] == 1) {

                    echo '<div class="btn-group">

                      <button class="btn btn-warning" id="btnEditarProveedor" data-bs-toggle="modal" data-bs-target="#modalEditarProveedor" idProveedor="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger" id="btnEliminarProveedor" idEliminarProveedor="'.$value["id"].'"><i class="fa fa-trash-can"></i></button>

                    </div>';
                  } 

              echo '</td>

            </tr>';          

          }

        ?>   

        </tbody>

      </table>

    </div>

  </section>

</div>

<!-- MODAL PARA EDITAR -->

<div class="modal fade" id="modalEditarProveedor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditarProveedor" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header text-bg-warning">

          <h1 class="modal-title fs-5" id="EditarProveedor"><i class="fa-solid fa-user-pen"></i> Editar Cliente</h1>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-warning ancho d-flex justify-content-center"><i class="fa-solid fa-user"></i></span>

            <input type="text" name="editarProveedor" id="editarProveedor" class="form-control shadow-sm" required>

            <input type="hidden" name="idProveedor" id="idProveedor"required>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-warning ancho d-flex justify-content-center"><i class="fa-solid fa-address-card"></i></span>

            <input type="text" name="editarTelefono" id="editarTelefono" class="form-control shadow-sm" required>

          </div>

        </div>

        <div class="modal-footer bg-secondary-subtle">

          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>

          <button type="submit" id="btnEditarProveedor" class="btn btn-warning"><i class="fa-solid fa-plus"></i> Guardar cambios</button>

        </div>

      </form>

      <?php

      $editarProveedor = new ControladorProveedores();
      $editarProveedor->ctrEditarProveedor();

      ?>

    </div>

  </div>

</div>