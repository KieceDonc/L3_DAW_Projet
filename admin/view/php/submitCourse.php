<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Submit - E-lolning</title>

    <!-- CSS -->
</head>

<body>
<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/controller/submitCourse.php");
?>

<?php 
    $name = $_POST["courseNameInput"];
    $desc = $_POST["courseDescInput"];
    $id = $_GET["userid"];
    addCourse($name,$desc,$id);
?>
</body>

</html>