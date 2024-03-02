<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$oBD->EliminarEncuesta($_GET['Id']);

header("Location: ../../Index.html");