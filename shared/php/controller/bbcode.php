<?php

function convertBBCode ($txt){
    $patterns = array('/\[b\](.*?)\[\/b\]/','/\[i\](.*?)\[\/i\]/','/\[img\](.*?)\[\/img\]/');
    $replace = array("<b>$1</b>","<i>$1</i>","---- $1 ----");
    $res = preg_replace($patterns,$replace, $txt);
    return $res;
}

?>