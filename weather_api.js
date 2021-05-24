
fetch("weather_geolocation_api.php").then(onResponseGeo).then(onJsonGeo);

function onResponseGeo(response){
    
    return response.json()

}


function onJsonGeo(json){

    console.log(json);
    

    

    fetch("weather_api.php?"+"&q="+json.city).then(onResponseWeather).then(onJsonWeather);

}



function onResponseWeather(response){
    
    return response.json()

}

function onJsonWeather(json){
    
    

    document.getElementById('city').innerHTML = json.location.name;
    document.getElementById('temperature').innerHTML = json.current.temperature;
    document.getElementById('weather_descriptions').innerHTML = json.current.weather_descriptions[0];
    document.getElementById('weather-img').src = json.current.weather_icons[0];

}



