<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");

    function getLanguageListDB(){
        $conn = getPDO();
        $request = $conn->prepare("SELECT count(*), id, name FROM languages GROUP BY name, id;");
        $request->execute();
        $answer = $request->fetchAll();
        closePDO($conn);

        if(count($answer) > 0){ 
            return $answer;
        } 

        return CONST_DB_UNKNOWN_ERROR;
    }

    function getTranslationDB($textId, $language) {
        $conn = getPDO();
        $request = $conn->prepare("SELECT count(*), text FROM texts WHERE textId=:textid AND lang=:lang GROUP BY text;");
        $request->bindValue(":textid", $textId);
        $request->bindValue(":lang", $language);
        $request->execute();
        $answer = $request->fetch(PDO::FETCH_ASSOC);
        closePDO($conn);

        if($answer["count(*)"] > 0){ 
            return $answer["text"];
        } 

        return CONST_DB_UNKNOWN_ERROR;
    }
?>