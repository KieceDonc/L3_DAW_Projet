<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="./src/client/css/font-face.css" />
  </head>
  <body>
    <div id="container">
      <!-- zone de connexion -->
      
      <form action="../php/checklogin.php" method="POST">
          <h1>Connexion</h1>
          
          <label><b>Email</b></label>
          <input type="text" placeholder="Entrer l'email'" name="email" required>

          <label><b>Mot de passe</b></label>
          <input type="password" placeholder="Entrer le mot de passe" name="password" required>

          <input type="submit" id='submit' value='login' >
          <?php
          if(isset($_GET['erreur'])){
            $err = $_GET['erreur'];
            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
          }
          ?>
      </form>
    </div>
    <!-- JS -->
    <script src="./src/client/js/login.js"></script>
  </body>
</html>