<?php

header('Content-Type: application/json');

$url = 'https://covid-api.mmediagroup.fr/v1/cases?country=Italy';
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
$json = json_decode($result, true);
curl_close($curl);




echo json_encode($json);

?>