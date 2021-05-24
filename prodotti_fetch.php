<?php

    require_once 'dbconfig.php';

    header("Content-Type: application/json");

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $query = "SELECT CodiceMinsan, PrezzoNetto, Immagine FROM prodotto;";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $prodottiArray = array();

    if (mysqli_num_rows($res) > 0) 
    {
        while($entry = mysqli_fetch_assoc($res)){

            $prodottiArray[] = array('Minsan' => $entry['CodiceMinsan'], 'PrezzoNetto' => $entry['PrezzoNetto'], 'Immagine' => $entry['Immagine']);

        }
    }

    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($prodottiArray);
    

?>