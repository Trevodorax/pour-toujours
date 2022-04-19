document.getElementById('sort-button').addEventListener('click', function(){
    document.getElementById('sort').classList.toggle('pouf');
})





let selectedFilter ;
let column_name ;

function filter(element){

    selectedFilter = element.innerHTML;
    column_name = (element.parentNode).classList[0]

    const request = new XMLHttpRequest();
  

    request.open('post', 'includes/add_filters.php');

    request.onreadystatechange = function(){

        if ( request.readyState == 4){

            purgeSectionPro();
            displayFilteredResults();
                    
        } 
}

$data = 'column_name=' + column_name + '&content=' + selectedFilter ;
request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
request.send($data);
}

function purgeSectionPro(){
    toDelete = document.querySelectorAll(".presta-card") 

    for (let div of toDelete) {    
        div.remove() ;
    }
}

function displayFilteredResults(){
    section = document.getElementById("all-presta")
    section.innerHTML = "<?php include('includes/add_filters.php'); ?>"
}
