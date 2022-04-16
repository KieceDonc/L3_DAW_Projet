<?php
    
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/mysqli.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/mysqli.php");
    
    function getForumTopics(){
        $mysqli = getMysqli();

        $requete = "SELECT * FROM topics;";
        $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);

        closeMysqli($mysqli);

        return $result->fetch_all(MYSQLI_ASSOC);
    } 
?>