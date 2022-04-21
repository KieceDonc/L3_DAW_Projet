<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php"); ?>

<header class="site-header">
    <div class="wrapper site-header__wrapper">
        <div class="site-header__start">
            <a href="/" class="brand">E-lolning</a>
        </div>
        <div class="site-header__middle">
            <nav class="nav">
            <ul class="nav__wrapper">
                <li class="nav__item">
                    <a href="/"><?php echo getTranslation(1); ?></a>
                </li>
				<li class="nav__item">
                    <a href="/forum"><?php echo getTranslation(2); ?></a>
                </li>
                <li class="nav__item">
                    <a href="/courses"><?php echo getTranslation(3); ?></a>
                </li>
                <li class="nav__item">
                    <a href="/contact"><?php echo getTranslation(4); ?></a>
                </li>
            </ul>
            </nav>
        </div>
        <div class="site-header__end">
        <?php
            date_default_timezone_set("Etc/GMT-2");
            require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");

            session_start();
          
          
            if(isset($_SESSION[CONST_SESSION_ISLOGGED]) && $_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES){
                    echo '<a class="header-button" href="/admin/profile">';
                    echo getTranslation(5);
                    echo '</a>';
                    echo '<a class="header-button" href="logout.php">';
                    echo getTranslation(6);
                    echo '</a>';
            }else{
                echo '<a class="header-button" href="/login?callback='. $_SERVER['REQUEST_URI'] .'">';
                echo getTranslation(7); 
                echo '</a>';
            }
            
        ?>
        </div>
        <label class="switch">
            <input id="switchBtn" type="checkbox" checked>
            <span class="slider round"></span>
        </label>
        <select id="language" name="language">
            <?php
                $languages = getLanguageList();
                foreach($languages as $lang)
                {
                    echo "<option lang='{$lang["name"]}' value='{$lang["id"]}'";
                    if(isset($_COOKIE['lang']) && $lang["id"] == $_COOKIE['lang']){
                        echo "selected";
                    }
                    echo ">{$lang["name"]}</option>";
                }
            ?>
        </select>
    </div>
</header>