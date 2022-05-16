<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Dashboard - E-lolning</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/profile.css" />
	  <link rel="stylesheet" href="../css/sharedAdmin.css" />
    <link rel="stylesheet" href="../../client/view/css/font-face.css" />
    <link rel="stylesheet" href="../../client/view/css/darkMode.css" />
  </head>
  <body>
	<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/header.php"); 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/controller/profile.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
  ?>
	<div class="content">
    <h1> <?php echo getTranslation(143); ?> </h1>
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
      <?php echo getTranslation(145); ?> <?php echo getDBUserName($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      <?php echo getTranslation(146); ?> <?php echo getDBLastConnection($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      <?php echo getTranslation(147); ?> <?php echo getDBCreationDate($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      <?php echo getTranslation(148); ?> <?php echo getDBBirthdate($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      <?php echo getTranslation(149); ?> <?php echo getDBFirstName($_SESSION[CONST_SESSION_EMAIL]) . " " . getDBLastName($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      </div>
      <form method="get">
        <button name="edit" class="EditBtn"> <?php echo getTranslation(150); ?> </button>
      </form>
    <?php
  }

  function showEditProfile(){
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
    ?>
      <form method="post">
        <label for="username"> <?php echo getTranslation(155); ?> </label>
        <input type="text" name="username" id="username" value="<?php echo getUsernameID($_SESSION[CONST_SESSION_EMAIL]); ?>" /> <br />

        <label for="firstname"> <?php echo getTranslation(154); ?></label>
        <input type="text" name="firstname" id="firstname" value="<?php echo getDBFirstName($_SESSION[CONST_SESSION_EMAIL])?>" /><br />

        <label for="lastname"> <?php echo getTranslation(153); ?> </label>
        <input type="text" name="lastname" id="lastname" value="<?php echo getDBLastName($_SESSION[CONST_SESSION_EMAIL]); ?>" /><br />

        <label for="datefield"> <?php echo getTranslation(152); ?></label>
        <input id="datefield" type='date' min='1900-01-01' max='2099-12-31' name="birthdate" value="<?php echo getDBBirthdate($_SESSION[CONST_SESSION_EMAIL]); ?>" /><br />

        <label for="pass1"><?php echo getTranslation(37); ?></label>
        <input id="pass1" type="password" placeholder="<?php echo getTranslation(27); ?>" name="password"><br />

        <label for="pass2"><?php echo getTranslation(37); ?></label>
        <input id="pass2" type="password" placeholder="<?php echo getTranslation(34); ?>" name="passwordconfirmation"><br />

        <input type="hidden" name="edit" />
        <button class="EditBtn" name="save"> <?php echo getTranslation(151); ?> </button>
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