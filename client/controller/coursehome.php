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

     // Retrieves each themes from the corresponding section
     function getThemes($idsection){
        $themes = getThemesFromDB($idsection);
        return $themes;
    }

    // Swap the section's ord value with the following or previous one ($type = {up,down})
    function swapOrder($type,$section,$ord){
        swapOrderDB($type,$section,$ord);
    }
