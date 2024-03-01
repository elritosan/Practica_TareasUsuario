<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$oAT = new ClassAsignacionTarea();
$oAT->idusuario = $_POST['idusuario'];
$oAT->idtarea = $_POST['idtarea'];

$oBD->AsignarTarea($oAT);

header("Location: ../../Index.html");