fetch("parafarmacie_fetch.php").then(fetchResponse).then(fetchParafarmacieJson);


function fetchResponse(response){

    
    return response.json();

}

function fetchParafarmacieJson(json){

    

    for (const e of json){
   
        createElement(e);
     
     }
    

}



function createElement(element){

    const section = document.querySelector('#sub-section');

    const e = document.createElement('div');
    e.classList.add('para');


    const name = document.createElement('div');
    name.classList.add('name');
    name.textContent = element.nome;
    e.appendChild(name);

    const star = document.createElement('img');
    star.classList.add('star');
    star.src = 'img/star-plus.png';
    e.appendChild(star);

    const fotoPara = document.createElement('img');
    fotoPara.classList.add('foto-para');
    fotoPara.src = 'img/croce.png';
    e.appendChild(fotoPara);

    const p = document.createElement('p');
    p.classList.add('hidden');
    p.textContent = element.descrizione;
    e.appendChild(p);

    const buttom = document.createElement('buttom');
    buttom.textContent = 'Mostra dettagli';
    buttom.addEventListener('click', showDetails);
    e.appendChild(buttom);

    const overlay = document.createElement('div');
    overlay.classList.add('overlay-inside');
    e.appendChild(overlay);
    
    section.appendChild(e);

    const imgStar = document.querySelectorAll('.para .star');
    for(const star of imgStar){
        console.log("prova");
        star.addEventListener('click', addStarred);
        
    }


}

function showDetails(event){

    
    const details = event.currentTarget;
    details.textContent = "Nascondi dettagli";
    details.parentNode.getElementsByTagName('p')[0].classList.remove('hidden');


    details.addEventListener('click', hideDetails);
    details.removeEventListener('click', showDetails);
}

function hideDetails(event){


    const details = event.currentTarget;
    details.textContent = "Mostra dettagli";
    details.parentNode.getElementsByTagName('p')[0].classList.add('hidden');


    details.addEventListener('click', showDetails);
    details.removeEventListener('click', hideDetails);
}

function createStarElement(element, section){


    const nE = document.createElement('div');
    nE.classList.add('para');

    const name = document.createElement('div');
    name.classList.add('name');
    name.textContent = element.getElementsByClassName('name')[0].textContent;
    nE.appendChild(name);

    const star = document.createElement('img');
    star.classList.add('star');
    star.src = element.getElementsByClassName('star')[0].src;
    star.addEventListener('click', rmStarredFromStarredSection);
    nE.appendChild(star);

    const fotoPara = document.createElement('img');
    fotoPara.classList.add('foto-para');
    fotoPara.src = element.getElementsByClassName('foto-para')[0].src;
    nE.appendChild(fotoPara);

    const p = document.createElement('p');
    p.classList.add('hidden');
    p.textContent = element.getElementsByTagName('p')[0].textContent;
    nE.appendChild(p);

    const buttom = document.createElement('buttom');
    buttom.textContent = element.getElementsByTagName('buttom')[0].textContent;
    nE.appendChild(buttom);

    const overlay = document.createElement('div');
    overlay.classList.add('overlay-inside');
    nE.appendChild(overlay);
    
    section.appendChild(nE);

    

}



function addStarred(event){


    const imgStar = event.currentTarget;
    imgStar.src = "img/star-remove.png";
    
    const element = imgStar.parentNode;
    const starSection = document.querySelector('#ssselement')
    
    
    
    if(starSection.innerHTML === ''){

        starSection.parentNode.classList.remove('hidden');
        
    }

    createStarElement(element, starSection);
    
    imgStar.addEventListener('click', rmStarredFromSection);
    imgStar.removeEventListener('click', addStarred);

}

function rmStarredFromSection(event) {
    const imgStar = event.currentTarget;
    imgStar.src = "img/star-plus.png";
    
    
    const starSection = document.querySelector('#ssselement');
    
    
    for(const e of starSection.childNodes){
        
        if(e.getElementsByClassName('name')[0].textContent === imgStar.parentNode.getElementsByClassName('name')[0].textContent){
            starSection.removeChild(e);
            break;
            
        }
    }


    if(starSection.innerHTML === '')
    {
        starSection.parentNode.classList.add('hidden');
    }

    imgStar.addEventListener('click', addStarred);
    imgStar.removeEventListener('click', rmStarredFromSection);
    
}

function rmStarredFromStarredSection(event) {
    const imgStar = event.currentTarget;
    
    
    const section = document.querySelector('#sub-section');
    const starSection = document.querySelector('#ssselement')
    
    
    for(const e of section.childNodes){
        
        if(e.nodeType === Node.ELEMENT_NODE && e.getElementsByClassName('name')[0].textContent === imgStar.parentNode.getElementsByClassName('name')[0].textContent){
            
            e.getElementsByClassName('star')[0].src = "img/star-plus.png";
            e.getElementsByClassName('star')[0].addEventListener('click', addStarred);
            e.getElementsByClassName('star')[0].removeEventListener('click', rmStarredFromSection);
            break;
        
        }

        
    }

    imgStar.parentNode.parentNode.removeChild(imgStar.parentNode);

    if(starSection.innerHTML === '')
    {
        starSection.parentNode.classList.add('hidden');
    }

    
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


