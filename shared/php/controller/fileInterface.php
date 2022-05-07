<?php

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/coursesInfo.php");
    

    // Returns true if user is in the course with the given id, else false.
    function createXML($id,$name){
        $path = realpath($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$id.".xml";
        $file = fopen($path, 'w'); // Open the file named quiz[IDCOURSE].xml - creates it since it doesn't exist
        $stringXML = 
'<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE Questionnaire SYSTEM "quiz.dtd">
<Questionnaire chapitre="'.$id.'" Nom="'.$name.'"> 
</Questionnaire>';
        fwrite($file, $stringXML); // Adds a string containing the xml path
        fclose($file);
    }
?>