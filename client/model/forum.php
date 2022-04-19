<?php
    
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/model/pdo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/const.php");
    
    function getForumTopics(){
        $mysqli = getMysqli();

        // TODO : use const
        $requete = "SELECT topics.id AS id, topics.name AS name, topics.author AS author, firstname, lastname FROM topics, users WHERE topics.author = users.ID;";
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

    function getForumTopicLastMessageDateInDB($topicID){
        $mysqli = getMysqli();

        $requete = "SELECT ". CONST_DB_TABLE_TOPICSPOSTS_DATE ." FROM ". CONST_DB_TABLE_NAME_TOPICSPOSTS ." WHERE ". CONST_DB_TABLE_TOPICSPOSTS_DATE ."=(SELECT MAX(". CONST_DB_TABLE_TOPICSPOSTS_DATE .") FROM ". CONST_DB_TABLE_NAME_TOPICSPOSTS . " tp2 WHERE tp2.". CONST_DB_TABLE_TOPICSPOSTS_ID ."=". $topicID .");";
        // without const, query look like this = "SELECT date FROM topics_posts WHERE date=(SELECT MAX(date) FROM topics_posts tp2 WHERE tp2.id=$topicID);"
        $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);

        closeMysqli($mysqli);

        return $result->fetch_row()[0];
    }

    function getForumTopicMessageCountInDB($topicID){
        $mysqli = getMysqli();

        // TODO : use const
        $requete = "SELECT count(content) FROM topics_posts WHERE topic=". $topicID .";";
        $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);

        closeMysqli($mysqli);

        return $result->fetch_row()[0];
    }

    function getForumTopicMessagesInDB($topicID){
        $mysqli = getMysqli();

        $requete = "SELECT ". CONST_DB_TABLE_NAME_TOPICSPOSTS .".". CONST_DB_TABLE_TOPICSPOSTS_ID. ", ". CONST_DB_TABLE_USERS_FIRSTNAME .", ". CONST_DB_TABLE_USERS_LASTNAME .", ". CONST_DB_TABLE_TOPICSPOSTS_DATE .", ". CONST_DB_TABLE_TOPICSPOSTS_TOPIC .", ". CONST_DB_TABLE_TOPICSPOSTS_CONTENT ." FROM ". CONST_DB_TABLE_NAME_TOPICSPOSTS .", ". CONST_DB_TABLE_NAME_USERS ." WHERE ". CONST_DB_TABLE_TOPICSPOSTS_TOPIC ."=". $topicID ." AND ". CONST_DB_TABLE_NAME_TOPICSPOSTS .".". CONST_DB_TABLE_TOPICSPOSTS_AUTHOR ." = ". CONST_DB_TABLE_NAME_USERS .".". CONST_DB_TABLE_USERS_ID .";";
        // without const, query look like this = "SELECT topics_posts.ID, firstname, lastname, date, topic, content FROM topics_posts, users WHERE topic=". $topicID ." AND topics_posts.author = users.ID;";
        $result = $mysqli->query($requete,MYSQLI_STORE_RESULT);

        closeMysqli($mysqli);

        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    function addForumTopicMessageInDB($topicID, $userID, $sanitizedInput){
        $mysqli = getMysqli();

        // TODO : use const
        $mysqli->query("INSERT INTO topics_posts (author, date, content, topic) VALUES ($userID,".time().", '".$sanitizedInput."', ". $topicID.");");

        closeMysqli($mysqli);
    }

    function createTopicInDB($topicName, $userID){
        $mysqli = getMysqli();

        // TODO : use const
        $mysqli->query("INSERT INTO topics (name, author) VALUES ('".$topicName."', ". $userID .");");
        $topicID = $mysqli->insert_id;

        closeMysqli($mysqli);

        return $topicID;
    }
?>