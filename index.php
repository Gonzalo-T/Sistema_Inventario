<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="website icon" type="png" href="assets/icons/icon.barra.png">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')
    </script>
    <script src="js/material.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/loginScript.js"></script>

</head>

<body class="cover">
    <div class="container-login">
        <p class="text-center" style="font-size: 80px;">
            <i class="zmdi zmdi-account-circle"></i>
        </p>
        <p class="text-center text-condensedLight">Inicia sesión con tu cuenta</p>
        <form action="php/validador.php" method="POST">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="userName" name="userName">
                <label class="mdl-textfield__label" for="userName">Nombre Usuario</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="password" id="pass" name="pass">
                <label class="mdl-textfield__label" for="pass">Password</label>
            </div>

            <!-- Mensaje de error -->
            <div id="error-message" class="error-message" style="color: red; text-align: center; margin-top: 20px;"></div>

            <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect" style="color: #3F51B5; float: right;">
                Iniciar sesión <i class="zmdi zmdi-mail-send"></i>
            </button>
        </form>
    </div>

    
</body>

</html>