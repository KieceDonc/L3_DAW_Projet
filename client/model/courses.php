<?php
    
    // ---------------------- SQL FUNCTIONS

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/model/pdo.php");

    
    function getCourses(){
        $conn = getPDO();
        
        // QUERY - Retrieve the name of the course, name of its author and description of the course :
        $query = "SELECT name , username , description FROM courses JOIN users u on courses.idauthor = u.id;"; 
        $courses = $conn->prepare( $query)->execute();

        closePDO($conn);

        return $courses->fetchAll();
    } 
?>