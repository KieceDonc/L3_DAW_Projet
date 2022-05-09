<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    
    function GetXml($id)
    {

        $chemindossier =(realpath($_SERVER["DOCUMENT_ROOT"])."/quizxml/quiz".$id.".xml");
        if($xml = simplexml_load_file($chemindossier)==true)
        {
            return $xml;
        }
        else
        {
            echo "Impossible to open";
        }
    }

    function getBienvenueXml()
    {
        $chemindossier =(realpath($_SERVER["DOCUMENT_ROOT"])."/quizxml/quiz.xml");
        $xml = simplexml_load_file($chemindossier);
        return $xml;
    }
?>

