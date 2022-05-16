<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
        <link rel="stylesheet" href="../css/darkMode.css" />
        <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/addQ.css" />
  </head>

  <body>
    <?php
     require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
     require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/coursehome.php");
     require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
     require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/coursesInfo.php");
 
     $isAdmin = isAdmin($_GET['id']);
     $isStudent = isInCourse($_GET["id"]);
     
     if($GLOBALS['isAdmin'])
     {
     ?>
    
        <div class="quiz">
            <form action="ValidateQuestion" method="get">
            <div class="question">
                <input id="chapter" name="idchapter" placeholder="Entrez l'id du chapitre" pattern="[1-9]" value="<?php echo $_GET['id']; ?>" type="hidden" readonly="readonly""/>
</br>
                <label><?php echo getTranslation(113)?></label>
                <input id="question" name="question" type=text/>
</br>
                <label><?php echo getTranslation(114)?> </label>
                <input id="Difficulty" name="difficulté" type=text  pattern="[1,2,3]" maxlength="1" />
</br>
                <label><?php echo getTranslation(115)?></label>
                <input id="GoodChoice" name="answer" type="text"  pattern="[1-4]" maxlength="1"/>
                <div class="choice">
                    <div class="choice-container">
                        <p class="choice-prefix">1.</p>
                        <input class="choice-text" id="1" type="text"  name="choice1"/>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">2.</p>
                        <input class="choice-text" id="2" type="text"  name="choice2"/>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">3.</p>
                        <input class="choice-text" id="3" type="text"  name="choice3"/>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">4.</p>
                        <input class="choice-text" id="4" type="text"  name="choice4"/>
                    </div>
                        <input class="choice-valid" id="validate" type="submit" value="<?php echo getTranslation(116)?>" />
                    
                </div>
            </div>
            </form>
        </div>
        <?php 
     }
     else
     {
         echo "<div>".getTranslation(117)."</div>";
     }
     ?>
     <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
    </body>
    <script src="../../../../shared/js/jquery.js"></script>
        <script src="../js/shared.js"></script>
</html> 