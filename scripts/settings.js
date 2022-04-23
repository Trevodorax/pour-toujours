// PROFILE INFORMATIONS MODIFICATIONS 

// Opening section

form_section = document.getElementsByClassName("changing-forms");
opener = document.getElementById("title");

console.log(opener);
opener.addEventListener('click', function(){
    console.log("OK")
    form_section[0].classList.toggle('open-section')
})