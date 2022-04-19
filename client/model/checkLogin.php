<?php

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/config.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/const.php");

  function checkLogin($email, $password){
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
      try
      {
          $conn = new PDO('mysql:'.DB_SERVER.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USERNAME, DB_PASSWORD);

          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
          echo "Erreur de connection: " . $e->getMessage();
      }

    //$password = mysqli_real_escape_string($conn,htmlspecialchars($password));
    //$email    = mysqli_real_escape_string($conn,htmlspecialchars($email));


      // prepare sql and bind parameters

      $stmt = $conn->prepare("SELECT password,count(*) FROM ".DB_NAME.".users where LOWER(email) = :email GROUP BY email");
      $stmt->execute(['email'=>$email]);
      $reponse = $stmt->fetch(PDO::FETCH_ASSOC);
      $count = $reponse['count(*)'];




    if($count!=0){
      $hashed_password = $reponse['password'];
      if(password_verify($password, $hashed_password)){
        // nom d'utilisateur et mot de passe correctes(UPDATE Last connection)
          $sql = "UPDATE ".DB_NAME.".users SET lastconnection = :lastconnection WHERE LOWER(email) = :email";
          $stmt= $conn->prepare($sql);
          $lastconnection = date("Y-m-d H:i:s");
          $stmt->execute(['lastconnection'=>$lastconnection,'email'=>$email]);

          $conn=null; // fermer la connexion
        return CONST_LOGGING_ACCEPTED;
      }
    }

      $conn=null; // fermer la connexion
    // utilisateur ou mot de passe incorrect
    return CONST_LOGGING_INVALID;
  }
?>