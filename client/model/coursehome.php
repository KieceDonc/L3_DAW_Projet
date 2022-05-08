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

        // PREPARED QUERY - Retrieve each theme from the course
        $querystring = "SELECT themes.id AS id, themes.name AS name, themes.ord AS ord
                        FROM themes JOIN sections on themes.idsection = sections.id
                        WHERE sections.id=:id
                        ORDER BY ord ASC";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':id',$id);
        $query->execute();
        closePDO($conn);

        return $query->fetchAll();
    }

    function swapOrderDB($type,$idSection1,$ord){
        $conn = getPDO();

        // PREPARED QUERY - Get id of section to swap with
        $querystring = "SELECT sections.id AS id
        FROM courses JOIN sections on courses.id = sections.idcourse
        WHERE courses.id = (SELECT courses.id FROM courses JOIN sections ON courses.id = sections.idcourse WHERE sections.id=:id) AND sections.ord = :ord";

        $query = $conn->prepare( $querystring );
        $query->bindParam(':id',$idSection1);
        $ordQuery = $type == "up" ? $ord-1 : $ord+1;
        $query->bindParam(':ord',$ordQuery);
        $query->execute();
        $idSection2 = $query->fetchAll()[0]['id'];

        // PREPARED QUERY - Swap the order values from both sections
        $querystring = "UPDATE sections SET ord=:ord1 WHERE id=:id1 ; UPDATE sections SET ord=:ord2 WHERE id=:id2 ;";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':id1',$idSection1);
        $query->bindParam(':id2',$idSection2);
        $query->bindParam(':ord1',$ordQuery);
        $query->bindParam(':ord2',$ord);

        $query->execute();

        closePDO($conn);
    }
?>