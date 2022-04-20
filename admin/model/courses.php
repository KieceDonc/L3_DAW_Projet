<?php

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
    
    function getCoursesDB($author){
        $conn = getPDO();

        // QUERY - Retrieve the name of the course, name of its author and description of course  :
        $courses = $conn->prepare("SELECT name, description FROM courses WHERE author=:id;");
        $courses->bindValue(":id", $author);
        closePDO($conn);

        return $courses->fetchAll();
    } 
?>