<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Reestablece tu Password en DevWebCam</p>
    <?php 
        require_once __DIR__ . '/../templates/alertas.php';
    ?>
    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password:</label>
            <input type="password" name="password" class="formulario__input" placeholder="Tu password" id="password">
        </div>
        <input type="submit" value="Reestablecer" class="formulario__submit">
    </form>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">Iniciar Sesion</a>
        <a href="/olvide" class="acciones__enlace">Recuperar Password</a>
    </div>
</main>