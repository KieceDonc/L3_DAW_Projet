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
    <link rel="stylesheet" href="../css/coursehome.css" />

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


    // GLOBAL VARIABLES

    $isAdmin = isAdmin($_GET['id']);
    $isStudent = isInCourse($_GET["id"]);


    // PRINTING THE PAGE

    printCourse();
    printSections();
    printButton();
    ?>

    <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
</body>

</html>


<!-- PHP FUNCTIONS -->

<?php

function printCourse()
{
    $name = getCourse();
    $b = "NONNNN";
    echo "<h1>" . $name . "</h1>";
}

function printSections()
{
    // Tells the user if he has taken this class or not.
    if(!$GLOBALS['isStudent'] && !$GLOBALS['isAdmin'])
        echo getTranslation(90);
    else
        if(!$GLOBALS['isAdmin'])
            echo getTranslation(91);

    // Show the sections.
    // TODO : Give access to links guiding to themes only if the user takes the class.
    $sections = getSections();
    foreach($sections as $section){
        echo "<div> Section " . $section["ord"] . " - " . $section["name"] ;

        // Adding ^ and v buttons for each sections, allowing reordering the sections
        if($GLOBALS['isAdmin']){
            echo "
            <span>
                <button id='upBtn' name='upBtn'>^</button>
                <button id='upBtn' name='upBtn'>v</button>
            </span>";
        }
        echo "</div>";
        printThemes($section["id"]);
    }
}

function printThemes($idsection){
    $themes = getThemes($idsection);
    foreach($themes as $theme){
        $icon = "<img src='../media/lesson.png' alt='lesson icon' class='icon'>";
        if($theme["type"]=="quizz")
            $icon = "<img src='../media/quizz.png' alt='quizz icon' class='icon'>";
        echo "<div class='theme'>" . $icon . "<span class='themelabel'> Theme " . $theme["ord"] . " - " . $theme["name"] . "</span></div>";
    }
}

function printButton(){
    if(!$GLOBALS['isAdmin'])
        return;
    else
        echo "<div><input type='text' id='newSectionTxt' name='newSectionTxt'><button id='addSectionBtn' name='addSectionBtn'>" . getTranslation(92) . "</button></input></div>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Something posted
  
    if (isset($_POST['btnDelete'])) {
      // btnDelete 
    } else {
      // Assume btnSubmit 
    }
  }

?>