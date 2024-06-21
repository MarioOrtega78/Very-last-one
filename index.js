document.getElementById('loginForm').addEventListener('submit', function(event) {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var errorDiv = document.getElementById('error');

    errorDiv.textContent = ''; // Clear previous error message

    if (username === '' || password === '') {
        errorDiv.textContent = 'Please fill in both fields.';
        event.preventDefault(); // Prevent form submission
    }
});
