<?php
session_start();

if(isset($_SESSION['registerCallback']))
{
    if($_SESSION['registerCallback'])
    {
        $_SESSION['registerCallback'] = false;
        if($_SESSION['loggedin'] == 'ACCEPTED')
        {
            // all good
            header('Location: ../view/php/index.php');
            exit();
        }
        else
        {   if(isset($_SESSION['username_err']))
            { //le username existe déjà
            header('Location: ../view/php/register.php?username_err=alreadyexists');
                unset($_SESSION['username_err']);
            exit();
            }
            elseif(isset($_SESSION['email_err']))
            { //l'email existe déjà
                header('Location: ../view/php/register.php?email_err=alreadyexists');
                unset($_SESSION['email_err']);
                exit();
            }
        }
    }
}

if(isset($_POST['username'])&& isset($_POST['email']) && isset($_POST['firstname']) &&
    isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['passwordconfirmation'])
    && isset($_POST['birthdate']))
{   $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordconfirmation = $_POST['passwordconfirmation'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthdate = $_POST['birthdate'];

    //username vide ou carac interdits
    if(empty(trim($username)))
    {

        header('Location: ../view/php/register.php?username_err=empty');
        exit();
    }
    elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"])))
    {
        header('Location: ../view/php/register.php?username_err=forbiddenchars');
        exit();
    }
    //email vide
    elseif(empty(trim($email)))
    {
        header('Location: ../view/php/register.php?email_err=empty');
        exit();
    }
    //password vide ou trop court
    elseif(empty(trim($password)))
    {
        header('Location: ../view/php/register.php?password_err=empty');
        exit();
    }
    elseif(strlen(trim($_POST["password"])) < 6)
    {
        header('Location: ../view/php/register.php?password_err=tooshort');
        exit();
    }
    //password confirmation vide ou unmatched
    elseif(empty(trim($passwordconfirmation)))
    {
        header('Location: ../view/php/register.php?passwordconfirmation_err=empty');
        exit();
    }
    elseif($password !== $passwordconfirmation){
        header('Location: ../view/php/register.php?passwordconfirmation_err=unmatchedpasswords');
        exit();
    }

    //firstname ou lastname vide ou carac interdits
    elseif(empty(trim($firstname)))
    {
        header('Location: ../view/php/register.php?firstname_err=empty');
        exit();
    }
    elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["firstname"])))
    {
        header('Location: ../view/php/register.php?firstname_err=forbiddenchars');
        exit();
    }


    elseif(empty(trim($lastname)))
    {
        header('Location: ../view/php/register.php?lastname_err=empty');
        exit();
    }
    elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["lastname"])))
    {
        header('Location: ../view/php/register.php?lastname_err=forbiddenchars');
        exit();
    }
    //birthdate vide
    elseif(empty(trim($birthdate)))
    {
        header('Location: ../view/php/register.php?birthdate_err=empty');
        exit();
    }

    else
    {
        $_SESSION['username']= $username;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['passwordconfirmation'] = $passwordconfirmation;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname']=$lastname;
        $_SESSION['birthdate']=$birthdate;
        header("Location: ../model/checkRegister.php");
        exit();

    }

}
else
{
    header('Location: ../view/php/index.php');
    exit();

}
?>