<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");


    function isInCourseDB($idUser,$idCourse){
        $conn = getPDO();

        // PREPARED QUERY - Check if there's an entry in the table 
        $querystring = "SELECT EXISTS(SELECT * FROM takes WHERE idcourse=:idcourse AND iduser=:iduser) AS takescourse";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':iduser',$idUser);
        $query->bindParam(':idcourse',$idCourse);
        $query->execute();
        closePDO($conn);

        return $query->fetchAll();
    }

    function isAdminDB($idUser,$idCourse){
        $conn = getPDO();

        // PREPARED QUERY - Check if there's an entry in the table 
        $querystring = "SELECT EXISTS(SELECT * FROM courses WHERE id=:idcourse AND idauthor=:iduser) AS isadmin";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':iduser',$idUser);
        $query->bindParam(':idcourse',$idCourse);
        $query->execute();
        closePDO($conn);

        return $query->fetchAll();
    }

    function ownsMediaDB($idCourse,$idMedia){
        $conn = getPDO();


        // PREPARED QUERY - Check if there's an entry in the table 
        $querystring = "SELECT EXISTS(SELECT *  FROM media WHERE id = :m AND owner = (SELECT idauthor FROM courses WHERE id=:c)) AS ownsmedia";
        $query = $conn->prepare( $querystring );
        $query->bindParam(':c',$idCourse);
        $query->bindParam(':m',$idMedia);
        $query->execute();
        closePDO($conn);

        return $query->fetchAll();
    }
?>