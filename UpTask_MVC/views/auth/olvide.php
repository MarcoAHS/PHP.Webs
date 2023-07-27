<div class="contenedor olvide">
<?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesion</p>
        <form action="/olvide" class="formulario" method="POST">
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" placeholder="Tu Email" name="email">
            </div>
            <input type="submit" class="boton" value="Reestablecer">
        </form>
        <div class="acciones">
            <a href="/">Inicia Sesion</a>
            <a href="/crear">Crear Nueva Cuenta</a>
        </div>
    </div>
</div>