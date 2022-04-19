<header class="site-header">
    <div class="wrapper site-header__wrapper">
        <div class="site-header__start">
            <a href="/" class="brand">E-lolning</a>
        </div>
        <div class="site-header__middle">
            <nav class="nav">
            <ul class="nav__wrapper">
                <li class="nav__item">
                    <a href="/">Home</a>
                </li>
				<li class="nav__item">
                    <a href="/forum">Forum</a>
                </li>
                <li class="nav__item">
                    <a href="/courses">Courses</a>
                </li>
                <li class="nav__item">
                    <a href="/contact">Contact</a>
                </li>
            </ul>
            </nav>
        </div>
        <div class="site-header__end">
        <?php
            require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/const.php");

            session_start();
          
          
            if(isset($_SESSION[CONST_SESSION_ISLOGGED]) && $_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES){
                    echo '<a id="header-button" href="/admin/profile">Profile</a>';
                    echo '<a id="header-button" href="logout.php">Log out</a>';
            }else{
                echo '<a id="header-button" href="/login?callback='. $_SERVER['REQUEST_URI'] .'">Sign in/up</a>';
            }
            
        ?>
        </div>
        <label class="switch">
            <input onclick="changeTheme()" type="checkbox" checked>
            <span class="slider round"></span>
        </label>
    </div>
</header>