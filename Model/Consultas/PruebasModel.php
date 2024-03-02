<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas Model</title>
    <?php 
    include_once(__DIR__.'/../ClassConsultasBD.php');
    include_once(__DIR__.'/../../Script/Func/ClassRotulosEntidades.php');

    $oBD = new ClassConsultasBD();

    $ListaU = $oBD->ConsultarUsuario();
    $ListaT = $oBD->ConsultarTarea();
    $ListaE = $oBD->ConsultarEncuesta();
    $ListaUE = $oBD->ConsultarUsuario_Encuesta();

    $Rotulos = new ClassRotulosEntidades();
    ?>
</head>
<body>
    <main>
        <center>
            <h1>Consultar Usuario</h1>
            <table border="1">
                <tr>
                    <th>idusuario</th>
                    <th>nombre</th>
                    <th>correo</th>
                    <th>clave</th>
                    <th>tipo</th>
                </tr>
                <?php 
                foreach ($ListaU as $x) 
                {
                ?>
                    <tr>
                        <td><?php echo $x->idusuario ?></td>
                        <td><?php echo $x->nombre ?></td>
                        <td><?php echo $x->correo ?></td>
                        <td><?php echo $x->clave ?></td>
                        <td><?php echo $x->tipo ?></td>
                        <td><a href="../Model/Consultas/MEliminarUSUARIO.php?Id=<?php echo $x->idusuario ?>">Eliminar</a></td>
                        <td><a href="../Model/Consultas/MEditarUSUARIO.php?Id=<?php echo $x->idusuario ?>">Actualizar</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>

            <h1>Consultar Tarea</h1>
            <table border="1">
                <tr>
                    <th>idtarea</th>
                    <th>titulo</th>
                </tr>
                <?php 
                foreach ($ListaT as $x) 
                {
                ?>
                    <tr>
                        <td><?php echo $x->idtarea ?></td>
                        <td><?php echo $x->titulo ?></td>
                        <td><a href="../Model/Consultas/MEliminarTAREA.php?Id=<?php echo $x->idtarea ?>">Eliminar</a></td>
                        <td><a href="../Model/Consultas/MEditarTAREA.php?Id=<?php echo $x->idtarea ?>">Actualizar</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>

            <h1>Consultar Encuesta</h1>
            <table border="1">
                <tr>
                    <th>idencuesta</th>
                    <th>descripcion</th>
                    <th>idtarea</th>
                </tr>
                <?php 
                foreach ($ListaE as $x) 
                {
                ?>
                    <tr>
                        <td><?php echo $x->idencuesta ?></td>
                        <td><?php echo $x->descripcion ?></td>
                        <td><?php echo $Rotulos->RetornarRotulo_Tarea($x->idtarea) ?></td>
                        <td><a href="../Model/Consultas/MEliminarENCUESTA.php?Id=<?php echo $x->idencuesta ?>">Eliminar</a></td>
                        <td><a href="../Model/Consultas/MEditarENCUESTA.php?Id=<?php echo $x->idencuesta ?>">Actualizar</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>

            <h1>Consultar Usuarario_Encuesta</h1>
            <table border="1">
                <tr>
                    <th>idusuario</th>
                    <th>idencuesta</th>
                    <th>estado</th>
                </tr>
                <?php 
                foreach ($ListaUE as $x) 
                {
                ?>
                    <tr>
                        <td><?php echo $x->idusuario ?></td>
                        <td><?php echo $Rotulos->RetornarRotulo_Encuesta($x->idencuesta) ?></td>
                        <td><?php echo $x->estado ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </center>
    </main>
</body>
</html>