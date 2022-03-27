/* ----- SWITCH BETWEEN USER AND PRO PAGE ----- */

// getting required elements
const pro_elements = document.querySelectorAll('.pro-form');
const user_elements = document.querySelectorAll('.user-form');
const pro_checkbox = document.getElementById('pro-checkbox');

// pro elements disappear at the beginning
pro_elements.forEach(x => x.classList.toggle('pouf'));

// this function switched the disappearing and appearing elements
function switch_forms(toggled_by_checkbox = false){
    pro_elements.forEach(x => x.classList.toggle('pouf'));
    user_elements.forEach(x => x.classList.toggle('pouf'));
    if(!toggled_by_checkbox){
        pro_checkbox.checked = !pro_checkbox.checked;
    }
}

// pro checkbox must toggle the switch_forms function
pro_checkbox.addEventListener('change', switch_forms, true);


/* ----- BUTTON LIGHTS UP WHEN CHECKBOXES CHECKED ----- */

// getting required elements
const required_checkboxes = document.querySelectorAll('.must-check');
const required_inputs = document.querySelectorAll('.required-input');

// checking every 500ms
setInterval(checkbox_verify, 500);

// function checks if form is completed
function checkbox_verify(){
    let all_set = true;

    //verifying text inputs
    required_inputs.forEach(function(input){
        if(input.value == ""){
            all_set = false;
        }
    })

    // verifying required_checkboxes
    required_checkboxes.forEach(function(box){
        if(!box.checked){
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
