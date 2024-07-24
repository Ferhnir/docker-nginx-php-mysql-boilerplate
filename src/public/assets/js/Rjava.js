document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    var name = document.getElementById('name').value;
    var surname = document.getElementById('surname').value;
    var birthdate = document.getElementById('birthdate').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var Username = document.getElementById('Username').value;
    var message = document.getElementById('message');

    if (!name || !surname || !birthdate || !email || !password) {
        message.textContent = "Please fill out all fields.";
        message.style.color = "red";
    } else if (!validateEmail(email)) {
        message.textContent = "Please enter a valid email address.";
        message.style.color = "red";
    } else {
        message.textContent = "Registration successful!";
        message.style.color = "green";
    }
});

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);