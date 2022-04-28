<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
?>

<!DOCTYPE html>
<html lang="<?php echo getLangCode(); ?>">

<head>
    <meta charset="UTF-8" />
    <title>E-lolning <?php echo getTranslation(3); ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/courses.css" />

    <!-- JS -->
    <script src="../../../../shared/js/jquery.js"></script>
    <script src="../js/shared.js"></script>
</head>

<body>
    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/coursehome.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/coursesInfo.php");

    printCourse();
    printSections();
    ?>

    <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
</body>

</html>


<!-- PHP FUNCTIONS -->

<?php

function printCourse()
{
    $name = getCourse();
    echo "<h1> NOM COURS : " . $name . "</h1>";
}

function printSections()
{
    // Tells the user if he has taken this class or not.
    if(!isInCourse($_GET["id"]))
        echo getTranslation(90);
    else
        echo getTranslation(91);

    // Show the sections.
    // TODO : Give access to links guiding to themes only if the user takes the class.
    $sections = getSections();
    foreach($sections as $section){
        echo "<div> Section " . $section["ord"] . " - " . $section["name"] . "</div>";
    }
}

?>