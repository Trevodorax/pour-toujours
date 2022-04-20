// write all users when page is loaded
searchPersonne();



// make appear and disappear pros and users on form click
function changeUserType(form){
    const userRows = document.querySelectorAll('.user-row');
    const proRows = document.querySelectorAll('.pro-row');
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

            // insert the found persons on top of table
            writeRows(JSON.parse(request.responseText));
        }

    }

    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("searchedText=" + searchedText);

    return false;
}

function writeRows(rows){
    const usersTable = document.getElementById('usersTable');
    usersTable.innerHTML = '';
    for(const row in rows) {
        addRow(usersTable, rows[row]);
    }
}

function addRow(table, rowInformation){
    console.log(rowInformation);
    // creating row with right classes
    const newRow = document.createElement('tr');
    if(rowInformation.estAdmin == 1) {
        newRow.classList.add('admin-row');
    }
    newRow.classList.add(rowInformation.estPro ? 'pro-row' : 'user-row');

    // creating "nom" column
    const nom = document.createElement('td');
    nom.innerHTML = rowInformation.nomComplet;

    // creating "rôle" column
    const role = document.createElement('td');
    role.innerHTML = rowInformation.estPro ? 'Prestataire' : 'Utilisateur';

    // creating "modifier" column
    const modifier = document.createElement('td');
    modifier.innerHTML = "<a href='consult.php?id=" + rowInformation.id + "'><img src='../images/pen_picto.svg'></a>"

    // creating "supprimer" column
    const supprimer = document.createElement('td');
    supprimer.innerHTML = "<a href='delete.php?id=" + rowInformation.id + "'><img src='../images/go_icon.svg'></a>"

    // inserting columns in row
    newRow.appendChild(nom);
    newRow.appendChild(role);
    newRow.appendChild(modifier);
    newRow.appendChild(supprimer);

    // inserting row in table
    table.appendChild(newRow);
}
