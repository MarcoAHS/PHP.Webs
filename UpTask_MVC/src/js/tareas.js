(function(){
    let tareas = [];
    let filtradas = [];
    obtenerTareas();
    const btn = document.querySelector('#agregar-tarea');
    btn.addEventListener('click', function(){
        mostrarFormulario();
    });
    const filtros = document.querySelectorAll('#filtros input[type="radio"]');
    filtros.forEach(radio => {
        radio.addEventListener('input', filtrarTareas);
    })
    function filtrarTareas(e){
        if(e.target.value !== ''){
            filtradas = tareas.filter(tarea => tarea.estado === e.target.value);
        } else {
            filtradas = [];
        }
        mostrarTareas();
    }
    async function obtenerTareas(){
        try {
            const id = obtenerProyecto();
            const url = `/api/tareas?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            tareas = resultado.tareas;
            mostrarTareas();
        } catch (error) {
            console.log(error);
        }
    }
    function mostrarTareas(){
        limpiarTareas();
        totalPendientes();
        totalCompletas();
        const arrayTareas = filtradas.length ? filtradas : tareas;
        if(arrayTareas.lenght === 0){
            const contenedorTareas = document.querySelector('#listado-tareas');
            const textoNoTareas = document.createElement('LI');
            textoNoTareas.textContent = 'No Hay Tareas';
            textoNoTareas.classList.add('no tareas');
            contenedorTareas.appendChild(textoNoTareas);
        } else {
            const estados = {
                0: 'Pendiente',
                1: 'Completa'
            }
            arrayTareas.forEach(tarea => {
                const contenedorTarea = document.createElement('LI');
                contenedorTarea.dataset.tareaId = tarea.id;
                contenedorTarea.classList.add('tarea');

                const nombreTarea = document.createElement('P');
                nombreTarea.textContent = tarea.nombre;
                nombreTarea.onclick = function(){
                    mostrarFormulario(true, {...tarea});
                }

                const opcionesDiv = document.createElement('DIV');
                opcionesDiv.classList.add('opciones');

                const btnEstadoTarea = document.createElement('BUTTON');
                btnEstadoTarea.classList.add('estado-tarea');
                btnEstadoTarea.classList.add(`${estados[tarea.estado].toLowerCase()}`);
                btnEstadoTarea.textContent = estados[tarea.estado];
                btnEstadoTarea.dataset.estadoTarea = tarea.estado;
                btnEstadoTarea.onclick = function() {
                    cambiarEstadoTarea({...tarea});
                }

                const btnEliminarTarea = document.createElement('BUTTON');
                btnEliminarTarea.classList.add('eliminar-tarea');
                btnEliminarTarea.dataset.idTarea = tarea.id;
                btnEliminarTarea.textContent = 'Eliminar';
                btnEliminarTarea.onclick = function(){
                    confirmarEliminarTarea({...tarea});
                }

                opcionesDiv.appendChild(btnEstadoTarea);
                opcionesDiv.appendChild(btnEliminarTarea);

                contenedorTarea.appendChild(nombreTarea);
                contenedorTarea.appendChild(opcionesDiv);

                document.querySelector('#listado-tareas').appendChild(contenedorTarea);
            });
        }
    }
    function totalPendientes(){
        const totalPendientes = tareas.filter(tarea => tarea.estado === "0");
        const pendientesRadio = document.querySelector('#incompletas');
        if(totalPendientes.length === 0){
            pendientesRadio.disabled = true;
        } else{
            pendientesRadio.disabled = false;
        }
    }
    function totalCompletas(){
        const totalCompletas = tareas.filter(tarea => tarea.estado === "1");
        const completasRadio = document.querySelector('#completas');
        if(totalCompletas.length === 0){
            completasRadio.disabled = true;
        } else{
            completasRadio.disabled = false;
        }
    }
    function mostrarFormulario(editar = false, tarea = {}){
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
            <form class = "formulario nueva-tarea">
                <legend>${editar ? 'Editar Tarea' : 'Crea una Nueva Tarea'}</legend>
                <div class="campo">
                    <label>Nombre</label>
                    <input id="tarea" type="text" placeholder="${editar ? 'Editar Tarea' : 'Crea Nueva Tarea'}" name="tarea" value="${tarea.nombre ? tarea.nombre : ''}">
                </div>
                <div class="opciones">
                    <input type="submit" class="submit-nueva-tarea" value="${editar ? 'Editar Tarea' : 'Crear Tarea'}"/>
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>`
        ;
        setTimeout(() => {
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar');
        }, 200);
        modal.addEventListener('click', function(e){
            e.preventDefault();
            if(e.target.classList.contains('cerrar-modal')){
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove(modal);
                }, 200);
            }
            if(e.target.classList.contains('submit-nueva-tarea')){
                const nombreTarea = document.querySelector('#tarea').value.trim();
                if(nombreTarea === ''){
                    mostrarAlerta('El nombre de la tarea es Obligatorio', 'error', document.querySelector('.formulario .campo'));
                    return;
                }
                if(!editar){
                    agregarTarea(nombreTarea);
                } else {
                    tarea.nombre = nombreTarea;
                    actualizarTarea(tarea);
                }
            }
        });
        document.querySelector('.dashboard').appendChild(modal);
    }
    function mostrarAlerta(mensaje, tipo, referencia){
        if(document.querySelector('.alerta')) return;
        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;
        referencia.parentElement.insertBefore(alerta, referencia);
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }
    async function agregarTarea(tarea){
        const datos = new FormData();
        datos.append('nombre', tarea);
        datos.append('proyectoId', obtenerProyecto());
        try {
            const url = 'http://localhost:3000/api/tarea';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();
            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.formulario .campo'));
            if(resultado.tipo === 'exito'){
                const modal = document.querySelector('.modal');
                setTimeout(() => {
                    modal.remove();
                    const tareaObj = {
                        id: String(resultado.id),
                        nombre: tarea,
                        estado: "0",
                        proyectoId: resultado.proyectoId
                    }
                    tareas = [...tareas, tareaObj];
                    mostrarTareas();
                }, 3000);
            }
        } catch (error) {
            console.log(error.value);
        }
    }
    function cambiarEstadoTarea(tarea){
        const nuevoEstado = tarea.estado === "1" ? "0" : "1";
        tarea.estado = nuevoEstado;
        actualizarTarea(tarea);
    }
    async function actualizarTarea(tarea){
        const datos = new FormData();
        datos.append('id', tarea.id);
        datos.append('nombre', tarea.nombre);
        datos.append('estado', tarea.estado);
        datos.append('proyectoId', obtenerProyecto());
        try {
            const url = 'http://localhost:3000/api/tarea/actualizar';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();
            if(resultado.tipo === 'exito'){
                const modal = document.querySelector('.modal');
                if(modal){
                    Swal.fire(
                        resultado.mensaje,
                        'UpTask',
                        'success'
                    );
                    modal.remove();
                }
                tareas = tareas.map(tareaMemoria => {
                    if(tareaMemoria.id === tarea.id){
                        tareaMemoria.estado = tarea.estado;
                        tareaMemoria.nombre = tarea.nombre;
                    }
                filtradas = filtradas.filter(filtrada => filtrada.id !== tarea.id);
                    return tareaMemoria;
                });
                mostrarTareas();
            }
        } catch (error) {
            console.log(error.value);
        }
    }
    function confirmarEliminarTarea(tarea){
        Swal.fire({
            title: 'Seguro que quieres Eliminar esta Tarea?',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.isConfirmed) {
                eliminarTarea(tarea);
            }
          })
    }
    async function eliminarTarea(tarea){
        const datos = new FormData();
        datos.append('id', tarea.id);
        datos.append('proyectoId', obtenerProyecto());
        try {
            const url = 'http://localhost:3000/api/tarea/eliminar';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();
            if(resultado.tipo === 'exito'){
                tareas = tareas.filter(tareaMemoria => tareaMemoria.id !== tarea.id);
                mostrarTareas();
            }
        } catch (error) {
            console.log(error.value);
        }
    }
    function obtenerProyecto(){
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());
        return proyecto.id;
    }
    function limpiarTareas(){
        const listado = document.querySelector('#listado-tareas');
        while(listado.firstChild){
            listado.removeChild(listado.firstChild);
        }
    }
})();
