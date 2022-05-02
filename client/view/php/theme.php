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
    <link rel="stylesheet" href="../css/theme.css" />

</head>

<body>
    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/theme.php");

    if($_GET['type'] = "lesson")
        printLesson();
    else
        printQuizz();

    ?>

    <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>

    <!-- JS -->
    <script src="../../../../shared/js/jquery.js"></script>
    <script src="../js/shared.js"></script>
    <script src="../js/lesson.js"></script>
</body>

</html>


<!-- PHP FUNCTIONS -->

<?php

function printLesson(){
    echo "<h1> LESSON </h1>";
    echo "<div id='lesson'>". (getContent($_GET['id'])) . "</div>";

}


function printQuizz(){
    echo "<h1> QUIZZ </h1>";
}

?>