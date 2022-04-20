document.getElementById('sort-button').addEventListener('click', function(){
    document.getElementById('sort').classList.toggle('pouf');
})



let selectedFilter ;
let column_name ;

function sort(element){
    
    let selectedSort = element.id ;
    console.log(selectedSort);

    const request = new XMLHttpRequest();
  
    request.open('post', 'includes/add_filters.php');

    request.onreadystatechange = function(){

        if ( request.readyState == 4){

            //step 1: delete what is previously done
            purgeSectionPro();
            
            //step2: display new elements
            displayFilteredResults(request.responseText);
        } 

}
request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
request.send('sort=' + selectedSort);

}

//Filter the service providers : 

function filter(element){

    selectedFilter = element.innerText;
    console.log(selectedFilter)
   
    column_name = (element.parentNode).classList[0]

    console.log(column_name)
    const request = new XMLHttpRequest();
  

    request.open('post', 'includes/add_filters.php');

    request.onreadystatechange = function(){

        if ( request.readyState == 4){

            //step 1: delete what is previously done
            purgeSectionPro();
            
            //step2: display new elements
            displayFilteredResults(request.responseText);
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

function displayFilteredResults(divs){
    section = document.getElementById("all-presta");
    console.log(divs)
    section.innerHTML = divs ;
}

