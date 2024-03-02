<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$oTarea = new ClassTAREA();

$oTarea->idtarea = $_POST['idtarea'];
$oTarea->titulo = $_POST['titulo'];

$oBD->ActualizarTarea($oTarea);

header("Location: ../../Index.html");