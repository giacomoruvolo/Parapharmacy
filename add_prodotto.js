function fetchResponse(response) {
    return response.json();
}


function checkProdottoJson(json) {
    
    if (formStatus.codice = json.exists) {
        
        document.querySelector('.error').textContent = "Prodotto già presente";
        
    }
}



function checkProdotto(event) {

    document.querySelector('.error').textContent = "";
    const input = document.querySelector('.codice input');

    if(!/^[0-9]{1,15}$/.test(input.value)) {
        document.querySelector('.error').textContent = "Sono ammessi numeri. Max. 15";
        
    } else {
        fetch("check_prodotto.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(checkProdottoJson);

    }    
}

const formStatus = {'upload': true};
document.querySelector('.codice input').addEventListener('blur', checkProdotto);