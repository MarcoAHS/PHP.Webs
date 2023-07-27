<fieldset>
                <legend>Informacion de Vendedor</legend>
                <label for="nombre">Nombre:</label>
                <input <?php if($u === 2){ ?> disabled <?php } ?> name="vendedor[nombre]" type="text" id="nombre" placeholder="Nombre Vendedor" value="<?php echo s($vendedor->nombre); ?>">
                <label for="apellido">Apellido:</label>
                <input <?php if($u === 2){ ?> disabled <?php } ?> name="vendedor[apellido]" type="text" id="apellido" placeholder="Apellido Vendedor" value="<?php echo s($vendedor->apellido); ?>">
                <label for="telefono">Telefono:</label>
                <input <?php if($u === 2){ ?> disabled <?php } ?> name="vendedor[telefono]" type="text" id="telefono" placeholder="Telefono Vendedor" value="<?php echo s($vendedor->telefono); ?>"></input>
</fieldset>