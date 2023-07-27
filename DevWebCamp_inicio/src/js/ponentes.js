(function(){
    const ponentesInput = document.querySelector('#ponentes');
    if(ponentesInput){
        let ponentes = [];
        let ponentesFiltrados = [];
        const listadoPonentes = document.querySelector('#listado-ponentes');
        const ponenteHidden = document.querySelector('[name="ponente_id"]');
        obtenerPonentes();
        ponentesInput.addEventListener('input', buscarPonentes);
        if(ponenteHidden.value){
            (async () => {
                const ponente = await obtenerPonente(ponenteHidden.value);
                const ponenteDOM = document.createElement('LI');
                ponenteDOM.classList.add('listado-ponentes__ponente', 'listado-ponentes__ponente--seleccionado');
                ponenteDOM.textContent = `${ponente.nombre} ${ponente.apellido}`;
                listadoPonentes.appendChild(ponenteDOM);
            })();
        }
        async function obtenerPonentes(){
            const url = `/api/ponentes`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            formatearPonentes(resultado);
        }
        async function obtenerPonente(id){
            const url = `/api/ponente?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            return resultado;
        }
        function formatearPonentes(arrayPonentes = []){
            ponentes = arrayPonentes.map( ponente => {
                return {
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id
                }
            });
        }
        function buscarPonentes(e){
            const busqueda = e.target.value;
            if(busqueda.length > 3){
                const exprecion = new RegExp(busqueda, "i");
                ponentesFiltrados = ponentes.filter( ponente => {
                    if(ponente.nombre.toLowerCase().search(exprecion) != -1){
                        return ponente;
                    }
                });
            } else{
                ponentesFiltrados = [];
            }
            mostrarPonentes();
        }
        function mostrarPonentes(){
            while(listadoPonentes.firstChild){
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }
            if(ponentesFiltrados.length > 0){
                ponentesFiltrados.forEach(ponente =>{
                    const HTML = document.createElement('LI');
                    HTML.classList.add('listado-ponentes__ponente');
                    HTML.textContent = ponente.nombre;
                    HTML.dataset.ponenteId = ponente.id;
                    HTML.onclick = seleccionarPonente;
                    listadoPonentes.appendChild(HTML);
                });
            } else {
                const HTML = document.createElement('P');
                HTML.classList.add('listado-ponentes__no');
                HTML.textContent = 'No hay Resultados';
                listadoPonentes.appendChild(HTML);
            }
        }
        function seleccionarPonente(e){
            const ponente = e.target;
            const ponentePrevio = document.querySelector('.listado-ponentes__ponente--seleccionado');
            if(ponentePrevio){
                ponentePrevio.classList.remove('listado-ponentes__ponente--seleccionado');
            }
            ponente.classList.add('listado-ponentes__ponente--seleccionado');
            ponenteHidden.value = ponente.dataset.ponenteId;
            document.querySelector('#ponentes').value = ponente.textContent;
        }
    }
})();