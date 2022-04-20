// make appear and disappear pros and users on form click

const userRows = document.querySelectorAll('.user-row');
const proRows = document.querySelectorAll('.pro-row');

function changeUserType(form){
    if(form.value == "users"){
        userRows.forEach(function(row){
            row.classList.remove('pouf');
        })
        proRows.forEach(function(row){
            row.classList.add('pouf');
        })
    }else if(form.value == "prestas"){
        userRows.forEach(function(row){
            row.classList.add('pouf');
        })
        proRows.forEach(function(row){
            row.classList.remove('pouf');
        })
    }else{
        userRows.forEach(function(row){
            row.classList.remove('pouf');
        })
        proRows.forEach(function(row){
            row.classList.remove('pouf');
        })
    }
}


// search bar functionnality
function searchPersonne(){

    const searchedText = document.getElementById('searchedText').value;


    const request = new XMLHttpRequest();
    request.open('post', '../includes/search_personne.php');

    request.onreadystatechange = function(){

        if ( request.readyState == 4){

            // display the found persons on top of table
            console.log(request.responseText)
            writeRows(JSON.parse(request.responseText));
        }

    }

    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("searchedText=" + searchedText);

    return false;
}

function writeRows(rows){
    console.log(rows);
}