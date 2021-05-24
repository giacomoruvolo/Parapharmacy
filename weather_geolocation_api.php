<?php

header('Content-Type: application/json');

$apikey = 'ae11c41e447e4dd78b7664d1c628dca4';

$url = 'https://ipgeolocation.abstractapi.com/v1/?api_key='.$apikey;
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
$json = json_decode($result, true);
curl_close($curl);




echo json_encode($json);

?>