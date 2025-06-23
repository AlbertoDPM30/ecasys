<?php

$_SESSION["iniciarSesion"] = null;
$_SESSION["id"] = null;
$_SESSION["nombres"] = null;
$_SESSION["usuario"] = null;
$_SESSION["perfil"] = null;

session_destroy();

return header("Location: login");