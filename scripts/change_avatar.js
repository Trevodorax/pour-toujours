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

function saveAvatar(){
    // get all the avatar indexes
    const avatarParts = document.querySelectorAll('#avatar>div');
    let avatarSpecs = "";
    avatarParts.forEach(part => {
        avatarSpecs += part.id[part.id.length - 1];
    })

    const request = new XMLHttpRequest();
    request.open('post', 'includes/change_avatar.php');

    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("newAvatar=" + avatarSpecs);
}
