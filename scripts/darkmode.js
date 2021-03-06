function darkMode(){

    body = document.body ;
    logo = document.getElementById('logo_text') ;

    //changing colors
    body.classList.toggle('darkmode') ;

    //changing button image
    image = document.getElementById('mode');

    if (image.src.match("images/button_dark_mode.svg")) {
        
        image.src = "images/button_light_mode.svg";
        //creating the darkmode cookie to keep the darkmode on the whole website
        document.cookie = "theme=darkmode"
      

    }
    else {
        image.src = "images/button_dark_mode.svg";
        document.cookie =  "theme=lightmode";
       
        //deleting the cookie if we are on light mode
    }

    if (body.classList[0] == "darkmode"){
        logo.src = "images/easter_text_logo.svg";
    } else {
        logo.src = "images/text_logo.svg";
    }
   
  
}