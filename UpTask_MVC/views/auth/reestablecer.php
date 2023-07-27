<div class="contenedor reestablecer">
<?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo Password</p>
        <form class="formulario" method="POST">
            <div class="campo">
                <label for="password">Password:</label>
                <input type="password" id="password" placeholder="Tu Password" name="password">
            </div>
            <div class="campo">
                <label for="password2">Repite tu Password:</label>
                <input type="password" id="password2" placeholder="Confirma tu Password" name="password2">
            </div>
            <input type="submit" class="boton" value="Guardar Password">
        </form>
        <div class="acciones">
            <a href="/">Inicia Sesion</a>
            <a href="/crear">Crear Nueva Cuenta</a>
        </div>
    </div>
</div>