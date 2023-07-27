<?php include_once __DIR__ . '/header-dashboard.php'; ?>
    <div class="contenedor-sm">
        <?php @include_once __DIR__ . '/../templates/alertas.php'; ?>
        <a href="/cambiar-password" class="enlace">Cambiar Password</a>
        <form method="POST" class="formulario" action="/perfil">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" value="<?php echo $usuario->nombre; ?>" name="nombre">
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" placeholder="Tu email" value="<?php echo $usuario->email; ?>" name="email">
            </div>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>