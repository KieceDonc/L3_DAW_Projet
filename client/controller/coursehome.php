<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/coursehome.php");

    // Retrieves the course's name from the model
    function getCourse(){
        $id = $_GET["id"];
        $name = getCourseNameFromDB($id);
        return $name[0]["name"];
    }

    // Retrieves each sections from the corresponding course
    function getSections(){
        $id = $_GET["id"];
        $sections = getSectionsFromDB($id);
        return $sections;
    }
