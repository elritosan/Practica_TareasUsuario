<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
    include_once(__DIR__.'/../ClassConsultasBD.php');
    include_once(__DIR__.'/../../Script/Func/ClassRotulosEntidades.php');

    $oBD = new ClassConsultasBD();

    $ListaE = $oBD->BuscarEncuesta($_GET['Id']);

    $Rotulos = new ClassRotulosEntidades();
    ?>
</head>
<body>
    <main>
        <center>
            <h1>Consultar Usuario</h1>
            <form action="../Consultas/MActualizarENCUESTA.php" method="post">
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
                            <td><input type="text" name="idencuesta" value="<?php echo $x->idencuesta ?>" readonly></td>
                            <td><input type="text" name="descripcion" value="<?php echo $x->descripcion ?>"></td>
                            <td>
                                <select name="idtarea">
                                    <option value="<?php echo $x->idtarea ?>" select><?php echo $Rotulos->RetornarRotulo_Tarea($x->idtarea) ?></option>
                                    <?php 
                                    $ListaT = $oBD->ConsultarTarea();
                                    foreach ($ListaT as $y) 
                                    {
                                        if ($x->idtarea != $y->idtarea) 
                                        {
                                    ?>
                                            <option value="<?php echo $y->idtarea ?>"><?php echo $y->titulo ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
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