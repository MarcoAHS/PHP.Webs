import Swal from 'sweetalert2';
(function (){
    let eventos = [];
    const resumen = document.querySelector('#registro-resumen');
    if(resumen){
        const eventosBoton = document.querySelectorAll('.evento__agregar');
        eventosBoton.forEach(boton => boton.addEventListener('click', seleccionarEvento));
        const formularioRegistro = document.querySelector('#registro');
        formularioRegistro.addEventListener('submit', submitFormulario);
        mostrarEventos();
        function seleccionarEvento(e){
            if(eventos.length < 5){
                eventos = [...eventos, {
                    id: e.target.dataset.id,
                    titulo: e.target.parentElement.querySelector('.evento__nombre').textContent.trim()
                }];
                e.target.disabled = true;
                mostrarEventos();
            } else{
                Swal.fire({
                    title: 'Error',
                    text: 'Maximo 5 Eventos',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
        function mostrarEventos(){
            limpiarEventos();
            if(eventos.length > 0){
                eventos.forEach(evento => {
                    const eventoDOM = document.createElement('DIV');
                    eventoDOM.classList.add('registro__evento');
                    const titulo = document.createElement('H3');
                    titulo.classList.add('registro__nombre');
                    titulo.textContent = evento.titulo;
                    const botonE = document.createElement('BUTTON');
                    botonE.classList.add('registro__eliminar');
                    botonE.innerHTML = `<i class="fa-solid fa-trash"></i>`;
                    botonE.onclick = function(){
                        eliminarEvento(evento.id);
                    }
                    eventoDOM.appendChild(titulo);
                    eventoDOM.appendChild(botonE);
                    resumen.appendChild(eventoDOM);
                });
            } else{
                const noRegistro = document.createElement('P');
                noRegistro.textContent = 'No hay eventos, agregar hasta 5 del lado izquierdo';
                noRegistro.classList.add('registro__texto');
                resumen.appendChild(noRegistro);
            }
        }
        function eliminarEvento(id){
            eventos = eventos.filter(evento => evento.id !== id);
            const botonAgregar = document.querySelector(`[data-id="${id}"]`);
            botonAgregar.disabled = false;
            mostrarEventos();
        }
        function limpiarEventos(){
            while(resumen.firstChild){
                resumen.removeChild(resumen.firstChild);
            }
        }
        async function submitFormulario(e){
            e.preventDefault();
            const regaloId = document.querySelector('#regalo').value;
            const eventosId = eventos.map(evento => evento.id);
            if(eventosId.length === 0 || regaloId === ''){
                Swal.fire({
                    title: 'Error',
                    text: 'Escoge almenos una Conferencia o el Regalo de tu agrado',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } else{
                const datos = new FormData();
                datos.append('eventos', eventosId);
                datos.append('regalo_id', regaloId);
                const url = '/finalizar-registro/conferencias';
                const respuesta = await fetch(url, {
                    method: 'POST',
                    body: datos
                });
                const resultado = await respuesta.json();
                if(resultado.resultado){
                    Swal.fire({
                        title: 'Registro Exitoso',
                        text: 'Se genero correctamente tu Registro, te Esperamos en DevWebCamp!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then( () => location.href = `/boleto?id=${resultado.token}`);
                } else{
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo en Error al completar tu Registro',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then( () => location.reload);
                }
            }
        }
    }
})();