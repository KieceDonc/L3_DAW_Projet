<?php

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/model/pdo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/const.php");

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
        $mysqli = getMysqli();
    
        $requete = "SELECT count(*), ". $columnName .",". CONST_DB_TABLE_USERS_EMAIL ." FROM users where ". CONST_DB_TABLE_USERS_EMAIL ." = '".$email."' GROUP BY ".$columnName;
        $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
        $reponse = $result->fetch_assoc();
        $count = $reponse['count(*)'];

        closeMysqli($mysqli);

        if($count!=0){ 
            return $reponse[$columnName];
        } 

        return CONST_DB_ERR_USERDONTEXIST;
    }
?>