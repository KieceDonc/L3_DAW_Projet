<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/forum.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/sanitizeHelper.php");

    // Function call to add message inside a topic
    // sanitize input and then add user message in DB    
    function addForumTopicMessage($topicID, $userID, $userInput){
        $sanitizedInput = sanitizeString($userInput);
        
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

?>