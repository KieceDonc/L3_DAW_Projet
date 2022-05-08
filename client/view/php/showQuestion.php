<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/showQ.css" />
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/darkMode.css" />
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
        $NumQuestion=1;

        $chemindossier =(realpath($_SERVER["DOCUMENT_ROOT"])."/quizxml/quiz".$NumChapter.".xml");

        if (simplexml_load_file($chemindossier)==false)
        {
            echo "<div>".$chemindossier." cant be open</div>";
        }
        else {
        $xml = simplexml_load_file($chemindossier);
        }

        $xml = simplexml_load_file($chemindossier);

        function supprimer($a,$NumChapter)
        {
            $xml = simplexml_load_file(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml");
            $tosupp = $xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$a}]");
            foreach($tosupp as $node)
            {
                unset($node[0]);
            }
            $xml->asXML(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml");
        }

        function reorgonize($NumChapter)
        {
            $xml = simplexml_load_file(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml");
            $number = $xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question");
            $number = count($number);

            $toreplace = $xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question");

            for($i=1;$i<=$number;$i++)
            {
                $toreplace[$i-1]['id']=$i;
            }

            $xml->asXML(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml");
        }

        if(isset($_GET['supprimer']))
        {
            supprimer($_GET["idQ"],$NumChapter);
            echo '<script type="text/javascript">window.location.href = "showQuestion.php?id={$NumChapter}";</script>';
        }

        reorgonize($NumChapter);

        $number = $xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question");
        $number = count($number);
        $RequestAnswer=$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$NumQuestion}]/reponse");

        echo "<div class='ChapterName'>Voici le quiz pour le chapitre : ";
        $array=$xml->xpath("//Questionnaire/@Nom");
        echo $array[0][0]."</div>";
        if($GLOBALS['isAdmin'])        
        {
        for($NumQuestion;$NumQuestion<=$number;$NumQuestion++)
        {
    ?>
        <div class = "question">
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
                        <a class="SuppBtn" href="showQuestion.php?id=<?php echo $NumChapter ?>supprimer=true&idQ=<?php echo $NumQuestion ?>">Supprimer la question</a>
                    </div>
                </div>
        </div>
        <div>
            <a href="addQuestion?id=<?php echo $NumChapter; ?>">Rajouter une question</a>
        </div>
            <?php 
                };
            }
            else 
            {
                echo "Dont have right to be here";
            }
            ?>
    </body>
</html>