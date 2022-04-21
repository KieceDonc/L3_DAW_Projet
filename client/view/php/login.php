<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/login.css"/>
  </head>
  <body>
    
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/checkLogin.php");
		}
		else
		{
			?>
			  <form method="POST">
				  <header>Login</header>

				  <label>Email</label>
				  <input id="email" type="text" placeholder="Enter your email" name="email" required>

				  <label>Password</label>
				  <input id="password" type="password" placeholder="Enter your password" name="password" required>

				  <input type="submit" id='submit' value='Log in'>
				  <footer class="options">Not registered ? <a href="register.php">Create an account !</a></footer>
			  </form>
		<?php
		}
		?>
  </body>
</html>