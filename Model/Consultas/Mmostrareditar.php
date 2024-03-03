<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas Model</title>
    <?php 
    include_once(__DIR__.'/../ClassConsultasBD.php');
    include_once(__DIR__.'/../../Script/Func/ClassRotulosEntidades.php');

    $oBD = new ClassConsultasBD();
    $ListaT = $oBD->ConsultarTarea();
 

    $Rotulos = new ClassRotulosEntidades();
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
    text-transform: capitalize;
    text-decoration: none;
}

body {
    min-height: 100vh;
    background-color: darkcyan;
    background-size: cover;
    background-position: center;
    margin: 0;
}
.dashboard {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    background: #333;
    color: #fff;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.dashboard .logo {
    font-weight: bolder;
    font-size: 20px;
    margin-bottom: 20px;
}

.dashboard .navbar {
    width: 100%;
}

.dashboard .navbar ul {
    list-style: none;
    padding: 0;
}

.dashboard .navbar ul li {
    margin-bottom: 10px;
}

.dashboard .navbar ul li a {
    font-size: 16px;
    color: #fff;
    display: block;
    padding: 10px;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.dashboard .navbar ul li a:hover {
    background: #555;
}

.dashboard .navbar ul li.dashboard-item {
    position: relative;
}

.dashboard .navbar ul li.dashboard-item ul {
    position: absolute;
    top: 0;
    left: 100%;
    width: 200px;
    background: #555;
    display: none;
}

.dashboard .navbar ul li.dashboard-item:hover ul {
    display: block;
}

.dashboard .navbar ul li.dashboard-item ul li {
    width: 100%;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

/* Estilo para el fondo blanco de la tabla */
table {
    background-color: #fff;
    width: 80%; /* Ancho de la tabla reducido */
    margin: 20px auto; /* Margen superior y inferior */
    border-collapse: collapse;
}

/* Estilo para las celdas de la tabla */
table th,
table td {
    padding: 10px;
    border: 1px solid tomato; /* Bordes de la tabla en color tomate */
}

/* Estilo para mover la tabla hacia la derecha */
main {
    margin-left: 280px; /* Ajustar según sea necesario */
}

    </style>
</head>

<body>
<main>
        <center>


            <h1>Consultar Tarea</h1>
            <table border="1">
                <tr>
                    <th>idtarea</th>
                    <th>titulo</th>
                    <th>Acciones</th> <!-- Columna para los iconos de acción -->
                </tr>
                <?php 
                foreach ($ListaT as $x) 
                {
                ?>
                    <tr>
                        <td><?php echo $x->idtarea ?></td>
                        <td><?php echo $x->titulo ?></td>
                        <!-- Columna para los iconos de acción -->
                        <td>
                            <!-- Icono de eliminar con enlace -->
                            <a href="../Model/Consultas/MEliminarTAREA.php?Id=<?php echo $x->idtarea ?>"><i class="fas fa-trash-alt"></i></a>
                            <!-- Icono de editar con enlace -->
                            <a href="../Model/Consultas/MEditarTAREA.php?Id=<?php echo $x->idtarea ?>"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>

        </center>
    </main>
    
<div class="dashboard">
    <div class="logo">ADMINISTRADOR</div>
    <nav class="navbar">
        <ul>
            <li class="dashboard-item">
                <a href="#">GESTION DE TAREAS </a>
                <ul class="submenu">
                    <li><a href="../Controller/Controlador.php?Opcion=2"class="btn btn-primary py-2 px-4 rounded-0">INSERTAR TAREA</a></li>
                    <li><a href="../Controller/Controlador.php?Opcion=4"class="btn btn-primary py-2 px-4 rounded-0">EDITAR TAREA</a></li>
                    <li><a href="../Controller/Controlador.php?Opcion=3"class="btn btn-primary py-2 px-4 rounded-0">INSERTAR ENCUESTA</a></li>
                    <li><a href="../Controller/Controlador.php?Opcion=5"class="btn btn-primary py-2 px-4 rounded-0">EDITAR ENCUESTA</a></li>
                </ul>
            </li>
                
            <li class="dashboard-item">
                <a href="#">REPORTES </a>
                <ul class="submenu">
                    <li><a href="#">GENERAR REPORTE </a></li>
                    <li><a href="#">GENERAR REPORTE </a></li>
                    <li><a href="#">GENERAR REPORTE </a></li>
                    <li><a href="#">GENERAR REPORTE </a></li>
                </ul>
            </li>
            <li> <a href="../Controller/Entidades/CerrarLogin.php">SALIR</a></li>
        </ul>
    </nav>
</div>

<!-- Resto del contenido de la página aquí -->

</body>
</html>
