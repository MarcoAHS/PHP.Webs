const datos = {
    nombre: '',
    email: '',
    mensaje: ''
}
//querySelector, querySelectorAll, getElementById
const heading = document.querySelector('.header__texto h2'); //0 o 1 elementos
heading.textContent = 'Nuevo Heading';

const enlaces = document.querySelectorAll('.navegacion a');
// enlaces[0].href = 'http://twitter.com';
const nuevoEnlace = document.createElement('A');
nuevoEnlace.href = 'nuevo-enlace.html'; 
nuevoEnlace.textContent = 'Secreto';
nuevoEnlace.classList.add('navegacion__enlace');
console.log(nuevoEnlace);

const navegacion = document.querySelector('.navegacion');
navegacion.appendChild(nuevoEnlace);
//Eventos
window.addEventListener('load', function() { //load espera a que el Js y los archivos que dependen del HTML esten listos
    console.log(1);
});
document.addEventListener('DOMContentLoaded', function() {//DOMContentLoaded espera solo al HTML, no al CSS ni imagenes, por eso DOMContentLoade => load
    console.log(2);
});

const nombre = document.querySelector('#nombre');
const email = document.querySelector('#email');
const mensaje = document.querySelector('#mensaje');
nombre.addEventListener('input', leerTexto);
email.addEventListener('input', leerTexto);
mensaje.addEventListener('input', leerTexto);
//Evento
const formulario = document.querySelector('.formulario');
formulario.addEventListener('submit', function(evento) {
    evento.preventDefault();
    //Validar Formulario
    const {nombre, email, mensaje} = datos;
    if(nombre === '' || email === '' || mensaje === ''){
        mostrarAlerta('Todos Los Campos son Obligatorios', true);
    }else { 
        mostrarAlerta('Formulario Enviado');
    }
});

function leerTexto(e) {
    datos[e.target.id] = e.target.value;
}
function mostrarAlerta(a, b = null) {
    const alerta = document.createElement('P');
    alerta.textContent = a;
    if(b){
        alerta.classList.add('error');
    }else {
        alerta.classList.add('succes');
    }
    formulario.appendChild(alerta);
    setTimeout(() => {
        alerta.remove();
    }, 3000);
}