<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>E-lolning</title>    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/font-face.css" />
        <link rel="stylesheet" href="../css/shared.css" />
        <link rel="stylesheet" href="../css/font-face.css" />
        <link rel="stylesheet" href="../css/darkMode.css" />
        <link rel="stylesheet" href="../css/shared.css" />
    </head>
    
    <body>
        
        <?php
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/coursehome.php");
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/coursesInfo.php");

    
        $isAdmin = isAdmin($_GET['id']);
        $isStudent = isInCourse($_GET["id"]);
        
        $NumChapter = $_GET['id'];
        $NumQuestion = 1;

        $xml = simplexml_load_file(realpath(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml"));

        $number = $xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question");
        $number = count($number);
        $RequestAnswer =$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$NumQuestion}]/reponse");
        ?>
        <div class="quiz">
            <div id="info">
                <div id="chapter">Chapitre <?php echo $NumChapter." : "; $array=$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/@Nom"); echo $array[0][0] ?></div>
            </div>
            <form action="finishquiz" method="get">
            <?php
            if($GLOBALS['isStudent'])
            {
                for($NumQuestion;$NumQuestion<=$number;$NumQuestion++){ 
            ?>
            <div class="question">
                <h1><?php $array=$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$NumQuestion}]/intitule");echo $array[0][0] ?></h1>
                <div class="choice">
                    <div class="choice-container">
                        <p class="choice-prefix">A.</p>
                        <p class="choice-text" id="1" numberQ="<?php echo $NumQuestion; ?>"><?php $array=$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$NumQuestion}]/choix[@id='1']");echo $array[0][0] ?></p>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">B.</p>
                        <p class="choice-text" id="2" numberQ="<?php echo $NumQuestion; ?>"><?php $array=$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$NumQuestion}]/choix[@id='2']");echo $array[0][0] ?></p>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">C.</p>
                        <p class="choice-text" id="3" numberQ="<?php echo $NumQuestion; ?>"><?php $array=$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$NumQuestion}]/choix[@id='3']");echo $array[0][0] ?></p>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">D.</p>
                        <p class="choice-text" id="4" numberQ="<?php echo $NumQuestion; ?>"><?php $array=$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$NumQuestion}]/choix[@id='4']");echo $array[0][0] ?></p>
                    </div>
                    <div class="choice-container">
                        <p class="choice-valid">Choose a Answer :</p>
                        <input class="choice-input" name="<?php echo "choice".$NumQuestion ;?>" type="hidden" readonly="readonly" numberQ="<?php echo $NumQuestion; ?>" />
                    </div>
                </div>
            </div>
            <?php 
                };
            ?>
            <input type="submit" value = "Submit" class="SubmitBtn"/>    
            <input type="hidden" name="numchapter" class="tohidd" value=<?php echo $NumChapter ;?> /> 
            </form>
            <?php 
            };
            ?>
        </div>
        <script src="../../../../shared/js/jquery.js"></script>
        <script src="../js/shared.js"></script>
        <script src="../js/Quiz.js"></script>
    </body>
</html>