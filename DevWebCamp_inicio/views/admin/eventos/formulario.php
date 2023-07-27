<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">
        Informacion Evento
    </legend>
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre Evento</label>
        <input 
        type="text"
        class="formulario__input"
        id="nombre"
        name="nombre"
        placeholder="Nombre Evento"
        value="<?php echo $evento->nombre ?? ''; ?>"
        >
    </div>
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Descrpcion Evento</label>
        <textarea 
        class="formulario__input"
        id="descripcion"
        name="descripcion"
        placeholder="Descripcion Evento"
        rows="5"
        ><?php echo $evento->descripcion ?? ''; ?></textarea>
    </div>
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Categoria</label>
        <select class="formulario__select" name="categoria_id" id="categoria">
            <option selected disabled value="">--Selecciona--</option>
            <?php foreach($categorias as $categoria) {?>
                <option <?php if($evento->categoria_id === $categoria->id){ echo 'selected';}?> value="<?php echo $categoria->id ?? '';?>"><?php echo $categoria->nombre; ?></option>
            <?php } ?> 
        </select>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label">Selecciona el Dia</label>
        <div class="formulario__radio">
            <?php foreach($dias as $dia){ ?>
                <div>
                    <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre; ?></label>
                    <input <?php if($dia->id === $evento->dia_id){ echo 'checked'; } ?> type="radio" id="<?php echo strtolower($dia->nombre); ?>" name="dia" value="<?php echo $dia->id; ?>">
                </div>
            <?php } ?>
        </div>
        <input type="hidden" name="dia_id" value="<?php echo $evento->dia_id; ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label">Selecciona la Hora</label>
        <ul id="horas" class="horas">
            <?php foreach($horas as $hora){ ?>
                <li data-hora-id="<?php echo $hora->id; ?>" class="horas__hora horas__hora--des"><?php echo $hora->hora; ?></li>
            <?php } ?>
        </ul>
        <input type="hidden" name="hora_id" value="<?php echo $evento->hora_id; ?>">
    </div>
</fieldset>
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Extra</legend>
    <div class="formulario__campo">
        <label for="pontentes" class="formulario__label">Ponente</label>
        <input 
        type="text"
        class="formulario__input"
        id="ponentes"
        placeholder="Buscar Ponente"
        >
        <ul id="listado-ponentes" class="listado-ponentes"></ul>
        <input type="hidden" name="ponente_id" value="<?php echo $evento->ponente_id; ?>">
    </div>
    <div class="formulario__campo">
        <label for="disponibles" class="formulario__label">Lugares Disponibles</label>
        <input 
        type="number"
        class="formulario__input"
        min="1"
        id="disponibles"
        name="disponibles"
        placeholder="Buscar Ponente"
        value="<?php echo $evento->disponibles; ?>"
        >
    </div>
</fieldset>