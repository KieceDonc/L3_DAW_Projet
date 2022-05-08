<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    
    function GetXml($id)
    {
        $chemindossier =(realpath($_SERVER["DOCUMENT_ROOT"])."/quizxml/quiz".$id.".xml");
        $xml = simplexml_load_file($chemindossier);
        return $xml;
    }
?>

