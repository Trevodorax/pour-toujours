function addToFav(){

    


}

function changePicto(element){
    //Change the picto to show it's been added to the fav

      if (element.src.match("images/heart_picto.svg")) {        
          element.src = "images/heart_picto_full.svg";

      } else {
          element.src = "images/heart_picto.svg";

      }
  
}