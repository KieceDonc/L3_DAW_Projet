<?php 
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/model/submitCourse.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/submitCourse.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/fileInterface.php");
function addCourse($name,$desc,$id){
    $query = addCourseInDB($name,$desc,$id);
    $lastid = $query[0]['lastid'];
    createXML($lastid,$name);
    header("Location: /admin/courses");
}
?> 