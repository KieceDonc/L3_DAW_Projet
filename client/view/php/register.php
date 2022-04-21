<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/register.css" />
</head>
<body>
<div id="container">
    <!-- zone de connexion -->

    <form action="../../controller/checkRegister.php" method="POST">
        <header>Connection</header>
        <label>Username</label>
        <input type="text" placeholder="Enter your username" name="username" required>

        <label>Last name</label>
        <input type="text" placeholder="Enter your last name" name="lastname" required>

        <label>First name</label>
        <input type="text" placeholder="Enter your first name" name="firstname" required>

        <label>Email</label>
        <input type="email" placeholder="Email" name="email" required>
        <label>Date de naissance</label>
        <input id="datefield" type='date' min='1900-01-01' max='2099-12-31' name="birthdate"></input>

        <label>Password</label>
        <input type="password" placeholder="Enter your password" name="password" required>

        <label>Password</label>
        <input type="password" placeholder="Confirm your password" name="passwordconfirmation" required>

        <input type="submit" id='submit' value="Register" >
        <?php
            require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
            
            //messages d'erreurs
            if(($error = checkError(CONST_URLPARAM_ERR_USERNAME)) !== false){
                switch($error){
                    case CONST_ERR_ALREADYEXISTS:
                        echoError("Username already taken");
                        break;
                    case CONST_ERR_EMPTY:
                        echoError("Please enter an username");
                        break;
                    case CONST_ERR_FORBIDDENCHARS:
                        echoError("Your username has forbidden characters");
                        break;
                }
            }

            if(($error = checkError(CONST_URLPARAM_ERR_EMAIL)) !== false){
                switch($error){
                    case CONST_ERR_ALREADYEXISTS:
                        echoError('Email already registered');
                        break;
                    case CONST_ERR_EMPTY:
                        echoError('Please enter an email');
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_PASSWORD)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError('Please enter a password');
                        break;
                    case CONST_ERR_TOOSHORT:
                        echoError("Your password must be at least 6 characters long");
                        break;
                    case CONST_ERR_FORBIDDENCHARS:
                        echoError("Your password must contains: 1 letter, 1 digit and 1 special character between !,@,#,$,%");
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_PASSWORDCONFIRMATION)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError('Please confirm your password');
                        break;
                    case CONST_ERR_UNMATCHED:
                        echoError('Your password confirmation is not matching !');
                        break;
                }
            }

            if(($error = checkError(CONST_URLPARAM_ERR_FIRSTNAME)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError('Please enter your first name');
                        break;
                    case CONST_ERR_FORBIDDENCHARS:
                        echoError('Your first name must contains only letters');
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_LASTNAME)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError('Please enter your last name');
                        break;
                    case CONST_ERR_ALREADYEXISTS:
                        echoError('Your last name must contains only letters');
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_BIRTHDATE)) !== false){
                if($error === CONST_ERR_EMPTY){
                    echoError('Please enter your date of birth');
                }
            }

            function checkError($toCheck){
                if(isset($_GET[$toCheck])){
                    return $_GET[$toCheck];
                }else{
                    return false;
                }
            }

            function echoError($toShow){
                echo "<p style='color:red'>" . $toShow . "</p>";
            }
        ?>
    </form>
</div>
</body>

</html>
