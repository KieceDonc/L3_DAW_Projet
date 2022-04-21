<?php     
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
?>

<!DOCTYPE html>
<html lang="<?php echo getLangCode(); ?>">
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
				  <header><?php echo getTranslation(24); ?></header>

				  <label><?php echo getTranslation(25); ?></label>
				  <input id="email" type="text" placeholder="<?php echo getTranslation(26); ?>" name="email" required>

				  <label><?php echo getTranslation(37); ?></label>
				  <input id="password" type="password" placeholder="<?php echo getTranslation(27); ?>" name="password" required>

				  <input type="submit" id='submit' value='<?php echo getTranslation(24); ?>'>
				  <footer class="options"><?php echo getTranslation(28); ?><a href="register.php"><?php echo getTranslation(29); ?></a></footer>
			  </form>
		<?php
		}
		?>
  </body>
</html>