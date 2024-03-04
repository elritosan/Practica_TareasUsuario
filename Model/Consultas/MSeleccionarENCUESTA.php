<?php

include_once(__DIR__.'/../ClassConsultasBD.php');

$oBD = new ClassConsultasBD();

$IdUsuario = $_POST['variable1'];
$SelectsEncuestas = json_decode($_POST['variable2']); // Decodificar el array enviado desde JavaScript
$SelectsDisponibilidad = json_decode($_POST['variable3']); // Decodificar el array enviado desde JavaScript
$SelectsEstados = json_decode($_POST['variable4']); // Decodificar el array enviado desde JavaScript

for ($i=0; $i < count($SelectsEncuestas); $i++) 
{ 
    $oUsuarioEncuesta = new ClassUSUARIO_ENCUESTA();

    $oUsuarioEncuesta->idusuario = $IdUsuario;
    $oUsuarioEncuesta->idencuesta = $SelectsEncuestas[$i];
    $oUsuarioEncuesta->disponibilidad = $SelectsDisponibilidad[$i];
    $oUsuarioEncuesta->estado = $SelectsEstados[$i];

    $oBD->ActualizarUsuario_Encuesta($oUsuarioEncuesta);
}
// Imprimir datos recibidos (para propósitos de demostración)
// Realizar alguna operación con los datos recibidos, por ejemplo:
// foreach ($data as $value) {
//   echo $value;
// }