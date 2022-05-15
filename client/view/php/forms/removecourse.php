<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Submit - E-lolning</title>

    <!-- CSS -->
</head>

<body>
<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/coursehome.php");
?>

<?php 
    $courseId = $_POST['courseId'];
    echo $courseId;
    removeCourse($courseId);
    
    header("Location: /courses");
?>
</body>

</html>