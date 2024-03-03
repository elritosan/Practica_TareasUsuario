<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$oTarea = new ClassTAREA();

$oTarea->titulo = $_POST['titulo'];

$oBD->InsertarTarea($oTarea);

header("Location: ../../View/IndexA.php");