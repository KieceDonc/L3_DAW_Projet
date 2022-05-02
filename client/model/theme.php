<?php

function getContentDB($id){
    $conn = getPDO();

    // PREPARED QUERY - Retrieve the content of the theme
    $querystring = "SELECT content FROM lessons WHERE id=:id";
    $query = $conn->prepare( $querystring );
    $query->bindParam(':id',$id);
    $query->execute();
    closePDO($conn);

    return $query->fetchAll();
}