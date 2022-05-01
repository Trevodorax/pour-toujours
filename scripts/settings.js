// PROFILE INFORMATIONS MODIFICATIONS 

// Opening section

form_section = document.getElementsByClassName("changing-forms");
opener = document.getElementById("title");

console.log(opener);
opener.addEventListener('click', function(){
    form_section[0].classList.toggle('open-section');
})



//We are not allowing the user to delete their account unless they REALLY want it 
let clicks = 0 ;

function deleteAccount(){
    clicks ++ ;
    console.log(clicks);
    if (clicks < 5){
    alert("Oh-ho, vous voulez supprimer votre compte ? Impossible. Vous allez vous marier et être heureux, d'accord ?");
    } else {

    //Message to warn user about the deletion
    alert("Bon, vous avez l'air d'y tenir, votre compte va être supprimé...");

    //Ajax to delete account


    }  

}