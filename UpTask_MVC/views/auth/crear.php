<div class="contenedor crear">
<?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu Cuenta en UpTask</p>
        <form action="/crear" class="formulario" method="POST">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="nombre" id="nombre" placeholder="Tu Nombre" name="nombre" value="<?php echo $usuario->nombre; ?>">
            </div>
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" placeholder="Tu Email" name="email"  value="<?php echo $usuario->email; ?>">
            </div>
            <div class="campo">
                <label for="password">Password:</label>
                <input type="password" id="password" placeholder="Tu Password" name="password">
            </div>
            <div class="campo">
                <label for="password2">Repite tu Password:</label>
                <input type="password" id="password2" placeholder="Confirma tu Password" name="password2">
            </div>
            <input type="submit" class="boton" value="Crear Cuenta">
        </form>
        <div class="acciones">
            <a href="/">Inicia Sesion</a>
            <a href="/olvide">Olvidaste tu Password?</a>
        </div>
    </div>
</div>