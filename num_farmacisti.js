fetch("num_farmacisti_fetch.php").then(fetchResponse).then(fetchFarmacistaJson);


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
    e.classList.add('parafarmacia');

    const nome = document.createElement('div');
    nome.classList.add('nome');
    nome.textContent = "Nome: " + element.Nome;
    e.appendChild(nome);

    const numero = document.createElement('div');
    numero.classList.add('numero');
    numero.textContent = "Numero Farmacisti: " + element.Numero;
    e.appendChild(numero);

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
        
        if(e.nodeType === Node.ELEMENT_NODE && e.getElementsByTagName('div')[0].textContent.toLowerCase().search(keyWord.value.toLowerCase()) === -1){
           
            e.classList.add('hidden');

        
        }

        if(e.nodeType === Node.ELEMENT_NODE && e.getElementsByTagName('div')[0].textContent.toLowerCase().search(keyWord.value.toLowerCase()) !== -1){
           
            e.classList.remove('hidden');

        
        }

        
    }





}


