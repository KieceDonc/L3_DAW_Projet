<?php
    
    // ---------------------- SQL FUNCTIONS

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");

    
    function getCourses(){
        $conn = getPDO();

        // QUERY - Retrieve the name of the course, name of its author and description of the course :
        $courses = $conn->query("SELECT name, username, description, courses.id FROM courses JOIN users u on courses.idauthor = u.id;");

        closePDO($conn);

        return $courses->fetchAll();
    }
?>