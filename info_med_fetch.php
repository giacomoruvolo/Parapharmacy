<?php

    require_once 'dbconfig.php';


    header("Content-Type: application/json");

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));


    $query = "SELECT * FROM medicinale;";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $medArray = array();

    if (mysqli_num_rows($res) > 0) 
    {
        while($entry = mysqli_fetch_assoc($res)){

            $medArray[] = array('Prodotto' => $entry['Prodotto'], 'Nome' => $entry['Nome'], 'PrincipioAttivo' => $entry['PrincipioAttivo']);

        }
    }

    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($medArray);
    

?>