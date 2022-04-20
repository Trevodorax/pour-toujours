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
    }else{
        userRows.forEach(function(row){
            row.classList.add('pouf');
        })
        proRows.forEach(function(row){
            row.classList.remove('pouf');
        })
    }
}