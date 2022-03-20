<header class="site-header">
    <div class="wrapper site-header__wrapper">
        <div class="site-header__start">
            <a href="#" class="brand">E-lolning</a>
        </div>
        <div class="site-header__middle">
            <nav class="nav">
            <ul class="nav__wrapper">
                <li class="nav__item">
                    <a href="#">Home</a>
                </li>
                <li class="nav__item">
                    <a href="#">About us</a>
                </li>
                <li class="nav__item">
                    <a href="#">Contact</a>
                </li>
            </ul>
            </nav>
        </div>
        <div class="site-header__end">
        <?php
            session_start();
          
            $Sign_in_up = '<a id="header-button" href="./login.php">Sign in/up</a>';
          
            if(isset($_SESSION['loggedin'])){
            if($_SESSION['loggedin'] == 'ACCEPTED'){
                echo '<a id="header-button" href="#">'.$_SESSION['email'].'</a>';
                echo '<a id="header-button" href="logout.php">Log out</a>';
            }else{
                echo $Sign_in_up;
            }
            }else{
            echo $Sign_in_up;
            }
            
        ?>
        </div>
    </div>
</header>