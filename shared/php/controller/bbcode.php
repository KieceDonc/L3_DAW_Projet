<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/mediaInterface.php");

/* Returns the string passed in parameters after doing the aftermentioned changes :
 [b]txt[/b]            -> <b>txt</b>
 [i]txt[/i]            -> <i>txt</i>
 [img=id]legend[/img]  -> display the image + legend in text.
*/
function convert($txt) {
    do {
        $txt = preg_replace_callback_array(
            [
                '~\[([bi])](.*?)\[/\1]~' => fn($m) => sprintf('<%1$s>%2$s</%1$s>', $m[1], $m[2]),   // If matches [b]txt[/b] or [i]txt[/i], replace with bold or italic in html
                '~\[img=(.*?)](.*?)\[/img]~' => 'fetchImg', // If matches [img]txt[/img], passes txt into the fetchImg($m) function
            ],
            $txt,
            -1,
            $count
        );
    } while ($count);
    return $txt;
}

// Builds a div containing the image and the legend, only if the image exists in the database and is owned by the user
function fetchImg($m) {
    $mediaId = $m[1];
    $file = getFile($mediaId);
    $path = getFilePath($file['content']);
    return "<div class='imgContainer'><img class'userImg' src=".$path."><div class='userLegend'>".$m[2]."</div></div>";
}

?>