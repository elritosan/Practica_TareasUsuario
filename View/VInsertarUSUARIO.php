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
            <legend>Insertar Usuario</legend>
            <form action="../Model/Consultas/MInsertarUSUARIO.php" method="post">
                <label for="">Insertar nombre De Usuario</label>    
                <input type="text" name="nombre"><br><br>
                <label for="">Insertar correo De Usuario</label>
                <input type="text" name="correo"><br><br>
                <label for="">Insertar clave De Usuario</label>
                <input type="text" name="clave"><br><br>
                <label for="">Insertar tipo De Usuario</label>
                <input type="text" name="tipo"><br><br>
                <input type="submit" value="Guardar">
            </form>
        </fieldset>
    </main>
</body>
</html>