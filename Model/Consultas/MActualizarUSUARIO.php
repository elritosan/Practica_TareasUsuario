<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$oUsuario = new ClassUSUARIO();

$oUsuario->idusuario = $_POST['idusuario'];
$oUsuario->nombre = $_POST['nombre'];
$oUsuario->correo = $_POST['correo'];
$oUsuario->clave = $_POST['clave'];
$oUsuario->tipo = $_POST['tipo'];

$oBD->ActualizarUsuario($oUsuario);

header("Location: ../../Index.html");