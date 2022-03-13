<?php
  header("Content-type: text/xml; charset=utf-8");

  if(isset($_POST['email']) && isset($_POST['password'])){
    // connexion à la base de données
    $db_username = 'php';
    $db_password = 'php_local';
    $db_name     = 'sys';
    $db_host     = 'localhost';
    $db          = mysqli_connect($db_host, $db_username, $db_password,$db_name) or die('could not connect to database');


    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    $email    = mysqli_real_escape_string($db,htmlspecialchars($_POST['email'])); 

    $requete = "SELECT count(*) FROM dev_users where email = '".$email."' and password = '".$password."' ";
    $result = mysqli_query($db,$requete,MYSQLI_STORE_RESULT);
    $reponse = $result->fetch_assoc();
    $count = $reponse['count(*)'];

    if($count!=0){ 
      // nom d'utilisateur et mot de passe correctes
      echo "<?xml   version='1.0' encoding='utf-8'?><Root><result>PASS</result></Root>";
    }else{
      // utilisateur ou mot de passe incorrect
      echo "<?xml version='1.0' encoding='utf-8'?><Root><result>DENIED</result></Root>";
    }

    mysqli_close($db); // fermer la connexion
  }
?>