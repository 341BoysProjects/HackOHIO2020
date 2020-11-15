/**
 * JavaScript API Interface to Interact with Backend API
 */

//Button Listeners
window.onload = function () {
    document.getElementById("sign-in-button").addEventListener("click", function () {
        var email = document.getElementById('userEmail').value;
        var password = document.getElementById('userPassword').value;
        console.log(email);
        console.log(password);
        login(email, password);
    });
}

const base_url = 'http://ec2-18-188-72-25.us-east-2.compute.amazonaws.com';

function login(email, password) {
    fetch(base_url + '/api/login', {
        method: 'post',
        body: JSON.stringify({ email: email, password: password, password_confirmation: password }), // string or object
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(function (response) {
        return response.json();
    });

    console.log("Im down here");
}