<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Changeorder - E-lolning</title>

    <!-- CSS -->
</head>

<body>
<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/coursehome.php");
?>

<?php
    swapOrder($_GET['direction'],$_GET['current'],$_GET['order']);
    header("Location: ".$_SERVER['HTTP_REFERER'])
?>
</body>

</html>