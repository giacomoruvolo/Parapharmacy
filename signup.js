function fetchResponse(response) {
    return response.json();
}


function checkUsernameJson(json) {
    
    if (formStatus.username = json.exists) {
        
        document.querySelector('.error').textContent = "Username già utilizzato";
        
    }
}


function checkEmailJson(json) {
    
    if (formStatus.email = json.exists) {
        
        document.querySelector('.error').textContent = "Email già in uso";
    }
}


function checkUsername(event) {

    document.querySelector('.error').textContent = "";
    const input = document.querySelector('.username input');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        document.querySelector('.error').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        
    } else {
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(checkUsernameJson);

    }    
}

function checkEmail(event) {

    document.querySelector('.error').textContent = "";
    const input = document.querySelector('.email input');

    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input.value).toLowerCase())) {
        document.querySelector('.error').textContent = "Email non valida";
    } else {
        fetch("check_email.php?q="+encodeURIComponent((String(input.value)).toLowerCase())).then(fetchResponse).then(checkEmailJson);
    }
}

function checkPassword(event) {
   
    document.querySelector('.error').textContent = "";
    const passwordInput = document.querySelector('.password input');
    if (formStatus.password = passwordInput.value.length < 8) {
        document.querySelector('.error').textContent = "Password troppo corta, Min. 8";
    }
}

function checkConfirmPassword(event) {

    document.querySelector('.error').textContent = "";
    const confirmPasswordInput = document.querySelector('.confirm_password input');
    if (!(formStatus.confirmPassword = confirmPasswordInput.value === document.querySelector('.password input').value)) {
        document.querySelector('.error').textContent = "Le Password non coincidono";
    }
}

const formStatus = {'upload': true};
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password input').addEventListener('blur', checkConfirmPassword);