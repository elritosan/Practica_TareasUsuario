<?php
include("../../Config/ClassConexion.php");

// Crear una instancia de la clase ClassConexion para establecer la conexión
$conexion = new ClassConexion();

$nombre = $_POST['nombre'];
$clave = $_POST['clave'];

$sql = "SELECT * FROM usuario WHERE nombre = ?";
$stmt = mysqli_prepare($conexion->Conectar, $sql); // Accede a la conexión a través de la instancia de ClassConexion
mysqli_stmt_bind_param($stmt, 's', $nombre);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($clave === $row['clave']) { // Comparar la contraseña ingresada con la contraseña almacenada en texto plano
        // Verificar si el usuario es administrador
        if ($nombre == 'Admin') {
            header("Location: ../../View/IndexA.php");
            exit;
        } else {
            // Redirigir a la página principal del usuario normal
            header("Location: ../../View/IndexC.php");
            exit;
        }
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}

mysqli_stmt_close($stmt);
$conexion->CerrarConexion(); // Utiliza el método CerrarConexion de la clase ClassConexion para cerrar la conexión
?>
