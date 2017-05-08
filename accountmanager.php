<html>
    <head>

    </head>

    <body>
        <h1>Hello. This is my account management page.</h1>
        <?php
         session_start();
         $name=$_SESSION['name'];    
         echo'welcome: '. $name[1].'<br>';
         echo'<a href="php/sign_out.php">Signout</a>';
         ?>
    </body>
</html>