<?php include_once __DIR__ . '/header-dashboard.php'; ?>
    <div class="contenedor-sm">
        <?php @include_once __DIR__ . '/../templates/alertas.php'; ?>
        <a href="/perfil" class="enlace">Volver al Perfil</a>
        <form method="POST" class="formulario" action="/cambiar-password">
            <div class="campo">
                <label for="passwordA">Password Actual</label>
                <input type="password" placeholder="Actual" value="" name="passwordA">
            </div>
            <div class="campo">
                <label for="passwordN">Password Nuevo</label>
                <input type="password" placeholder="Nuevo" value="" name="passwordN">
            </div>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>