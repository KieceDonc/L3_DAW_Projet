<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/theme.php");

function getContent($id){
    return getContentDB($id)[0]['content'];
}

function addTheme($name,$content,$sectionId){
    addThemeDB($name,$content,$sectionId);
}

?>