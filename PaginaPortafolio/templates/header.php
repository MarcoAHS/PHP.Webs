<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Portafolio</title>
    <link rel="stylesheet" href="/css/header.css"></link>
    <link rel="stylesheet" href="/css/footer.css"></link>
    <link rel="stylesheet" href="/css/banner.css"></link>
    <link rel="stylesheet" href="/css/about.css"></link>
    <link rel="stylesheet" href="/css/anuncios.css"></link>
    <link rel="stylesheet" href="/css/contacto.css"></link>
</head>
<body>
    <div class="header">
        <a href="/index.php"><img src="../img/logo.webp" alt="Logo"></a>
        <nav class="navbar">
            <a href="/index.php" class="link <?php echo $flag === 1 ? 'selected' : ''; ?>">Inicio</a>
            <a href="/about.php" class="link <?php echo $flag === 2 ? 'selected' : ''; ?>">Acerca de Nosotros</a>
            <a href="/anuncios.php" class="link <?php echo $flag === 3 ? 'selected' : ''; ?>">Anuncios</a>
            <a href="/contacto.php" class="link <?php echo $flag === 4 ? 'selected' : ''; ?>">Contacto</a>
        </nav>
    </div>
