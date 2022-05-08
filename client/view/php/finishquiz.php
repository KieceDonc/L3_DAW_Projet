<?php 



$NumChapter = $_GET["numchapter"];
$xml = simplexml_load_file(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml");

$number = $xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question");
$number = count($number);

$NiceAnswer = 0;

for($i = 1;$i<=$number;$i++)
{
    $RequestAnswer =$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$i}]/reponse");
    $RequestAnswer = $RequestAnswer[0][0];

    if($_GET["choice{$i}"]==$RequestAnswer)
    {
        $NiceAnswer++;
    }
}

?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Quiz</title>    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="cssQuiz.css">
        <link rel="stylesheet" href="../css/font-face.css" />
        <link rel="stylesheet" href="../css/shared.css" />
        <link rel="stylesheet" href="../css/forum.css" />
    </head>
    <body>
         
    <?php 
        
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
    ?>

        <div class="chapter">You have ended the test for the chapter <?php  $RequestAnswer =$xml->xpath("//Questionnaire/@Nom"); echo $RequestAnswer[0][0]; ?> </div>
        <div class="Note">You have <?php echo $NiceAnswer." on ".$number ; ?></div>
        <button>Go back</button>
        
        <script src="../../../../shared/js/jquery.js"></script>
        <script src="../js/shared.js"></script>
    </body>