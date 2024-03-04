<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$oUsuarioEncuesta = new ClassUSUARIO_ENCUESTA();

$oUsuarioEncuesta->idusuario = $_POST['variable1'];
$oUsuarioEncuesta->idencuesta = $_POST['variable2'];
$oUsuarioEncuesta->disponibilidad = $_POST['variable3'];
$oUsuarioEncuesta->estado = $_POST['variable4'];

$oBD->ActualizarUsuario_Encuesta($oUsuarioEncuesta);