<div class="content-wrapper px-5 py-3 pb-5 text-bg-light contenedor-principal">

  <section class="content-header">    

    <h3><b>Generar</b> <span class="text-warning">venta</span></h3>

  </section>

  <section class="content">

    <div class="row mb-5">

      <!--=====================================
        LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 col-xs-12">         

        <div class="card card-warning">

          <div class="card-header bg-primary-subtle border-primary">
            
            <h5><b class="text-primary">Productos</b></h5>

          </div>

          <div class="card-body">            

            <table class="table table-sm table-bordered table-striped table-responsive tablaVentas">

              <thead>

                <tr class="table-primary">

                  <th style="width: 10px">#</th>
                  <th>producto</th>
                  <th>Categoría</th>
                  <th>Stock</th>
                  <th>Precio $</th>
                  <th class="text-center">Acciones</th>

                </tr>

              </thead>

            </table>

          </div>

        </div>

      </div>

      <!--=====================================
      EL FORMULARIO
      ======================================-->      

      <div class="col-lg-5 col-xs-12">        

        <div class="card">          

          <form role="form" method="post" class="formularioVenta">

            <div class="p-3">

              <!--=====================================
                  ENTRADA DEL VENDEDOR
              ======================================-->            

              <div class="form-floating mb-3">

                <input type="text" class="form-control border-warning" id="nuevoVendedor" value="<?php echo $_SESSION["nombres"]; ?>" readonly placeholder="Vendedor">
                
                <label for="nuevoVendedor">Vendedor:</label>

              </div>

              <!--=====================================
              ENTRADA DEL CLIENTE
              ======================================--> 

              <div class="input-group mb-3">                    

                <span class="input-group-text ancho bg-warning"><i class="fa fa-users"></i></span>

                <select class="form-select" id="seleccionarCliente" name="seleccionarCliente" required>

                  <option value="">Seleccionar cliente</option>

                  <?php

                    $item = null;
                    $valor = null;

                    $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                    foreach ($categorias as $key => $value) {

                      echo '<option value="'.$value["id"].'">'.$value["cedula"].' - '.$value["nombres"].' '.$value["apellidos"].'</option>';

                    }

                  ?>

                </select>                    

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente" data-dismiss="modal"><i class="fa-solid fa-circle-plus"></i></button>                 

              </div>
              
              <div class="form-floating mb-1">

                <input type="text" class="form-control border-warning text-end" id="nuevoTasaBs" placeholder="0.00">

                <label for="nuevoTasaBs">Tasa BS:</label>

              </div>
                
              <small id="alertaTasaBs" class="alert text-danger p-1 rounded">***Debe llenar el campo "Tasa BS"***</small>

              <hr>

              <!--=====================================
              ENTRADA PARA AGREGAR PRODUCTO
              ======================================--> 

              <div class="form-group row nuevoProducto"></div>

              <input type="hidden" id="listaProductos" name="listaProductos">

              <hr>

              <div class="row">

              <!--=====================================
              ENTRADA IMPUESTOS Y TOTAL
              ======================================-->                 

                <div class="col-xs-8 table-responsive">                    

                  <table class="table table-bordered">

                    <thead>

                      <tr class="table-warning">

                        <th class="text-end">IVA</th>
                        <th class="text-end">Total $</th>     
                        <th class="text-end">Total BS</th>     

                      </tr>

                    </thead>

                    <tbody>                      

                      <tr>                          

                        <td style="width: 33.33%">                            

                          <div class="input-group">                           

                            <input type="number" class="form-control input-lg text-end" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="16" readonly>

                            <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                            <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

                            <span class="input-group-text bg-warning"><i class="fa fa-percent"></i></span>                       

                          </div>

                        </td>

                        <td style="width: 33.33%">                            

                          <div class="input-group">                           

                            <span class="input-group-text bg-warning"><i class="fa-solid fa-dollar-sign"></i></span>

                            <input type="text" class="form-control input-lg text-end" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0.00" readonly required>

                            <input type="hidden" name="totalVenta" id="totalVenta">

                          </div>

                        </td>

                        <td style="width: 33.33%">                            

                          <div class="input-group">                           

                            <span class="input-group-text bg-warning"><b>BS</b></span>

                            <input type="text" class="form-control input-lg text-end" id="nuevoTotalVentaBS" name="nuevoTotalVentaBS" placeholder="0,00" readonly required>

                            <input type="hidden" name="totalVentaBS" id="totalVentaBS">

                          </div>

                        </td>

                      </tr>

                    </tbody>

                  </table>

                </div>

              </div>

            </div>

            <div class="card-footer bg-warning-subtle border-warning">

              <button type="submit" class="btn btn-warning shadow-sm">Generar venta</button>

            </div>

          </form>

        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();          

        ?>

        </div>            

      </div>

    </div>   

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div class="modal fade" id="modalAgregarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="agregarCliente" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header text-bg-danger">

          <h1 class="modal-title fs-5" id="agregarCliente"><i class="fa-solid fa-user-pen"></i> agregar Cliente</h1>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-danger ancho d-flex justify-content-center"><i class="fa-solid fa-user"></i></span>

            <input type="text" name="nuevoNombres" id="nuevoNombres" class="form-control shadow-sm" placeholder="Nombres" required>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-danger ancho d-flex justify-content-center"><i class="fa-solid fa-user"></i></span>

            <input type="text" name="nuevoApellidos" id="nuevoApellidos" class="form-control shadow-sm" placeholder="Apellidos" required>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-danger ancho d-flex justify-content-center"><i class="fa-solid fa-address-card"></i></span>

            <input type="text" name="nuevoCedula" id="nuevoCedula" class="form-control shadow-sm" placeholder="Cedula o RIF" required>

          </div>

        </div>

        <div class="modal-footer bg-secondary-subtle">

          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>

          <button type="submit" id="btnEditarCliente" class="btn btn-danger"><i class="fa-solid fa-plus"></i> Registrar cliente</button>

        </div>

      </form>

      <?php

      $agregarCliente = new ControladorClientes();
      $agregarCliente->ctrCrearClienteVenta();

      ?>

    </div>

  </div>

</div>
