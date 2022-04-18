document.getElementById('sort-button').addEventListener('click', function(){
    document.getElementById('sort').classList.toggle('pouf');
})





let selectedFilter ;
let currentURL = window.location.href ;

function filter(element){

    selectedFilter =element.innerHTML;

    const request = new XMLHttpRequest();
  

    request.open('GET', 'search_pro.php?filter='+ selectedFilter);

    request.onreadystatechange =function(){

        if ( request.readyState == 4){

            console.log(selectedFilter);
            
        
        } 


}
request.send();
}

