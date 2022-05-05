<?php

function insertContactDB($name, $phone, $email, $subject, $question){
    $conn = getPDO();

    // PREPARED QUERY - Insert infos in contact table
    $querystring = "INSERT INTO contact (name,phone,email,subject,question) VALUES (:name,:phone,:email,:subject,:question)";
    $query = $conn->prepare( $querystring );
    $query->bindParam(':name',$name);
    $query->bindParam(':phone',$phone);
    $query->bindParam(':email',$email);
    $query->bindParam(':subject',$subject);
    $query->bindParam(':question',$question);
    $query->execute();

    closePDO($conn);

    return true;
}

?>