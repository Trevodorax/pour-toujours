/* ----- SWITCH BETWEEN USER AND PRO PAGE ----- */

// getting required elements
const pro_elements = document.querySelectorAll('.pro-form');
const user_elements = document.querySelectorAll('.user-form');
const pro_checkbox = document.getElementById('pro-checkbox');

// variable used to know if captcha is currently done
let captcha_achieved = false;

// check the pro checkbox every 200ms
setInterval(pro_form_check, 200);

// right elements disappear at the beginning (doesn't work yet)
// get user or pro parameter
const url = new URL(window.location.href);
const pov = url.searchParams.get('pov');

if(pov == 1){
    user_elements.forEach(x => x.classList.toggle('pouf'));
    pro_checkbox.checked = true;
}else{
    pro_elements.forEach(x => x.classList.toggle('pouf'));
}

// this function switched the disappearing and appearing elements
function switch_forms(){
    pro_checkbox.checked = ! pro_checkbox.checked;
}


function pro_form_check(){
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

    // verifying captcha{
    if(! captcha_achieved){
        all_set = false;
    }

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


/* ----- CAPTCHA FUNCTIONNALITY ----- */
let previous_pick = null;
let captcha_cases = document.querySelectorAll('#captcha img');

mix_captcha();

captcha_cases.forEach(element => {
    element.addEventListener('click', function(){
        captcha_clicked(element);
    });
});

function captcha_clicked(pick){

    if(previous_pick == null){
        pick.style.opacity = 0.8;
        previous_pick = pick;
        return;
    }

    let temp_id = previous_pick.id;
    previous_pick.id = pick.id;
    pick.id = temp_id;

    previous_pick.style.opacity = 1;
    previous_pick = null;

    if(check_win()){
         captcha_achieved = true;
        document.getElementById('captcha').style.display = 'none';
    }

}

function check_win(){

    for(let i = 1; i < 10; i++){
        let case_index = captcha_cases[i - 1].id.charAt(captcha_cases[i - 1].id.length - 1);
        if(case_index != i){
            return false;
        }
    }

    return true;
}

function mix_captcha(){
    let random_positions = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];
    for(i = 0; i < 20; i++){
        // 2 random indexes
        from = Math.floor(Math.random() * 9);
        to = Math.floor(Math.random() * 9);

        // swapping elements at these indexes
        temp = random_positions[from];
        random_positions[from] = random_positions[to];
        random_positions[to] = temp;
    }

    for(let i = 0; i < 9; i++){
        captcha_cases[i].id = 'captcha' + random_positions[i];
    }
}
