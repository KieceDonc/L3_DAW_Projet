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
$cheminfichier = ($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$id.".xml";

if(simplexml_load_file($cheminfichier)==true)
{
$xml = simplexml_load_file($cheminfichier);
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

$xml->asXML($cheminfichier);    
}

else {
    $isok=false;
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Dashboard - E-lolning</title>
    
    <!-- CSS -->
	<link rel="stylesheet" href="../css/sharedAdmin.css" />
    <link rel="stylesheet" href="../../client/view/css/font-face.css" />
    <link rel="stylesheet" href="../../client/view/css/darkMode.css" />
  </head>
  <body>
	<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/header.php");
    ?>
        <div class="AddQuestion"> You have entered a question for the chapter <?php echo $id ."</div>";?>
        <a href="addQuestion.php?id=<?php echo $id; ?>">Re add question</a>

    </body>
</html>
