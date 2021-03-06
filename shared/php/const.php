<?php
    // Info to connect to db
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'php');
    define('DB_PASSWORD', 'php_local');
    define('DB_NAME', 'public');
    define("DB_CHARSET", "utf8");

    // DB table, columns name for table topics_posts
    define('CONST_DB_TABLE_NAME_TOPICSPOSTS','topics_posts'); // topics_posts = name of the column in db in topics_posts table
    define('CONST_DB_TABLE_TOPICSPOSTS_ID','id'); // id = name of the column in db in topics_posts table
    define('CONST_DB_TABLE_TOPICSPOSTS_AUTHOR','author'); // author = name of the column in db in topics_posts table
    define('CONST_DB_TABLE_TOPICSPOSTS_DATE','date'); // date = name of the column in db in topics_posts table
    define('CONST_DB_TABLE_TOPICSPOSTS_CONTENT','content'); // content = name of the column in db in topics_posts table
    define('CONST_DB_TABLE_TOPICSPOSTS_TOPIC','topic'); // topic = name of the column in db in topics_posts table

    // DB table, columns name for table users
    define('CONST_DB_TABLE_NAME_USERS','users'); // users = name of the column in db in users table
    define('CONST_DB_TABLE_USERS_ID','id'); // id = name of the column in db in users table
    define('CONST_DB_TABLE_USERS_EMAIL','email'); // email = name of the column in db in users table
    define('CONST_DB_TABLE_USERS_FIRSTNAME','firstname'); // firstname = name of the column in db in users table
    define('CONST_DB_TABLE_USERS_LASTNAME','lastname'); // lastname = name of the column in db in users table
    define('CONST_DB_TABLE_USERS_USERNAME','username'); // username = name of the column in db in users table
    define('CONST_DB_TABLE_USERS_LASTCONNECTION','lastconnection'); // lastconnection = name of the column in db in users table
    define('CONST_DB_TABLE_USERS_BIRTHDATE','birthdate'); // birthdate = name of the column in db in users table
    define('CONST_DB_TABLE_USERS_CREATIONDATE','creationdate'); // creationdate = name of the column in db in users table
    define('CONST_DB_TABLE_USERS_PASSWORD','password'); // password = name of the column in db in users table
    define('CONST_DB_TABLE_ADMIN_VALUE','admin'); // admin = name of the column in db in users table

    // DB return type
    define('CONST_DB_ACCEPTED', 'ACCEPTED');
    define('CONST_DB_ERR_USERDONTEXIST','USER_DONT_EXIST');
    define('CONST_DB_ERR_USERNAMEEXIST','USERNAME_ALREADY_EXISTS');
    define('CONST_DB_ERR_EMAILEXISTS','EMAIL_ALREADY_EXISTS');
    define('CONST_DB_UNKNOWN_ERROR', 'UKNOWN_ERROR');

    // Error type
    define('CONST_ERR_EMPTY', 'empty');
    define('CONST_ERR_FORBIDDENCHARS', 'forbiddenchars');
    define('CONST_ERR_TOOSHORT', 'tooshort');
    define('CONST_ERR_UNMATCHED', 'unmatched');
    define('CONST_ERR_ALREADYEXISTS', 'alreadyexists');

    // Specific error type
    define('CONST_URLPARAM_ERR_USERNAME','username_err');
    define('CONST_URLPARAM_ERR_EMAIL','email_err');
    define('CONST_URLPARAM_ERR_PASSWORD','password_err');
    define('CONST_URLPARAM_ERR_PASSWORDCONFIRMATION','passwordconfirmation_err');
    define('CONST_URLPARAM_ERR_FIRSTNAME','firstname_err');
    define('CONST_URLPARAM_ERR_LASTNAME','lastname_err');
    define('CONST_URLPARAM_ERR_BIRTHDATE','birthdate_err');

    // Logging return type
    define('CONST_LOGGING_ACCEPTED','ACCEPTED');
    define('CONST_LOGGING_INVALID','INVALID');

    // Session info, const etc ...
    define('CONST_SESSION_EMAIL','EMAIL');
    define('CONST_SESSION_USERID','USERID');
    define('CONST_SESSION_ISLOGGED','ISLOGGED');
    define('CONST_SESSION_ISLOGGED_YES','YES');
    define('CONST_SESSION_USERSTORED_ID','CONST_SESSION_USERSTORED_ID'); // Use for $_SESSION[CONST_SESSION_USERSTORED_ID] and know the id if we stored it. Plz see userInfo.php in controller
    define('CONST_SESSION_USERSTORED_FIRSTNAME','USER_STORED_FIRSTNAME'); // Use for $_SESSION[CONST_SESSION_USERSTORED_FIRSTNAME] and know the firstname if we stored it. Plz see userInfo.php in controller
    define('CONST_SESSION_USERSTORED_LASTNAME','USER_STORED_LASTNAME'); // Use for $_SESSION[CONST_SESSION_USERSTORED_LASTNAME] and know the lastname if we stored it. Plz see userInfo.php in controller
    define('CONST_SESSION_USERSTORED_USERNAME','USER_STORED_USERNAME'); // Use for $_SESSION[CONST_SESSION_USERSTORED_USERNAME] and know the username if we stored it. Plz see userInfo.php in controller
    define('CONST_SESSION_USERSTORED_BIRTHDATE','USER_STORED_BIRTHDATE'); // Use for $_SESSION[CONST_SESSION_USERSTORED_BIRTHDATE] and know the birthdate if we stored it. Plz see userInfo.php in controller
    define('CONST_SESSION_USERSTORED_PASSWORD','USER_STORED_PASSWORD'); // Use for $_SESSION[CONST_SESSION_USERSTORED_PASSWORD] and know the password if we stored it. Plz see userInfo.php in controller
    define('CONST_SESSION_USERSTORED_ADMIN','USER_STORED_PASSWORD'); // Use for $_SESSION[CONST_SESSION_USERSTORED_ADMIN] and know the admin value if we stored it. Plz see userInfo.php in controller

    define('CONST_SESSION_LANGUAGESTORED_LIST','LANGUAGE_STORED_LIST'); // Use for $_SESSION[CONST_SESSION_LANGUAGESTORED_LIST] and know the list if we stored it.
    define('CONST_SESSION_LANGUAGESTORED_TRANSLATIONS','LANGUAGE_STORED_TRANSLATIONS'); // Use for $_SESSION[CONST_SESSION_LANGUAGESTORED_TRANSLATIONS] and know the list if we stored it.
    define('CONST_SESSION_LANGUAGESTORED_CURRENT_LANG','LANGUAGE_STORED_LANG'); // Use for $_SESSION[CONST_SESSION_LANGUAGESTORED_CURRENT_LANG] and know the current language for server if we stored it.

?>