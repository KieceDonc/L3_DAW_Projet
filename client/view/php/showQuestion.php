<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    
    <!-- CSS -->
    
    <link rel="stylesheet" href="../css/font-face.css" />
        <link rel="stylesheet" href="../css/darkMode.css" />
        <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/showQ.css" />
  </head>
  <body>
      <div class="showQ">
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

        echo "<div class='ChapterName'>".getTranslation(123).getName($xml)."</div>";
        if($GLOBALS['isAdmin'])        
        {
        for($NumQuestion;$NumQuestion<=$number;$NumQuestion++)
        {
    ?>
        <div class = "question">
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
                        <p class="choice-prefix"><?php echo getTranslation(126)?></p>
                        <p class="choice-text" id="5" numberQ="<?php echo $NumQuestion; ?>"><?php echo getReponse($xml,$NumQuestion,$NumChapter); ?></p>
                    </div>
                    <div class="choice-container">
                        <a class="SuppBtn" href="showQuestion.php?id=<?php echo $NumChapter ?>&supprimer=true&idQ=<?php echo $NumQuestion ?>"><?php echo getTranslation(122)?></a>
                    </div>
                </div>
        </div>
            <?php 
            };?>
            <div>
            <a style="color:black" href="addQuestion?id=<?php echo $NumChapter; ?>"><?php echo getTranslation(121)?></a>
            </div>
            <?php
            }
            else 
            {
                echo getTranslation(117);
            }
            ?>
            <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
        </div>
    </body>
    <script src="../../../../shared/js/jquery.js"></script>
        <script src="../js/shared.js"></script>
</html>