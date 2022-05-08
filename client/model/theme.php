<?php

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

function addThemeDB($idsection,$name,$content){
    $conn = getPDO();

    // PREPARED QUERY - Retrieve the content of the theme
    $querystring = "INSERT INTO themes (idsection,name,ord,type) VALUES (:idsection,:name,:truc) FROM lessons WHERE id=:id";
    $query = $conn->prepare( $querystring );
    $query->bindParam(':id',$id);
    $query->execute();
    closePDO($conn);

    return $query->fetchAll();
}