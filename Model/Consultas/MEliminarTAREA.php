<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$oBD->EliminarTarea($_GET['Id']);

header("Location: ../../Index.html");