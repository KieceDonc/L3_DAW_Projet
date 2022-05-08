<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");

function deleteContactDB($id){
    $conn = getPDO();

    // PREPARED QUERY - Delete infos in contact table
    $querystring = "DELETE FROM contact WHERE id=:id;";
    $query = $conn->prepare( $querystring );
    $query->bindParam('id',$id);
    $query->execute();

    closePDO($conn);
}

function getContactsDB(){
    $conn = getPDO();

    // PREPARED QUERY - Print infos about contact table
    $querystring = "SELECT * FROM contact";
    $query = $conn->prepare( $querystring );
    $query->execute();

    $res = $query->fetchAll();
    closePDO($conn);

    return $res;
}

function clearContactDB(){
    $conn = getPDO();

    // PREPARED QUERY - Clear all infos in contact table
    $querystring = "DELETE FROM contact";
    $query = $conn->prepare( $querystring );
    $query->execute();

    closePDO($conn);
}
?>