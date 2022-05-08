let forms = document.getElementsByClassName('form-question');
forms[0].classList.add('active');

document.onkeydown = function (e) {
    return e.key != 'Enter';
}

function change_form(index, next){
    index -= 1;

    if(index == 9) {
        return;
    }

    if(next){
        forms[index].classList.remove('active');
        forms[index + 1].classList.add('active');
    }else{
        forms[index].classList.remove('active');
        forms[index - 1].classList.add('active');
    }
}

function checkButton(spanElement) {
    const radioButtonParent = spanElement.parentNode;
    const radioButton = radioButtonParent.querySelector('input');
    radioButton.checked = !radioButton.checked;
}