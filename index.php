<?php

    require_once 'auth.php';
    if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
    }
    
?>
<html>
    <head>
        <title>Home</title>
 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="index.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Noto+Sans:ital@1&family=Oswald&family=Poppins&family=Ubuntu:ital@1&display=swap" rel="stylesheet">
        <link rel="icon" href="img/logo.png" type="image/png" />

        <script src="covid_api.js" defer></script>
        <script src="weather_api.js" defer></script>
    </head>
 
    <body>
        
            
        <header>
                 
            <nav>

                <div id="logo">
                    <a href="index.php"><img id="imglogo" src="img/logo.png"></a>
                </div>
    
                <div id="links">

                    <a href="parafarmacie.php">Parafarmacie</a>
                    <a href="prodotti.php">Prodotti</a>
                    <a href="clienti.php">Clienti</a>
                    <a class="buttom" href="logout.php">Logout</a>

                </div>

                <img id="menu" src="img/menu.png">
                        
            </nav>

            <div class="overlay"></div>
 
        </header>





 
        <section>

            <div id ="data-section">

                SITUAZIONE COVID-19</br>

                Casi in Italia - Confermati: <span id="confAll" class="font-colored"></span>  Guariti: <span id="guarAll" class="font-colored"></span> Morti: <span id="MorALL" class="font-colored"> </span></br>

                Casi in Sicilia - Confermati: <span id="confSicilia" class="font-colored"></span> Guariti: <span id="guarSicilia" class="font-colored"></span> Morti: <span id="MorSicilia" class="font-colored"></span>

            </div>
                
            <div id="sub-section">

                

                <div id="ism" class="function">
                        
                    Info su medicinale</br>
                
                    <div class="buttom-inside">
                        <a href="info_med.php"><img class="open" src="img/open.png" ></a>
                    </div>

                    <div class="overlay-inside"></div>

                </div>

                <div id="cf" class="function">

                    Cerca farmacista

                    <div class="buttom-inside">
                        <a href="find_farmacista.php"><img class="open" src="img/open.png" ></a>
                    </div>

                    <div class="overlay-inside"></div>


                </div>

                <div id="ap" class="function">

                    Aggiungi prodotto

                    <div class="buttom-inside">
                        <a href="add_prodotto.php"><img class="open" src="img/open.png" ></a>
                    </div>

                    <div class="overlay-inside"></div>
            
                </div>

                <div id="nfppv" class="function">
                        
                    Numero farmacisti
                        
                    <div class="buttom-inside">
                        <a href="num_farmacisti.php"><img class="open" src="img/open.png" ></a>
                    </div>

                    <div class="overlay-inside"></div>

                </div>

                <div id="nfppv" class="function">
                        
                    Aggiungi farmacista
                        
                    <div class="buttom-inside">
                        <a href="add_farmacista.php"><img class="open" src="img/open.png" ></a>
                    </div>

                    <div class="overlay-inside"></div>

                </div>

                <div id="nfppv" class="function">
                        
                    Aggiungi Parafarmacia
                        
                    <div class="buttom-inside">
                        <a href="add_parafarmacia.php"><img class="open" src="img/open.png" ></a>
                    </div>

                    <div class="overlay-inside"></div>

                </div>

            </div>

            <div id ="weather-section">

                
                <div id=primary-row>
                    METEO</br>
                <div id="row1"> <div>Citt&agrave;: </div><span id="city" class="font-colored"></span> </div>
                <div id="row2"> <div>Temperatura: </div><span id="temperature" class="font-colored"></span><div class="font-colored">C&ordm;</div> </div>
                <div id="row3"> <div>Descrizione: </div><span id="weather_descriptions" class="font-colored"></span> </div>
                </div>
                <img id="weather-img"></img>

            </div>
    
        </section>

 




        <footer>

            <a href="https://github.com/giacomoruvolo">Developed by Giacomo Ruvolo</br>O46002010</a>
    
        </footer>


 
    
 
    </body>
 
</html>
