<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Script/Styles/EstilosGlobal.css">
    <title>Panel de Administrador</title>
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
            margin: 0;
            display: flex;
            background-color: darkcyan;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column; /* Añadido para centrar el título */
        }

        .title {
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
            position: relative;
            z-index: 9999; /* Asegurar que el título esté por encima de las modales */
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
            z-index: 1; /* Asegurar que el menú esté detrás del título */
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

        .content {
            position: absolute;
            top: 20px;
            left: 270px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.5);
            width: 300px;
            max-width: calc(100% - 40px);
            z-index: 1; /* Asegurar que el contenido esté detrás del título */
        }

        .content form {
            text-align: center;
        }

        .content form label {
            display: block;
            margin-bottom: 10px;
        }

        .content form input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
        }

        .content form input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .content form input[type="submit"]:hover {
            background-color: #555;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 0; /* Asegurar que las modales estén detrás del título */
            left: 50%;
            top: 50px;
            transform: translate(-50%, 0);
            width: 80%;
            max-width: 500px;
            background-color: #aeeef8; /* Cambia el color de fondo a celeste agua */
            overflow: auto;
            border-radius: 10px;
            border: 2px solid tomato;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .modal-content {
            padding: 20px;
        }

        .modal-header {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
        #modalEncuesta img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<!-- Ventana modal para seleccionar tarea -->
<div id="modalTarea" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" id="closeTarea">&times;</span>
        <div class="modal-header">Ingreso de Encuestas</div> <!-- Título centrado -->
        <h2>Seleccionar Tarea</h2>
        <select id="tareaSelect" name="idtarea">
            <option value="null">Seleccione</option>
            <?php 
            include_once(__DIR__.'/../Model/ClassConsultasBD.php');
            $oBD = new ClassConsultasBD();
            $ListaU = $oBD->ConsultarTarea();
            foreach ($ListaU as $x) {
                echo '<option value="'.$x->idtarea.'">'.$x->titulo.'</option>';
            }
            ?>
        </select>
        <br><br>
        <input type="button" id="btnAceptarTarea" value="Aceptar">
    </div>
</div>

<!-- Ventana modal para ingresar encuesta -->
<div id="modalEncuesta" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" id="closeEncuesta">&times;</span>
        <div class="modal-header">Ingreso de Encuestas</div> <!-- Título centrado -->
        <h2>Ingresar Encuesta</h2>
        <img src="../img/TAREAS.png" alt="Imagen de ejemplo"> <!-- Agregar imagen aquí -->
        <form id="formEncuesta" action="../Model/Consultas/MInsertarENCUESTA.php" method="post">
            <label for="descripcionEncuesta">Ingresar descripción de la Encuesta</label>
            <input type="text" id="descripcionEncuesta" name="descripcion"><br><br>
            <input type="hidden" id="idTareaEncuesta" name="idtarea" value="">
            <input type="submit" value="Guardar">
        </form>
    </div>
</div>

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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modalTarea = document.getElementById("modalTarea");
        var modalEncuesta = document.getElementById("modalEncuesta");
        var btnAceptarTarea = document.getElementById("btnAceptarTarea");
        var closeTarea = document.getElementById("closeTarea");
        var closeEncuesta = document.getElementById("closeEncuesta");

        // Mostrar la ventana modal de tarea al cargar la página
        modalTarea.style.display = "block";

        // Evento para cerrar la ventana modal de tarea desde la "X"
        closeTarea.addEventListener("click", function() {
            modalTarea.style.display = "none";
        });

        // Evento para cerrar la ventana modal de encuesta desde la "X"
        closeEncuesta.addEventListener("click", function() {
            modalEncuesta.style.display = "none";
            modalTarea.style.display = "block"; // Mostrar modal de tarea nuevamente
        });

        // Evento para seleccionar tarea y mostrar la ventana modal de encuesta
        btnAceptarTarea.addEventListener("click", function() {
            var tareaSelect = document.getElementById("tareaSelect");
            var selectedTarea = tareaSelect.options[tareaSelect.selectedIndex].value;
            if(selectedTarea !== "null") {
                modalTarea.style.display = "none";
                modalEncuesta.style.display = "block";
                document.getElementById("idTareaEncuesta").value = selectedTarea;
            } else {
                alert("Seleccione una tarea antes de continuar.");
            }
        });
    });
</script>

</body>
</html>
