/* ----- SWITCH BETWEEN USER AND PRO PAGE ----- */

// getting required elements
const pro_elements = document.querySelectorAll('.pro-form');
const user_elements = document.querySelectorAll('.user-form');
const pro_checkbox = document.getElementById('pro-checkbox');

// check the pro checkbox every 200ms
setInterval(pro_form_check, 200);

// right elements disappear at the beginning (doesn't work yet)
// get user or pro parameter
const url = new URL(window.location.href);
const pov = url.searchParams.get('pov');

if(pov = "user"){
    pro_elements.forEach(x => x.classList.toggle('pouf'));
}else{
    user_elements.forEach(x => x.classList.toggle('pouf'));
    pro_checkbox.checked = ! pro_checkbox.checked;
}




// this function switched the disappearing and appearing elements
function switch_forms(){
    pro_checkbox.checked = ! pro_checkbox.checked;
}


function pro_form_check(){
    console.log("caught");
    if(pro_checkbox.checked){
        pro_elements.forEach(x => x.classList.remove('pouf'));
        user_elements.forEach(x => x.classList.add('pouf'));
    }else{
        pro_elements.forEach(x => x.classList.add('pouf'));
        user_elements.forEach(x => x.classList.remove('pouf'));
    }
}



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
