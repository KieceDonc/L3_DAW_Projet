<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/si.css"/>
  </head>
  <body>
    
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/dev/betterRequire.php");
			betterRequire("/client/controller/checkLogin.php");
		}
		else
		{
			?>
			  <form method="POST">
				  <header>Connexion a votre compte</header>

				  <label>Email</label>
				  <input id="email" type="text" placeholder="Entrer l'email" name="email" required>

				  <label>Mot de passe</label>
				  <input id="password" type="password" placeholder="Entrer le mot de passe" name="password" required>

				  <input type="submit" id='submit' value='Connexion'>
				  <footer class="options">Pas inscrit? <a href="register.php">Créer un compte!</a></footer>
			  </form>
		<?php
		}
		?>
  </body>
</html>