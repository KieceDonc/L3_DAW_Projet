<?php

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");

    function insertMediaDB($fileOwner,$fileType,$fileName,$fileSize,$fileContent){
        $conn = getPDO();

        // PREPARED QUERY - Insert media in DB
        $querystring = "INSERT INTO media (owner,type,name,size,content) VALUES (:o,:t,:n,:s,:c)";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':o',$fileOwner);
        $query->bindParam(':t',$fileType);
        $query->bindParam(':n',$fileName);
        $query->bindParam(':s',$fileSize);
        $query->bindParam(':c',$fileContent);
        $query->execute();
        closePDO($conn);
    }

    function getAllFilesDB($userId){
        $conn = getPDO();

        // PREPARED QUERY - Get all the media from user $id in DB 
        $querystring = "SELECT * FROM media WHERE owner=:id";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':id',$userId);
        $query->execute();
        closePDO($conn);

        return $query->fetchAll();
    }

    function getFileDB($mediaId){
        $conn = getPDO();

        // PREPARED QUERY - Get all the media from user $id in DB 
        $querystring = "SELECT * FROM media WHERE id=:id";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':id',$mediaId);
        $query->execute();
        closePDO($conn);

        return $query->fetchAll();
    }

    function deleteMediaDB($mediaId){
        $conn = getPDO();

        // PREPARED QUERY - Delete a media in DB from its ID
        $querystring = "DELETE FROM media WHERE id=:id";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':id',$mediaId);
        $query->execute();
        closePDO($conn);
    }