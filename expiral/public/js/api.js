/**
 * JavaScript API Interface to Interact with Backend API
 */

const base_url = 'http://ec2-18-188-72-25.us-east-2.compute.amazonaws.com';

function login(email, password) {
    fetch(base_url + '/api/login', {
        method: 'post',
        body: JSON.stringify({ email: email, password: password, password_confirmation: password }), // string or object
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(function (response) {
        console.log(response.json());
        return response.json();
    });

    // const myJson = await response.json(); //extract JSON from the http response
    // // do something with myJson
    // console.log(response);
    // console.log(myJson);
}