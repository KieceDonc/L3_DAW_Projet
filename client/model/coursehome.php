<?php
    
    // ---------------------- SQL FUNCTIONS

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");

    function getCourseNameFromDB($id){
        $conn = getPDO();

        // PREPARED QUERY - Retrieve the name of the course
        $querystring = "SELECT name 
                        FROM courses 
                        WHERE id=:id";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':id',$id);
        $query->execute();
        closePDO($conn);

        return $query->fetchAll();
    }

    function getSectionsFromDB($id){
        $conn = getPDO();

        // PREPARED QUERY - Retrieve each section from the course
        $querystring = "SELECT sections.name AS name, sections.id AS id, ord
                        FROM courses JOIN sections on courses.id = sections.idcourse
                        WHERE courses.id=:id
                        ORDER BY ord ASC";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':id',$id);
        $query->execute();
        closePDO($conn);

        return $query->fetchAll();
    }

    function getThemesFromDB($id){
        $conn = getPDO();

        // PREPARED QUERY - Retrieve each section from the course
        $querystring = "SELECT themes.id AS id, themes.name AS name, themes.ord AS ord, themes.type AS type
                        FROM themes JOIN sections on themes.idsection = sections.id
                        WHERE sections.id=:id
                        ORDER BY ord ASC";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':id',$id);
        $query->execute();
        closePDO($conn);

        return $query->fetchAll();
    }
?>