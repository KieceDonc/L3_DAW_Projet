<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/model/manageContact.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");

function getContacts(){
    if(getAdminID($_SESSION[CONST_SESSION_EMAIL]) == 1)
    {
        return getContactsDB();
    }
}

function deleteContact($id){
    if(getAdminID($_SESSION[CONST_SESSION_EMAIL]) == 1)
    {
        deleteContactDB($id);
    }
}

function clearContacts(){
    if(getAdminID($_SESSION[CONST_SESSION_EMAIL]) == 1)
    {
        clearContactDB();
    }
}

?>