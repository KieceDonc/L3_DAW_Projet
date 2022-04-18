<?php
    
    // ---------------------- SQL FUNCTIONS

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/model/mysqli.php");

    
    function getCourses(){
        $mysqli = getMysqli();
        
        // QUERY - Retrieve the name of the course, name of its author and description of the course :
        $query = "SELECT name , username , description FROM courses JOIN users u on courses.idauthor = u.id;"; 
        $courses = $mysqli -> query( $query , MYSQLI_STORE_RESULT );

        closeMysqli( $mysqli );

        return $courses->fetch_all( MYSQLI_ASSOC );
    } 
?>