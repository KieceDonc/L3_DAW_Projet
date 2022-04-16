<?php

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/userInfo.php");

    function getUserID($email){
        $userID = $_SESSION[CONST_SESSION_USERSTOREDID];

        // we check if we already stored the userID
        if(isset($userID)){

            // No, we need to query id
            $userID = getDBUserID($email);

            // Has db returned error ?
            if($userID != CONST_DB_ERR_USERDONTEXIST){
                
                // we store the user id so we don't have to recall and spam db querry
                $_SESSION[CONST_SESSION_USERSTOREDID] = $userID; 
                return $userID;
            }else{
                var_dump($userID);
                // TODO: You're trying to get userID but DB say you don't have a user for this email. 
                // Btw if this happend, good luck :) 
            }
        }else{

            // Yes we return it
            return $userID; 
        }
    }
?>