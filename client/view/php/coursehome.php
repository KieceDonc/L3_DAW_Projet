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
    printJoinButton();
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
    echo "<h1>" . $name . "</h1>";
}

function printJoinButton(){
    if(!isLogged() || $GLOBALS['isAdmin']){
        return;
    }
    if(!$GLOBALS['isStudent']){

        echo "<form action='/forms/studentCourse' method='post'><input type='submit' name='joinCourse' id='joinCourse' value='".getTranslation(109)."'>
        <input type='hidden' class='joins' name='joins' value='1'>
        <input type='hidden' class='userIdJoins' name='userIdJoins' value='".$_SESSION[CONST_SESSION_USERID]."'>
        <input class='courseIdJoins' name='courseIdJoins' type='hidden' value='".$_GET['id']."'></form>";
    }else{
    echo "<form action='/forms/studentCourse' method='post'><input type='submit' name='quitCourse' id='quitCourse' value='".getTranslation(110)."'>
    <input type='hidden' class='joins' name='joins' value='0'>
    <input type='hidden' class='userIdJoins' name='userIdJoins' value='".$_SESSION[CONST_SESSION_USERID]."'>
    <input class='courseIdJoins' name='courseIdJoins' type='hidden' value='".$_GET['id']."'></form>";
    }
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
    $sections = getSections();
    foreach($sections as $section){
        echo "<div>Section " . $section['ord'] . " - " . $section['name'] ;

        // Adding ^ and v buttons for each sections, allowing reordering the sections
        if($GLOBALS['isAdmin']){
            $isFirst = ($section['ord'] == 1) ? "disabled='true'" : "";
            $isLast = ($section['ord'] == count($sections)) ? "disabled='true'" : "";
            echo "<span>";
            echo "<form class='orderSectionForm' action='/forms/changeorder.php?direction=up&current=".$section['id']."&order=".$section['ord']."' method='post'><input type='submit' value='^' class='upBtn' name='upBtn' ". $isFirst ."></form>";
            echo "<form class='orderSectionForm' action='/forms/changeorder.php?direction=down&current=".$section['id']."&order=".$section['ord']."' method='post'><input type='submit' value='v' class='downBtn' name='downBtn' ". $isLast ."></form>";
            echo "<form class='orderSectionForm' action='addtheme.php?section=".$section['id']."&course=".$_GET['id']."&type=lesson' method='post'><input type='submit' value='+' class='addBtn' name='addBtn'></form>";
            echo "<form class='orderSectionForm' action='/forms/removesection' method='post'><input type='submit' value='-' class='delBtn' name='delBtn'><input type='hidden' value='".$section['id']."' name='deleteSectionId' id='deleteSectionId'></form>";
            echo "</span>";
        }
        echo "</div>";
        printThemes($section["id"]);
    }
}

function printThemes($idsection){
    $themes = getThemes($idsection);
    foreach($themes as $theme){
        $link = $theme["name"];
        if($GLOBALS['isStudent'] || $GLOBALS['isAdmin'])
            $link = "<a href='/theme?id=" . $theme["id"] . "&type=lesson' class='courselink'>" . $theme["name"] . "</a>";
        $icon = "<img src='../media/lesson.png' alt='lesson icon' class='icon'>";
        echo "<div class='theme'>" . $icon . "<span class='spanTheme'> Theme " . $theme["ord"] . " - ".$link."
        <form class='deleteTheme' action='/forms/removetheme' method='post'><input type='submit' value='-' class='delThemeBtn' name='delThemeBtn'><input type='hidden' value='".$theme['id']."' name='deleteThemeId' id='deleteThemeId'></form></span></div>";
        echo "</div>";
    }
}

function printButton(){
    if($GLOBALS['isAdmin']){
        echo "<form action='/forms/addsection' method='post'>
        <div><input type='text' id='newSectionTxt' name='newSectionTxt'>
        <input type='submit' id='addSectionBtn' name='addSectionBtn' value='" . getTranslation(92) . "'></div>
        <input id='courseId' name='courseId' type='hidden' value='".$_GET['id']."'>
        </form>";
    }
}

function printAddQuizz(){
    $icon = "<img src='../media/quizz.png' alt='quizz icon' class='icon'>";
    if($GLOBALS['isAdmin'])
        //echo "";   // EDIT THE QUIZZ (admin)
        echo "<div class='theme' id='quizz'>" . $icon . "<span class='spanTheme'> <a href='showQuestion?id={$_GET['id']}'>".getTranslation(94)."</a></span></div>";
    elseif($GLOBALS['isStudent'])
        echo "<div class='theme' id='quizz'>" . $icon . "<span class='spanTheme'> <a href='doQuiz?id={$_GET['id']}'>".getTranslation(95)."</a></span></div>";  // DO THE QUIZZ (student)
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