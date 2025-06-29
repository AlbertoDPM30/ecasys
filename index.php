<?php

/*=============================================
   CONTROLADORES
=============================================*/

require_once "controladores/clientes.controlador.php";
require_once "controladores/proveedores.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/ventas.controlador.php";
/* ADMINISTRACION */
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/roles.controlador.php";
require_once "controladores/plantilla.controlador.php";

/*=============================================
   MODELOS
=============================================*/

require_once "modelos/clientes.modelo.php";
require_once "modelos/proveedores.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/ventas.modelo.php";
/* ADMINISTRACION */
require_once "modelos/categorias.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/roles.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
