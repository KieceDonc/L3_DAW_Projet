<?php
    // inspire from https://stackoverflow.com/a/130534

    function sanitizeString($input){
        $output = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        return $output;  
    }
    function sanitizeEmail($input){
        $output = filter_var($input, FILTER_SANITIZE_EMAIL);
        return $output;

    }
    function sanitizeURL($input){
        $output = filter_var($input, FILTER_SANITIZE_URL);
        return $output;

    }

?>