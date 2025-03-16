const container=document.querySelector('.container');
const registerbtn=document.querySelector('.register-btn');
const loginbtn=document.querySelector('.login-btn');

registerbtn.addEventListener('click',()=>{
    container.classList.add('active');
});

loginbtn.addEventListener('click',()=>{
    container.classList.remove('active');
});


function validateLoginForm() {
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value.trim();
    let usernameError = document.getElementById("loginUsernameError");
    let passwordError = document.getElementById("loginPasswordError");
    let isValid = true;

    // Reset error messages
    usernameError.innerHTML = "";
    passwordError.innerHTML = "";

    // Validate Username
    if (username === "") {
        usernameError.innerHTML = "Username is required!";
        isValid = false;
    }

    // Validate Password
    if (password === "") {
        passwordError.innerHTML = "Password is required!";
        isValid = false;
    }

    return isValid; // Prevent form submission if validation fails
}
