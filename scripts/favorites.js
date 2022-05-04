
function changePicto(element, id_presta, id_customer){
    //Change the picto to show it's been added to the fav
        // element.classList.toggle("favorites-off");


      if (element.src.match("images/heart_picto.svg")) {        
           element.src = "images/heart_picto_full.svg";

          //add the favori
            actOnFav(element, id_presta, id_customer,"add");
       

      } else {
           element.src = "images/heart_picto.svg";

          //delete the favori
          actOnFav(element, id_presta, id_customer,"delete");
      }
  
}


function actOnFav(element, id_presta, id_customer,action){
    console.log(element, id_customer, id_presta, action);

    const request = new XMLHttpRequest();
  
    request.open('POST', 'actions_on_favori.php');

    request.onreadystatechange = function(){

        if ( request.readyState == 4){
            console.log(request.responseText);
        } 
    }

    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    data = "pro=" + id_presta + "&customer=" + id_customer + "&action=" + action;
    request.send(data);

}
