<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Test Hugo</title>    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="showquiz.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200&display=swap');
        </style>
    </head>
    
    <body>
    <?php 
        
        $NumChapter = $_GET['id'];
        $NumQuestion=1;

        $xml = simplexml_load_file(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml");
        echo $NumChapter;


        function supprimer($a,$NumChapter)
        {
            $xml = simplexml_load_file(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml");
            $tosupp = $xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$a}]");
            foreach($tosupp as $node)
            {
                unset($node[0]);
            }
            $xml->asXML("quiz.xml");
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

            $xml->asXML("quiz.xml");
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
            <?php 
                };
            ?>
        <div>
            <a href="addQuestion.php?id=<?php echo $NumChapter; ?>">Rajouter une question</a>
        </div>
    </body>
</html>