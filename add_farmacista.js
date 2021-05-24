function fetchResponse(response) {
    return response.json();
}


function checkFarmacistaJson(json) {
    
    if (formStatus.numero = json.exists) {
        
        document.querySelector('.error').textContent = "Farmacista già presente";
        
    }
}



function checkFarmacista(event) {
    document.querySelector('.error').textContent = "";
    const input = document.querySelector('.numero input');

    if(!/^[0-9]{1,15}$/.test(input.value)) {
        document.querySelector('.error').textContent = "Sono ammessi numeri. Max. 15";
        
    } else {
        fetch("check_farmacista.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(checkFarmacistaJson);

    }    
}

function checkParafarmaciaJson(json) {
    
    if (!(formStatus.parafarmacia = json.exists)) {
        
        document.querySelector('.error').textContent = "Parafarmacia non presente";
        
    }
}



function checkParafarmacia(event) {

    document.querySelector('.error').textContent = "";
    const input = document.querySelector('.parafarmacia input');
    fetch("check_parafarmacia.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(checkParafarmaciaJson);

}

const formStatus = {'upload': true};
document.querySelector('.numero input').addEventListener('blur', checkFarmacista);
document.querySelector('.parafarmacia input').addEventListener('blur', checkParafarmacia);