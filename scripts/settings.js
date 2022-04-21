const avatarParts = document.querySelectorAll('#avatar>div');
const hair = avatarParts[0];
const face = avatarParts[1];
const eyes = avatarParts[2];
const nose = avatarParts[3];
const mouth = avatarParts[4];
const chest = avatarParts[5];
const detail = avatarParts[6]

function changeAvatar(part, next) {
    let currentPartIndex;
    switch(part) {
        case('hair'):
            currentPartIndex = parseInt(hair.id[hair.id.length - 1]);
            if(next){
                hair.id = 'hair' + (currentPartIndex < 3 ? (currentPartIndex + 1) : '1');
            } else {
                hair.id = 'hair' + (currentPartIndex > 1 ? (currentPartIndex - 1) : '3');
            }
            break;
        case('face'):
            currentPartIndex = parseInt(face.id[face.id.length - 1]);
            if(next){
                face.id = 'face' + (currentPartIndex < 3 ? (currentPartIndex + 1) : '1');
            } else {
                face.id = 'face' + (currentPartIndex > 1 ? (currentPartIndex - 1) : '3');
            }
            break;
        case('eyes'):
            currentPartIndex = parseInt(eyes.id[eyes.id.length - 1]);
            if(next){
                eyes.id = 'eyes' + (currentPartIndex < 3 ? (currentPartIndex + 1) : '1');
            } else {
                eyes.id = 'eyes' + (currentPartIndex > 1 ? (currentPartIndex - 1) : '3');
            }
            break;
        case('nose'):
            currentPartIndex = parseInt(nose.id[nose.id.length - 1]);
            if(next){
                nose.id = 'nose' + (currentPartIndex < 3 ? (currentPartIndex + 1) : '1');
            } else {
                nose.id = 'nose' + (currentPartIndex > 1 ? (currentPartIndex - 1) : '3');
            }
            break;
        case('mouth'):
            currentPartIndex = parseInt(mouth.id[mouth.id.length - 1]);
            if(next){
                mouth.id = 'mouth' + (currentPartIndex < 3 ? (currentPartIndex + 1) : '1');
            } else {
                mouth.id = 'mouth' + (currentPartIndex > 1 ? (currentPartIndex - 1) : '3');
            }
            break;
        case('chest'):
            currentPartIndex = parseInt(chest.id[chest.id.length - 1]);
            if(next){
                chest.id = 'chest' + (currentPartIndex < 3 ? (currentPartIndex + 1) : '1');
            } else {
                chest.id = 'chest' + (currentPartIndex > 1 ? (currentPartIndex - 1) : '3');
            }
            break;
        case('detail'):
            currentPartIndex = parseInt(detail.id[detail.id.length - 1]);
            if(next){
                detail.id = 'detail' + (currentPartIndex < 3 ? (currentPartIndex + 1) : '1');
            } else {
                detail.id = 'detail' + (currentPartIndex > 1 ? (currentPartIndex - 1) : '3');
            }
            break;
    }
}
