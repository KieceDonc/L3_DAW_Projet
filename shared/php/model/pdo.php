<?php

    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");

function getPDO(){
    try
    {
        $conn = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USERNAME, DB_PASSWORD);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connection: " . $e->getMessage();
    }
    return $conn;

}

function closePDO(&$conn){
    $conn = null;
}
