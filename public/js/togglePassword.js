var togglePassword = document.getElementById("togglePassword");
if (togglePassword) {
    togglePassword.addEventListener('click', function() {
    var x = document.getElementById("inputPassword");
    if (x.type === "password") {
        togglePassword.firstElementChild.classList.remove("fa-eye");
        togglePassword.firstElementChild.classList.add("fa-eye-slash");
        x.type = "text";
    } else {
        togglePassword.firstElementChild.classList.remove("fa-eye-slash");
        togglePassword.firstElementChild.classList.add("fa-eye");
        x.type = "password";
    }
    });
}

var togglePasswordConfirmation = document.getElementById("togglePasswordConfirmation");
if (togglePasswordConfirmation) {
    togglePasswordConfirmation.addEventListener('click', function() {
    var x = document.getElementById("inputPasswordConfirmation");
    if (x.type === "password") {
        togglePasswordConfirmation.firstElementChild.classList.remove("fa-eye");
        togglePasswordConfirmation.firstElementChild.classList.add("fa-eye-slash");
        x.type = "text";
    } else {
        togglePasswordConfirmation.firstElementChild.classList.remove("fa-eye-slash");
        togglePasswordConfirmation.firstElementChild.classList.add("fa-eye");
        x.type = "password";
    }
    });
}