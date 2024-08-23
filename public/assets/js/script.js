document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var message = document.getElementById('message');

    if (username === "" || password === "") {
        message.textContent = "Please fill out both fields.";
    } else {
        message.textContent = "Login successful!";
        message.style.color = "green";
    }
});