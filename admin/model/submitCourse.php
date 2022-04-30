<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");

function addCourseInDB($name,$desc,$userid){
    $conn = getPDO();

    // PREPARED QUERY - Insert course in table
    $querystring = "INSERT INTO courses (idauthor,name,description) VALUES (:id,:n,:d)";
    $query = $conn->prepare( $querystring );
    $query->bindParam(':id',$userid);
    $query->bindParam(':n',$name);
    $query->bindParam(':d',$desc);
    $query->execute();
    closePDO($conn);
}
?>