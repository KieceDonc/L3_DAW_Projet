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
    <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/contact.css" />
  </head>
  <body>
    <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php"); ?>
    <div id="mainContainer">
        <div id="imgContainer">
            <img src="../media/contact.jpg" alt="Contact img">
        </div>
        <div id="contactContainer">
            <h1>
                Contact us
            </h1>
            <p>
                Contact us about anything related to our company or services
            </p>
            <p>
                We'll do our best to get back to you as soon as possible
            </p>
            
            <form action="" method="get">
            <div>
                <label for="name">Your name *</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                <label for="phone">Phone number</label>
                <input type="phone" name="phone">
            </div>
                <div>
                <label for="email">Email *</label>
                <input type="phone" name="phone">
            </div>
            <div>
                <label for="subject">Subject *</label>
                <input type="subject" name="subject">
            </div>
            <div>
                <label for="question">Your question *</label>
                <input type="question" name="question">
            </div>
            <div>
                <label></label>
                <input id="submit" type="submit" value="Send">
            </div>
            </form>
        </div>
    </div>
    <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
      
    <!-- JS -->
    <script src="../../../../shared/js/jquery.js"></script>
    <script src="../js/shared.js"></script>
  </body>
</html>