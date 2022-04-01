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
        <header>Connexion</header>
        <label>Nom d'utilisateur</label>
        <input type="text" placeholder="Entrer votre nom d'utilisateur" name="username" required>

        <label>Nom</label>
        <input type="text" placeholder="Entrer votre nom" name="lastname" required>

        <label>Prénom</label>
        <input type="text" placeholder="Entrer votre prénom" name="firstname" required>

        <label>Email</label>
        <input type="email" placeholder="Email" name="email" required>
        <label>Date de naissance</label>
        <input id="datefield" type='date' min='1900-01-01' max='2099-12-31' name="birthdate"></input>

        <label>Mot de passe</label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <label>Mot de passe</label>
        <input type="password" placeholder="Confirmer le mot de passe" name="passwordconfirmation" required>

        <input type="submit" id='submit' value="S'inscrire" >
        <?php
            require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/const.php");
            
            //messages d'erreurs
            if(($error = checkError(CONST_URLPARAM_ERR_USERNAME)) !== false){
                switch($error){
                    case CONST_ERR_ALREADYEXISTS:
                        echoError("Nom d'utilisateur existant");
                        break;
                    case CONST_ERR_EMPTY:
                        echoError("Veuillez donner un nom d'utilisateur");
                        break;
                    case CONST_ERR_FORBIDDENCHARS:
                        echoError("Votre nom d'utilisateur contient des caracteres interdits");
                        break;
                }
            }

            if(($error = checkError(CONST_URLPARAM_ERR_EMAIL)) !== false){
                switch($error){
                    case CONST_ERR_ALREADYEXISTS:
                        echoError('Email existant');
                        break;
                    case CONST_ERR_EMPTY:
                        echoError('Veuillez donner une adresse mail');
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_PASSWORD)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError('Veuillez donner un mot de passe');
                        break;
                    case CONST_ERR_TOOSHORT:
                        echoError('Votre mot de passe doit au moins contenir 6 caracteres');
                        break;
                    case CONST_ERR_FORBIDDENCHARS:
                        echoError("Votre mot de passe doit contenir au moins: 1 lettre, 1 chiffre et 1 caractere spécial entre !,@,#,$,%");
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_PASSWORDCONFIRMATION)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError('Veuillez confirmer votre mot de passe');
                        break;
                    case CONST_ERR_UNMATCHED:
                        echoError('Vos mot de passes sont différents');
                        break;
                }
            }

            if(($error = checkError(CONST_URLPARAM_ERR_FIRSTNAME)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError('Veuillez donner votre prénom');
                        break;
                    case CONST_ERR_FORBIDDENCHARS:
                        echoError('Votre prénom ne doit contenir que des lettres');
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_LASTNAME)) !== false){
                switch($error){
                    case CONST_ERR_EMPTY:
                        echoError('Veuillez donner votre nom<');
                        break;
                    case CONST_ERR_ALREADYEXISTS:
                        echoError('Votre nom ne doit contenir que des lettres');
                        break;
                }
            }
            
            if(($error = checkError(CONST_URLPARAM_ERR_BIRTHDATE)) !== false){
                if($error === CONST_ERR_EMPTY){
                    echoError('Veuillez donner votre date de naissance');
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
