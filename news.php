<html>
    <head>

    </head>

    <body>
        <h1>Hello. This is my news page.</h1>
        <?php
         session_start();
         $user=$_SESSION['user'];    
         echo'welcome: '. $user[1].'<br>';
         ?>
         <div id="menu">
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="recommendations.php"</a>Recommendations</li>
                <li><a href="accountmanager.php">Account</a></li>
                <li><a href="php/sign_out.php">Signout</a></li>
            </ul>
        </div>
    </body>
</html>