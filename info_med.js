fetch("info_med_fetch.php").then(fetchResponse).then(fetchMedicineJson);


function fetchResponse(response){

    return response.json();

}

function fetchMedicineJson(json){

    

    for (const e of json){
   
        createElement(e);
     
     }
    

}


function createElement(element){

    const section = document.querySelector('#sub-section');

    const e = document.createElement('div');
    e.classList.add('med');

    const prodotto = document.createElement('div');
    prodotto.classList.add('Prodotto');
    prodotto.textContent = "Codice: " + element.Prodotto;
    e.appendChild(prodotto);

    const nome = document.createElement('div');
    nome.classList.add('Nome');
    nome.textContent = "Nome: " + element.Nome;
    e.appendChild(nome);

    const principioattivo = document.createElement('div');
    principioattivo.classList.add('principioattivo');
    principioattivo.textContent = "Principio Attivo: " + element.PrincipioAttivo;
    e.appendChild(principioattivo);

    const overlay = document.createElement('div');
    overlay.classList.add('overlay-inside');
    e.appendChild(overlay);
    
    section.appendChild(e);


}


const log = document.getElementById('input');

log.addEventListener('keyup', keyInput);

function keyInput(event)

{
    const keyWord = event.currentTarget;

    const section = document.querySelector('#sub-section');

    for(const e of section.childNodes){
        
        if(e.nodeType === Node.ELEMENT_NODE && e.getElementsByTagName('div')[2].textContent.toLowerCase().search(keyWord.value.toLowerCase()) === -1){
           
            e.classList.add('hidden');

        
        }

        if(e.nodeType === Node.ELEMENT_NODE && e.getElementsByTagName('div')[2].textContent.toLowerCase().search(keyWord.value.toLowerCase()) !== -1){
           
            e.classList.remove('hidden');

        
        }

        
    }

}


