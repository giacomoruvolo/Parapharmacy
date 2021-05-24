<?php

    require_once 'auth.php';

    if (!checkAuth()) {
        header("Location: login.php");
        exit;
    }   

    

    //verifico se tutti i campi rimepiti
    if (!empty($_POST["codice"]) && !empty($_POST["nome"]) && !empty($_POST["Indirizzo"]))
        {
            $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

            $errore = array();
            
            $codice = mysqli_real_escape_string($conn, $_POST['codice']);
                
            $query = "SELECT CodiceTracciabilita FROM parafarmacia WHERE CodiceTracciabilita = '$codice'";
            $res = mysqli_query($conn, $query);

            if (mysqli_num_rows($res) > 0) 
            {
                $errore[] = "Parafarmacia già presente";
            }

            mysqli_free_result($res);

            if (count($errore) == 0) {
                $codice = mysqli_real_escape_string($conn, $_POST['codice']);
                $nome = mysqli_real_escape_string($conn, $_POST['nome']);
                $Indirizzo = mysqli_real_escape_string($conn, $_POST['Indirizzo']);
                $numero = '0';
                
                
                
                $query = "INSERT INTO parafarmacia (CodiceTracciabilita, Nome, Descrizione) 
                VALUES('$codice', '$nome', '$Indirizzo');";

                
                if (mysqli_query($conn, $query)) {
                    mysqli_close($conn);
                    header("Location: add_parafarmacia.php");
                    exit;
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
        <title>Aggiungi una Parafarmacia</title>
 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="add_parafarmacia.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Noto+Sans:ital@1&family=Oswald&family=Poppins&family=Ubuntu:ital@1&display=swap" rel="stylesheet">
        <link rel="icon" href="img/logo.png" type="image/png" />

        <script src="add_parafarmacia.js" defer></script>
        
    </head>
 
    <body>

        <div class="overlay"></div>
        
        <section>

            <div id="logo">
                <a href="index.php"><img id="imglogo" src="img/logo&name.png"></a>
            </div>

            <h1>Aggiungi una Parafarmacia</h1>
            <div id="boxprodotto" class="function">

                <p class='error'></p>
                
                <form name='AggiuntaParafarmacia' method='post'>
                   
                    <div class="codice">
                        <div><label for='codice'>Codice Tracciabilità</label></div>
                        <div><input type='text' name='codice' <?php if(isset($_POST["codice"])){echo "value=".$_POST["codice"];} ?>></div>
                        
                    </div>
                    <div class="nome">
                        <div><label for='nome'>Nome</label></div>
                        <div><input type='text' name='nome' <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?>></div>
                        
                    </div>
                
                    <div class="Indirizzo">
                        <div><label for='Indirizzo'>Indirizzo (Via, Citta, CAP)</label></div>
                        <div><input type='text' name='Indirizzo' <?php if(isset($_POST["Indirizzo"])){echo "value=".$_POST["Indirizzo"];} ?>></div>
                        
                    </div>
                

                    </br>

                    <div class="submit">
                        <input type='submit' value="Aggiungi la parafarmacia" id="submit">
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
