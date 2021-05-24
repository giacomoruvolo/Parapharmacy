<?php

header('Content-Type: application/json');

$apikey = 'dc1badfcf60bcb7171bf3937f3a2e7c8';

$query = urlencode($_GET["q"]);

$url = 'http://api.weatherstack.com/current?access_key='.$apikey.'&query='.$query;
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
$json = json_decode($result, true);
curl_close($curl);




echo json_encode($json);

?>