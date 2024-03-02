<?php
session_start();
include_once(__DIR__.'/../../Model/ClassConsultasBD.php');
$oBD = new ClassConsultasBD();

if(isset($_POST['correo']) && isset($_POST['clave'])) {
    $correoElectronico = $_POST['correo'];
    $clave = $_POST['clave'];

    $usu = $oBD->ValidarUsuario($correoElectronico,$clave);

    $usuarioValidado = $usu[0];

    if ($usuarioValidado) {
        $_SESSION['usuario'] = $usuarioValidado; // Guardar información del usuario en la sesión
        $tipoUsuario = $usuarioValidado->tipo;
        if ($tipoUsuario === "cliente") {
            header("Location: ../../View/IndexC.php");
            exit();
        } elseif ($tipoUsuario === "administrador") {
            header("Location: ../../View/IndexA.php");
            exit();
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
} else {
    echo "Correo electrónico o contraseña no proporcionados.";
}