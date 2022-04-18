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
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/header.php"); 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/userInfo.php");
  ?>
	<div class="content">
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
      Your username : <?php echo getDBUserName($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      Last connection : <?php echo getDBLastConnection($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      You created your account on <?php echo getDBCreationDate($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      Your birthdate : <?php echo getDBBirthdate($_SESSION[CONST_SESSION_EMAIL]); ?> <br />
      Your full name : <?php echo getDBFirstName($_SESSION[CONST_SESSION_EMAIL]) . " " . getDBLastName($_SESSION[CONST_SESSION_EMAIL]); ?> <br />

      <form method="get">
        <button name="edit"> Edit profile </button>
      </form>
    <?php
  }

  function showEditProfile(){
    ?>
      <form method="post">
        <label for="username"> New username : </label>
        <input type="text" name="username" id="username" value="<?php echo getDBUserName($_SESSION[CONST_SESSION_EMAIL]); ?>" />

        <label for="firstname"> New first name : </label>
        <input type="text" name="firstname" id="firstname" value="<?php echo getDBFirstName($_SESSION[CONST_SESSION_EMAIL])?>" />

        <label for="lastname"> New last name : </label>
        <input type="text" name="lastname" id="lastname" value="<?php echo getDBLastName($_SESSION[CONST_SESSION_EMAIL]); ?>" />

        <label for="datefield">Edit your birthdate: </label>
        <input id="datefield" type='date' min='1900-01-01' max='2099-12-31' name="birthdate" value="<?php echo getDBBirthdate($_SESSION[CONST_SESSION_EMAIL]); ?>"></input>

        <label for="pass1">Mot de passe</label>
        <input id="pass1" type="password" placeholder="Entrer le mot de passe" name="password">

        <label for="pass2">Confirmer le mot de passe</label>
        <input id="pass2" type="password" placeholder="Confirmer le mot de passe" name="passwordconfirmation">

        <input hidden name="edit" />
        <button name="save"> Save </button>
      </form>
    <?php
  }

  function editProfile(){

  }


?>