<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/showQ.css" />
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/darkMode.css" />
  </head>
  <body>
	<?php 
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/coursehome.php");
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/coursesInfo.php");
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/Xml.php"); 
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/xml.php");

        $isAdmin = isAdmin($_GET['id']);
        $isStudent = isInCourse($_GET["id"]);

        $NumChapter = $_GET['id'];
        $NumQuestion=1;


        $xml = getXml($NumChapter);

        if(isset($_GET['supprimer']))
        {
            supprimer($_GET["idQ"],$NumChapter);
            echo '<script type="text/javascript">window.location.href = "showQuestion.php?id='.$NumChapter.'";</script>';
        }
        reorgonize($NumChapter);

        $number = getCountXML($xml,$NumChapter);

        echo "<div class='ChapterName'>There is the quiz for the course : ".getName($xml)."</div>";
        if($GLOBALS['isAdmin'])        
        {
        for($NumQuestion;$NumQuestion<=$number;$NumQuestion++)
        {
    ?>
        <div class = "question">
        <h1><?php echo "Question  : ".getQuestion($xml,$NumQuestion,$NumChapter) ?></h1>
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
                        <p class="choice-prefix">Reponse.</p>
                        <p class="choice-text" id="5" numberQ="<?php echo $NumQuestion; ?>"><?php echo getReponse($xml,$NumQuestion,$NumChapter); ?></p>
                    </div>
                    <div class="choice-container">
                        <a class="SuppBtn" href="showQuestion.php?id=<?php echo $NumChapter ?>&supprimer=true&idQ=<?php echo $NumQuestion ?>">Supprimer la question</a>
                    </div>
                </div>
        </div>
            <?php 
            };?>
            <div>
            <a href="addQuestion?id=<?php echo $NumChapter; ?>">Add Question</a>
            </div>
            <?php
            }
            else 
            {
                echo "Dont have right to be here";
            }
            ?>
    </body>
</html>