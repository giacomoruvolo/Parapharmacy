<?php 
    
    require_once 'dbconfig.php';

    header('Content-Type: application/json');
    
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $codice = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT CodiceTracciabilita FROM parafarmacia WHERE CodiceTracciabilita = '$codice';";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_free_result($res);
    mysqli_close($conn);
?>