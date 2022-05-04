<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/mediaInterface.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");

    // Adds a file into the database 
    function uploadFile(){
        if(!isset($_SESSION[CONST_SESSION_USERID]) || !isset($_FILES['userfile']['type']) || !isset($_FILES['userfile']['name']) || !isset($_FILES['userfile']['size']) || !isset($_FILES['userfile']['tmp_name']) )
            return false;

        $fileOwner=$_SESSION[CONST_SESSION_USERID];
        $fileType=$_FILES['userfile']['type'];
        $fileName=$_FILES['userfile']['name'];
        $fileSize=$_FILES['userfile']['size'];
        $fileContent = file_get_contents($_FILES['userfile']['tmp_name']);

        insertMediaDB($fileOwner,$fileType,$fileName,$fileSize,$fileContent);
        return true;
    } 

    function getAllFiles(){
        $files = getAllFilesDB($_SESSION[CONST_SESSION_USERID]);
        return $files;
    }

    function getFile($mediaId){
        $file = getFileDB($mediaId);
        return $file[0];
    }

    function getFilePath($content){
        return "data:image/png;base64,".base64_encode($content);
    }

    function deleteMedia($mediaId){
        deleteMediaDB($mediaId);
    }
?>