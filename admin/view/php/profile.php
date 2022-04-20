<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Dashboard - E-lolning</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/profile.css" />
	<link rel="stylesheet" href="../css/sharedAdmin.css" />
  </head>
  <body>
	<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/header.php"); 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/controller/profile.php");
  ?>
	<div class="content">
    <h1> Your profile </h1>
    <?php
      if(isset($_REQUEST["edit"])){
        if(isset($_REQUEST["save"])){
          editProfile();
        }
        else{
          showEditProfile();
        }
      }
      else {
        showProfileInfos();
      }
    ?>
	</div>

<!-- JS -->
	<script src="../../../../shared/js/jquery.js"></script>
	<script src="../js/profile.js"></script>
  </body>
</html>

<?php
  function showProfileInfos(){
    ?>
      <div class = "InfosProfiles">
      Your username : <?php echo getDBUserName($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      Last connection : <?php echo getDBLastConnection($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      You created your account on <?php echo getDBCreationDate($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      Your birthdate : <?php echo getDBBirthdate($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      Your full name : <?php echo getDBFirstName($_SESSION[CONST_SESSION_EMAIL]) . " " . getDBLastName($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      </div>
      <form method="get">
        <button name="edit" class="EditBtn"> Edit profile </button>
      </form>
    <?php
  }

  function showEditProfile(){
    //TODO put in common because same as register view
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
    ?>
      <form method="post">
        <label for="username"> New username : </label>
        <input type="text" name="username" id="username" value="<?php echo getUsernameID($_SESSION[CONST_SESSION_EMAIL]); ?>" /> <br />

        <label for="firstname"> New first name : </label>
        <input type="text" name="firstname" id="firstname" value="<?php echo getDBFirstName($_SESSION[CONST_SESSION_EMAIL])?>" /><br />

        <label for="lastname"> New last name : </label>
        <input type="text" name="lastname" id="lastname" value="<?php echo getDBLastName($_SESSION[CONST_SESSION_EMAIL]); ?>" /><br />

        <label for="datefield">Edit your birthdate: </label>
        <input id="datefield" type='date' min='1900-01-01' max='2099-12-31' name="birthdate" value="<?php echo getDBBirthdate($_SESSION[CONST_SESSION_EMAIL]); ?>" /><br />

        <label for="pass1">Mot de passe</label>
        <input id="pass1" type="password" placeholder="Entrer le mot de passe" name="password"><br />

        <label for="pass2">Confirmer le mot de passe</label>
        <input id="pass2" type="password" placeholder="Confirmer le mot de passe" name="passwordconfirmation"><br />

        <input type="hidden" name="edit" />
        <button class="EditBtn" name="save"> Save </button>
      </form>
    <?php
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