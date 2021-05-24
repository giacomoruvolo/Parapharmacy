<?php

    require_once 'auth.php';

    if (!checkAuth()) {
        header("Location: login.php");
        exit;
    }   

    

    //verifico se tutti i campi rimepiti
    if (!empty($_POST["codice"]) && !empty($_POST["iva"]) && !empty($_POST["PrezzoNetto"]) && !empty($_POST["immagine"]))
        {
            $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

            $errore = array();
            
            $codice = mysqli_real_escape_string($conn, $_POST['codice']);
                
            $query = "SELECT CodiceMinsan FROM prodotto WHERE CodiceMinsan = '$codice'";
            $res = mysqli_query($conn, $query);

            if (mysqli_num_rows($res) > 0) 
            {
                $errore[] = "Prodotto già presente";
            }

            mysqli_free_result($res);

            if (count($errore) == 0) {
                $codice = mysqli_real_escape_string($conn, $_POST['codice']);
                $iva = mysqli_real_escape_string($conn, $_POST['iva']);
                $PrezzoNetto = mysqli_real_escape_string($conn, $_POST['PrezzoNetto']);
                $immagine = mysqli_real_escape_string($conn, $_POST['immagine']);
                
                
                
                $query = "INSERT INTO prodotto (CodiceMinsan, iva, PrezzoNetto, Immagine) 
                VALUES('$codice', '$iva', '$PrezzoNetto', '$immagine')";

                
                if (mysqli_query($conn, $query)) {
                    mysqli_close($conn);
                    header("Location: add_prodotto.php");
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
        <title>Aggiungi un prodotto</title>
 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="add_prodotto.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Noto+Sans:ital@1&family=Oswald&family=Poppins&family=Ubuntu:ital@1&display=swap" rel="stylesheet">
        <link rel="icon" href="img/logo.png" type="image/png" />

        <script src="add_prodotto.js" defer></script>
        
    </head>
 
    <body>

        <div class="overlay"></div>
        
        <section>

            <div id="logo">
                <a href="index.php"><img id="imglogo" src="img/logo&name.png"></a>
            </div>

            <h1>Aggiungi un prodotto</h1>
            <div id="boxprodotto" class="function">

                <p class='error'></p>
                
                <form name='AggiuntaProdotto' method='post'>
                   
                    <div class="codice">
                        <div><label for='codice'>Codice Minsan</label></div>
                        <div><input type='text' name='codice' <?php if(isset($_POST["codice"])){echo "value=".$_POST["codice"];} ?>></div>
                        
                    </div>
                    <div class="iva">
                        <div><label for='iva'>IVA (valore decimale)</label></div>
                        <div><input type='text' name='iva' <?php if(isset($_POST["iva"])){echo "value=".$_POST["iva"];} ?>></div>
                        
                    </div>
                
                    <div class="PrezzoNetto">
                        <div><label for='PrezzoNetto'>Prezzo Netto</label></div>
                        <div><input type='text' name='PrezzoNetto' <?php if(isset($_POST["PrezzoNetto"])){echo "value=".$_POST["PrezzoNetto"];} ?>></div>
                        
                    </div>
                    
                    </br>
                    <div class="immagine">
                        <div><label for='immagine'>Immagine</label></div>
                        <div><input type='text' name='immagine' <?php if(isset($_POST["immagine"])){echo "value=".$_POST["immagine"];} ?>></div>
                        
                    </div>
                

                    </br>

                    <div class="submit">
                        <input type='submit' value="Aggiungi il prodotto" id="submit">
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
