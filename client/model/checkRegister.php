<?php

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/model/mysqli.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/const.php");


    function checkRegister($username, $email, $password, $firstname, $lastname, $birthdate,$creationdate,$lastconnection){
        session_start();

        //mysqli db poo connexion
        $mysqli = getMysqli();

        $sqlusername = "SELECT count(*) FROM users WHERE LOWER(username) = ?";
        $sqlemail = "SELECT count(*) FROM users WHERE LOWER(email) = ?";
        if($stmt = $mysqli->prepare($sqlusername))
        {
            $usernamelower = strtolower($username);
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $usernamelower);



            // Attempt to execute the prepared statement
            if($stmt->execute())
            {
                // store result
                $stmt->bind_result($totalRows);
                $stmt->fetch();

                if($totalRows == 1)
                {
                    closeMysqli($mysqli);
                    return CONST_DB_ERR_USERNAMEEXIST;
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
            $emaillower = strtolower($email);
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $emaillower);



            // Attempt to execute the prepared statement
            if($stmt->execute())
            {
                // store result
                $stmt->bind_result($totalRows);
                $stmt->fetch();

                if($totalRows == 1)
                {
                    closeMysqli($mysqli);
                    return CONST_DB_ERR_EMAILEXISTS;
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();

        }

        $stmt = $mysqli->prepare("INSERT INTO users (username,email,firstname, lastname, password,birthdate,creationdate,lastconnection) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if(!($stmt === false))
        {
            $stmt->bind_param("ssssssss", $username, $email, $firstname, $lastname, $password, $birthdate, $creationdate, $lastconnection);


            $stmt->execute();
            $stmt->close();

            closeMysqli($mysqli);
            return CONST_DB_ACCEPTED;
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }
    
        closeMysqli($mysqli);
    }
?>


