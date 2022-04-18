<?php
    
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/model/mysqli.php");
    
    function getForumTopics(){
        $mysqli = getMysqli();

        $requete = "SELECT * FROM topics;";
        $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);

        closeMysqli($mysqli);

        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    function getForumTopicInfo($topicID){
        $mysqli = getMysqli();

        $requete = "SELECT * FROM topics WHERE id=" . $topicID . ";";
        $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);

        closeMysqli($mysqli);

        return $result->fetch_assoc(); 
    }

    function getForumTopicMessages($topicID){
        $mysqli = getMysqli();

        $requete = "SELECT ". CONST_DB_TABLE_NAME_TOPICSPOSTS .".". CONST_DB_TABLE_TOPICSPOSTS_ID. ", ". CONST_DB_TABLE_USERS_FIRSTNAME .", ". CONST_DB_TABLE_USERS_LASTNAME .", ". CONST_DB_TABLE_TOPICSPOSTS_DATE .", ". CONST_DB_TABLE_TOPICSPOSTS_TOPIC .", ". CONST_DB_TABLE_TOPICSPOSTS_CONTENT ." FROM ". CONST_DB_TABLE_NAME_TOPICSPOSTS .", ". CONST_DB_TABLE_NAME_USERS ." WHERE ". CONST_DB_TABLE_TOPICSPOSTS_TOPIC ."=". $topicID ." AND ". CONST_DB_TABLE_NAME_TOPICSPOSTS .".". CONST_DB_TABLE_TOPICSPOSTS_AUTHOR ." = ". CONST_DB_TABLE_NAME_USERS .".". CONST_DB_TABLE_USERS_ID .";";
        // without const, query look like this = "SELECT topics_posts.ID, firstname, lastname, date, topic, content FROM topics_posts, users WHERE topic=". $topicID ." AND topics_posts.author = users.ID;";
        $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);

        closeMysqli($mysqli);

        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    function addForumTopicMessageInDB($topicID, $userID, $sanitizedInput){
        $mysqli = getMysqli();

        $mysqli->query("INSERT INTO topics_posts (author, date, content, topic) VALUES ($userID,".time().", '".$sanitizedInput."', ". $topicID.");");

        closeMysqli($mysqli);
    }

    function createTopicInDB($topicName, $userID){
        $mysqli = getMysqli();

        $mysqli->query("INSERT INTO topics (name, author) VALUES ('".$topicName."', ". $userID .");");
        $topicID = $mysqli->insert_id;

        closeMysqli($mysqli);

        return $topicID;
    }
?>