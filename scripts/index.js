document.getElementById('mobile-header').firstElementChild.addEventListener('click', menu_appear);

function menu_appear(){
    document.querySelector('main').classList.toggle('pouf');
    document.querySelector('footer').classList.toggle('pouf');

    document.getElementById('burger-menu').classList.toggle('pouf');

    //Changing icon when we open the burger menu
    document.getElementById('icon-burger-menu').classList.toggle('icon-burger-on')
}
