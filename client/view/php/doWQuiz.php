<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>E-lolning</title>    
        <link rel="stylesheet" href="../css/font-face.css" />
        <link rel="stylesheet" href="../css/darkMode.css" />
        <link rel="stylesheet" href="../css/shared.css" />
        <link rel="stylesheet" href="../css/quiz.css" />
    </head>
    
    <body>
        
        <?php
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/coursehome.php");
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/coursesInfo.php");
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/Xml.php"); 
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/xml.php");
    
        
        $NumChapter = "0";
        $NumQuestion = 1;

        $xml = getXml($NumChapter);
        if($xml == false)
        {
            echo "<div>hello</div>";
        }
        $number = getCountXml($xml,$NumChapter);
        ?>

        <div class="quiz">
            <div id="info">
                <div id="chapter">Welcome Quiz </div>
            </div>
            <form action="FinishQW" method="get">
            <?php
                for($NumQuestion;$NumQuestion<=$number;$NumQuestion++){ 
            ?>
            <div class="question">
                <h1><?php echo getQuestion($xml,$NumQuestion,$NumChapter) ?></h1>
                <div class="choice">
                <div class="choice-container">
                        <p class="choice-prefix">A.</p>
                        <p class="choice-text" id="1" numberQ="<?php echo $NumQuestion; ?>"><?php echo getChoice($NumQuestion,$xml,'1',$NumChapter); ?></p>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">B.</p>
                        <p class="choice-text" id="2" numberQ="<?php echo $NumQuestion; ?>"><?php echo getChoice($NumQuestion,$xml,'2',$NumChapter); ?></p>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">C.</p>
                        <p class="choice-text" id="3" numberQ="<?php echo $NumQuestion; ?>"><?php echo getChoice($NumQuestion,$xml,'3',$NumChapter); ?></p>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">D.</p>
                        <p class="choice-text" id="4" numberQ="<?php echo $NumQuestion; ?>"><?php echo getChoice($NumQuestion,$xml,'4',$NumChapter); ?></p>
                    </div>
                    <div class="choice-container">
                        <p class="choice-valid">Choose a Answer :</p>
                        <input class="choice-input" name="<?php echo "choice".$NumQuestion ;?>" type="hidden" readonly="readonly" numberQ="<?php echo $NumQuestion; ?>" />
                    </div>
                </div>
            </div>
            <?php 
                }
            ?>
            <input type="submit" value = "Submit" class="SubmitBtn"/>    
            <input type="hidden" name="numchapter" class="tohidd" value=<?php echo $NumChapter ;?> /> 
            </form>
        </div>
        <script src="../../../../shared/js/jquery.js"></script>
        <script src="../js/shared.js"></script>
        <script src="../js/Quiz.js"></script>
    </body>
</html>