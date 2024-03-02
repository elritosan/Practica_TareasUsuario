<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../Script/Styles/EstilosGlobal.css">

    <title>Document</title>

    <?php 
    include_once(__DIR__.'/../Model/ClassConsultasBD.php');

    $oBD = new ClassConsultasBD();
    ?>
</head>
<body>
    <main>
        <fieldset>
            <legend>Insertar Usuario</legend>
            <form action="../Model/Consultas/MInsertarUSUARIOENCUESTA.php" method="post">
                <label for="">Ingresar idusuario:</label>
                <select name="idusuario" id="">
                    <?php 
                    $ListaU = $oBD->ConsultarUsuario();

                    foreach ($ListaU as $x) 
                    {
                    ?>
                        <option value="<?php echo $x->idusuario ?>"><?php echo $x->nombre ?></option>
                    <?php
                    }
                    ?>
                </select><br><br>
                <label for="">Ingresar idencuesta:</label>
                <select name="idencuesta" id="">
                    <?php 
                    $ListaE = $oBD->ConsultarEncuesta();

                    foreach ($ListaE as $x) 
                    {
                    ?>
                        <option value="<?php echo $x->idencuesta ?>"><?php echo $x->descripcion ?></option>
                    <?php
                    }
                    ?>
                </select><br><br>
                <label for="">Ingresar estado:</label>
                <Select name="estado">
                    <option value="pendiente" select>Pendiente</option>
                    <option value="completado">Completado</option>
                </Select><br><br>
                <label for="">Ingresar disponibilidad:</label>
                <Select name="disponibilidad">
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </Select><br><br>
                <input type="submit" value="Guardar">
            </form>
        </fieldset>
    </main>
</body>
</html>