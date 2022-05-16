<?php     
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
?>

<!DOCTYPE html>
<html lang="<?php echo getLangCode(); ?>">
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
        <header><?php echo getTranslation(24); ?></header>
        <label><?php echo getTranslation(30); ?></label>
        <input type="text" placeholder="<?php echo getTranslation(31); ?>" name="username" required>

        <label><?php echo getTranslation(35); ?></label>
        <input type="text" placeholder="<?php echo getTranslation(32); ?>" name="lastname" required>

        <label><?php echo getTranslation(36); ?></label>
        <input type="text" placeholder="<?php echo getTranslation(33); ?>" name="firstname" required>

        <label><?php echo getTranslation(25); ?></label>
        <input type="email" placeholder="<?php echo getTranslation(26); ?>" name="email" required>
        <label><?php echo getTranslation(144); ?></label>
        <input id="datefield" type='date' min='1900-01-01' max='2020-12-31' name="birthdate"></input>

        <label><?php echo getTranslation(37); ?></label>
        <input type="password" placeholder="<?php echo getTranslation(27); ?>" name="password" required>

        <label><?php echo getTranslation(37); ?></label>
        <input type="password" placeholder="<?php echo getTranslation(34); ?>" name="passwordconfirmation" required>

        <input type="submit" id='submit' value="<?php echo getTranslation(38); ?>" >
        <?php
            require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
            
            //messages d'erreurs
            if(($error = checkError(CONST_URLPARAM_ERR_USERNAME)) !== false){
                switch($error){
                    case CONST_ERR_ALREADYEXISTS:
                        echoError(getTranslation(39));
                        break;
                    case CONST_ERR_EMPTY:
                        echoError(getTranslation(40));
                        break;
                    case CONST_ERR_FORBIDDENCHARS:
                        echoError(getTranslation(41));
                        break;
                }
            }

            if(($error = checkError(CONST_URLPARAM_ERR_EMAIL)) !== false){
                switch($error){
                    case CONST_ERR_ALREADYEXISTS:
                        echoError(getTranslation(42));
                        break;
                    case CONST_ERR_EMPTY:
                        echoError(getTranslation(43));
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_PASSWORD)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError(getTranslation(44));
                        break;
                    case CONST_ERR_TOOSHORT:
                        echoError(getTranslation(45));
                        break;
                    case CONST_ERR_FORBIDDENCHARS:
                        echoError(getTranslation(46));
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_PASSWORDCONFIRMATION)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError(getTranslation(47));
                        break;
                    case CONST_ERR_UNMATCHED:
                        echoError(getTranslation(48));
                        break;
                }
            }

            if(($error = checkError(CONST_URLPARAM_ERR_FIRSTNAME)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError(getTranslation(49));
                        break;
                    case CONST_ERR_FORBIDDENCHARS:
                        echoError(getTranslation(50));
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_LASTNAME)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError(getTranslation(51));
                        break;
                    case CONST_ERR_FORBIDDENCHARS:
                        echoError(getTranslation(52));
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_BIRTHDATE)) !== false){
                if($error === CONST_ERR_EMPTY){
                    echoError(getTranslation(53));
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
