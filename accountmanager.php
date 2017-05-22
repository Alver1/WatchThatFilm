<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/main.css">  
        <script type="text/javascript" src="scripts/sidenav.js"></script>
        <script type="text/javascript">	
            function confirmation() {
                confirm("You are about to permanently delete this account.");
            }
        </script>
    </head>

    <body>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="homepage.php">home</a>
            <a href="recommendations.php">recommended</a>
            <a href="upcoming.php">upcoming</a>
            <a href="watchedfilms.php">seen</a>
            <a href="accountmanager.php">account</a>
            <a href="about.html">about</a>
            <a href="php/sign_out.php">logout</a>
        </div>
        <div id="main">
            <span style="font-size:30px;cursor:pointer;margin-bottom:50px" onclick="openNav()">&#9776; menu</span>
            <form method="post" action="php/change_password.php">
            <input type="hidden" name="submitted" value="true" />
            <div class="container">
                <label><b>current password</b></label><br />
                <input type="password" placeholder="enter current password" name="currentpassword" required><br />
                <label><b>new password</b></label><br />
                <input type="password" placeholder="enter new password" name="newpassword" required><br />
                <label><b>repeat new password</b></label><br />
                <input type="password" placeholder="repeat new password" name="repeatnew" required><br />
                <button style="width:160px" type="submit">change password</button>        
            </div>
            </form>

            <form method="post" action="php/delete_account.php">
            <input type="hidden" name="submitted" value="true" />
            <div class="container">
                <label><b>current password</b></label><br />
                <input type="password" placeholder="enter current password" name="currentpassword" required><br />
                <button onclick="confirmation()" style="width:160px" type="submit">delete account</button>        
            </div>
            </form>
        </div>
    </body>
</html>