<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/forum.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/sanitizeHelper.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");

    // Function call to add message inside a topic
    // it sanitize input and then add user message in DB
    // $userInput = message content    
    function addForumTopicMessage($topicID, $userID, $userInput){
        $sanitizedInput = sanitizeString($userInput); // TODO : check if it is really sanitize cuz I don't really know
        
        if(isset($sanitizedInput)){
            if(empty($sanitizedInput)){
                // TODO: Handle error
            }else{
                addForumTopicMessageInDB($topicID, $userID, $sanitizedInput);        
            }
        }else{
            // TODO: Handle error
        }
    } 

    // Function call to create a new topic
    // it sanitize input, add the new topic in DB and then load the page of the topic
    // $userInput = topic name
    function createTopic($userInput, $userID){
        $sanitizedInput = sanitizeString($userInput); // TODO : check if it is really sanitize cuz I don't really know

        if(isset($sanitizedInput)){
            if(empty($sanitizedInput)){
                // TODO: Handle error
            }else{
                $topicID = createTopicInDB($sanitizedInput, $userID);        
                header("Location: /forum?topic=". $topicID);

            }
        }else{
            // TODO: Handle error
        }

        // TODO : sanitize inputs
        
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

    function getForumTopics($page, $searchTxt){
        if(!isset($_COOKIE["topicsPerPage"]) || empty($_COOKIE["topicsPerPage"])){
			$topicsPerPage = 10;
		}
		else{
			$topicsPerPage = $_COOKIE["topicsPerPage"];//TODO sanitize inputs
		}

        return getForumTopicsInDB($searchTxt, $page * $topicsPerPage, $topicsPerPage);
    }

    function getForumTopicNbPages($searchTxt){
        if(!isset($_COOKIE["topicsPerPage"]) || empty($_COOKIE["topicsPerPage"])){
			$topicsPerPage = 10;
		}
		else{
			$topicsPerPage = $_COOKIE["topicsPerPage"];//TODO sanitize inputs
		}

        $count = getTopicCountInDB($searchTxt);

        return intdiv($count, $topicsPerPage);
    }

?>