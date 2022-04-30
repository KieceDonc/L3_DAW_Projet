<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Dashboard - E-lolning</title>

  <!-- CSS -->
  <link rel="stylesheet" href="../css/courseBuilder.css" />
  <link rel="stylesheet" href="../css/sharedAdmin.css" />
</head>

<body>
  <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/header.php"); ?>
  <div class="content">
    <form action=<?php echo "submitCourse?userid=" . $_SESSION[CONST_SESSION_USERID]?>  method="post">
      <div>Course name : <input type="text" id="nametxt" name="courseNameInput" /></p>
      <div>Course description : <input type="text" id="desctxt" name="courseDescInput" /></p>
      <p><input id="submitbtn" type="submit" value="OK" disabled="true"></p>
    </form>
  </div>

  <!-- JS -->
  <script src="../../../../shared/js/jquery.js"></script>
  <script src="../js/courseBuilder.js"></script>
</body>

</html>