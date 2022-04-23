<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/sanitizeHelper.php");
    function editProfile(){
        $username = sanitizeString($_REQUEST["username"]);
        $firstname = sanitizeString($_REQUEST["firstname"]);
        $lastname = sanitizeString($_REQUEST["lastname"]);
        $birthdate = sanitizeString($_REQUEST["birthdate"]);
        $password = sanitizeString($_REQUEST["password"]);
        $passwordconfirmation = sanitizeString($_REQUEST["passwordconfirmation"]);

        $errors = [];
        //TODO put in common because same as checkregister controller
        if($username != getUsernameID($_SESSION[CONST_SESSION_EMAIL]))
        {
            //username vide ou carac interdits
            if(empty($username)){
                $errors = storeError($errors,CONST_URLPARAM_ERR_USERNAME, CONST_ERR_EMPTY);
            }
            elseif(!preg_match('/^[a-zA-Z0-9_]+$/', $username)){
                $errors = storeError($errors,CONST_URLPARAM_ERR_USERNAME, CONST_ERR_FORBIDDENCHARS);
            }
            else{
                setUsername($_SESSION[CONST_SESSION_EMAIL], $username);
            }
        }

        if($firstname != getFirstnameID($_SESSION[CONST_SESSION_EMAIL]))
        {
            //firstname vide ou carac interdits
            if(empty($firstname)){
                $errors = storeError($errors,CONST_URLPARAM_ERR_FIRSTNAME, CONST_ERR_EMPTY);
            }
            elseif(!preg_match('/^[a-zA-Z]+$/', $firstname)){
                $errors = storeError($errors,CONST_URLPARAM_ERR_FIRSTNAME, CONST_ERR_FORBIDDENCHARS);
            }
            else{
                setFirstname($_SESSION[CONST_SESSION_EMAIL], $firstname);
            }
        }

        if($lastname != getLastnameID($_SESSION[CONST_SESSION_EMAIL]))
        {
            //lastname vide ou carac interdits
            if(empty(trim($lastname))){
                $errors = storeError($errors,CONST_URLPARAM_ERR_LASTNAME, CONST_ERR_EMPTY);
            }
            elseif(!preg_match('/^[a-zA-Z]+$/', $lastname)){
                $errors = storeError($errors,CONST_URLPARAM_ERR_LASTNAME, CONST_ERR_FORBIDDENCHARS);
            } 
            else {
                setLastname($_SESSION[CONST_SESSION_EMAIL], $lastname);
            }
        }

        if($birthdate != getBirthdateID($_SESSION[CONST_SESSION_EMAIL]))
        {
            //birthdate vide
            if(empty($birthdate)){
                $errors = storeError($errors,CONST_URLPARAM_ERR_BIRTHDATE, CONST_ERR_EMPTY);
            }
            else {
                setBirthdate($_SESSION[CONST_SESSION_EMAIL], $birthdate);
            }
        }
        
        if($password != getPasswordID($_SESSION[CONST_SESSION_EMAIL]) && !empty($password))
        {
            $incorrectPassword = false;
            //password contenant des carac interdits
            //at least 1 number, 1 letter, 1 special char !@#$% between 6 and 100 chars
            if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,100}$/', $password)){
                $error = storeError($errors,CONST_URLPARAM_ERR_PASSWORD, CONST_ERR_FORBIDDENCHARS);
                $incorrectPassword = true;
            }
            if(strlen($password) < 6){
                $errors = storeError($errors,CONST_URLPARAM_ERR_PASSWORD, CONST_ERR_TOOSHORT);
                $incorrectPassword = true;
            }

            //password confirmation vide ou unmatched
            if(empty($passwordconfirmation)){
                $errors = storeError($errors,CONST_URLPARAM_ERR_PASSWORDCONFIRMATION, CONST_ERR_EMPTY);
                $incorrectPassword = true;
            }
            
            if($password !== $passwordconfirmation){
                $errors = storeError($errors,CONST_URLPARAM_ERR_PASSWORDCONFIRMATION, CONST_ERR_UNMATCHED);
                $incorrectPassword = true;
            }

            if(!$incorrectPassword){
                $password = password_hash($password, PASSWORD_DEFAULT);
                setPassword($_SESSION[CONST_SESSION_EMAIL], $password);
            }
        }

        if(count($errors) == 0)
            header("Location: /admin/profile");
        else {
            header("Location: /admin/profile" . concatErrors($errors));
        }
    }

    function storeError($errors,$origin, $error){
        array_push($errors,$origin . '=' . $error);
        return $errors;
    }

    function concatErrors($errors){
        $errors_length = count($errors);
        $str = '?edit';
        if($errors_length > 0){
            $str.= '&';
            for ($index = 0; $index < $errors_length ; $index++) {
                $str.= $errors[$index]; 
                
                if($index != $errors_length - 1){
                    // if not last element of errors array
                    $str.= '&';
                }
            }
        }

        return $str;
    }
?>