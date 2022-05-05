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
    <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");?>
    <div id="mainContainer">
        <div id="imgContainer">
            <img src="../media/contact.jpg" alt="Contact img">
        </div>
        <div id="contactContainer">
            <h1>
                <?php echo getTranslation(81); // Contact us ?>
            </h1>
            <p>
                <?php echo getTranslation(82); // Contact us about anything related to our company or services ?>
            </p>
            <p>
                <?php echo getTranslation(83); // We'll do our best to get back to you as soon as possible ?>
            </p>
            
            <form action="" method="get">
            <div>
                <label for="name"><?php echo getTranslation(84); // Your name * ?></label>
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                <label for="phone"><?php echo getTranslation(85); // Phone number ?></label>
                <input type="phone" name="phone">
            </div>
                <div>
                <label for="email"><?php echo getTranslation(86); // Email * ?></label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label for="subject"><?php echo getTranslation(87); // Subject * ?></label>
                <input type="subject" name="subject" required>
            </div>
            <div>
                <label for="question" style="vertical-align: middle;"><?php echo getTranslation(88); // Your question * ?></label>
                <textarea name="question" required></textarea>
            </div>
            <div>
                <label></label>
                <input id="submit" type="submit" name="submit" <?php echo "value='".getTranslation(89)."'"; // Send ?>>
            </div>
            </form>
        </div>
    </div>

    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/contact.php");

    $name = $_GET['name'];
    $phone = $_GET['phone'];
    $email = $_GET['email'];
    $subject = $_GET['subject'];
    $question = $_GET['question'];

    if(isset($_GET['submit']))
    {
        if(insertContactDB($name, $phone, $email, $subject, $question) == true)
        {
            echo "<script>alert(\"Message envoyé avec succès\")</script>";
            echo '<script>document.location.href="/client/view/php/index.php";</script>';
            //echo "<script>alert(\'".getTranslation()."'\)</script>";
        }
        else
        {
            echo "<script>alert(\"Le message n'a pas peu être envoyé\")</script>";
            //echo "<script>alert(\'".getTranslation()."'\)</script>";
        }
    }
    ?>

    <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
      
    <!-- JS -->
    <script src="../../../../shared/js/jquery.js"></script>
    <script src="../js/shared.js"></script>
  </body>
</html>