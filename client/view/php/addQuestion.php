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
                <label>Enter Question</label>
                <input id="question" name="question" type=text placeholder="Enter question"/>
</br>
                <label>Enter difficulty </label>
                <input id="Difficulty" name="difficulté" type=text placeholder="Enter difficulty" pattern="[1,2,3]" maxlength="1" />
</br>
                <label>Enter good choice</label>
                <input id="GoodChoice" name="answer" type="text" placeholder="Enter good choice" pattern="[1-4]" maxlength="1"/>
                <div class="choice">
                    <div class="choice-container">
                        <p class="choice-prefix">1.</p>
                        <input class="choice-text" id="1" type="text" placeholder="Enter choice 1" name="choice1"/>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">2.</p>
                        <input class="choice-text" id="2" type="text" placeholder="Enter choice 2" name="choice2"/>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">3.</p>
                        <input class="choice-text" id="3" type="text" placeholder="Enter choice 3" name="choice3"/>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">4.</p>
                        <input class="choice-text" id="4" type="text" placeholder="Enter choice 4" name="choice4"/>
                    </div>
                        <input class="choice-valid" id="validate" type="submit" value="Submit" />
                    
                </div>
            </div>
            </form>
        </div>
        <?php 
     }
     else
     {
         echo "<div>dont have permission to be here</div>";
     }
     ?>
     <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
    </body>
    <script src="../js/shared.js"></script>
</html> 