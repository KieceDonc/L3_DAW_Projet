<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/mediaInterface.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");

    function uploadFile(){
        $fileOwner=$_SESSION[CONST_SESSION_USERID];
        $fileType=$_FILES['userfile']['type'];
        $fileName=$_FILES['userfile']['name'];
        $fileSize=$_FILES['userfile']['size'];
        $fileContent = file_get_contents($_FILES['userfile']['tmp_name']);
        echo print_r($_FILES);
        insertMediaDB($fileOwner,$fileType,$fileName,$fileSize,$fileContent);
        header("Location: /admin/profile");
    } 

    function getAllFiles(){
        $files = getAllFilesDB($_SESSION[CONST_SESSION_USERID]);
        return $files;
    }

    function getFile($mediaId){
        $file = getFile($mediaId);
        return $file[0]['content'];
    }

    function getFilePath($content){
        return "<img src='data:image/png;base64,".base64_encode($content)."'/>";
    }

    function deleteMedia($mediaId){
        deleteMediaDB($mediaId);
    }
?>