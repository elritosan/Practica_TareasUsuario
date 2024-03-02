<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$oUsuario = new ClassUSUARIO();

$oUsuario->nombre = $_POST['nombre'];
$oUsuario->correo = $_POST['correo'];
$oUsuario->clave = $_POST['clave'];
$oUsuario->tipo = $_POST['tipo'];

$oBD->InsertarUsuario($oUsuario);

header("Location: ../../Index.html");