<?php
    
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/mysqli.php");
    
    function getForumTopics(){
        $mysqli = getMysqli();

        $requete = "SELECT * FROM topics;";
        $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);

        closeMysqli($mysqli);

        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    function getForumTopic($topicID){
        $mysqli = getMysqli();

        $requete = "SELECT * FROM topics WHERE id=" . $topicID . ";";
        $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);

        closeMysqli($mysqli);

        return $result->fetch_assoc(); 
    }

    function addForumTopicMessageInDB($topicID, $userID, $sanitizedInput){
        $mysqli = getMysqli();

        $mysqli->query("INSERT INTO topics_posts (author, date, content, topic) VALUES ($userID,".time().", '".$sanitizedInput."', ". $topicID.");");

        closeMysqli($mysqli);
    }
?>