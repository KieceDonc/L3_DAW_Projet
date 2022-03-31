<?php
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/mysqli.php");

  function checkLogin($email, $password){
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $mysqli = getMysqli();
    
    $password = mysqli_real_escape_string($mysqli,htmlspecialchars($password));
    $email    = mysqli_real_escape_string($mysqli,htmlspecialchars($email)); 

    $requete = "SELECT count(*),password FROM users where email = '".$email."'";
    $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
    $reponse = $result->fetch_assoc();
    $count = $reponse['count(*)'];
    
    mysqli_close($mysqli); // fermer la connexion

    if($count!=0){ 
      $hashed_password = $reponse['password'];
      if(password_verify($password, $hashed_password)){
        // nom d'utilisateur et mot de passe correctes
        return "ACCEPTED";
      }
    } 
    // utilisateur ou mot de passe incorrect
    return "INVALID";

    closeMysqli($mysqli);
  }
?>