<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../index.css">
    <title>Datos Ingresados</title>
    <style>
        .table {
            border: 2px solid tomato; /* Agrega bordes tomate a la tabla */
            background-color: white; /* Fondo blanco para la tabla */
            margin-top: 100px; /* Agrega margen superior */
            margin-left: auto; /* Centra la tabla horizontalmente */
            margin-right: auto;
        }

        .table th,
        .table td {
            border: 1px solid tomato; /* Bordes tomate para las celdas */
            padding: 8px; /* Ajusta el espacio interno de las celdas */
        }

        .table th {
            background-color: #f2f2f2; /* Fondo gris claro para las celdas de encabezado */
        }

        .btn-pendiente {
            background-color:peachpuff; /* Color del botón cuando está pendiente */
            border-color: tomato; /* Color del borde cuando está pendiente */
        }

        .btn-completado {
            background-color:mediumseagreen; /* Color del botón cuando está completado */
            border-color: green; /* Color del borde cuando está completado */
        }
    </style>

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

    $ListaTareas = $oBD->ConsultarTarea();
    ?>
</head>
<body>
<header class="header">
        <div class="container">
            <div class="btn-menu">
               
            </div>
            <div class="logo">
                <center><h1>COMPLETAR TAREAS</h1></center>
            </div>
            <nav class="menu">
                <!-- Iconos para los elementos del menú -->
                <a href="../Controller/Controlador.php?Opcion=7" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block"><i class="fas fa-home"></i> Inicio
                </a>
                <a href="../Controller/Entidades/CerrarLogin.php" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>

            </nav>
        </div>
    </header>
    <div class="capa"></div>
    <!-- Resto del contenido -->
    <div class="content">
            <?php foreach ($ListaTareas as $tarea): ?>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tarea</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Completado</th>
                            </tr>
                        </thead>
                        <tbody id="RowTarea-<?php echo $tarea->idtarea ?>">
                            <?php $oListaUE = $oBD->ConsultarUsuario_EncuestaPorIdUsuarioIdTarea($IdUsuario,$tarea->idtarea) ?>
                            <?php foreach ($oListaUE as $x): ?>
                                <?php 
                               if ($x->disponibilidad == '1') {
                                    $estado = $x->estado;
                                    $boton_texto = ($estado == 'pendiente') ? 'Pendiente' : 'Completado';
                                    $boton_clase = ($estado == 'pendiente') ? 'btn-pendiente' : 'btn-completado';
                                    
                                    $Rotulos = new ClassRotulosEntidades();

                                    echo "<tr>";
                                    echo "<td>{$tarea->titulo}</td>";
                                    echo "<td>{$Rotulos->RetornarRotulo_Encuesta($x->idencuesta)}</td>";
                                    echo "<td><button id='{$x->idencuesta}' name='{$x->estado}' title='{$x->disponibilidad}' class='btn $boton_clase' onclick=\"marcarEncuesta({$IdUsuario},{$tarea->idtarea},this)\">$boton_texto</button></td>";
                                    echo "</tr>";
                                }
                                ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            <?php endforeach; ?>
    </div>

    <script>
        function marcarEncuesta(idusuario, idTarea, boton) {
            // Cambiar el estado del botón
            let RowTarea = document.getElementById('RowTarea-' + idTarea)
            let Inputs = RowTarea.getElementsByTagName('button');

            let Selecciones = boton.id;
            let Disponibilidad = boton.title;
            let Estados = "";

            if (boton.innerHTML == "Pendiente") {
                boton.innerHTML = "Completado";
                boton.classList.remove('btn-pendiente');
                boton.classList.add('btn-completado');
                Estados = "completado";
            } else {
                boton.innerHTML = "Pendiente";
                boton.classList.remove('btn-completado');
                boton.classList.add('btn-pendiente');
                Estados = 'pendiente';
            }
            
            console.log(idusuario);
            console.log(Selecciones);
            console.log(Disponibilidad);
            console.log(Estados);

            let variable1 = idusuario;
            let variable2 = Selecciones;
            let variable3 = Disponibilidad;
            let variable4 = Estados;
            
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../Model/Consultas/MCompletarENCUESTA.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText); // Respuesta del servidor
                }
            };
            let datos = "variable1=" + encodeURIComponent(variable1) + "&variable2=" + encodeURIComponent(variable2) + "&variable3=" + encodeURIComponent(variable3) + "&variable4=" + encodeURIComponent(variable4);
            xhr.send(datos); // Enviar datos al servidor
        }
    </script>
</body>
</html>
