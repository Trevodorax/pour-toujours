/* ----- MAKE NAV APPEAR AND DISAPPEAR ON MOBILE ----- */
document.getElementById('nav-opener').addEventListener('click', function(){
    document.querySelector('#mobile-control-nav nav').classList.toggle('mobile-nav-disappear');
});

