<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
</head>
<body>
<div id="container">
    <!-- zone de connexion -->

    <form action="../../controller/checkRegister.php" method="POST">
        <h1>Connexion</h1>
        <label><b>Username</b></label>
        <input type="text" placeholder="Entrer votre nom d'utilisateur" name="username" required>

        <label><b>Nom</b></label>
        <input type="text" placeholder="Entrer votre nom" name="lastname" required>

        <label><b>Prénom</b></label>
        <input type="text" placeholder="Entrer votre prénom" name="firstname" required>

        <label><b>Email</b></label>
        <input type="email" placeholder="Email" name="email" required>
        <label><b>Date de naissance</b></label>
        <input id="datefield" type='date' min='1900-01-01' max='2099-12-31' name="birthdate"></input>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Confirmer le mot de passe" name="passwordconfirmation" required>

        <input type="submit" id='submit' value='Sign Up' >
        <?php
        //messages d'erreurs
        if(isset($_GET['username_err'])){
            if($_GET['username_err'] === "alreadyexists")
                echo "<p style='color:red'>Nom d'utilisateur existant</p>";
            elseif($_GET['username_err'] === "empty")
                echo "<p style='color:red'>Veuillez donner un nom d'utilisateur</p>";
            elseif($_GET['username_err'] === "forbiddenchars")
                echo "<p style='color:red'>Votre nom d'utilisateur contient des caracteres interdits</p>";

        }
        elseif(isset($_GET['email_err']))
        {
            if($_GET['email_err'] === "alreadyexists")
                echo "<p style='color:red'>Email existante</p>";
            elseif($_GET['email_err'] === "empty")
                echo "<p style='color:red'>Veuillez donner une adresse mail</p>";


        }
        elseif(isset($_GET['password_err']))
        {
            if($_GET['password_err'] === "empty")
                echo "<p style='color:red'>Veuillez donner un mot de passe</p>";
            elseif($_GET['email_err'] === "tooshort")
                echo "<p style='color:red'>Votre mot de passe doit au moins contenir 6 caracteres</p>";

        }
        elseif(isset($_GET['passwordconfirmation_err']))
        {
            if($_GET['passwordconfirmation_err'] === "empty")
                echo "<p style='color:red'>Veuillez confirmer votre mot de passe</p>";
            elseif($_GET['passwordconfirmation_err'] === "unmatchedpasswords" )
                echo "<p style='color:red'>Vos mot de passes sont différents</p>";

        }
        elseif(isset($_GET['firstname_err']))
        {
            if($_GET['firstname_err'] === "empty")
                echo "<p style='color:red'>Veuillez donner votre prénom</p>";
            elseif($_GET['firstname_err'] === "forbiddenchars" )
                echo "<p style='color:red'>Votre prénom ne doit contenir que des lettres</p>";

        }
        elseif(isset($_GET['lastname_err']))
        {
            if($_GET['lastname_err'] === "empty")
                echo "<p style='color:red'>Veuillez donner votre nom</p>";
            elseif($_GET['lastname_err'] === "forbiddenchars" )
                echo "<p style='color:red'>Votre nom ne doit contenir que des lettres</p>";

        }
        elseif(isset($_GET['birthdate_err']))
        {
            if($_GET['birthdate_err'] === "empty")
                echo "<p style='color:red'>Veuillez donner votre date de naissance</p>";

        }


        ?>
    </form>
</div>
</body>

</html>
