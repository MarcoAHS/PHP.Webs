document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});
function iniciarApp(){
    crearGaleria();
}
function crearGaleria(){
    const galeria = document.querySelector('.album-imagenes');
    for(let i = 1; i<=8; i++){
        const imagen = document.createElement('picture');
        imagen.innerHTML = `
        <img loading="lazy" width= "200" height="300" src="src/img/${i}.jpg" alt="Imagen ${i}">`;
        galeria.appendChild(imagen);    
    }
}
