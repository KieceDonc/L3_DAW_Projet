<?php
    
    function betterRequire($path){
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/dev/const.php");
        
        if(DEV_MODE){
            require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/dev/' .$path);
        }else{
            require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . $path);
        }
    }
?>