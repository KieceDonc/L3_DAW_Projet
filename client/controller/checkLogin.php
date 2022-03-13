<?php
  session_start(); 

  if(isset($_SESSION['loginCallback'])){
    if($_SESSION['loginCallback']){
      $_SESSION['loginCallback'] = false;
      if($_SESSION['loginResult'] == 'ACCEPTED'){
        // l'email et le mot de passe sont vérifiés
        header('Location: ../view/php/index.php');
        exit();
      }else{
        // l'email et/ou le mot de passe est/sont invalide/s
        header('Location: ../view/php/login.php?error=invalid');
        exit();
      }
    }
  }

  if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if($email !== "" && $password !== ""){
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
      header("Location: ../model/checkLogin.php");
      exit();

    }else{
      // utilisateur ou mot de passe vide
      header('Location: ../view/php/login.php?error=empty'); 
      exit();

    }
    
  }else{
    header('Location: ../view/php/login.php');
    exit();

  }
?>