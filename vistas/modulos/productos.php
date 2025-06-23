<div class="content-wrapper px-5 py-3 pb-5 text-bg-light contenedor-principal" style="background: linear-gradient(to top, #FFFFFF,rgba(0, 195, 255, 0.2));">

  <section class="content-header">

    <h3><b class="text-primary">Administrar</b> Productos</h3>

  </section>

  <?php if ($_SESSION["perfil"] == "1"): ?>

  <section class="content py-3">

    <form role="form" method="post">

      <div class="container-fluid">

        <h5 class="h5">Agregar nuevo Producto</h5>

        <div class="d-flex gap-3">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-primary ancho d-flex justify-content-center"><i class="fa-solid fa-shapes"></i></span>
            
            <input type="text" name="nuevoProducto" aria-label="Nombre del Producto" placeholder="Nombre del Producto *" class="form-control shadow-sm" required>

          </div>

        </div>

        <div class="d-flex gap-3">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-primary ancho d-flex justify-content-center"><i class="fa-solid fa-dolly"></i></span>
            
            <input type="number" name="nuevoStock" aria-label="Cantidad" placeholder="Cantidad *" class="form-control shadow-sm" required>

          </div>

          <div class="input-group mb-3">
            
            <span class="input-group-text shadow-sm text-bg-primary ancho d-flex justify-content-center"><i class="fa-solid fa-dollar-sign"></i></span>

            <input type="text" name="nuevoPrecioCompra" id="nuevoPrecioCompra" aria-label="Precio de Compra" placeholder="Precio de Compra $*" class="form-control shadow-sm" required>

          </div>

          <div class="input-group mb-3">
            
            <span class="input-group-text shadow-sm text-bg-primary ancho d-flex justify-content-center"><i class="fa-solid fa-dollar-sign"></i></span>

            <input type="text" name="nuevoPrecioVenta" id="nuevoPrecioVenta" aria-label="Precio de Venta" placeholder="Precio de Venta $" class="form-control shadow-sm" readonly required>

          </div>

        </div>

        <div class="d-flex gap-3">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-primary ancho d-flex justify-content-center"><i class="fa-solid fa-list"></i></span>
            
            <select class="form-select shadow-sm" id="nuevoIDCategoria" name="nuevoIDCategoria" required>

              <option value="">Seleccionar Categoría *</option>

              <?php

              $itemCategorias = null;
              $valorCategorias = null;

              $respuestaCategorias = ControladorCategorias::ctrMostrarCategorias($itemCategorias, $valorCategorias);

              foreach ($respuestaCategorias as $key => $valueCategorias) {

                echo '<option value="' . $valueCategorias["id"] . '">' . $valueCategorias["categoria"] . ' - ' . $valueCategorias["descripcion"] . '</option>';
              }

              ?>

            </select>

            <button class="btn btn-success shadow-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria"><i class="fa-solid fa-plus"></i></button>
              
          </div>

        </div>

        <div class="d-flex gap-3">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-primary ancho d-flex justify-content-center"><i class="fa-solid fa-truck"></i></span>
            
            <select class="form-select shadow-sm" id="nuevoIDProveedor" name="nuevoIDProveedor" required>

              <option value="">Seleccionar Proveedor *</option>

              <?php

              $itemProveedores = null;
              $valorProveedores = null;

              $respuestaProveedores = ControladorProveedores::ctrMostrarProveedores($itemProveedores, $valorProveedores);

              foreach ($respuestaProveedores as $key => $valueProveedores) {

                echo '<option value="' . $valueProveedores["id"] . '">' . $valueProveedores["proveedor"].'</option>';
              }

              ?>

            </select>

            <button class="btn btn-success shadow-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalAgregarProveedor"><i class="fa-solid fa-plus"></i></button>
              
          </div>

        </div>

        <div>

          <button type="submit" class="btn btn-primary d-flex align-items-center ms-auto shadow-sm"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
          
        </div>

      </div>

    </form>

    <?php

      $nuevoProducto = new ControladorProductos();
      $nuevoProducto->ctrCrearProducto();

    ?> 

  </section>

  <?php endif; ?>

  <section class="content py-3">

    <div class="container-fluid">

      <h5 class="h5">Consultar Productos</h5>

      <table class="table table-sm table-striped DataTable">

        <thead>

          <tr class="table-primary">

            <th scope="col">#</th>
            <th scope="col">Nombre Producto</th>
            <th scope="col">Categoría</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Stock</th>
            <th scope="col">Precio de Compra $</th>
            <th scope="col">Precio de Venta $</th>
            <th scope="col">Acciones</th>

          </tr>

        </thead>

        <tbody id="cuerpoTablaProductos">

          <?php

            $item = null;
            $valor = null;

            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

            foreach ($respuesta as $key => $value) {
              echo '
                <tr>

                  <td>'.($key + 1).'</td>

                  <td>'.$value["producto"].'</td>

                  <td>'.$value["categoria"].'</td>

                  <td>'.$value["proveedor"].'</td>

                  <td>'.$value["stock"].'</td>

                  <td>'.$value["precio_compra"].' $</td>

                  <td>'.$value["precio_venta"].' $</td>

                  <td class="text-center">
                    
                    <div class="btn-group">

                      <button type="button" id="btnEditarProducto" idProducto="'.$value["id"].'" data-bs-toggle="modal" data-bs-target="#modalEditarProducto" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>';

                      if ($_SESSION["perfil"] == "1"){
                  
                        echo '<button type="button" id="btnEliminarProducto" idEliminarProducto="'.$value["id"].'" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>';
                      }

                    echo '</div>

                  </td>

                </tr>
              ';
            }

          ?>

        </tbody>

      </table>

    </div>

  </section>

