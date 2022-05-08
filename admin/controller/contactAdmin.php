<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");

    //function used to know if the current user exitis an admin
	function isAnAdmin(){
        return getDBAdmin($_SESSION[CONST_SESSION_EMAIL]);
    }
?>