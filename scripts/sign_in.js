// button becomes red when form is ready
const required_inputs = document.querySelectorAll('.required-input');

setInterval(checkbox_verify, 500);

function checkbox_verify(){
    let all_set = true;

    //verifying text inputs
    required_inputs.forEach(function(input){
        if(input.value == ""){
            all_set = false;
        }
    })
    
    // performing document modifications
    form_ready(all_set);
}

// function performs document modifications accordingly
function form_ready(all_set){
    const button = document.getElementById('validate-button');
    if(all_set){
        button.style.backgroundColor = '#CF697B';
        button.classList.remove('no-click');
    }else{
        button.style.backgroundColor = '#bbbbbb';
        button.classList.add('no-click');
    }
}