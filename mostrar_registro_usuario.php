<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Poppins:wght@200;300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/materialize.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="shortcut icon" href="./media/favicon/favicon.png" type="image/x-icon">

    <script src="./js/materialize.js"></script>
    <script src="js/modernizr.js"></script>

    <style>
        header {
            padding: 13px 20px;
            display: flex;
            align-items: center;
        }

        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f8f8;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            color: #333;
            z-index: 10;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        #footer p {
            margin: 0;
        }

        .container {
            margin-top: 28vh;
            max-width: 600px;
        }

        .header-title {
            font-size: 2rem;
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
            font-family: 'Cinzel', serif;
        }

        .input-field input {
            width: 100%;
            padding-left: 15px;
            font-style: italic;
            background-color: #f8f9fa;
            border: none;
            box-shadow: none;
        }

        .btn-register {
            width: 100%;
            background-color: #000;
            color: #fff;
            text-transform: uppercase;
            font-family: 'Poppins', sans-serif;
        }

        .login-text {
            text-align: center;
            margin-top: 15px;
            font-family: 'Poppins', sans-serif;
        }

        .icon-eye {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 1;
        }

        .volver-text {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-family: 'Poppins', sans-serif;
        }

        .volver-text a {
            color: #000;
            text-decoration: none;
            font-weight: 500;
        }

        .volver-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
    data-bs-smooth-scroll="true" tabindex="0">

    <header id="header" class="site-header text-black">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="media/img/lunaticos-logo.png" class="logo" alt="Logo Principal">
            </a>
        </div>
    </header>

    <div class="container">
        <h2 class="header-title">Crea tu Cuenta</h2>
        <div class="row">
            <div class="col s12">
                <form method="POST" action="logica/registrar_user.php">
                    <div class="input-field">
                        <label for="usuario" class="active">Usuario</label>
                        <input type="text" id="usuario" name="usuario" required>
                    </div>
                    <div class="input-field">
                        <label for="correo" class="active">Correo electrónico</label>
                        <input type="text" id="correo" name="correo" required>
                    </div>
                    <div class="input-field">
                        <input type="password" id="contrasena" name="contrasena" required>
                        <label for="contrasena">Contraseña</label>
                        <span toggle="#contrasena" class="material-icons icon-eye"
                            style="cursor: pointer; position: absolute; right: 10px; top: 20px;">visibility</span>
                    </div>
                    <button type="submit" class="btn btn-register waves-effect waves-light">Registrar</button>
                </form>

                <p class="login-text">¿Ya tienes una cuenta? <a href="mostrar_login.php">Inicia sesión</a></p>
                <div class="volver-text">
                    <a href="index.html">Volver</a>
                </div>
            </div>
        </div>
    </div>
    <footer id="footer" class="overflow-hidden padding-large">
        <div class="container-fluid">
            <div class="row">
                <div class="row d-flex flex-wrap justify-content-between">
                    <p>Términos y condiciones / Aviso de Privacidad © 2024</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const iconEye = document.querySelector('.icon-eye');
        iconEye.addEventListener('click', function () {
            const passwordField = document.getElementById('contrasena');
            const isPassword = passwordField.type === 'password';
            passwordField.type = isPassword ? 'text' : 'password';
            iconEye.textContent = isPassword ? 'visibility_off' : 'visibility';
        });
    </script>


    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</body>

</html>