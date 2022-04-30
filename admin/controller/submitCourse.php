<?php 
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/model/submitCourse.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/submitCourse.php");
function addCourse($name,$desc,$id){
    echo "<div>Name : " . $name . "</div>" . "<div>Desc : " . $desc . "</div>" . "<div>Id : " . $id . "</div>" ;
    addCourseInDB($name,$desc,$id);
    header("Location: /admin/courses");
}
?> 