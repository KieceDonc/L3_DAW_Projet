<?php 
// NOT USED ANYMORE
/*
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/config.php");

function getMysqli(){
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
    return $mysqli;

}

function closeMysqli($mysqli){
    $mysqli->close();
}
*/