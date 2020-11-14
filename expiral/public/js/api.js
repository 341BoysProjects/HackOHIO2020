/**
 * JavaScript API Interface to Interact with Backend API
 */

const base_url = 'http://ec2-18-188-72-25.us-east-2.compute.amazonaws.com';

function login(email, password) {
    const userAction = async () => {
        const response = await fetch(base_url + '/api/login', {
            method: 'POST',
            body: JSON.stringify({ email: email, password: password, password_confirmation: password }), // string or object
            headers: {
                'Content-Type': 'application/json'
            }
        });
        const myJson = await response.json(); //extract JSON from the http response
        // do something with myJson
        console.log(response);
        console.log(myJson);
    }
}