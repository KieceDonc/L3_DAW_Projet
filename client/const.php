<?php

    // DB table, columns name for table users
    define('CONST_DB_TABLE_NAME_TOPICSPOSTS','topics_posts'); // topics_posts = name of table inside the db for users
    define('CONST_DB_TABLE_TOPICSPOSTS_ID','id'); // id = name of the column in db inside topics_posts table
    define('CONST_DB_TABLE_TOPICSPOSTS_AUTHOR','author'); // author = name of the column in db topics_posts table
    define('CONST_DB_TABLE_TOPICSPOSTS_DATE','date'); // date = name of the column in db topics_posts table
    define('CONST_DB_TABLE_TOPICSPOSTS_CONTENT','content'); // content = name of the column in db topics_posts table
    define('CONST_DB_TABLE_TOPICSPOSTS_TOPIC','topic'); // topic = name of the column in db topics_posts table

    // DB table, columns name for table users
    define('CONST_DB_TABLE_NAME_USERS','users'); // users = name of table inside the db for users
    define('CONST_DB_TABLE_USERS_ID','id'); // id = name of the column in db inside users table
    define('CONST_DB_TABLE_USERS_EMAIL','email'); // email = name of the column in db users table
    define('CONST_DB_TABLE_USERS_FIRSTNAME','firstname'); // firstname = name of the column in db users table
    define('CONST_DB_TABLE_USERS_LASTNAME','lastname'); // lastname = name of the column in db users table

    // DB return type
    define('CONST_DB_ACCEPTED', 'ACCEPTED');
    define('CONST_DB_ERR_USERDONTEXIST','USER_DONT_EXIST');
    define('CONST_DB_ERR_USERNAMEEXIST','USERNAME_ALREADY_EXISTS');
    define('CONST_DB_ERR_EMAILEXISTS','EMAIL_ALREADY_EXISTS');

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
    define('CONST_SESSION_ISLOGGED','ISLOGGED');
    define('CONST_SESSION_ISLOGGED_YES','YES');
    define('CONST_SESSION_USERSTORED_ID','CONST_SESSION_USERSTORED_ID'); // Use for $_SESSION[CONST_SESSION_USERSTORED_ID] and know the id if we stored it. Plz see userInfo.php in controller
    define('CONST_SESSION_USERSTORED_FIRSTNAME','USER_STORRED_FIRSTNAME'); // Use for $_SESSION[CONST_SESSION_USERSTORED_FIRSTNAME] and know the firstname if we stored it. Plz see userInfo.php in controller
    define('CONST_SESSION_USERSTORED_LASTNAME','USER_STORRED_LASTNAME'); // Use for $_SESSION[CONST_SESSION_USERSTORED_LASTNAME] and know the lastname if we stored it. Plz see userInfo.php in controller
?>