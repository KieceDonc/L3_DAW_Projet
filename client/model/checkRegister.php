<?php


    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/config.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/const.php");


    function checkRegister($username, $email, $password, $firstname, $lastname, $birthdate,$creationdate,$lastconnection){
        session_start();

        //pdo db poo connexion
        try
        {
            $conn = new PDO('mysql:'.DB_SERVER.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USERNAME, DB_PASSWORD);

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connection: " . $e->getMessage();
        }

        $sqlusername = "SELECT count(*) FROM ".DB_NAME.".users WHERE LOWER(username) = :username GROUP BY username";
        $sqlemail = "SELECT count(*) FROM ".DB_NAME.".users WHERE LOWER(email) = :email GROUP BY email";
        if($stmt = $conn->prepare($sqlusername))
        {
            $usernamelower = strtolower($username);

            // Attempt to execute the prepared statement
            if($stmt->execute(['username' => $usernamelower]))
            {
                // store result
                $reponse = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $reponse['count(*)'];

                if($count == 1)
                {
                    $conn = null;
                    return CONST_DB_ERR_USERNAMEEXIST;
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";   
            }



        }

        if($stmt = $conn->prepare($sqlemail))
        {
            $emaillower = strtolower($email);




            // Attempt to execute the prepared statement
            if($stmt->execute(['email' => $emaillower]))
            {

                // store result
                $reponse = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $reponse['count(*)'];

                if($count == 1)
                {
                    $conn = null;
                    return CONST_DB_ERR_EMAILEXISTS;
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }



        }

        $stmt = $conn->prepare("INSERT INTO ".DB_NAME.".users (username,email,firstname, lastname, password,birthdate,creationdate,lastconnection) VALUES (:username, :email, :firstname, :lastname, :password, :birthdate, :creationdate, :lastconnection)");
        if(!($stmt === false))
        {
            $stmt->execute(['username' => $username,'email' => $email,'firstname'=>$firstname,'lastname'=>$lastname,'password'=>$password,'birthdate'=>$birthdate,'creationdate'=>$creationdate,'lastconnection'=>$lastconnection]);

            $conn = null;
            return CONST_DB_ACCEPTED;
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }

        $conn = null;
    }
?>


