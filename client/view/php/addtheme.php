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
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/addtheme.php");
  ?>

  <h1>Add a theme:</h1>

  <?php
    echo "<form >"
  ?>

  <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
</body>

</html>


<!-- PHP FUNCTIONS -->

<?php

?>