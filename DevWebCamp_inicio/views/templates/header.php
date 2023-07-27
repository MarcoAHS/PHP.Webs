<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <?php if(auth()){ 
                if($_SESSION['admin'] === 1){?>
                    <a href="/admin/dashboard" class="header__enlace">Administrar</a>
                <?php } else {?>
                    <a href="/finalizar-registro" class="header__enlace">Administrar</a>
                <?php } ?>
                <form class="dashboard__form" method="POST" action="/logout">
                    <input type="submit" value="Cerrar Sesion" class="dashboard__submit--logout">
                </form>
            <?php } else { ?>
                <a href="/registro" class="header__enlace">Registro</a>
                <a href="/login" class="header__enlace">Iniciar Sesion</a>
            <?php } ?>
        </nav>
        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">&#60;DevWebCamp/></h1>
            </a>
            <p class="header__texto">Octubre 4-5 - 2023</p>
            <p class="header__texto header__texto--modalidad">En Linea - Presencial</p>
            <a href="/comprar" class="header__boton">Comprar Pase</a>
        </div>
    </div>
</header>
<div class="barra">
    <div class="barra__contenido">
        <a href="/" class="barra__logo"><h2>
        &#60;DevWebCamp/>
        </h2></a>
        <nav class="navegacion">
            <a href="/devwebcamp" class="navegacion__enlace <?php echo ($titulo === "Sobre DevWebCamp") ? 'navegacion__enlace--sel'  : ''; ?>">Eventos</a>
            <a href="/paquetes" class="navegacion__enlace <?php echo ($titulo === "Paquetes DevWebCamp") ? 'navegacion__enlace--sel'  : ''; ?>">Paquetes</a>
            <a href="/workshops-conferencias" class="navegacion__enlace <?php echo ($titulo === "Conferencias & WorkShops") ? 'navegacion__enlace--sel'  : ''; ?>">Workshops / Conferencias</a>
            <a href="/registro" class="navegacion__enlace <?php echo ($titulo === "Registrate") ? 'navegacion__enlace--sel'  : ''; ?>">Comprar Pase</a>
        </nav>
    </div>
</div>