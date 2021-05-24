<?php

    
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;}
    


?>

<html>
    <head>
        <title>Cerca farmacista</title>
 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="find_farmacista.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Noto+Sans:ital@1&family=Oswald&family=Poppins&family=Ubuntu:ital@1&display=swap" rel="stylesheet">
        <link rel="icon" href="img/logo.png" type="image/png" />
        
        <script src="find_farmacista.js" defer></script>
    
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

            <div id="sub-section-search" >
                Cerca il farmacista</br>
                <input id="input" type='text' placeholder='Inserisci il codice della Parafarmacia'>
            </div>
                
            <div id="sub-section">


            </div>
    
        </section>

 




        <footer>

            <a href="https://github.com/giacomoruvolo">Developed by Giacomo Ruvolo</br>O46002010</a>
    
        </footer>


 
    
 
    </body>
 
</html>
