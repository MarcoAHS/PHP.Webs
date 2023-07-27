<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Registrate en DevWebCam</p>
    <?php 
        require_once __DIR__ . '/../templates/alertas.php';
    ?>
    <form action="/registro" method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre:</label>
            <input value="<?php echo $usuario->nombre; ?>" type="text" name="nombre" class="formulario__input" placeholder="Tu nombre" id="nombre">
        </div>
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido:</label>
            <input value="<?php echo $usuario->apellido; ?>" type="text" name="apellido" class="formulario__input" placeholder="Tu Apellido" id="apellido">
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email:</label>
            <input value="<?php echo $usuario->email; ?>" type="email" name="email" class="formulario__input" placeholder="Tu Email" id="email">
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password:</label>
            <input type="password" name="password" class="formulario__input" placeholder="Tu password" id="password">
        </div>
        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Confirma Tu Password:</label>
            <input type="password" name="password2" class="formulario__input" placeholder="Confirma tu password" id="password">
        </div>
        <input type="submit" value="Crear Cuenta" class="formulario__submit">
    </form>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">Iniciar Sesion</a>
        <a href="/olvide" class="acciones__enlace">Recuperar Password</a>
    </div>
</main>