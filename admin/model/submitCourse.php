<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");

function addCourseInDB($name,$desc,$userid){
    $conn = getPDO();

    // PREPARED QUERY - Insert course in table and get the id of the inserted course.
    $querystring = "INSERT INTO courses (idauthor,name,description) VALUES (:id,:n,:d); ";
    $query = $conn->prepare( $querystring );
    $query->bindParam(':id',$userid);
    $query->bindParam(':n',$name);
    $query->bindParam(':d',$desc);
    $query->execute();

    $querystring = "SELECT LAST_INSERT_ID() AS lastid;";
    $query2 = $conn->prepare($querystring);
    $query2->execute();;

    closePDO($conn);

    return $query2->fetchAll();
}
?>