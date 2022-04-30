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
    <form method="post">
      <div>Course name : <input type="text" id="namebtn" name="name" /></p>
      <div>Course description : <input type="text" id="descbtn" name="description" /></p>
      <p><input id="submitbtn" type="submit" value="OK" "></p>
    </form>
  </div>

  <!-- JS -->
  <script src="../../../../shared/js/jquery.js"></script>
  <script src="../js/courseBuilder.js"></script>
</body>

</html>