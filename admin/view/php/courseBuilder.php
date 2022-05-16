<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Dashboard - E-lolning</title>

  <!-- CSS -->
  <link rel="stylesheet" href="../css/courseBuilder.css" />
  <link rel="stylesheet" href="../css/sharedAdmin.css" />
  <link rel="stylesheet" href="../../client/view/css/font-face.css" />
  <link rel="stylesheet" href="../../client/view/css/darkMode.css" />
</head>

<body>
  <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/header.php"); 
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
  ?>
  
  <div class="content">
    <form action=<?php echo "submitCourse?userid=" . $_SESSION[CONST_SESSION_USERID]?>  method="post">
      <div><?php echo getTranslation(131); ?> <input type="text" id="nametxt" name="courseNameInput" /></p>
      <div><?php echo getTranslation(132); ?> <input type="text" id="desctxt" name="courseDescInput" /></p>
      <p><input id="submitbtn" type="submit" value="OK" disabled="true"></p>
    </form>
  </div>

  <!-- JS -->
  <script src="../../../../shared/js/jquery.js"></script>
  <script src="../js/courseBuilder.js"></script>
</body>

</html>