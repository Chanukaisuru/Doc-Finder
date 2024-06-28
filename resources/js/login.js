document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission

    // Here you can add your authentication logic
    var email = document.getElementById("login-email").value;
    var password = document.getElementById("login-password").value;

    // For demonstration purposes, just log the values to console
    console.log("Email:", email);
    console.log("Password:", password);

    
});
