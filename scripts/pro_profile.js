// Forms appear on click 

form_section = document.getElementsByClassName("add");
opener = document.getElementsByClassName("title");

console.log(opener);

for(let i=0;i<opener.length;i++){
    opener[i].addEventListener('click', function(){
        form_section[i].classList.toggle('open-section')
    })
}


function deleteInfos(element, type, id_service, id_presta){

    const request = new XMLHttpRequest();
    request.open('GET', 'delete_services.php?column=' + type +'&id_service=' + id_service + '&id_presta=' + id_presta);

    request.onreadystatechange = function(){

        if ( request.readyState == 4){
            console.log(request.responseText);
            removeThing(element);
        } 
    }
request.send();
}

function removeThing(button){

    button.parentNode.remove();

  
}
