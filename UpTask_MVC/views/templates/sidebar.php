<aside class="sidebar">
    <div class="contenedor-sidebar">
        <h2>Uptask</h2>
        <div class="cerrar-menu">
            <img id="cerrar-menu" src="/build/img/cerrar.svg" alt="imagen cerrar menu">
        </div>
    </div>
    <nav class="sidebar-nav">
        <a class="<?php echo ($titulo === 'Proyectos') ? 'activo' : ''; ?>" href="/dashboard">Dashboard</a>
        <a class="<?php echo ($titulo === 'Crear Proyecto') ? 'activo' : ''; ?>" href="/crear-proyecto">Crear Proyectos</a>
        <a class="<?php echo ($titulo === 'Perfil') ? 'activo' : ''; ?>" href="/perfil">Perfil</a>
    </nav>
    <div class="cerrar-sesion-mobil">
        <a href="/logout" class="cerrar-sesion">Cerrar Sesion</a>
    </div>
</aside>