<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/forum.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/listTopics.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/sanitizeHelper.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");

    // Function call to add message inside a topic
    // it sanitizes input and then add user message in DB
    // $userInput = message content    
    function addForumTopicMessage($topicID, $userID, $userInput){
        $sanitizedInput = sanitizeString($userInput);
        
        if(isset($sanitizedInput) && !empty($sanitizedInput)){
            addForumTopicMessageInDB($topicID, $userID, $sanitizedInput);        
        }
    } 

    // Function call to create a new topic
    // it sanitize input, add the new topic in DB and then load the page of the topic
    // $userInput = topic name
    function createTopic($userInput, $userID){
        $sanitizedInput = sanitizeString($userInput);

        if(isset($sanitizedInput) && !empty($sanitizedInput)){
            $topicID = createTopicInDB($sanitizedInput, $userID);        
            header("Location: /forum?topic=". $topicID);
        }
    }

    function getForumTopicLastMessageDate($topicID){
        return getForumTopicLastMessageDateInDB($topicID);
    }

    function editMessage($messageId, $newContent){
        if(
            isset($_SESSION[CONST_SESSION_ISLOGGED]) 
            && $_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES
            && getForumMessageAuthorInDB($messageId) == getUserID($_SESSION[CONST_SESSION_EMAIL])
        ){
            editMessageInDB($messageId, $newContent);
        }
    }

    function deleteMessage($messageId){
        if(
            isset($_SESSION[CONST_SESSION_ISLOGGED]) 
            && $_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES
            && getForumMessageAuthorInDB($messageId) == getUserID($_SESSION[CONST_SESSION_EMAIL])
        ){
            deleteMessageInDB($messageId);
        }
    }

    function editTopic($topicId, $newName){
        if(
            isset($_SESSION[CONST_SESSION_ISLOGGED]) 
            && $_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES
            && getForumTopicAuthorInDB($topicId) == getUserID($_SESSION[CONST_SESSION_EMAIL])
        ){
            editTopicInDB($topicId, $newName);
        }
    }

    function deleteTopic($topicId){
        if(
            isset($_SESSION[CONST_SESSION_ISLOGGED]) 
            && $_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES
            && getForumTopicAuthorInDB($topicId) == getUserID($_SESSION[CONST_SESSION_EMAIL])
        ){
            deleteTopicInDB($topicId);
        }
    }

    function getForumTopicNbPages($searchTxt){
        if(!isset($_COOKIE["topicsPerPage"]) || empty($_COOKIE["topicsPerPage"])){
			$topicsPerPage = 10;
		}
		else{
			$topicsPerPage = sanitizeString($_COOKIE["topicsPerPage"]);
		}

        $count = getTopicCountInDB($searchTxt);

        return intdiv($count, $topicsPerPage);
    }
    

    function getForumTopicMessagesNbPages($topicId){
        if(!isset($_COOKIE["messagesPerPage"]) || empty($_COOKIE["messagesPerPage"])){
			$messagesPerPage = 10;
		}
		else{
			$messagesPerPage = sanitizeString($_COOKIE["messagesPerPage"]);
		}

        $count = getForumTopicMessageCountInDB($topicId);

        return intdiv($count, $messagesPerPage);
    }

    function getForumTopicMessages($topicID, $page){
        if(!isset($_COOKIE["messagesPerPage"]) || empty($_COOKIE["messagesPerPage"])){
			$messagesPerPage = 10;
		}
		else{
			$messagesPerPage = sanitizeString($_COOKIE["messagesPerPage"]);
		}

        return getForumTopicMessagesInDB($topicID, $page * $messagesPerPage, $messagesPerPage);
    }

?>