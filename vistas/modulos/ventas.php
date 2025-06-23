<?php

  if(isset($_SESSION["iniciarSesion"]) != "ok" || $_SESSION["perfil"] != 1) {

    return header("Location: login");
  } 

?>

<div class="content-wrapper px-5 py-3 pb-5 text-bg-light contenedor-principal" style="background: linear-gradient(to top, #FFFFFF,rgba(252, 241, 25, 0.19));">

  <section class="content-header">

    <h3><b class="text-warning" style="text-shadow: 2px 2px 3px rgb(77, 77, 77);">Administrar</b> Ventas</h3>

  </section>

  <section class="content py-3">

    <div class="container-fluid">

      <h5 class="h5">Consultar venta</h5>

      <table class="table table-bordered table-striped dt-responsive table-sm table-hover align-middle DataTable" width="100%">         

        <thead>         

          <tr class="table-warning">           

            <th style="width:50px">#</th>
            <th>Fecha de venta</th>
            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Total $</th>
            <th>Total BS</th>
            <th>Acciones</th>

          </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

          foreach ($ventas as $key => $value) { 
            
            $fecha = date('d/m/Y H:i:s', strtotime($value["fecha"]));

            echo '<tr>
            
              <td class="text-end">'.($key+1).'</td>

              <td>'.$fecha.'</td>

              <td>'.$value["cedulaCliente"].', '.$value["nombreCliente"].' '.$value["apellidoCliente"].'</td>

              <td>'.$value["vendedor"].'</td>

              <td>'.$value["total"].'</td>

              <td>'.$value["total_bs"].'</td>

              <td class="text-center">

                <div class="btn-group">

                  <button class="btn btn-info" id="btnImprimirVenta" data-bs-toggle="modal" data-bs-target="#modalImprimirVenta" idVenta="'.$value["id"].'"><i class="fa-solid fa-print"></i></button>

                </div>

              </td>

            </tr>';          

          }

        ?>   

        </tbody>

      </table>

    </div>

  </section>

</div>
