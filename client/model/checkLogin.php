<?php
  session_start();
  if(isset($_SESSION['email']) && isset($_SESSION['password'])){
    // connexion à la base de données
    $db_username = 'php';
    $db_password = 'php_local';
    $db_name     = 'sys';
    $db_host     = 'localhost';


    $db          = mysqli_connect($db_host, $db_username, $db_password,$db_name) or die('could not connect to database');


    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $password = mysqli_real_escape_string($db,htmlspecialchars($_SESSION['password']));
    $email    = mysqli_real_escape_string($db,htmlspecialchars($_SESSION['email'])); 

    $requete = "SELECT count(*) FROM dev_users where email = '".$email."' and password = '".$password."' ";
    $result = mysqli_query($db,$requete,MYSQLI_STORE_RESULT);
    $reponse = $result->fetch_assoc();
    $count = $reponse['count(*)'];

    if($count!=0){ 
      // nom d'utilisateur et mot de passe correctes
      $_SESSION['loggedin'] = "ACCEPTED";
    }else{
      // utilisateur ou mot de passe incorrect
      $_SESSION['loggedin'] = "DENIED";
    }
    $_SESSION['loginCallback'] = true;

    mysqli_close($db); // fermer la connexion

    header("Location: ../controller/checkLogin.php");
    exit();
  }
?>