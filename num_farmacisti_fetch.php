<?php

    require_once 'dbconfig.php';


    header("Content-Type: application/json");

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));


    $query = "SELECT P.Nome as nome, P.NumeroFarmacisti as numero
    FROM parafarmacia P;";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $parafarmacieArray = array();

    if (mysqli_num_rows($res) > 0) 
    {
        while($entry = mysqli_fetch_assoc($res)){

            $parafarmacieArray[] = array('Nome' => $entry['nome'], 'Numero' => $entry['numero']);

        }
    }

    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($parafarmacieArray);
    
?>