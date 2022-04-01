<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/checkRegister.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/const.php");

    $errors = [];

    if(isset($_POST['username'])&& isset($_POST['email']) && isset($_POST['firstname']) &&
        isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['passwordconfirmation'])
        && isset($_POST['birthdate'])){   
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordconfirmation = $_POST['passwordconfirmation'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $birthdate = $_POST['birthdate'];
            $creationdate = date("Y-m-d H:i:s");
            $lastconnection = $creationdate;

        //hashage du mot de passe avec l'algo par default de php
        //$param_password = password_hash(trim($password), PASSWORD_DEFAULT);


        //username vide ou carac interdits
        if(empty($username)){
            $errors = storeError($errors,CONST_URLPARAM_ERR_USERNAME, CONST_ERR_EMPTY);
        }

        if(!preg_match('/^[a-zA-Z0-9_]+$/', $username)){
            $errors = storeError($errors,CONST_URLPARAM_ERR_USERNAME, CONST_ERR_FORBIDDENCHARS);
        }

        //email vide
        if(empty($email)){
            $errors = storeError($errors,CONST_URLPARAM_ERR_EMAIL, CONST_ERR_EMPTY);
        }

        //password vide ou trop court
        if(empty($password)){
            $errors = storeError($errors,CONST_URLPARAM_ERR_PASSWORD, CONST_ERR_EMPTY);
        }

        if(strlen($password) < 6){
            $errors = storeError($errors,CONST_URLPARAM_ERR_PASSWORD, CONST_ERR_TOOSHORT);
        }

        //password confirmation vide ou unmatched
        if(empty($passwordconfirmation)){
            $errors = storeError($errors,CONST_URLPARAM_ERR_PASSWORDCONFIRMATION, CONST_ERR_EMPTY);
        }
        
        if($password !== $passwordconfirmation){
            $errors = storeError($errors,CONST_URLPARAM_ERR_PASSWORDCONFIRMATION, CONST_ERR_UNMATCHED);
        }

        //firstname ou lastname vide ou carac interdits
        if(empty($firstname)){
            $errors = storeError($errors,CONST_URLPARAM_ERR_FIRSTNAME, CONST_ERR_EMPTY);
        }

        if(!preg_match('/^[a-zA-Z]+$/', $firstname)){
            $errors = storeError($errors,CONST_URLPARAM_ERR_FIRSTNAME, CONST_ERR_FORBIDDENCHARS);
        }

        if(empty(trim($lastname))){
            $errors = storeError($errors,CONST_URLPARAM_ERR_LASTNAME, CONST_ERR_EMPTY);
        }
        
        if(!preg_match('/^[a-zA-Z]+$/', $lastname)){
            $errors = storeError($errors,CONST_URLPARAM_ERR_LASTNAME, CONST_ERR_FORBIDDENCHARS);
        }

        //birthdate vide
        if(empty($birthdate)){
            $errors = storeError($errors,CONST_URLPARAM_ERR_BIRTHDATE, CONST_ERR_EMPTY);
        }

        if(count($errors) > 0){
            redirectTo('/client/view/php/register.php',$errors);
        }else{
            session_start();
            $password = password_hash($password, PASSWORD_DEFAULT);
            switch(checkRegister($username, $email, $password, $firstname, $lastname, $birthdate,$creationdate,$lastconnection)){
                case CONST_DB_ACCEPTED:
                    $_SESSION[CONST_SESSION_ISLOGGED] = CONST_SESSION_ISLOGGED_YES;
                    $_SESSION[CONST_SESSION_EMAIL] = $email;
                    redirectTo('/client/view/php/index.php',$errors);
                    break;
                case CONST_DB_ERR_USERNAMEEXIST:
                    $errors = storeError($errors,CONST_URLPARAM_ERR_USERNAME, CONST_ERR_ALREADYEXISTS);
                    redirectTo('/client/view/php/register.php',$errors);
                    break;
                case CONST_DB_ERR_EMAILEXISTS:
                    $errors = storeError($errors,CONST_URLPARAM_ERR_EMAIL, CONST_ERR_ALREADYEXISTS);
                    redirectTo('/client/view/php/register.php',$errors);
                    break;     
            }

        }

    }else{
        redirectTo('/');
    }

    function redirectTo($path,$errors){
        header('Location: ' . $path . concactEror($errors));
        exit();
    }

    function storeError($errors,$origin, $error){
        array_push($errors,$origin . '=' . $error);
        return $errors;
    }

    function concactEror($errors){
        $errors_length = count($errors);
        $str = '';

        if($errors_length == 1){
            $str.= '?'.$errors[0];

        }elseif($errors_length > 0){
            $str.= '?';
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