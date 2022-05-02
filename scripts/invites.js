getGuests();

function addGuest() {
    const guest = {
        nomComplet : document.getElementById('nomComplet').value,
        email : document.getElementById('email').value
    };

    insertGuest(guest);
}

function insertGuest(guest) {
    const request = new XMLHttpRequest();

    request.open('POST', 'includes/control_pannel/guestsList/addGuest.php');

    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    const body = [];

    body.push("nomComplet=" + guest.nomComplet);
    body.push("email=" + guest.email);

    request.onreadystatechange = function() {
    if(request.readyState === 4) {
        console.log(request.responseText);
    }
    };

    request.send(body.join('&'));

    setTimeout(getGuests, 500);
}


function getGuests () {
    const request = new XMLHttpRequest();
    request.open('GET', 'includes/control_pannel/guestsList/getGuests.php');
    request.onreadystatechange = function() {
      if(request.readyState === 4) {
          document.getElementById('guestsList').innerHTML = request.responseText;
      }
    };
    request.send();
}

function deleteGuest(id, button) {
    const request = new XMLHttpRequest();

    request.open('GET', 'includes/control_pannel/guestsList/deleteGuest.php?id=' + id);
    request.onreadystatechange = function() {
        if(request.readyState === 4) {
            if(request.responseText === 'success') {
                button.parentNode.parentNode.remove();
            }
        }
    };
    request.send();
}
