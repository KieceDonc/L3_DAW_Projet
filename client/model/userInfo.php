<?php

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/mysqli.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/const.php");

    function getDBUserID($email){
        $mysqli = getMysqli();
    
        $requete = "SELECT id,email FROM users where email = '".$email."'";
        $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
        $reponse = $result->fetch_assoc();
        
        closeMysqli($mysqli); // fermer la connexion

        if($count!=0){ 
            return $reponse['id'];
        } 

        return CONST_DB_ERR_USERDONTEXIST;

    }
?>