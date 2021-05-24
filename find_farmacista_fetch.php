<?php

    require_once 'dbconfig.php';


    header("Content-Type: application/json");

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));


    $query = "SELECT F.Nome AS Nome_Farmacista, F.Cognome as Cognome_Farmacista, CL.Tipo as Stato_Contratto, P.CodiceTracciabilita as CodiceTracciabilita
    FROM parafarmacia P, contrattolavoro CL, farmacista F
    where P.CodiceTracciabilita = CL.Parafarmacia AND CL.Farmacista = F.NumeroIscrizioneAlbo;";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $farmacistiArray = array();

    if (mysqli_num_rows($res) > 0) 
    {
        while($entry = mysqli_fetch_assoc($res)){

            $farmacistiArray[] = array('Nome' => $entry['Nome_Farmacista'], 'Cognome' => $entry['Cognome_Farmacista'], 'Stato_Contratto' => $entry['Stato_Contratto'], 'CodiceTracciabilita' => $entry['CodiceTracciabilita']);

        }
    }

    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($farmacistiArray);
    

?>