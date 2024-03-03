<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../Script/Styles/EstilosGlobal.css">

    <title>Document</title>
</head>
<body>
    <div id="login" class="login-form">   
        <h1>Ingresar</h1>
        
        <form action="../Controller/Entidades/ControladorLogin.php" method="post">
            <div class="field-wrap">
                <label for="">Insertar su correo electronico</label>    
                <input type="email" name="correo"><br><br>
            </div>
        
            <div class="field-wrap">
             <label for="">Insertar clave De Usuario</label>
                <input type="password" name="clave"><br><br>
            </div>
        
            <input type="submit" class="button" value="Iniciar Sesión">
        </form>

        <div class="register-link">
            <a href="#" class="button" id="register-link">Registrarse</a>
        </div>
    </div>
     
    <div id="signup" class="login-form" style="display: none;">   
        <h1>Registrarse</h1>
        
        <form action="../Model/Consultas/MInsertarUSUARIO.php" method="post">
                <label for="">Insertar nombre De Usuario</label>    
                <input type="text" name="nombre"><br><br>
                <label for="">Insertar correo De Usuario</label>
                <input type="email" name="correo"><br><br>
                <label for="">Insertar clave De Usuario</label>
                <input type="text" name="clave"><br><br>
                <input type="text" name="tipo" value="cliente" style="display:none">
                <input type="submit" value="Guardar">
        </form>
    </div>

    <script>
        var loginDiv = document.getElementById('login');
        var signupDiv = document.getElementById('signup');
        
        document.getElementById('register-link').addEventListener('click', function(event) {
            event.preventDefault();
            loginDiv.style.display = 'none';
            signupDiv.style.display = 'block';
        });
    </script>
</body>
</html>