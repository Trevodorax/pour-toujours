function darkMode(){
    console.log("ok");
    body = document.body ;

    //changing colors
    body.classList.toggle('darkmode') ;

    //changing button image
    image = document.getElementById('mode');

    if (image.src.match("images/button_dark_mode.svg")) {
        image.src = "images/button_light_mode.svg";
    }
    else {
        image.src = "images/button_dark_mode.svg";
    }

}