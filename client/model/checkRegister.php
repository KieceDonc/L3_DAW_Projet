<?php

    require_once("../../admin/mysqli.php");

    function checkRegister($username, $password, $email, $firstname, $lastname, $birthdate){
        session_start();

        //mysqli db poo connexion
        $mysqli = getMysqli();

        $sqlusername = "SELECT count(*) FROM users WHERE username = ?";
        $sqlemail = "SELECT count(*) FROM users WHERE email = ?";
        if($stmt = $mysqli->prepare($sqlusername))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($username);

            // Attempt to execute the prepared statement
            if($stmt->execute())
            {
                // store result
                $stmt->bind_result($totalRows);
                $stmt->fetch();

                if($totalRows == 1)
                {
                    closeMysqli($mysqli);
                    return 'USERNAME_ALREADY_EXISTS';
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
            $param_email = trim($email);

            // Attempt to execute the prepared statement
            if($stmt->execute())
            {
                // store result
                $stmt->bind_result($totalRows);
                $stmt->fetch();

                if($totalRows == 1)
                {
                    closeMysqli($mysqli);
                    return 'EMAIL_ALREADY_EXISTS';
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();

        }
        mysqli_report(MYSQLI_REPORT_ALL);
        $stmt = $mysqli->prepare("INSERT INTO users (username,email,firstname, lastname, password,birthdate,creationdate,lastconnection) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if(!($stmt === false))
        {
            $stmt->bind_param("ssssssss", $param_username, $param_email, $param_firstname, $param_lastname, $param_password, $param_birthdate, $param_creationdate, $param_lastconnection);

            $param_username = strtolower(trim($usernames));
            $param_email = strtolower(trim($email));
            $param_firstname = trim($firstname);
            $param_lastname = trim($lastname);
            //hashage du mot de passe avec l'algo par default de php
            $param_password = password_hash(trim($password), PASSWORD_DEFAULT);
            $param_birthdate = date('Y-m-d',strtotime($birthdate));
            $param_creationdate = date("Y-m-d H:i:s");
            $param_lastconnection = $param_creationdate;
            $stmt->execute();
            $stmt->close();

            closeMysqli($mysqli);
            return "ACCEPTED";
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }
    
        closeMysqli($mysqli);
    }
?>


