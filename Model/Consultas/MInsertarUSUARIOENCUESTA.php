<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$oUsuarioEncuesta = new ClassUSUARIO_ENCUESTA();

$oUsuarioEncuesta->idusuario = $_POST['idusuario'];
$oUsuarioEncuesta->idencuesta = $_POST['idencuesta'];
$oUsuarioEncuesta->estado = $_POST['estado'];
$oUsuarioEncuesta->disponibilidad = $_POST['disponibilidad'];

$oBD->InsertarUsuarioEncuesta($oUsuarioEncuesta);

header("Location: ../../Index.html");