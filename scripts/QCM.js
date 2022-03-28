let forms = document.getElementsByClassName('form-question');
forms[0].classList.add('active');

function change_form(index, next){
    index -= 1;

    if(next){
        forms[index].classList.remove('active');
        forms[index + 1].classList.add('active');
    }else{
        forms[index].classList.remove('active');
        forms[index - 1].classList.add('active');
    }
}
