<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/model/language.php");

    function getLanguageList() {
        // we check if we already stored the list
        if(!isset($_SESSION[CONST_SESSION_LANGUAGESTORED_LIST])){
            // No, we need to query the list
            $list = getLanguageListDB();

            // Has db returned error ?
            if($list != CONST_DB_UNKNOWN_ERROR){
                // we store the list so we don't have to recall and spam db of query
                $_SESSION[CONST_SESSION_LANGUAGESTORED_LIST] = $list; 
                return $list;
            }else{
                //no language in DB, should never happen
                return array();
            }
        }else{

            // Yes we return it
            return $_SESSION[CONST_SESSION_LANGUAGESTORED_LIST]; 
        }
    }

    function getTranslation($textId) {
        $lang = $_COOKIE["lang"];

        //detect if the client switched his language
        if(!isset($_SESSION[CONST_SESSION_LANGUAGESTORED_CURRENT_LANG]) || $lang != $_SESSION[CONST_SESSION_LANGUAGESTORED_CURRENT_LANG]){
            $_SESSION[CONST_SESSION_LANGUAGESTORED_CURRENT_LANG] = $lang;
            unset($_SESSION[CONST_SESSION_LANGUAGESTORED_TRANSLATIONS]);
            $_SESSION[CONST_SESSION_LANGUAGESTORED_TRANSLATIONS] = array();
        }

        // we check if we already stored the translation
        if(!isset($_SESSION[CONST_SESSION_LANGUAGESTORED_TRANSLATIONS][$textId])){
            // No, we need to query the translation
            $translation = getTranslationDB($textId, $lang);

            // Has db returned error ?
            if($translation != CONST_DB_UNKNOWN_ERROR){
                // we store the list so we don't have to recall and spam db of query
                $_SESSION[CONST_SESSION_LANGUAGESTORED_TRANSLATIONS][$textId] = $translation; 
                return $translation;
            }else{
                //no translation in DB, should never happen (if the language is correct)
                return "TRANSLATION ERROR";
            }
        }else{

            // Yes we return it
            return $_SESSION[CONST_SESSION_LANGUAGESTORED_TRANSLATIONS][$textId]; 
        }
    }
?>