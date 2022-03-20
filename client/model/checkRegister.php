<?php
session_start();

require_once("../../admin/config.php");

//mysqli db poo connexion
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

 //Check connection
if($mysqli === false){
   die("ERROR: Could not connect. " . $mysqli->connect_error);

}

$uniqueemailandusername = true;

$sqlusername = "SELECT count(*) FROM users WHERE username = ?";
$sqlemail = "SELECT count(*) FROM users WHERE email = ?";
if($stmt = $mysqli->prepare($sqlusername))
{
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("s", $param_username);

    // Set parameters
    $param_username = trim($_SESSION["username"]);

    // Attempt to execute the prepared statement
    if($stmt->execute())
    {
        // store result
        $stmt->bind_result($totalRows);
        $stmt->fetch();

        if($totalRows == 1)
        {
            $_SESSION["username_err"] = "username already exists";
            $uniqueemailandusername = false;
            $_SESSION['loggedin'] = "DENIED";


        }
    }
    else
    {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    $stmt->close();

}

if($stmt = $mysqli->prepare($sqlemail))
{
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("s", $param_email);

    // Set parameters
    $param_email = trim($_SESSION["email"]);

    // Attempt to execute the prepared statement
    if($stmt->execute())
    {
        // store result
        $stmt->bind_result($totalRows);
        $stmt->fetch();

        if($totalRows == 1)
        {
            $_SESSION["email_err"] = "email already exists";
            $uniqueemailandusername=false;
            $_SESSION['loggedin'] = "DENIED";


        }
    }
    else
    {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    $stmt->close();

}
if($uniqueemailandusername)
{

    if($stmt = $mysqli->prepare("INSERT INTO users (username,email,firstname, lastname, password,birthdate,creationdate,lastconnection) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"))
    {
        $stmt->bind_param("ssssssss", $param_username, $param_email, $param_firstname, $param_lastname, $param_password, $param_birthdate, $param_creationdate, $param_lastconnection);

        $param_username = strtolower(trim($_SESSION["username"]));
        $param_email = strtolower(trim($_SESSION["email"]));
        $param_firstname = trim($_SESSION["firstname"]);
        $param_lastname = trim($_SESSION["lastname"]);
        //hashage du mot de passe avec l'algo par default de php
        $param_password = password_hash(trim($_SESSION["password"]), PASSWORD_DEFAULT);
        $param_birthdate = date('Y-m-d',strtotime($_SESSION["birthdate"]));
        $param_creationdate = date("Y-m-d H:i:s");
        $param_lastconnection = $param_creationdate;
        $stmt->execute();
        $stmt->close();
        $_SESSION['loggedin'] = "ACCEPTED";
    }
    else
        echo "something went wrong";

}
$mysqli->close();

$_SESSION['registerCallback'] = true;
header("Location: ../controller/checkRegister.php");
exit();

?>


