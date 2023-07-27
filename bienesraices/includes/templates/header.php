<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraices/index.php">
                    <img src="/bienesraices/build/img/logo.svg" alt="logotipo">
                </a>
                <div class="mobile-menu">
                    <img src="/bienesraices/build/img/barras.svg" alt="Icono Menu">
                </div>
                <div class="derecha">
                    <img class="dark" src="/bienesraices/build/img/dark-mode.svg" alt="Imagen Modo Oscuro">
                    <nav class="navegacion">
                        <a href="nosotors.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if($auth === true){ ?>
                            <a href="/../../bienesraices/cerrar-sesion.php">Cerrar Sesion</a>
                        <?php } else{ ?>
                            <a href="/../../bienesraices/login.php">Iniciar Sesion</a>
                        <?php } ?>
                    </nav>
                </div>
            </div>
            <?php if($inicio) { ?>
            <h1> Venta de Casas y Departamentos</h1>
            <?php } ?>
        </div>
    </header>