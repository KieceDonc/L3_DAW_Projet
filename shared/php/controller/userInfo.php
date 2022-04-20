<?php

    // TODO : generalize ( but can we ? ). Plz see in model userInfo.php to see how it was generalize

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/userInfo.php");

    function getUserID($email){
        // we check if we already stored the userID
        if(!isset($_SESSION[CONST_SESSION_USERSTORED_ID])){
            //$userID = $_SESSION[CONST_SESSION_USERSTORED_ID];

            // No, we need to query id
            $userID = getDBUserID($email);

            // Has db returned error ?
            if($userID != CONST_DB_ERR_USERDONTEXIST){
                
                // we store the user id so we don't have to recall and spam db querry
                $_SESSION[CONST_SESSION_USERSTORED_ID] = $userID; 
                return $userID;
            }else{
                var_dump($userID);
                // TODO: You're trying to get userID but DB say you don't have a user for this email. 
                // Btw if this happend, good luck :) 
            }
        }else{

            // Yes we return it
            return $_SESSION[CONST_SESSION_USERSTORED_ID]; 
        }
    }

    function getUsernameID($email){
        // we check if we already stored the username
        if(!isset($_SESSION[CONST_SESSION_USERSTORED_USERNAME])){
            // No, we need to query username
            $username = getDBUserName($email);

            // Has db returned error ?
            if($username != CONST_DB_ERR_USERDONTEXIST){
                // we store the username so we don't have to recall and spam db querry
                $_SESSION[CONST_SESSION_USERSTORED_USERNAME] = $username; 
                return $username;
            }else{
                var_dump($username);
                // TODO: You're trying to get username but DB say you don't have a user for this email. 
                // Btw if this happend, good luck :) 
            }
        }else{
            // Yes we return it
            return $_SESSION[CONST_SESSION_USERSTORED_USERNAME]; 
        }
    }

    function getFirstnameID($email){
        // we check if we already stored the firstname
        if(!isset($_SESSION[CONST_SESSION_USERSTORED_FIRSTNAME])){
           // $firstname = $_SESSION[CONST_SESSION_USERSTORED_FIRSTNAME];

            // No, we need to query firstname
            $firstname = getDBFirstName($email);

            // Has db returned error ?
            if($firstname != CONST_DB_ERR_USERDONTEXIST){
                
                // we store the firstname so we don't have to recall and spam db querry
                $_SESSION[CONST_SESSION_USERSTORED_FIRSTNAME] = $firstname; 
                return $firstname;
            }else{
                var_dump($firstname);
                // TODO: You're trying to get firstname but DB say you don't have a user for this email. 
                // Btw if this happend, good luck :) 
            }
        }else{

            // Yes we return it
            return $_SESSION[CONST_SESSION_USERSTORED_FIRSTNAME]; 
        }
    }

    function getLastnameID($email){
        // we check if we already stored the lastname
        if(!isset($_SESSION[CONST_SESSION_USERSTORED_LASTNAME])){
            //$lastname = $_SESSION[USER_STORED_LASTNAME];

            // No, we need to query lastname
            $lastname = getDBLastName($email);

            // Has db returned error ?
            if($lastname != CONST_DB_ERR_USERDONTEXIST){
                
                // we store the lastname so we don't have to recall and spam db querry
                $_SESSION[CONST_SESSION_USERSTORED_LASTNAME] = $lastname; 
                return $lastname;
            }else{
                var_dump($lastname);
                // TODO: You're trying to get lastname but DB say you don't have a user for this email. 
                // Btw if this happend, good luck :) 
            }
        }else{

            // Yes we return it
            return $_SESSION[CONST_SESSION_USERSTORED_LASTNAME]; 
        }
    }

    function getBirthdateID($email){
        // we check if we already stored the lastname
        if(!isset($_SESSION[CONST_SESSION_USERSTORED_BIRTHDATE])){
            // No, we need to query lastname
            $birthdate = getDBBirthdate($email);

            // Has db returned error ?
            if($birthdate != CONST_DB_ERR_USERDONTEXIST){
                
                // we store the birthdate so we don't have to recall and spam db querry
                $_SESSION[CONST_SESSION_USERSTORED_BIRTHDATE] = $birthdate; 
                return $birthdate;
            }else{
                var_dump($birthdate);
                // TODO: You're trying to get birthdate but DB say you don't have a user for this email. 
                // Btw if this happend, good luck :) 
            }
        }else{

            // Yes we return it
            return $_SESSION[CONST_SESSION_USERSTORED_BIRTHDATE]; 
        }
    }

    function getPasswordID($email){
        // we check if we already stored the password
        if(!isset($_SESSION[CONST_SESSION_USERSTORED_PASSWORD])){
            // No, we need to query lastname
            $password = getDBPassword($email);

            // Has db returned error ?
            if($password != CONST_DB_ERR_USERDONTEXIST){
                
                // we store the password so we don't have to recall and spam db querry
                $_SESSION[CONST_SESSION_USERSTORED_PASSWORD] = $password; 
                return $password;
            }else{
                var_dump($password);
                // TODO: You're trying to get password but DB say you don't have a user for this email. 
                // Btw if this happend, good luck :) 
            }
        }else{

            // Yes we return it
            return $_SESSION[CONST_SESSION_USERSTORED_PASSWORD]; 
        }
    }

    function setUsername($email, $value) {
        //reset cached value to not query bdd again
        $_SESSION[CONST_SESSION_USERSTORED_USERNAME] = $value;

        setDBUsername($email, $value);
    }

    function setFirstname($email, $value) {
        //reset cached value to not query bdd again
        $_SESSION[CONST_SESSION_USERSTORED_FIRSTNAME] = $value;

        setDBFirstname($email, $value);
    }

    function setLastname($email, $value) {
        //reset cached value to not query bdd again
        $_SESSION[CONST_SESSION_USERSTORED_LASTNAME] = $value;

        setDBLastname($email, $value);
    }

    function setBirthdate($email, $value) {
        //reset cached value to not query bdd again
        $_SESSION[CONST_SESSION_USERSTORED_BIRTHDATE] = $value;

        setDBBirthdate($email, $value);
    }

    function setPassword($email, $value) {
        //reset cached value to not query bdd again
        $_SESSION[CONST_SESSION_USERSTORED_PASSWORD] = $value;

        setDBPassword($email, $value);
    }

?>