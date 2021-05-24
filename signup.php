<?php

    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: index.php");
        exit;
    }   

    

    //verifico se tutti i campi rimepiti
    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["name"]) && 
        !empty($_POST["surname"]) && !empty($_POST["confirm_password"]))
        {
            $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

            $errore = array();
            
            $username = mysqli_real_escape_string($conn, $_POST['username']);
                
            $query = "SELECT username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);

            if (mysqli_num_rows($res) > 0) 
            {
                $errore[] = "Username già utilizzato";
            }
            
            mysqli_free_result($res);
           
            if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
                $errore[] = "Le password tra loro non coincidono";
            }

            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $errore[] = "Email già in uso";
            }

            mysqli_free_result($res);

            if (count($errore) == 0) {
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $surname = mysqli_real_escape_string($conn, $_POST['surname']);
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                
    
                $query = "INSERT INTO users (username, password, name, surname, email) 
                VALUES('$username', '$password', '$name', '$surname', '$email')";

                
                if (mysqli_query($conn, $query)) {
                    $_SESSION["site_username"] = $_POST["username"];
                    $_SESSION["site_user_id"] = mysqli_insert_id($conn); //generato da autoincrement
                    mysqli_close($conn);
                    header("Location: index.php");
                    exit;
                } else {
                    $errore[] = "Errore di connessione al Database";
                }
            }   
            mysqli_close($conn);
        }

        
?>



<html>
    <head>
        <title>Signup</title>
 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="signup.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Noto+Sans:ital@1&family=Oswald&family=Poppins&family=Ubuntu:ital@1&display=swap" rel="stylesheet">
        <link rel="icon" href="img/logo.png" type="image/png" />
        
        <script src="signup.js" defer></script>
    </head>
 
    <body>

        <div class="overlay"></div>
        
        <section>

            <div id="logo">
                <a href="index.php"><img id="imglogo" src="img/logo&name.png"></a>
            </div>

            <h1>Registrati</h1>
            <div id="boxsignup" class="function">

            <p class='error'></p>

                
                <form name='signup' method='post'>
                   
                    <div class="name">
                        <div><label for='name'>Nome</label></div>
                        <div><input type='text' name='name' <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>></div>
                        
                    </div>
                    <div class="surname">
                        <div><label for='surname'>Cognome</label></div>
                        <div><input type='text' name='surname' <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?>></div>
                        
                    </div>
                </br>
                <div class="username">
                    <div><label for='username'>Nome utente</label></div>
                    <div><input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></div>
                    
                </div>
                <div class="email">
                    <div><label for='email'>Email</label></div>
                    <div><input type='text' name='email'<?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?> ></div>
                    
                </div>
                </br>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                    
                </div>
                <div class="confirm_password">
                    <div><label for='confirm_password'>Conferma Password</label></div>
                    <div><input type='password' name='confirm_password' <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>></div>
                    
                </div>

                </br>

                <div class="submit">
                    <input type='submit' value="Registrati" id="submit">
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
            </br>
            <div class="signup">Hai un account? <a href="login.php">Accedi</a>
    
        </section>


 
    </body>
 
</html>
