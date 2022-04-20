<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");

    function getDBUserID($email){
        return getDBInfo($email,CONST_DB_TABLE_USERS_ID);
    }

    function getDBFirstName($email){
        return getDBInfo($email,CONST_DB_TABLE_USERS_FIRSTNAME);
    }

    function getDBLastName($email){
        return getDBInfo($email,CONST_DB_TABLE_USERS_LASTNAME);
    }

    function getDBUserName($email){
        return getDBInfo($email,CONST_DB_TABLE_USERS_USERNAME);
    }

    function getDBLastConnection($email) {
        return getDBInfo($email, CONST_DB_TABLE_USERS_LASTCONNECTION);
    }

    function getDBBirthdate($email) {
        return getDBInfo($email, CONST_DB_TABLE_USERS_BIRTHDATE);
    }

    function getDBCreationDate($email) {
        return getDBInfo($email, CONST_DB_TABLE_USERS_CREATIONDATE);
    }

    function getDBInfo($email,$columnName){
        $conn = getPDO();
        $request = $conn->prepare("SELECT count(*), ".$columnName.", email FROM users where email = :email GROUP BY ".$columnName.";");
        $request->bindValue(":email", $email);
        $request->execute();
        $answer = $request->fetch(PDO::FETCH_ASSOC);
        $count = $answer['count(*)'];
        closePDO($conn);

        if($count!=0){ 
            return $answer[$columnName];
        } 

        return CONST_DB_ERR_USERDONTEXIST;
    }
?>