const mobileMenuBtn = document.querySelector('#mobile-menu');
const cerrarMenuBtn = document.querySelector('#cerrar-menu');
const sideBar = document.querySelector('.sidebar');
if(mobileMenuBtn){
    mobileMenuBtn.addEventListener('click', function() {
        sideBar.classList.toggle('mostrar');
    });
}
if(cerrarMenuBtn){
    cerrarMenuBtn.addEventListener('click', function(){
        sideBar.classList.add('cerrar');
        setTimeout(() => {
            sideBar.classList.remove('mostrar');
            sideBar.classList.remove('cerrar');
        }, 500);
    });
}
window.addEventListener('resize', function() {
    const anchoPantalla = document.body.clientWidth;
    if(anchoPantalla >= 768){
        sideBar.classList.remove('mostrar');
    }
});