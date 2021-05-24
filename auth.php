<?php

    //controllo se utente già loggato

    require_once 'dbconfig.php';
    session_start();

    function checkAuth(){

        GLOBAL $dbconfig;
        // Se esiste già una sessione, la ritorno
        if(isset($_SESSION['sito_user_id'])){

            return $_SESSION['sito_user_id'];
            exit;

        }


    }



?>