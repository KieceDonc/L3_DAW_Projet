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
    $courseId = $_POST['courseId'];
    $content = htmlspecialchars($_POST['newSectionTxt']);
    addSection($content,$sectionId);

    header("Location: /coursehome?id=".$courseId);
?>
</body>

</html>