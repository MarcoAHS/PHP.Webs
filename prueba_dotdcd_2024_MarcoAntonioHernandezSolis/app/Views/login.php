<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia Sesion</title>
        <!-- STYLES -->
    <style {csp-style-nonce}>
        html {
        height: 100%;
        }

        .login-box {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 400px;
        padding: 40px;
        transform: translate(-50%, -50%);
        background: rgba(221, 72, 20, .8);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0,0,0,.6);
        border-radius: 10px;
        }

        .login-box h2 {
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
        }

        .login-box .user-box {
        position: relative;
        }

        .login-box .user-box input {
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
        }
        .login-box .user-box label {
        position: absolute;
        top:0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: .5s;
        }

        .login-box .user-box input:focus ~ label,
        .login-box .user-box input:valid ~ label {
        top: -20px;
        left: 0;
        color: black;
        font-size: 12px;
        }

        .login-box form button {
        position: relative;
        display: inline-block;
        padding: 10px 20px;
        color: white;
        font-size: 16px;
        text-decoration: none;
        text-transform: uppercase;
        overflow: hidden;
        transition: .5s;
        margin-top: 40px;
        letter-spacing: 4px;
        background: transparent;
        cursor: pointer;
        &:hover{
            scale: 1.1;
        }
        }
        .error{
            background-color: pink;
            border-left: 4px solid red;
            border-radius: 10%;
            padding: 0.5rem;
            margin: 1rem auto;
        }

    </style>
</head>
<body>
    <div class="login-box">
        <h2>Bienvenido al Login</h2>
        <form action="/public/login" method="POST">
            <div class="user-box">
                <input type="email" name="email" id="email" required>
                <label for="correo">Correo:</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" id="password" required>
                <label for="password">Contrasena:</label>
            </div>
            <button class="enviar">Iniciar Sesion</button>
        </form>
        <?php if(isset($_GET['flag'])){ ?>
            <?php if(($_GET['flag']) == 1):?>
                <div class="error">Correo invalido</div>
            <?php endif?>
            <?php if(($_GET['flag']) == 2):?>
                <div class="error">Contrasena invalida</div>
            <?php endif?>
        <?php } ?>
    </div>
</body>
</html>