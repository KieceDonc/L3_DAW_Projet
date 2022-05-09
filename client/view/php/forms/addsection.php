<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Submit - E-lolning</title>

    <!-- CSS -->
</head>

<body>
<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/theme.php");
?>

<?php 
    $name = $_POST['lessonName'];
    $content = htmlspecialchars($_POST['lessonContent']);
    $sectionId = $_POST['sectionId'];
    addTheme($name,$content,$sectionId);
    $course = $_POST['courseId'];
    echo "NICE";
    header("Location: /coursehome?id=".$course);
?>
</body>

</html>