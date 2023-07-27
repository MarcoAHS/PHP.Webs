(function(){
    const horas = document.querySelector('#horas');
    if(horas){
        const categoria = document.querySelector('[name="categoria_id"]');
        const dias = document.querySelectorAll('[name="dia"]');
        const hiddenDia = document.querySelector('[name="dia_id"]');
        const hiddenHora = document.querySelector('[name="hora_id"]');
        categoria.addEventListener('change', terminoBusqueda);
        dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));
        let busqueda = {
            categoria_id: +categoria.value || '',
            dia: +hiddenDia.value || ''
        }
        if(!Object.values(busqueda).includes('')){
            (async () => {
                await buscarEventos();
                const horaSeleccionada = document.querySelector(`[data-hora-id="${hiddenHora.value}"]`);
                horaSeleccionada.classList.remove('horas__hora--des');
                horaSeleccionada.classList.add('horas__hora--sel');
            })();
        }
        function terminoBusqueda(e){
            busqueda[e.target.name] = e.target.value;
            hiddenHora.value = '';
            hiddenDia.value = '';
            const seleccionada = document.querySelector('.horas__hora--sel');
            if(seleccionada){
                seleccionada.classList.remove('horas__hora--sel');
            }
            if(Object.values(busqueda).includes('')){
                return;
            }
            buscarEventos();
        }
        async function buscarEventos(){
            const url = `/api/eventos-horario?dia_id=${busqueda.dia}&categoria_id=${busqueda.categoria_id}`;
            const resultado = await fetch(url);
            const eventos = await resultado.json();
            obtenerHorasDisponibles(eventos);
        }
        function obtenerHorasDisponibles(eventos){
            //Reiniciar Horas
            const listadoHoras = document.querySelectorAll('#horas li');
            listadoHoras.forEach(li => li.classList.add('horas__hora--des'));

            const horasTomadas = eventos.map(evento => evento.hora_id);
            const listadoHorasArray = Array.from(listadoHoras);
            const resultado = listadoHorasArray.filter( li => !horasTomadas.includes(li.dataset.horaId));
            resultado.forEach(li => li.classList.remove('horas__hora--des')); 
            const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--des)');
            horasDisponibles.forEach( hora => hora.addEventListener('click', seleccionarHora));
        }
        function seleccionarHora(e){
            hiddenHora.value = e.target.dataset.horaId;
            hiddenDia.value = document.querySelector('[name="dia"]:checked').value;
            const seleccionada = document.querySelector('.horas__hora--sel');
            if(seleccionada){
                seleccionada.classList.remove('horas__hora--sel');
            }
            e.target.classList.add('horas__hora--sel');
        }
    }
})();