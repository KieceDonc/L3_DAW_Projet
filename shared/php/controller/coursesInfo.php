<?php

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/coursesInfo.php");
    

    // Returns true if user is in the course with the given id, else false.
    function isInCourse($idcourse){
        if(!isLogged())
            return false;
        $isInCourse = isInCourseDB($_SESSION[CONST_SESSION_USERID],$idcourse);
        return boolval($isInCourse[0]['takescourse']);
    }
?>