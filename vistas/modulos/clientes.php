<div class="content-wrapper px-5 py-3 pb-5 text-bg-light contenedor-principal" style="background: linear-gradient(to top, #FFFFFF,rgba(231, 100, 144, 0.26));">

  <section class="content-header">

    <h3><b class="text-danger" >Administrar</b> Clientes</h3>

  </section>

  <section class="content py-3">

    <form role="form" method="post">

      <div class="container-fluid">

        <h5 class="h5">Nuevo cliente</h5>

        <div class="d-flex gap-3">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-danger ancho d-flex justify-content-center"><i class="fa-solid fa-user"></i></span>
            
            <input type="text" name="nuevoNombres" aria-label="Nombres" placeholder="Nombres" class="form-control shadow-sm" required>

          </div>

        </div>

        <div class="d-flex gap-3">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-danger ancho d-flex justify-content-center"><i class="fa-solid fa-user"></i></span>
            
            <input type="text" name="nuevoApellidos" aria-label="Apellidos" placeholder="Apellidos" class="form-control shadow-sm" required>

          </div>

        </div>

        <div class="d-flex gap-3">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-danger ancho d-flex justify-content-center"><i class="fa-solid fa-address-card"></i></span>
            
            <input type="text" name="nuevoCedula" id="nuevoCedula" aria-label="Cedula" placeholder="Cedula" class="form-control shadow-sm" required>

          </div>

        </div>

        <div>

          <button type="submit" id="btnRegistrarCliente" class="btn btn-danger d-flex align-items-center ms-auto shadow-sm"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Registrar</button>
          
        </div>
            
        <div>

          <div id="alerta" class="alert alert-warning my-2 d-none"></div>
          
        </div>

      </div>

    </form>

    <?php

      $nuevoCliente = new ControladorClientes();
      $nuevoCliente->ctrCrearCliente();

    ?> 

  </section>

  <section class="content py-3">

    <div class="container-fluid">

      <h5 class="h5">Consultar Cliente</h5>

      <table class="table table-bordered table-striped dt-responsive table-sm table-hover align-middle DataTable" width="100%">         

        <thead>         

          <tr class="table-danger">           

            <th style="width:50px">#</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cedula</th>
            <th>Fecha Creación</th>
            <th>Acciones</th>

          </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

          foreach ($clientes as $key => $value) { 
            
            $fecha = date('d/m/Y H:i:s', strtotime($value["fecha"]));

            echo '<tr>

              <td class="text-end">'.($key+1).'</td>

              <td>'.$value["nombres"].'</td>
              
              <td>'.$value["apellidos"].'</td>

              <td>'.$value["cedula"].'</td>

              <td>'.$fecha.'</td>

              <td class="text-center">';

                  if(isset($_SESSION["iniciarSesion"]) != "ok" || $_SESSION["perfil"] == 1) {

                    echo '<div class="btn-group">

                      <button class="btn btn-warning" id="btnEditarCliente" data-bs-toggle="modal" data-bs-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger" id="btnEliminarCliente" idEliminarCliente="'.$value["id"].'"><i class="fa fa-trash-can"></i></button>

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

<div class="modal fade" id="modalEditarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditarCliente" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header text-bg-warning">

          <h1 class="modal-title fs-5" id="EditarCliente"><i class="fa-solid fa-user-pen"></i> Editar Cliente</h1>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-warning ancho d-flex justify-content-center"><i class="fa-solid fa-user"></i></span>

            <input type="text" name="editarNombres" id="editarNombres" class="form-control shadow-sm" required>

            <input type="hidden" name="idCliente" id="idCliente"required>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-warning ancho d-flex justify-content-center"><i class="fa-solid fa-user"></i></span>

            <input type="text" name="editarApellidos" id="editarApellidos" class="form-control shadow-sm" required>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-warning ancho d-flex justify-content-center"><i class="fa-solid fa-address-card"></i></span>

            <input type="text" name="editarCedula" id="editarCedula" class="form-control shadow-sm" required>

          </div>

        </div>

        <div class="modal-footer bg-secondary-subtle">

          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>

          <button type="submit" id="btnEditarCliente" class="btn btn-warning"><i class="fa-solid fa-plus"></i> Guardar cambios</button>

        </div>

      </form>

      <?php

      $editarCliente = new ControladorClientes();
      $editarCliente->ctrEditarCliente();

      ?>

    </div>

  </div>

</div>