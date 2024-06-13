<?php
    $flag = 4;
    include 'templates/header.php';
?>
    <div class="form">
        <form action="/contacto.php">
            <div class="campo">
                <label for="name">Nombre: </label>
                <input type="text" id="name">
                <label for="email">Email: </label>
                <input type="text" id="email">
            </div>
                
            
            <div class="campo">
                <label for="reason">Cuentanos como podemos ayudarte: </label>
                <input type="textbox" id="reason" placeholder="Quiero obtener una cotizacion...">
            </div>
        </form>
    </div>
<?php
    include 'templates/footer.php';
?>