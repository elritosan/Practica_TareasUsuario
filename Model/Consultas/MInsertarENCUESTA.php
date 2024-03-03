<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$oEncuesta = new ClassENCUESTA();

$oEncuesta->descripcion = $_POST['descripcion'];
$oEncuesta->idtarea = $_POST['idtarea'];

$oBD->InsertarEncuesta($oEncuesta);

header("Location: ../../View/VInsertarENCUESTA.php");