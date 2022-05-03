<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Delete - E-lolning</title>

    <!-- CSS -->
</head>

<body>
<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/controller/mediaManager.php");
?>

<?php 
    $mid = $_POST['mediaId'];
    deleteMedia($mid);
    header("Location: /admin/mediaDisplay");

?>
</body>

</html>