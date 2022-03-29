<?php

  require_once("../../admin/mysqli.php");

  function checkDataLogin($email, $password){
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $mysqli = getMysqli();
    
    $password = mysqli_real_escape_string($mysqli,htmlspecialchars($password));
    $email    = mysqli_real_escape_string($mysqli,htmlspecialchars($email)); 

    $requete = "SELECT count(*) FROM dev_users where email = '".$email."' and password = '".$password."' ";
    $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
    $reponse = $result->fetch_assoc();
    $count = $reponse['count(*)'];
    
    mysqli_close($mysqli); // fermer la connexion

    if($count!=0){ 
      // nom d'utilisateur et mot de passe correctes
      return "ACCEPTED";
    }else{
      // utilisateur ou mot de passe incorrect
      return "INVALID";
    }

    closeMysqli($mysqli);
  }


  function checkDataRegister(){

  }
?>