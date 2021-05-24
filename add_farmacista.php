<?php

    require_once 'auth.php';

    if (!checkAuth()) {
        header("Location: login.php");
        exit;
    }   

    

    //verifico se tutti i campi rimepiti
    if (!empty($_POST["numero"]) && !empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["dataInizioContratto"]) && !empty($_POST["parafarmacia"]))
        {
            $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
            
            $errore = array();
            
            $numero = mysqli_real_escape_string($conn, $_POST['numero']);
                
            $query = "SELECT NumeroIscrizioneAlbo FROM farmacista WHERE NumeroIscrizioneAlbo = '$numero'";
            $res = mysqli_query($conn, $query);

            if (mysqli_num_rows($res) > 0) 
            {
                $errore[] = "Farmacista già presente";
            }

            mysqli_free_result($res);

            if (count($errore) == 0) {
                $numero = mysqli_real_escape_string($conn, $_POST['numero']);
                $nome = mysqli_real_escape_string($conn, $_POST['nome']);
                $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
                $dataInizioContratto = mysqli_real_escape_string($conn, $_POST['dataInizioContratto']);
                $parafarmacia = mysqli_real_escape_string($conn, $_POST['parafarmacia']);
                
                
                
                
                $query1 = "INSERT INTO farmacista (NumeroIscrizioneAlbo, Nome, Cognome) 
                VALUES('$numero', '$nome', '$cognome')";
                
                $query2 = "INSERT INTO contrattolavoro (Tipo, DataInizio, Farmacista, Parafarmacia) 
                VALUES('Corrente', '$dataInizioContratto', '$numero', '$parafarmacia')";
                


                
                if (mysqli_query($conn, $query1)) {
                    if(mysqli_query($conn, $query2)){
                    mysqli_close($conn);
                    header("Location: add_farmacista.php");
                    exit;
                    }else{
                      
                        $query = "DELETE FROM farmacista WHERE NumeroIscrizioneAlbo = '$numero'";
                        mysqli_query($conn, $query);
                        $errore[] = "Errore di connessione al Database";

                    }
                } else {
                    $errore[] = "Errore di connessione al Database";
                }
            }   
            mysqli_close($conn);
        }else
        {
            $errore[] = "Inserisci tutti i campi";  
        }

?>



<html>
    <head>
        <title>Aggiungi un farmacista</title>
 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="add_farmacista.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Noto+Sans:ital@1&family=Oswald&family=Poppins&family=Ubuntu:ital@1&display=swap" rel="stylesheet">
        <link rel="icon" href="img/logo.png" type="image/png" />

        <script src="add_farmacista.js" defer></script>
        
    </head>
 
    <body>

        <div class="overlay"></div>
        
        <section>

            <div id="logo">
                <a href="index.php"><img id="imglogo" src="img/logo&name.png"></a>
            </div>

            <h1>Aggiungi un farmacista</h1>
            <div id="boxfarmacista" class="function">

                <p class='error'></p>
                
                <form name='AggiuntaProdotto' method='post'>
                   
                    <div class="numero">
                        <div><label for='numero'>Numero di iscrizione Albo</label></div>
                        <div><input type='text' name='numero' <?php if(isset($_POST["numero"])){echo "value=".$_POST["numero"];} ?>></div>
                        
                    </div>

                    <div class="nome">
                        <div><label for='nome'>Nome</label></div>
                        <div><input type='text' name='nome' <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?>></div>
                        
                    </div>
                
                    <div class="cognome">
                        <div><label for='cognome'>Cognome</label></div>
                        <div><input type='text' name='cognome' <?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?>></div>
                        
                    </div>

                    </br>

                    <div class="dataInizioContratto">
                            <div><label for='dataInizioContratto'>Inizio contratto (aaaa-mm-gg)</label></div>
                            <div><input type='text' name='dataInizioContratto' <?php if(isset($_POST["dataInizioContratto"])){echo "value=".$_POST["dataInizioContratto"];} ?>></div>
                            
                    </div>

                    <div class="parafarmacia">
                            <div><label for='parafarmacia'>Codice Parafarmacia di assunzione</label></div>
                            <div><input type='text' name='parafarmacia' <?php if(isset($_POST["parafarmacia"])){echo "value=".$_POST["parafarmacia"];} ?>></div>
                            
                    </div>


                    </br>

                    <div class="submit">
                        <input type='submit' value="Aggiungi il farmacista" id="submit">
                    </div>


                </form>

                
                <?php
                if (isset($errore)) {

                $arrayLength = count($errore);

                $i = 0;
                while ($i < $arrayLength)
                {
                    
                    echo "<p class='error2'>";
                    echo "$errore[$i]";
                    echo "</p>";
                    
                    $i++;
                }
                echo "<br />";
                }
                
                ?>
                
    

                <div class="overlay-inside"></div>

            </div>
            
    
        </section>

        

        <footer>

            <a href="https://github.com/giacomoruvolo">Developed by Giacomo Ruvolo</br>O46002010</a>
    
        </footer>

    </body>
 
</html>
