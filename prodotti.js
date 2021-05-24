fetch("prodotti_fetch.php").then(fetchResponse).then(fetchProdottiJson);


function fetchResponse(response){

    
    return response.json();

}

function fetchProdottiJson(json){

    

    for (const e of json){
   
        createElement(e);
     
     }
    

}


function createElement(element){

    const section = document.querySelector('#sub-section');

    const e = document.createElement('div');
    e.classList.add('prodotto');

    const codice = document.createElement('p');
    codice.classList.add('codice');
    codice.textContent = "Codice: " + element.Minsan;
    e.appendChild(codice);

    const fotoProdotto = document.createElement('img');
    fotoProdotto.classList.add('foto-prodotto');
    fotoProdotto.src = element.Immagine;
    e.appendChild(fotoProdotto);

    const costo = document.createElement('div');
    costo.classList.add('costo');
    costo.textContent = "Prezzo Netto: " + element.PrezzoNetto + "€";
    e.appendChild(costo);

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
        
        if(e.nodeType === Node.ELEMENT_NODE && e.getElementsByTagName('p')[0].textContent.toLowerCase().search(keyWord.value.toLowerCase()) === -1){
           
            e.classList.add('hidden');

        
        }

        if(e.nodeType === Node.ELEMENT_NODE && e.getElementsByTagName('p')[0].textContent.toLowerCase().search(keyWord.value.toLowerCase()) !== -1){
           
            e.classList.remove('hidden');

        
        }

        
    }





}


