<?php
  if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if($email !== "" && $password !== ""){
      $url = realpath("../model/checkLogin.php?email=$email&password=$password");
      $xml = simplexml_load_file($xml) or die("feed not loading");
      $result = $xml->result;
      
      if($result == "PASS"){
        // l'email et le mot de passe sont vérifiés
        session_start();
        $_SESSION['hasStarted'] = yes;
        $_SESSION['email'] = $email;
        header('Location: ../view/php/index.php');
      }else{
        // l'email et/ou le mot de passe est/sont invalide/s
        header('Location: ../view/php/login.php?error=invalid');
      }
    }else{
      // utilisateur ou mot de passe vide
      header('Location: ../view/php/login.php?error=empty'); 
    }
    
  }else{
    header('Location: ../view/php/login.php');
  }
?>