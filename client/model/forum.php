<?php
    ini_set('display_errors', 1);
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    
    function getForumTopics(){
        $conn = getPDO();

        // TODO : use const
        $result = $conn->query("SELECT topics.id AS id, topics.name AS name, topics.author AS author, firstname, lastname FROM topics, users WHERE topics.author = users.ID;", PDO::FETCH_ASSOC);;
        return $result->fetchAll();
    } 

    function getForumTopicInfo($topicID){
        $conn = getPDO();

        // TODO : use const
        $result = $conn->prepare("SELECT * FROM topics WHERE id=:id;");
        $result->execute(array("id"=>$topicID));

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    function getForumTopicLastMessageDateInDB($topicID){
        $conn = getPDO();

        // without const, query look like this = "SELECT date FROM topics_posts WHERE date=(SELECT MAX(date) FROM topics_posts tp2 WHERE tp2.id=$topicID);"

        $result = $conn->prepare("SELECT :column FROM :tablename WHERE :column=(SELECT MAX(:column) FROM :tablename tp2 WHERE tp2.:nameid =:valueid);");
        $result->execute(array("column"=>CONST_DB_TABLE_TOPICSPOSTS_DATE, "tablename"=>CONST_DB_TABLE_NAME_TOPICSPOSTS, "nameid"=>CONST_DB_TABLE_TOPICSPOSTS_ID, "valueid"=>$topicID));

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    function getForumTopicMessageCountInDB($topicID){
        $conn = getPDO();

        $result = $conn->prepare("SELECT count(content) FROM topics_posts WHERE topic=:valueid;");
        $result->execute(array("valueid"=>$topicID));

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    function getForumTopicMessagesInDB($topicID){
        $conn = getPDO();

        // without const, query look like this = "SELECT topics_posts.ID, firstname, lastname, date, topic, content FROM topics_posts, users WHERE topic=". $topicID ." AND topics_posts.author = users.ID;";
        $result = $conn->prepare("SELECT :topicposts.:topicpostid, :firstname, :lastname, :datename, :topicname, :content FROM :topicposts, :users WHERE :topicname=:topicvalue AND :topicposts.:author = :users.:nameid;");
        $result->execute(array("topicposts"=>CONST_DB_TABLE_NAME_TOPICSPOSTS, "topicpostid"=>CONST_DB_TABLE_TOPICSPOSTS_ID, "firstname"=>CONST_DB_TABLE_USERS_FIRSTNAME, "lastname"=>CONST_DB_TABLE_USERS_LASTNAME, "datename"=>CONST_DB_TABLE_TOPICSPOSTS_DATE, "topicname"=>CONST_DB_TABLE_TOPICSPOSTS_TOPIC, "content"=>CONST_DB_TABLE_TOPICSPOSTS_CONTENT, "users"=>CONST_DB_TABLE_NAME_USERS, "topicvalue"=>$topicID, "author"=>CONST_DB_TABLE_TOPICSPOSTS_AUTHOR, "nameid"=>CONST_DB_TABLE_USERS_ID));

        return $result->fetchAll();
    }

    function addForumTopicMessageInDB($topicID, $userID, $sanitizedInput){
        $conn = getPDO();
        
        // TODO : use const
        $result = $conn->prepare("INSERT INTO topics_posts (author, date, content, topic) VALUES (:userid, :time, ':input', :topicid);");
        $result->execute(array("userid"=>$userID, "time"=>time(), "input"=>$sanitizedInput, "topicid"=>$topicID));
    }

    function createTopicInDB($topicName, $userID){
        $conn = getPDO();
        
        // TODO : use const
        $result = $conn->prepare("INSERT INTO topics (name, author) VALUES (':name', :userid);");
        $result->execute(array("name"=>$topicName, "userid"=>$userID));

        $topicID = $conn->lastInsertId();

        return $topicID;
    }
?>