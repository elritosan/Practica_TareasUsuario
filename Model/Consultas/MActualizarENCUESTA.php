<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$oEncuesta = new ClassENCUESTA();

$oEncuesta->idencuesta = $_POST['idencuesta'];
$oEncuesta->descripcion = $_POST['descripcion'];
$oEncuesta->idtarea = $_POST['idtarea'];

$oBD->ActualizarEncuesta($oEncuesta);

header("Location: ../../View/IndexA.php");