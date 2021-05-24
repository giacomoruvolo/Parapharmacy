fetch("find_farmacista_fetch.php").then(fetchResponse).then(fetchFarmacistaJson);


function fetchResponse(response){

    return response.json();

}

function fetchFarmacistaJson(json){

    

    for (const e of json){
   
        createElement(e);
     
     }
    

}


function createElement(element){

    const section = document.querySelector('#sub-section');

    const e = document.createElement('div');
    e.classList.add('farmacista');

    const nome = document.createElement('div');
    nome.classList.add('nome');
    nome.textContent = "Nome: " + element.Nome;
    e.appendChild(nome);

    const cognome = document.createElement('div');
    cognome.classList.add('cognome');
    cognome.textContent = "Cognome: " + element.Cognome;
    e.appendChild(cognome);

    const Stato_Contratto= document.createElement('div');
    Stato_Contratto.classList.add('Stato_Contratto');
    Stato_Contratto.textContent = "Tipo contratto: " + element.Stato_Contratto;
    e.appendChild(Stato_Contratto);

    const CodiceTracciabilita= document.createElement('div');
    CodiceTracciabilita.classList.add('CodiceTracciabilita');
    CodiceTracciabilita.textContent = "Codice Parafarmacia : " + element.CodiceTracciabilita;
    e.appendChild(CodiceTracciabilita);

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
        
        if(e.nodeType === Node.ELEMENT_NODE && e.getElementsByTagName('div')[3].textContent.toLowerCase().search(keyWord.value.toLowerCase()) === -1){
           
            e.classList.add('hidden');

        
        }

        if(e.nodeType === Node.ELEMENT_NODE && e.getElementsByTagName('div')[3].textContent.toLowerCase().search(keyWord.value.toLowerCase()) !== -1){
           
            e.classList.remove('hidden');

        
        }

        
    }





}


