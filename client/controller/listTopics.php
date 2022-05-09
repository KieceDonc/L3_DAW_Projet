<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/forum.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/sanitizeHelper.php");

    if(isset($_REQUEST["searchTxt"]) && isset($_REQUEST["page"])){
        $searchTxt = sanitizeString($_REQUEST["searchTxt"]);
        $page = sanitizeString($_REQUEST["page"]);
        echo json_encode(getForumTopics($page, $searchTxt));
    }

    function getForumTopics($page, $searchTxt){
        if(!isset($_COOKIE["topicsPerPage"]) || empty($_COOKIE["topicsPerPage"])){
            $topicsPerPage = 10;
        }
        else{
            $topicsPerPage = sanitizeString($_COOKIE["topicsPerPage"]);
        }

        return getForumTopicsInDB($searchTxt, $page * $topicsPerPage, $topicsPerPage);
    }

?>