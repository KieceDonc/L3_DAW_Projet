<?php 

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/Xml.php"); 
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/xml.php");

$NumChapter = $_GET["numchapter"];
$xml = GetXml($NumChapter);

$number = getCountXML($xml,$NumChapter);

$NiceAnswer = 0;

for($i = 1;$i<=$number;$i++)
{
    $RequestAnswer = getReponse($xml,$i,$NumChapter);

    if($_GET["choice{$i}"]==$RequestAnswer)
    {
        $NiceAnswer++;
    }
}

?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>E-lolning</title>    
        <link rel="stylesheet" href="../css/font-face.css" />
        <link rel="stylesheet" href="../css/shared.css" />
        <link rel="stylesheet" href="../css/font-face.css" />
        <link rel="stylesheet" href="../css/darkMode.css" />
    </head>
    <body>
         
    <?php 
        
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
    ?>

        <div class="chapter">You have ended the test</div>
        echo $NiceAnswer;
        <div class="Note"><?php if($NumChapter==53 ){echo getResultatBienvenue($NiceAnswer);}else{echo $NiceAnswer." on ".$number ;} ?></div>
        <a href="/courses">Go to courses</button>
        
        <script src="../../../../shared/js/jquery.js"></script>
        <script src="../js/shared.js"></script>
    </body>