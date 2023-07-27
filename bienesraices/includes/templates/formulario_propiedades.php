<fieldset>
                <legend>Informacion General de Propiedad</legend>
                <label for="titulo">Titulo:</label>
                <input <?php if($u === 2){ ?> disabled <?php } ?> name="propiedad[titulo]" type="text" id="titulo" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">
                <label for="precio">Precio:</label>
                <input <?php if($u === 2){ ?> disabled <?php } ?> name="propiedad[precio]" type="number" id="precio" placeholder="Precio Propiedad"  value="<?php echo s($propiedad->precio); ?>">
                <label for="imagen">Imagen:</label>
                <?php if($propiedad->imagen){ ?>
                    <img src="../../imagenes/<?php echo $propiedad->imagen?>" class="imagen-small">
                    <?php if($u === 1){ ?>
                        <input name="propiedad[imagen]" type="file" id="imagen" placeholder="Imagen Propiedad" accept="image/jpeg, image/png">
                    <?php } ?>
                <?php } else { ?>
                    <input name="propiedad[imagen]" type="file" id="imagen" placeholder="Imagen Propiedad" accept="image/jpeg, image/png">
                <?php } ?>
                <label for="descripcion">Descripcion:</label>
                <textarea <?php if($u === 2){ ?> disabled <?php } ?> name="propiedad[descripcion]" id="descripcion"> <?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>
<fieldset>
                <legend>Informacion de Propiedad</legend>
                <label for="habitaciones">Habitaciones:</label>
                <input <?php if($u === 2){ ?> disabled <?php } ?> name="propiedad[habitaciones]" type="number" id="habitaciones" placeholder="Ej. 3" min="1" max="8"  value="<?php echo s($propiedad->habitaciones); ?>">
                <label for="wc">Wc:</label>
                <input <?php if($u === 2){ ?> disabled <?php } ?> name="propiedad[wc]" type="number" id="wc" placeholder="Ej. 2" min="1" max="8"  value="<?php echo s($propiedad->wc); ?>">
                <label for="estacionamiento">Estacionamiento:</label>
                <input <?php if($u === 2){ ?> disabled <?php } ?> name="propiedad[estacionamiento]" type="number" id="estacionamiento" placeholder="Ej. 1" min="1" max="8"  value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>
<fieldset>
                <legend>Vendedor</legend>
                <label for="vendedor">Vendedor</label>
                <select name="propiedad[vendedores_id]" id="vendedor">
                    <option disabled selected value="">--Seleccione Vendedor--</option>
                    <?php foreach($vendedores as $vendedor){ ?>
                        <option <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : '' ?> value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?></option>
                    <?php } ?> 
                </select>
</fieldset>