<?php

// Incluir tu archivo de consultas
include_once(__DIR__.'../../Model/ClassConsultasBD.php');
include_once(__DIR__.'../../Script/Func/ClassRotulosEntidades.php');

session_start(); // Iniciar la sesión si no está iniciada
if (!isset($_SESSION['usuario'])) {
    include_once(__DIR__.'../Controller/Entidades/ControladorLogin.php');
    exit();
}
$usuario = $_SESSION['usuario'];
$IdUsuario = $usuario->idusuario;

// Crear una instancia de la clase ConsultasBD
$oBD = new ClassConsultasBD();

// Obtener la lista de tareas
$ListaTareas = $oBD->ConsultarTarea();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagina Principal</title>
    <!-- Enlace al archivo CSS de Font Awesome a través del CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../index.css">

    <style>
        .container-tareas {
            margin-top: 150px; /* Reducido el margen superior */
            margin-left: auto;
            margin-right: auto;
            width: 50%; /* Mantenida la anchura al 50% */
        }

        .container-tareas table {
            width: 100%;
            text-align: center;
            border: 2px solid tomato; /* Cambio del color de los bordes a tomate */
            background-color: white; /* Cambio del fondo a blanco */
        }

        .container-tareas th, .container-tareas td {
            padding: 10px;
            border: 1px solid tomato; /* Cambio del color de los bordes a tomate */
        }

        .container-tareas .expandir-btn {
            cursor: pointer;
        }

        /* Estilos para el icono de más */
        .expandir-btn {
            font-size: 24px; /* Tamaño grande del icono */
            color: #337ab7; /* Color azul */
            display: block;
            margin: 0 auto; /* Centrado horizontal */
        }

        /* Estilos para la ventana modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            position: relative;
        }

        .modal-header, .modal-body, .modal-footer {
            padding: 10px 0;
        }

        .modal-header {
            border-bottom: 1px solid #ddd;
        }

        .modal-header h2 {
            margin: 0;
        }

        .modal-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .encuestas {
            display: none;
        }

        /* Estilos para la tabla de encuestas */
        .encuestas-table {
            border-collapse: collapse;
            width: 100%;
        }

        .encuestas-table th, .encuestas-table td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px; /* Aumenta el padding para hacer los checkbox más grandes */
        }

        .encuestas-table th {
            background-color: #f2f2f2;
        }
            /* Estilos para aumentar el tamaño del checkbox */
    .encuestas-table input[type="checkbox"] {
        transform: scale(1.5); /* Aumenta el tamaño del checkbox */
        margin: 0; /* Elimina el margen para que el checkbox esté centrado verticalmente */
        cursor: pointer; /* Cambia el cursor al pasar sobre el checkbox */
    }

        /* Estilos para la columna de selección */
        .seleccion-column {
            width: 50px;
            text-align: center;
        }

        /* Estilos para el botón de guardar */
        .guardar-btn {
            padding: 10px 20px; /* Aumenta el padding para hacer el botón más grande */
            background-color: #337ab7; /* Color azul */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: absolute;
            bottom: 10px; /* Ajusta la distancia desde la parte inferior */
            right: 20px; /* Ajusta la posición horizontal */
        }

        .guardar-btn:hover {
            background-color: #286090; /* Cambio de color al pasar el ratón */
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="btn-menu">
               
            </div>
            <div class="logo">
                <center><h1>TAREAS</h1></center>
            </div>
            <nav class="menu">
                <!-- Iconos para los elementos del menú -->
                <a href="../Controller/Controlador.php?Opcion=6" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block"><i class="fas fa-tasks"></i> Completar Tareas</a>

                <a href="../Controller/Entidades/CerrarLogin.php" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>

            </nav>
        </div>
    </header>
    <div class="capa"></div>
    <!-- Resto del contenido -->

    <!-- Contenedor para el contenido principal debajo de la barra del menú -->
    <div class="container container-tareas">
        <!-- Tabla para mostrar las tareas y sus encuestas -->
        <table>
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Encuestas</th>
                </tr>
            </thead>
            <tbody>
                <!-- Iterar sobre la lista de tareas -->
                <?php foreach ($ListaTareas as $tarea): ?>
                    <tr>
                        <td><?php echo $tarea->titulo; ?></td>
                        <td>
                            <!-- Icono para expandir -->
                            <i class="fas fa-plus-circle expandir-btn" onclick="openModal(<?php echo $tarea->idtarea; ?>)"></i>
                            <!-- Ventana modal para mostrar las encuestas asociadas a la tarea -->
                            <div id="modal-<?php echo $tarea->idtarea; ?>" class="modal">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2>Encuestas - <?php echo $tarea->titulo; ?></h2>
                                        <span class="modal-close" onclick="closeModal(<?php echo $tarea->idtarea ?>)">&times;</span>
                                    </div>
                                    <div class="modal-body">
                                        <table class="encuestas-table">
                                            <thead>
                                                <tr>
                                                    <th class="seleccion-column">Seleccionar</th>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody id="RowTarea-<?php echo $tarea->idtarea ?>">
                                                <?php
                                                $oListaUE = $oBD->ConsultarUsuario_EncuestaPorIdUsuarioIdTarea($IdUsuario,$tarea->idtarea);
                                                foreach ($oListaUE as $x) 
                                                {
                                                    $Rotulos = new ClassRotulosEntidades();
                                                    echo "<tr>";
                                                    if ($x->disponibilidad == '1') {
                                                        echo "<td ><input type='checkbox' id='{$x->idencuesta}' name='{$x->estado}' checked></td>";
                                                    } else {
                                                        echo "<td ><input type='checkbox' id='{$x->idencuesta}' name='{$x->estado}'></td>";
                                                    }
                                                    echo "<td>{$Rotulos->RetornarRotulo_Encuesta($x->idencuesta)}</td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <!-- Botón Guardar dentro de la modal -->
                                    </div>
                                    <!-- Contenedor del botón Guardar -->
                                    <div class="modal-footer">
                                        <button class="guardar-btn" onclick="guardar(<?php echo $IdUsuario ?>,<?php echo $tarea->idtarea ?>)">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript -->
    <script>
        function openModal(idTarea) {
            const modal = document.getElementById('modal-' + idTarea);
            modal.style.display = 'block';
        }

        function closeModal(idTarea) {
            const modal = document.getElementById('modal-' + idTarea);
            modal.style.display = 'none';
        }

        function guardar(idusuario, idTarea) {
            // Aquí puedes agregar la lógica para guardar los cambios
            let RowTarea = document.getElementById('RowTarea-' + idTarea)

            let Inputs = RowTarea.getElementsByTagName('input');

            let Selecciones = [];
            let Disponibilidad = [];
            let Estados = [];

            for (let i = 0; i < Inputs.length; i++) {
                let Input =Inputs[i];
                Selecciones.push(Input.id);
                let D = (Input.checked) ? '1': '0'
                Disponibilidad.push(D);
                Estados.push(Input.name);
            }

            console.log(Selecciones);
            console.log(Disponibilidad);
            console.log(Estados);

            let variable1 = idusuario;
            let variable2 = Selecciones;
            let variable3 = Disponibilidad;
            let variable4 = Estados;
            
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../Model/Consultas/MSeleccionarENCUESTA.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText); // Respuesta del servidor
                }
            };
            let datos = "variable1=" + encodeURIComponent(variable1) + "&variable2=" + encodeURIComponent(JSON.stringify(variable2)) + "&variable3=" + encodeURIComponent(JSON.stringify(variable3)) + "&variable4=" + encodeURIComponent(JSON.stringify(variable4));
            xhr.send(datos); // Enviar datos al servidor

            alert("Guardando cambios...");
        }
    </script>
</body>
</html>
