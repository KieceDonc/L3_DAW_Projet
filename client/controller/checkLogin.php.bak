<?php

  require_once("../model/checkLogin.php");
  
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  if(isset($email) && isset($password)){
    
    if($email !== "" && $password !== ""){
      // l'email et le mot de passe sont vérifiés
      // retourne ACCEPTED ou DENIED

      // On hash le pwd
      if(checkLogin($email,$password) == "ACCEPTED"){
        session_start();
        $_SESSION['loggedin'] = 'ACCEPTED';
        $_SESSION['email'] = $email;
        
        header('Location: ../view/php/index.php');
      }else{
        header('Location: ../view/php/login.php?error=DENIED');
      }
    }else{
      // utilisateur ou mot de passe vide
      header('Location: ../view/php/login.php?error=EMPTY');
    }

  }else{
    header('Location: ../view/php/login.php?error=PROCESSERROR');
  }

  exit();

?>