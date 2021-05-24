<?php

    require_once 'dbconfig.php';

    header("Content-Type: application/json");

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $query = "SELECT * FROM cliente;";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $clientiArray = array();

    if (mysqli_num_rows($res) > 0) 
    {
        while($entry = mysqli_fetch_assoc($res)){

            $clientiArray[] = array('Nome' => $entry['Nome'], 'Cognome' => $entry['Cognome'], 'CF' => $entry['CF'], 'Telefono' => $entry['Telefono']);

        }
    }

    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($clientiArray);
    

?>