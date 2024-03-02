<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
    include_once(__DIR__.'/../ClassConsultasBD.php');

    $oBD = new ClassConsultasBD();

    $ListaT = $oBD->BuscarTarea($_GET['Id']);
    ?>
</head>
<body>
    <main>
        <center>
            <h1>Consultar Usuario</h1>
            <form action="../Consultas/MActualizarTAREA.php" method="post">
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
                            <td><input type="text" name="idtarea" value="<?php echo $x->idtarea ?>" readonly></td>
                            <td><input type="text" name="titulo" value="<?php echo $x->titulo ?>"></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <input type="submit" value="Guardar">
            </form>
        </center>
    </main>
</body>
</html>