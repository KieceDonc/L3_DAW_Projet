<?php



    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/sanitizeHelper.php");

    function checkRegister($username, $email, $password, $firstname, $lastname, $birthdate,$creationdate,$lastconnection){
        session_start();

        //pdo db poo connexion
        $conn = getPDO();

        $username = sanitizeString($username);
        $email = sanitizeEmail($email);
        $password = sanitizeString($password);
        $firstname = sanitizeString($firstname);
        $lastname = sanitizeString($lastname);
        $birthdate = sanitizeString($birthdate);

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
                    closePDO($conn);
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
                    closePDO($conn);
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

            closePDO($conn);
            return CONST_DB_ACCEPTED;
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }

        closePDO($conn);
    }
?>


