// Forms appear on click 

form_section = document.getElementsByClassName("add");
opener = document.getElementsByClassName("title");
// form_section.forEach(function (element){
//     element.addEventListener('click', function(){
//         element.classList.toggle('open-section');
//     }
//     )}
// )
console.log(opener);

for(let i=0;i<opener.length;i++){
    opener[i].addEventListener('click', function(){
        form_section[i].classList.toggle('open-section')
    })
}

