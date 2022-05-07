<?php
$choice1 = $_GET['choice1'];
$choice2 = $_GET['choice2'];
$choice3 = $_GET['choice3'];
$choice4 = $_GET['choice4'];

$id = $_GET["idchapter"];
$ques = $_GET["question"];
$Difficulty = $_GET["difficulté"];
$isok=true;
$Answer = $_GET["answer"];

if(simplexml_load_file(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$id.".xml"==true)
{
$xml = simplexml_load_file(($_SERVER["DOCUMENT_ROOT"])."/quizxml/quiz".$id.".xml");
$number = $xml->xpath("//Questionnaire[@chapitre={$id}]/question");
$number = count($number);

$Question = $xml->addChild("question","");
$Question->addAttribute("id",strval(++$number));

$Question->addChild("difficulte",$Difficulty);
$Question->addChild("intitule",$ques);

$choix1xml = $Question->addChild("choix",$choice1);
$choix1xml->addAttribute("id",1);

$choix2xml = $Question->addChild("choix",$choice2);
$choix2xml->addAttribute("id",2);

$choix3xml = $Question->addChild("choix",$choice3);
$choix3xml->addAttribute("id",3);

$choix4xml = $Question->addChild("choix",$choice4);
$choix4xml->addAttribute("id",4);

$Question->addChild("reponse",$Answer);

$xml->asXML($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$id.".xml");    
}

else {
    $isok=false;
}
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Quiz</title>    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="cssQuiz.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200&display=swap');
        </style>
    </head>
    <body>
        <div class="AddQuestion"> You have entered a question for the chapter <?php echo $id ."</div>";?>
        <a href="addQuestion.php?id=<?php echo $id; ?>">Re add question</a>

    </body>
</html>
