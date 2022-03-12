<?php
session_start();
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
  
  if($email !== "" && $password !== ""){
    $requete = "SELECT count(*) FROM users where email = '".$email."' and password = '".$password."' ";
    $exec_requete = mysqli_query($db,$requete);
    $reponse      = mysqli_fetch_array($exec_requete);
    $count = $reponse['count(*)'];
    if($count!=0){ 
      // nom d'utilisateur et mot de passe correctes
      $_SESSION['email'] = $email;
      header('Location: index.html');
    }else{
      // utilisateur ou mot de passe incorrect
      header('Location: login.php?erreur');
    }
  }else{
    // utilisateur ou mot de passe vide
    header('Location: login.php?erreur'); 
  }
}else{
  header('Location: login.php');
}
mysqli_close($db); // fermer la connexion
?>