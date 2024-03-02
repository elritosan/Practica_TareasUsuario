<?php 

$Opcion = $_GET['Opcion'];

switch ($Opcion) {
    case 0: include_once(__DIR__. '/../View/PruebasView.php'); break;
    case 1: include_once(__DIR__. '/../View/VInsertarUSUARIO.php'); break;
    case 2: include_once(__DIR__. '/../View/VInsertarTAREA.php'); break;
    case 3: include_once(__DIR__. '/../View/VInsertarENCUESTA.php'); break;
    case 4: include_once(__DIR__. '/../View/VInsertarUSUARIOENCUESTA.php'); break;
    default: echo "Opción No Válida"; break;
}