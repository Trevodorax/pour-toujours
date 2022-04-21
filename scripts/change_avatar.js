const avatarParts = document.querySelectorAll('#avatar>div');
const hair = avatarParts[0];
const face = avatarParts[1];
const eyes = avatarParts[2];
const nose = avatarParts[3];
const mouth = avatarParts[4];
const chest = avatarParts[5];
const detail = avatarParts[6]

function changeAvatar(arrow, part, next) {
    // get the element focused by the arrow
    partElement = document.getElementsByClassName(arrow.getAttribute('for'))[0];

    // get the current number of the avatar element used
    let currentPartIndex = parseInt(partElement.id[partElement.id.length - 1]);

    // increase or descrease it while checking the value isn't out of bounds
    if(next){
        partElement.id = part + (currentPartIndex < 3 ? (currentPartIndex + 1) : '1');
    } else {
        partElement.id = part + (currentPartIndex > 1 ? (currentPartIndex - 1) : '3');
    }
}
