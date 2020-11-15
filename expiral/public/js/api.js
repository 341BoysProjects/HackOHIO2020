/**
 * JavaScript API Interface to Interact with Backend API
 */

//Button Listeners
window.onload = function () {
    document.getElementById("sign-in-button").addEventListener("click", function () {
        var email = document.getElementById('userEmail').value;
        var password = document.getElementById('userPassword').value;
        var token = document.getElementById('csrftoken').value;

        login(email, password, token);
    });
}

const base_url = 'http://ec2-18-188-72-25.us-east-2.compute.amazonaws.com';

function login(email, password, token) {
    var bodyData = 'email=' + email + '&password=' + password + '&password_confirmation=' + password;
    fetch(base_url + '/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-url-encoded',
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": token,
        },
        body: bodyData
    })
    .then(response => console.log(response))
    .catch(error => console.log(error));

    console.log("Im down here");
}