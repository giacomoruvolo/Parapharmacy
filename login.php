<?php

include 'auth.php';


if(checkAuth()){
    //se torna qualcosa
    header("Location: index.php");
    exit;

}


if (isset($_POST["username"]) && isset($_POST["password"])){

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $query = "SELECT * FROM users WHERE username = '$username'";
    
    
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($res) > 0) 
    { //se >0 ho trovato utente
        $entry = mysqli_fetch_assoc($res);
        
        if ($_POST['password'] == $entry['password'])
        {
            
            $_SESSION["sito_username"] = $entry['username'];
            $_SESSION["sito_user_id"] = $entry['id'];

            header("Location: index.php");
            mysqli_free_result($res);
            mysqli_close($conn); 
            exit;   

        }else{

            $errore = "Username e/o password errati.";

        }

    }
}

?>


<html>
    <head>
        <title>Login</title>
 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="login.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Noto+Sans:ital@1&family=Oswald&family=Poppins&family=Ubuntu:ital@1&display=swap" rel="stylesheet">
        <link rel="icon" href="img/logo.png" type="image/png" />
        
    </head>
 
    <body>

        <div class="overlay"></div>
        
        <section>

            <div id="logo">
                <a href="index.php"><img id="imglogo" src="img/logo&name.png"></a>
            </div>


            <div id="boxlogin" class="function">

                <?php
                   
                    if (isset($errore)) {
                        
                        echo "<p class='error'>";
                        echo "$errore";
                        echo "</p>";
            
                    }
                    
                ?>
                        
                <form name='login' method='post'>
                   
                    <div class="username">
                        <div><label for='username'>Nome utente</label></div>
                        <div><input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></div>
                    </div>
                    <div class="password">
                        <div><label for='password'>Password</label></div>
                        <div><input type='password' name='password'<?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                    </div>
                    </br>
                    <div>
                        <input type='submit' value="Accedi">
                    </div>
                </form>

                <div class="overlay-inside"></div>

                <div class="signup">Non hai un account? <a href="signup.php">Iscriviti</a>

            </div>

           
    
        </section>


 
    </body>
 
</html>
