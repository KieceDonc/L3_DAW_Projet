<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");

function getContentDB($id){
    $conn = getPDO();

    // PREPARED QUERY - Retrieve the content of the theme
    $querystring = "SELECT content FROM themes WHERE id=:id";
    $query = $conn->prepare( $querystring );
    $query->bindParam(':id',$id);
    $query->execute();
    closePDO($conn);

    return $query->fetchAll();
}

function addThemeDB($name,$content,$sectionId){
    $conn = getPDO();

    // PREPARED QUERY - Check if it's the first entry in the section or not. 
    $querystring = "SELECT EXISTS(SELECT * FROM themes WHERE idsection=:idsection) AS isfirst";
    $query = $conn->prepare( $querystring );
    $query->bindParam(':idsection',$sectionId);
    $query->execute();

    $isFirst = boolval($query->fetchAll()[0]['isfirst']);

    // PREPARED QUERY - Add a theme in the database
    $querystring = "INSERT INTO themes(idsection,name,ord,content) VALUES (:idsection,:name,(SELECT MAX(ord) FROM themes t2 WHERE idsection=:idsection)+1,:content)";
    if(!$isFirst)
        $querystring = "INSERT INTO themes(idsection,name,ord,content) VALUES (:idsection,:name,1,:content)";

    $query = $conn->prepare( $querystring );
    $query->bindParam(':idsection',$sectionId);
    $query->bindParam(':name',$name);
    $query->bindParam(':content',$content);
    $query->execute();
    
    closePDO($conn);
}