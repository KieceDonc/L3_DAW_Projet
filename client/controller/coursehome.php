<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/coursehome.php");

    function getCourse($id){
        //$id = $_GET["id"];
        $name = getCourseNameFromDB($id);
        //echo "<h1> QUery2 : " . print_r($name->fetchAll()) . "</h1>";
        return $name[0]["name"];
    }
?>