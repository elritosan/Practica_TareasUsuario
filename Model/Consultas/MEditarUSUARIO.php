<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
    include_once(__DIR__.'/../ClassConsultasBD.php');

    $oBD = new ClassConsultasBD();

    $ListaU = $oBD->BuscarUsuario($_GET['Id']);
    ?>
</head>
<body>
    <main>
        <center>
            <h1>Consultar Usuario</h1>
            <form action="../Consultas/MActualizarUSUARIO.php" method="post">
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
                            <td><input type="text" name="idusuario" value="<?php echo $x->idusuario ?>" readonly></td>
                            <td><input type="text" name="nombre" value="<?php echo $x->nombre ?>"></td>
                            <td><input type="text" name="correo" value="<?php echo $x->correo ?>"></td>
                            <td><input type="text" name="clave" value="<?php echo $x->clave ?>"></td>
                            <td><input type="text" name="tipo" value="<?php echo $x->tipo ?>"></td>
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