</div>

<!-- MODAL PARA EDITAR -->

<?php

if ($_SESSION["perfil"] == "1"){
  $autorizacion = "";
} else {
  $autorizacion = "d-none";
}

?>

<div class="modal fade" id="modalEditarProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditarEquipo" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header text-bg-warning">

          <h1 class="modal-title fs-5" id="EditarEquipo"><i class="fa-solid fa-pen-to-square"></i> Editar Producto</h1>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-warning ancho d-flex justify-content-center"><i class="fa-solid fa-shapes"></i></span>

            <input type="text" name="editarProducto" id="editarProducto" class="form-control shadow-sm" required>

            <input type="hidden" name="idProducto" id="idProducto" required>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-warning ancho d-flex justify-content-center"><i class="fa-solid fa-dolly"></i></span>

            <input type="text" name="editarStock" id="editarStock" class="form-control shadow-sm" required>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-warning ancho d-flex justify-content-center"><i class="fa-solid fa-arrow-down"></i><i class="fa-solid fa-dollar-sign"></i></span>

            <input type="text" name="editarPrecioCompra" id="editarPrecioCompra" class="form-control shadow-sm" required>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-warning ancho d-flex justify-content-center"><i class="fa-solid fa-arrow-up"></i><i class="fa-solid fa-dollar-sign"></i></span>

            <input type="text" name="editarPrecioVenta" id="editarPrecioVenta" class="form-control shadow-sm" readonly required>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-warning ancho d-flex justify-content-center"><i class="fa-solid fa-list"></i></span>

            <select class="form-select shadow-sm" id="editarIDCategoria" name="editarIDCategoria" required>

              <?php

              $itemCategorias = null;
              $valorCategorias = null;

              $respuestaCategorias = ControladorCategorias::ctrMostrarCategorias($itemCategorias, $valorCategorias);

              foreach ($respuestaCategorias as $key => $valueCategorias) {

                echo '<option value="' . $valueCategorias["id"] . '">' . $valueCategorias["categoria"] . '</option>';
              }

              ?>

            </select>

            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria"><i class="fa-solid fa-plus"></i></button>

          </div>

        </div>

        <div class="modal-footer bg-secondary-subtle">

          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>

          <button type="submit" id="btnGuardarProducto" class="btn btn-warning"><i class="fa-solid fa-plus"></i> Guardar cambios</button>

        </div>

      </form>

      <?php

      $editarProducto = new ControladorProductos();
      $editarProducto->ctrEditarProducto();

      ?>

    </div>

  </div>

</div>

<div class="modal fade" id="modalAgregarCategoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AgregarCategoria" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header text-bg-success">

          <h1 class="modal-title fs-5" id="agregarCategoria"><i class="fa-solid fa-list-check"></i> Agregar Categoria</h1>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-success ancho d-flex justify-content-center"><i class="fa-solid fa-list-check"></i></span>

            <input type="text" name="nuevoCategoria" id="nuevoCategoria" class="form-control shadow-sm" placeholder="Nombre de categoría" required>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-success ancho d-flex justify-content-center"><i class="fa-solid fa-bars"></i></span>

            <input type="text" name="nuevoDescripcion" id="nuevoDescripcion" class="form-control shadow-sm" placeholder="Descripción de la categoría" required>

          </div>

        </div>

        <div class="modal-footer bg-secondary-subtle">

          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>

          <button type="submit" id="btnAgregarCategoria" class="btn btn-success"><i class="fa-solid fa-plus"></i> Crear nueva Categoría</button>

        </div>

      </form>

      <?php

      $CrearCategoria = new ControladorCategorias();
      $CrearCategoria->ctrCrearCategoria();

      ?>

    </div>

  </div>

</div>

<div class="modal fade" id="modalAgregarProveedor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AgregarProveedor" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header text-bg-success">

          <h1 class="modal-title fs-5" id="agregarProveedor"><i class="fa-solid fa-truck"></i> Agregar Proveedor</h1>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-success ancho d-flex justify-content-center"><i class="fa-solid fa-truck"></i></span>

            <input type="text" name="nuevoProveedor" id="nuevoProveedor" class="form-control shadow-sm" placeholder="Nombre de Proveedor" required>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text shadow-sm text-bg-success ancho d-flex justify-content-center"><i class="fa-solid fa-phone"></i></span>

            <input type="text" name="nuevoTelefono" id="nuevoTelefono" class="form-control shadow-sm" placeholder="Telefono: 04241234567" required>

          </div>

        </div>

        <div class="modal-footer bg-secondary-subtle">

          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>

          <button type="submit" id="btnAgregarProveedor" class="btn btn-success"><i class="fa-solid fa-plus"></i> Crear nuevo Proveedor</button>

        </div>

      </form>

      <?php

      $CrearProveedor = new ControladorProveedores();
      $CrearProveedor->ctrCrearProveedorProductos();

      ?>

    </div>

  </div>

</div>