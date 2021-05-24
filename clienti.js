fetch("clienti_fetch.php").then(fetchResponse).then(fetchClientiJson);


function fetchResponse(response){

   
    return response.json();

}

function fetchClientiJson(json){

    

    for (const e of json){
   
        createElement(e);
     
     }
    

}


function createElement(element){

    const section = document.querySelector('#sub-section');

    const e = document.createElement('div');
    e.classList.add('cliente');

    const nome = document.createElement('div');
    nome.classList.add('nome');
    nome.textContent = "Nome: " + element.Nome;
    e.appendChild(nome);

    const cognome = document.createElement('div');
    cognome.classList.add('cognome');
    cognome.textContent = "Cognome: " + element.Cognome;
    e.appendChild(cognome);

    const CF = document.createElement('div');
    CF.classList.add('cf');
    CF.textContent = "CF: " + element.CF;
    e.appendChild(CF);

    const telefono = document.createElement('div');
    telefono.classList.add('telefono');
    telefono.textContent = "Telefono: " + element.Telefono;
    e.appendChild(telefono);

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


