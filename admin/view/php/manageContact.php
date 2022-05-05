<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Dashboard - E-lolning</title>

  <!-- CSS -->
  <link rel="stylesheet" href="../css/contact.css" />
  <link rel="stylesheet" href="../css/sharedAdmin.css" />
  <link rel="stylesheet" href="../../client/view/css/font-face.css" />
  <link rel="stylesheet" href="../../client/view/css/darkMode.css" />
</head>

<body>
    <?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/header.php"); 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/model/contact.php");
    printContactDB();
    ?>

    <div class="content">
    <form action="" method="get">
    <div> 
        <label for="name">Nom : </label>
        <input type="text" name="name" id="name" required>
    </div> 
    <div> 
        <label for="subject">Sujet :</label>
        <input type="subject" name="subject" required>
    </div> 
    <div> 
        <label></label>
        <input id="submit" type="submit" name="del" value="Supprimer une ligne">
    </div> 
    </form>
    </div>

    <?php
    $name = $_GET['name'];
    $subject = $_GET['subject'];

    if(isset($_GET['del']))
    {
        deleteTableFromContactDB($name, $subject);
    }
    ?>

    <!-- JS -->
    <script src="../../../../shared/js/jquery.js"></script>
</body>

</html>