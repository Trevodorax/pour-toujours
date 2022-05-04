function addToFav(element, id_presta, id_customer){
    console.log(element, id_customer, id_presta)
    //DO MAGIC AJAX : 
    const request = new XMLHttpRequest();
  
    request.open('POST', 'add_a_fav.php');

    request.onreadystatechange = function(){

        if ( request.readyState == 4){

            console.log(request.responseText);
            changePicto(element);
        } 
    }

    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    data = "pro=" + id_presta + "&customer=" + id_customer;
    request.send(data);

}

function changePicto(element){
    //Change the picto to show it's been added to the fav

      if (element.src.match("images/heart_picto.svg")) {        
          element.src = "images/heart_picto_full.svg";

      } else {
          element.src = "images/heart_picto.svg";

      }
  
}