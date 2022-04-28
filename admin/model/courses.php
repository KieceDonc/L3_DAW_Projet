<?php

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
    
    function getCoursesDB($author){
        $conn = getPDO();

        // QUERY - Retrieve the name of the course
        $courses = $conn->prepare("SELECT name FROM courses WHERE idauthor=:id;");
        $courses->bindValue(":id", $author);
        $courses->execute();
        closePDO($conn);

        return $courses->fetchAll();
    } 
?>