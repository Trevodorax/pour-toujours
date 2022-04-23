function changeAvatar(arrow, part, next) {
    // get the element focused by the arrow
    partElement = document.getElementsByClassName(arrow.getAttribute('for'))[0];

    // get the current number of the avatar element used
    const currentPartIndex = parseInt(partElement.id[partElement.id.length - 1]);

    // increase or descrease it while checking the value isn't out of bounds
    const maxIndex = 3;
    if(next){
        partElement.id = part + (currentPartIndex < maxIndex ? (currentPartIndex + 1) : '1');
    } else {
        partElement.id = part + (currentPartIndex > 1 ? (currentPartIndex - 1) : maxIndex);
    }
}

function changeAvatarColor(next) {
    // get the element who's class has to be changed
    const colorElement = document.getElementById('avatar');

    // get the color of this element
    const currentColor = colorElement.classList[0];

    // change the color accordingly
    switch(currentColor) {
        case('blue'):
            colorElement.classList.remove(currentColor);
            colorElement.classList.add('pink');
            break;
        case('pink'):
            colorElement.classList.remove(currentColor);
            colorElement.classList.add('green');
            break;
        case('green'):
            colorElement.classList.remove(currentColor);
            colorElement.classList.add('blue');
            break;
    }
}

function saveAvatar(){
    // get all the avatar elements
    const avatarParts = document.querySelectorAll('#avatar>div');

    // get avatar background color
    const color = document.getElementById('avatar').classList[0];
    const possibleColors = {
        "blue" : 1,
        "pink" : 2,
        "green" : 3
    }
    const colorNumber = possibleColors[color];

    let avatarSpecs = "";

    // add all the face parts to the avatarSpecs
    avatarParts.forEach(part => {
        avatarSpecs += part.id[part.id.length - 1];
    });

    // add the avatar background color at the last index
    avatarSpecs += colorNumber;

    const request = new XMLHttpRequest();
    request.open('post', 'includes/change_avatar.php');

    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("newAvatar=" + avatarSpecs);
}
