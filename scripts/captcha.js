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
        alert('captcha achieved');
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
