fetch("covid_api.php").then(onResponse).then(onJson);

function onResponse(response){
    
    return response.json()

}

function onJson(json){
    
    console.log(json);
    document.getElementById('confAll').innerHTML = json.All.confirmed;
    document.getElementById('guarAll').innerHTML = json.All.recovered;
    document.getElementById('MorALL').innerHTML = json.All.deaths;
    document.getElementById('confSicilia').innerHTML = json.Sicilia.confirmed;
    document.getElementById('guarSicilia').innerHTML = json.Sicilia.recovered;
    document.getElementById('MorSicilia').innerHTML = json.Sicilia.deaths;

}


