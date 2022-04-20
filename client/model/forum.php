<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    
    function getForumTopics(){
        $conn = getPDO();

        // TODO : use const
        $result = $conn->query("SELECT topics.id AS id, topics.name AS name, topics.author AS author, topics.view_count as view_count, firstname, lastname FROM topics, users WHERE topics.author = users.ID;", PDO::FETCH_ASSOC);;
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
        //TODO not working when binding const as table name
        $query = $conn->prepare("SELECT MAX(date) FROM topics_posts WHERE topic=:valueid;");
        $query->bindValue(":valueid", $topicID);
        $query->execute();

        return $query->fetch()[0];
    }

    function getForumTopicMessageCountInDB($topicID){
        $conn = getPDO();

        $result = $conn->prepare("SELECT count(content) FROM topics_posts WHERE topic=:valueid;");
        $result->execute(array("valueid"=>$topicID));

        return $result->fetch(PDO::FETCH_ASSOC)["count(content)"];
    }

    function getForumTopicMessagesInDB($topicID){
        $conn = getPDO();

        // without const, query look like this = "SELECT topics_posts.ID, firstname, lastname, date, topic, content FROM topics_posts, users WHERE topic=". $topicID ." AND topics_posts.author = users.ID;";
        $query = $conn->prepare("SELECT topics_posts.ID, firstname, lastname, date, topic, content FROM topics_posts, users WHERE topic=:valueid AND topics_posts.author = users.ID");
        $query->bindValue(":valueid", $topicID);
        $query->execute();

        return $query->fetchAll();
    }

    function addForumTopicMessageInDB($topicID, $userID, $sanitizedInput){
        $conn = getPDO();
        
        // TODO : use const
        $result = $conn->prepare("INSERT INTO topics_posts (author, date, content, topic) VALUES (:userid, :time, :input, :topicid);");
        $result->execute(array("userid"=>$userID, "time"=>time(), "input"=>$sanitizedInput, "topicid"=>$topicID));
    }

    function createTopicInDB($topicName, $userID){
        $conn = getPDO();
        
        // TODO : use const
        $query = $conn->prepare("INSERT INTO topics (name, author, view_count) VALUES (:name, :userid, 0);");
        $query->bindValue(":name", $topicName);
        $query->bindValue(":userid", $userID);
        $query->execute();

        $topicID = $conn->lastInsertId();

        return $topicID;
    }

    function updateTopicViewCountInDB($topicID){
        $conn = getPDO();
        
        // TODO : use const
        $update = $conn->prepare("UPDATE topics SET view_count=view_count+1 WHERE id=:topicid;");
        $update->bindValue(":topicid", $topicID);
        $update->execute();
    }
?>