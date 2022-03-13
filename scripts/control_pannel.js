/* ----- MAKE NAV APPEAR AND DISAPPEAR ON MOBILE ----- */
document.getElementById('nav-opener').addEventListener('click', function(){
    document.querySelector('#mobile-control-nav nav').classList.toggle('mobile-nav-disappear');
});

/* animate desktop nav items */
const desktop_nav_items = document.querySelectorAll('#desktop-control-nav a');
desktop_nav_items.forEach(element => {
    if(!element.classList.contains('active-nav-item')){
        element.addEventListener('mouseenter', function(){
            element.classList.add('active-nav-item');
        }, element)

        element.addEventListener('mouseleave', function(){
            element.classList.remove('active-nav-item');
        }, element)
    }
});
