<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/pdo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");

    function getTopicCountInDB($searchTxt){
        $conn = getPDO();

        // TODO : use const
        $query = $conn->prepare("SELECT COUNT(*) as count FROM topics WHERE topics.name LIKE :search;");
        $query->bindValue("search", "%" . $searchTxt . "%");
        $query->execute();
        
        return $query->fetch()["count"];
    }
    
    function getForumTopicsInDB($searchTxt, $start, $count){
        $conn = getPDO();

        // TODO : use const
        $query = $conn->prepare("SELECT topics.id AS id, topics.name AS name, topics.author AS author, topics.view_count as view_count, username FROM topics, users WHERE topics.author = users.ID AND topics.name LIKE :search LIMIT :start, :max;");
        $query->bindValue("search", "%" . $searchTxt . "%");
        $query->bindValue("start", $start, PDO::PARAM_INT);
        $query->bindValue("max", $count, PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchAll();
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

    function getForumTopicAuthorInDB($topicID){
        $conn = getPDO();

        $result = $conn->prepare("SELECT author FROM topics WHERE id=:valueid;");
        $result->execute(array("valueid"=>$topicID));

        return $result->fetch(PDO::FETCH_ASSOC)["author"];
    }

    function getForumMessageAuthorInDB($messageID){
        $conn = getPDO();

        $result = $conn->prepare("SELECT author FROM topics_posts WHERE id=:valueid;");
        $result->execute(array("valueid"=>$messageID));

        return $result->fetch(PDO::FETCH_ASSOC)["author"];
    }

    function getForumTopicMessagesInDB($topicID, $start, $count){
        $conn = getPDO();

        // without const, query look like this = "SELECT topics_posts.ID, firstname, lastname, date, topic, content FROM topics_posts, users WHERE topic=". $topicID ." AND topics_posts.author = users.ID;";
        $query = $conn->prepare("SELECT topics_posts.ID AS id, username, topics_posts.author AS author, date, topic, content FROM topics_posts, users WHERE topic=:valueid AND topics_posts.author = users.ID LIMIT :start, :max;");
        $query->bindValue(":valueid", $topicID);
        $query->bindValue("start", $start, PDO::PARAM_INT);
        $query->bindValue("max", $count, PDO::PARAM_INT);
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

    function deleteMessageInDB($id){
        $conn = getPDO();
        
        // TODO : use const
        $update = $conn->prepare("DELETE FROM topics_posts WHERE id=:id;");
        $update->bindValue(":id", $id);
        $update->execute();
    }

    function editMessageInDB($id, $content) {
        $conn = getPDO();
        
        // TODO : use const
        $update = $conn->prepare("UPDATE topics_posts SET content=:content WHERE id=:id;");
        $update->bindValue(":content", $content);
        $update->bindValue(":id", $id);
        $update->execute();
    }

    function deleteTopicInDB($id){
        $conn = getPDO();
        
        // TODO : use const
        $update = $conn->prepare("DELETE FROM topics WHERE id=:id;");
        $update->bindValue(":id", $id);
        $update->execute();
    }

    function editTopicInDB($id, $name) {
        $conn = getPDO();
        
        // TODO : use const
        $update = $conn->prepare("UPDATE topics SET name=:name WHERE id=:id;");
        $update->bindValue(":name", $name);
        $update->bindValue(":id", $id);
        $update->execute();
    }
?>