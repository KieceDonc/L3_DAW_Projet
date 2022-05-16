<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/mediaInterface.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/coursesInfo.php");

/* Returns the string passed in parameters after doing the aftermentioned changes :
 [b]txt[/b]            -> <b>txt</b>
 [i]txt[/i]            -> <i>txt</i>
 [img=id]legend[/img]  -> display the image + legend in text.
 [video]youtubeurl[/video]  ->  display youtube video
*/
function convert($txt) {
    do {
        $txt = preg_replace_callback_array(
            [
                '~\[([bi])](.*?)\[/\1]~' => fn($m) => sprintf('<%1$s>%2$s</%1$s>', $m[1], $m[2]),   // If matches [b]txt[/b] or [i]txt[/i], replace with bold or italic in html
                '~\[img=(.*?)](.*?)\[/img]~' => 'fetchImg', // If matches [img]txt[/img], passes txt into the fetchImg($m) function
                '~\[video](.*?)\[/video]~' => 'displayVideo', // If matches [img]txt[/img], passes txt into the fetchImg($m) function
            ],
            $txt,
            -1,
            $count
        );
    } while ($count);
    return $txt;
}

/*<iframe width="420" height="315"
src='https://www.youtube.com/embed/tgbNymZ7vqY'>
</iframe>*/

// Builds a div containing the image and the legend, only if the image exists in the database and is owned by the user
function fetchImg($m) {
    $mediaId = $m[1];
    $userId = $_SESSION[CONST_SESSION_USERID];

    //if(!ownsMedia($userId,$mediaId))    // Checks if the resource id has indeed been uploaded by this user. 
        //return "";
    
    $file = getFile($mediaId);
    $path = getFilePath($file['content']);
    return "<div class='imgContainer'><img class'userImg' src=".$path."><div class='userLegend'>".$m[2]."</div></div>";
}

// Builds a div containing the video from the youtube link
function displayVideo($m){
    $url = $m[1];
    $code = substr($url,17);
    return "<div class='vidContainer'><iframe class='ytbvideo' width='420' height='315' src='https://www.youtube.com/embed/".$code."'></iframe></div>";
}

?>