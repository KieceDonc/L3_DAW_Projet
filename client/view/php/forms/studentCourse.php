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
    $joins = boolval($_POST['joins']);
    $courseId = $_POST['courseIdJoins'];
    $userId = $_POST['userIdJoins'];
    echo $joins . "--" . $userId;
    if($joins)
        addTakes($userId,$courseId);
    else
        removeTakes($userId,$courseId);
?>
</body>

</html>