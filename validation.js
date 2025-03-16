function showError(msgElement, message) {
    if (message) {
        msgElement.innerHTML = message;
        msgElement.classList.add("error-visible");
    } else {
        msgElement.innerHTML = "";
        msgElement.classList.remove("error-visible");
    }
}


function onlyalpha(id,msg){
    var data=id.value;
    var alpha=data.match(/[a-z|A-Z ]+/);
    if (data === "") {
        msg.innerHTML = ""; 
    }
    else if(data!=alpha){
        msg.innerHTML="Enter only alpha";
    }
    else{
        msg.innerHTML="";
    }
}

// function validatePassword(id, msg) {
//     var data = id.value.trim();
//     var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])[A-Za-z0-9@$!%*?&]{8}$/;
//     if (data === "") {
//         msg.innerHTML = ""; // Remove error if empty
//     } 
//     else if (!passwordPattern.test(data)) {
//         msg.innerHTML = "Password must be at least 8 characters long and contain both uppercase & lowercase letters";
//     } 
//     else {
//         msg.innerHTML = "";
//     }
// }
    
function validatePassword(id, msg) {
    var data = id.value.trim();
    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
    if (data === "") {
        msg.innerHTML = ""; // Remove error if empty
    } 
    else if (!passwordPattern.test(data)) {
        msg.innerHTML = "Password must be at least 8 characters, contain an uppercase letter, lowercase letter, number, and special character.";
    } 
    else {
        msg.innerHTML = "";
    }
}

    
function validateConfirmPassword() {
    var password = document.getElementById("signup-password").value.trim();
    var cpassword = document.getElementById("cpassword").value.trim();
    var msg = document.getElementById("lcpassword");

    if (cpassword === "") {
        msg.innerHTML = ""; // Remove error if empty
    } else if (password !== cpassword) {
        msg.innerHTML = "Passwords do not match";
    } else {
        msg.innerHTML = "";
    }
}


function validateEmail(id, msg) {
    var data = id.value;
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (data === "") {
        msg.innerHTML = ""; 
    }
    else if (!emailPattern.test(data)) {
        msg.innerHTML = "Enter a valid email address";
    } else {
        msg.innerHTML = "";
    }
}

function validateContactNo(id, msg) {
    var data = id.value;
    var contactPattern = /^[0-9]{10}$/; 
    if (data === "") {
        msg.innerHTML = ""; 
    }
    else if (!contactPattern.test(data)) {
        msg.innerHTML = "Enter a valid 10-digit contact number";
    } else {
        msg.innerHTML = "";
    }
}

function formvalidation(){
    var usernameError = document.getElementById("username").innerHTML;
    var passwordError = document.getElementById("password").innerHTML;

    if (usernameError !== "" || passwordError !== "") {
        return false;
    }
    return true;
}
