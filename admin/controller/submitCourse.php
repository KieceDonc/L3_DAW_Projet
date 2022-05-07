<?php 
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/model/submitCourse.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/submitCourse.php");
function addCourse($name,$desc,$id){
    $oui = addCourseInDB($name,$desc,$id);
    $stringXml = '<?xml version="1.0" encoding="UTF-8"?>
    <!DOCTYPE Questionnaire SYSTEM "quiz.dtd">
    <Questionnaire chapitre="idduchapter" Nom="nomduchapter"> 
    </Questionnaire>';
    header("Location: /admin/courses");
}
?> 