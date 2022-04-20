<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/model/courses.php");

    function getCourses(){
        //user is connected otherwise header would have already redirected to login form
        $userID = getUserID($_SESSION[CONST_SESSION_EMAIL]);
        return getCoursesDB($userID);
    } 
?>