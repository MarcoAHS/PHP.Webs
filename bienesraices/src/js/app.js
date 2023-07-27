document.addEventListener('DOMContentLoaded', function(){
    eventListeners();
    darkMode();
});
function eventListeners(){
    const mobile = document.querySelector('.mobile-menu');
    mobile.addEventListener('click', navegacionResponsive);
}
function darkMode(){
    const preference = window.matchMedia('(prefers-color-scheme: dark)');
    if(preference.matches){
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }
    preference.addEventListener('change', function(){
        if(preference.matches){
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        }
    });
    const dark = document.querySelector('.dark');
    dark.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    })
}
function navegacionResponsive(){
    const nav = document.querySelector('.navegacion');
    if(nav.classList.contains('nav-visible')){
        nav.classList.remove('nav-visible');
    }else{
        nav.classList.add('nav-visible');
    }
}