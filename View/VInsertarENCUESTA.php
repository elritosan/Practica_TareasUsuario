<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../Script/Styles/EstilosGlobal.css">

    <title>Document</title>
</head>
<body>
    <main>
        <fieldset>
            <legend>Insertar Tarea</legend>
            <form action="../Model/Consultas/MInsertarENCUESTA.php" method="post">
                <label for="">Ingresar descripcion De La Encuesta</label>    
                <input type="text" name="descripcion"><br><br>
                <label for="">Ingresar a que Tarea Pertenece</label>
                <select name="idtarea">
                    <option value="null">Selccione</option>
                    <?php 
                    include_once(__DIR__.'/../Model/ClassConsultasBD.php');

                    $oBD = new ClassConsultasBD();

                    $ListaU = $oBD->ConsultarTarea();

                    foreach ($ListaU as $x) 
                    {
                    ?>
                        <option value="<?php echo $x->idtarea ?>"><?php echo $x->titulo ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br><br>
                <input type="submit" value="Guardar">
            </form>
        </fieldset>
    </main>
</body>
</html>