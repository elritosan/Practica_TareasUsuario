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
            <form action="../Model/Consultas/MInsertarTAREA.php" method="post">
                <label for="">Insertar Titulo de Tarea</label>
                <input type="text" name="titulo">
                <input type="submit" value="Guardar">
            </form>
        </fieldset>
    </main>
</body>
</html>