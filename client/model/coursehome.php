<?php
    
    // ---------------------- SQL FUNCTIONS

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");

    
    function getCourseNameFromDB($id){
        $conn = getPDO();

        // QUERY - Retrieve the name of the course
        $name = $conn->query("SELECT name FROM courses WHERE id=".$id );

        closePDO($conn);
    

        return $name->fetchAll();
    }
?>