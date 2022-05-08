<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
?>

<!DOCTYPE html>
<html lang="<?php echo getLangCode(); ?>">

<head>
  <meta charset="UTF-8" />
  <title>E-lolning <?php echo getTranslation(3); ?></title>

  <!-- CSS -->
  <link rel="stylesheet" href="../css/font-face.css" />
  <link rel="stylesheet" href="../css/shared.css" />
  <link rel="stylesheet" href="../css/addtheme.css" />

  <!-- JS -->
  <script src="../../../../shared/js/jquery.js"></script>
  <script src="../js/shared.js"></script>
</head>

<body>
  <?php
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/theme.php");
  ?>

  <?php
  echo "<form action='/forms/submitlesson' method='post'>
    
    <label for='lessonName'>Name :</label>
      <div id='nameDiv'>
        <input type='text' id='lessonName' name='lessonName'></br>
      </div>
    <label for='lessonContent'>Type your lesson :</label>
    <div id='lessonDiv'>
      <textarea id='lessonContent' name='lessonContent'></textarea>
    </div>
    <input id='submitBtn' name='submitBtn' type='submit' value='Submit your lesson'>
    <input id='sectionId' name='sectionId' type='hidden' value='" . $_GET['section'] . "'>
    <input id='courseId' name='courseId' type='hidden' value='" . $_GET['course'] . "'>
    </form>
    <ul>
      <li>" . getTranslation(96) . "</li>
      <li>" . getTranslation(97) . "</li>
      <li>" . getTranslation(98) . "</li>
    </ul>"
  ?>

  <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
</body>

</html>


<!-- PHP FUNCTIONS -->

<?php

?>