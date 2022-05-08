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
    printAddQuizz();
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
        echo "<div> Section " . $section['ord'] . " - " . $section['name'] ;

        // Adding ^ and v buttons for each sections, allowing reordering the sections
        if($GLOBALS['isAdmin']){
            $isFirst = ($section['ord'] == 1) ? "disabled='true'" : "";
            $isLast = ($section['ord'] == count($sections)) ? "disabled='true'" : "";
            echo "<span>";
            echo "<form class='orderSectionForm' action='/forms/changeorder.php?direction=up&current=".$section['id']."&order=".$section['ord']."' method='post'><input type='submit' value='^' class='upBtn' name='upBtn' ". $isFirst ."></form>";
            echo "<form class='orderSectionForm' action='/forms/changeorder.php?direction=down&current=".$section['id']."&order=".$section['ord']."' method='post'><input type='submit' value='v' class='downBtn' name='downBtn' ". $isLast ."></form>";
            echo "<form class='orderSectionForm' action='addtheme.php?section=".$section['id']."&course=".$_GET['id']."&type=lesson' method='post'><input type='submit' value='+' class='addBtn' name='addBtn'></form>";
            echo "</span>";
        }
        echo "</div>";
        printThemes($section["id"]);
    }
}

function printThemes($idsection){
    $themes = getThemes($idsection);
    foreach($themes as $theme){
        $icon = "<img src='../media/lesson.png' alt='lesson icon' class='icon'>";
        echo "<div class='theme'>" . $icon . "<span class='spanTheme'> Theme " . $theme["ord"] . " - <a href='/theme?id=" . $theme["id"] . "&type=lesson' class='courselink'>" . $theme["name"] . "</a></span></div>";
        echo "</div>";
    }
}

function printButton(){
    if(!$GLOBALS['isAdmin'])
        return;
    else
        echo "<div><input type='text' id='newSectionTxt' name='newSectionTxt'><button id='addSectionBtn' name='addSectionBtn'>" . getTranslation(92) . "</button></input></div>";
}

function printAddQuizz(){
    if($GLOBALS['isAdmin'])
        echo "<a href='showQuestion?id={$_GET['id']}'>".getTranslation(94)."</a>";   // EDIT THE QUIZZ (admin)
    elseif($GLOBALS['isStudent'])
        echo "<a href='doQuiz?id={$_GET['id']}'>".getTranslation(95)."</a>";  // DO THE QUIZZ (student)
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