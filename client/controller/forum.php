<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/forum.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/sanitizeHelper.php");

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
    function createTopic($userInput){
        $sanitizedInput = sanitizeString($userInput); // TODO : check if it is really sanitize cuz I don't really know

        if(isset($sanitizedInput)){
            if(empty($sanitizedInput)){
                // TODO: Handle error
            }else{
                $topicID = createTopicInDB($sanitizedInput);        
                header("Location: /forum?topic=". $topicID);

            }
        }else{
            // TODO: Handle error
        }

        // TODO : sanitize inputs
        
    }

?>