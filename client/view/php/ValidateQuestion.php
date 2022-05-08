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
$chemindossier =(realpath($_SERVER["DOCUMENT_ROOT"])."/quizxml/quiz".$id.".xml");
echo $id;
if(simplexml_load_file($chemindossier)==true)
{
echo "ok";
$xml = simplexml_load_file($chemindossier);
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

$xml->asXML($chemindossier);    
}

else {
    $isok=false;
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    
    <!-- CSS -->
	  <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/darkMode.css" />
  </head>
  <body>
	<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");?>
        <div>You have entered a question for the chapter <?php echo $id ."</div>";?>
        <a href="addQuestion?id=<?php echo $id; ?>">Re add question</a>
        </br>
        <a href="coursehome?id=<?php echo $id; ?>">Return to course</a>

    </body>
</html>
