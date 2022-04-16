<?php

  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/const.php");
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/checkLogin.php");
  
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  if(isset($email) && isset($password)){
    
    if($email !== "" && $password !== ""){

      if(checkLogin($email,$password) == CONST_LOGGING_ACCEPTED){
        session_start();
        $_SESSION[CONST_SESSION_ISLOGGED] = CONST_SESSION_ISLOGGED_YES;
        $_SESSION[CONST_SESSION_EMAIL] = $email;
        
        header('Location: /');
      }else{
        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
      }
    }else{
      // utilisateur ou mot de passe vide
      echo "<p style='color:red'>Veuillez entrer un mot de passe et/ou un nom d'utilisateur</p>";
    }

  }else{
    echo "<p style='color:red'>Erreur inconnue</p>";
  }

  exit();

?>