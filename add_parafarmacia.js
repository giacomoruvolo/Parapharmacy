function fetchResponse(response) {
    return response.json();
}


function checkParafarmaciaJson(json) {
    
    if (formStatus.codice = json.exists) {
        
        document.querySelector('.error').textContent = "Parafarmacia già presente";
        
    }
}



function checkParafarmacia(event) {

    document.querySelector('.error').textContent = "";
    const input = document.querySelector('.codice input');

    if(!/^[0-9]{1,15}$/.test(input.value)) {
        document.querySelector('.error').textContent = "Sono ammessi numeri. Max. 15";
        
    } else {
        fetch("check_parafarmacia.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(checkParafarmaciaJson);

    }    
}

const formStatus = {'upload': true};
document.querySelector('.codice input').addEventListener('blur', checkParafarmacia);