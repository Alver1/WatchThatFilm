<html>
    <head>
        <title>WatchThatFilm</title>
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
            <a href="homepage.php">all</a>
            <a href="recommendations.php">recommended</a>
            <a href="upcoming.php">upcoming</a>
            <a href="watchedfilms.php">seen</a>
            <a href="accountmanager.php">account</a>
            <a href="about.php">about</a>
        </div>
        <div id="main">
            <span id="menuspan" onclick="openNav()">&#9776; menu&ensp;-&ensp;account management</span>
			<?php
				session_start();
				$user = $_SESSION['user'];
				echo "<div style='float:right;clear:right;font-size:17px'>Logged in as: $user[2] $user[3]</div>";
				echo "<div style='float:right;clear:right;font-size:17px'>$user[1]&ensp;";
				echo "<a href='php/sign_out.php'>logout</a></div>";
			?>
            <form method="post" action="php/update_preferences.php">
            <div class="container">
            <label style="display: block;text-align: center"><b>genre preferences</b></label><br />
            <?php
                include('php/connect_mysql.php');
                $sqlselect = "SELECT status FROM genre_preferences WHERE userID='$user[0]'";
                $query = mysqli_query($dbconnect, $sqlselect) or die (mysqli_error($dbconnect));
            ?>
            <table id="filmTable">
            <tr>
                <td><input type="hidden" name="action" value="0">
                <label><input type="checkbox" name="action" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> action</label></td>
                <td><input type="hidden" name="adventure" value="0">
                <label><input type="checkbox" name="adventure" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> adventure</label></td>
                <td><input type="hidden" name="animation" value="0">
                <label><input type="checkbox" name="animation" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> animation</label></td>
                <td><input type="hidden" name="biography" value="0">
                <label><input type="checkbox" name="biography" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> biography</label></td>
            </tr>
            <tr>
                <td><input type="hidden" name="comedy" value="0">
                <label><input type="checkbox" name="comedy" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> comedy</label></td>
                <td><input type="hidden" name="crime" value="0">
                <label><input type="checkbox" name="crime" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> crime</label></td>
                <td><input type="hidden" name="documentary" value="0">
                <label><input type="checkbox" name="documentary" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> documentary</label></td>
                <td><input type="hidden" name="drama" value="0">
                <label><input type="checkbox" name="drama" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> drama</label></td>
            </tr>
            <tr>
                <td><input type="hidden" name="family" value="0">
                <label><input type="checkbox" name="family" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> family</label></td>
                <td><input type="hidden" name="fantasy" value="0">
                <label><input type="checkbox" name="fantasy" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> fantasy</label></td>
                <td><input type="hidden" name="film-noir" value="0">
                <label><input type="checkbox" name="film-noir" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> film-noir</label></td>
                <td><input type="hidden" name="history" value="0">
                <label><input type="checkbox" name="history" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> history</label></td>
            </tr>
            <tr>
                <td><input type="hidden" name="horror" value="0">
                <label><input type="checkbox" name="horror" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> horror</label></td>
                <td><input type="hidden" name="music" value="0">
                <label><input type="checkbox" name="music" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> music</label></td>
                <td><input type="hidden" name="musical" value="0">
                <label><input type="checkbox" name="musical" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> musical</label></td>
                <td><input type="hidden" name="mystery" value="0">
                <label><input type="checkbox" name="mystery" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> mystery</label></td>
            </tr>
            <tr>
                <td><input type="hidden" name="romance" value="0">
                <label><input type="checkbox" name="romance" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> romance</label></td>
                <td><input type="hidden" name="sci-fi" value="0">
                <label><input type="checkbox" name="sci-fi" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> sci-fi</label></td>
                <td><input type="hidden" name="sport" value="0">
                <label><input type="checkbox" name="sport" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> sport</label></td>
                <td><input type="hidden" name="thriller" value="0">
                <label><input type="checkbox" name="thriller" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> thriller</label></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="hidden" name="war" value="0">
                <label><input type="checkbox" name="war" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> war</label></td>
                <td><input type="hidden" name="western" value="0">
                <label><input type="checkbox" name="western" value="1" <?php $genres = mysqli_fetch_row($query); if($genres[0] == 1) echo "checked";?>> western</label></td>
                <td></td>
            </tr>
            </table>
            <button style="width:200px;margin: 15px 15px 0 0" type="submit">update preferences</button>
            </div>
            </form>

            <form method="post" action="php/change_password.php">
            <input type="hidden" name="submitted" value="true" />
            <div class="container">
                <label><b>current password</b></label><br />
                <input type="password" placeholder="enter current password" name="currentpassword" required><br />
                <label><b>new password</b></label><br />
                <input type="password" placeholder="enter new password" name="newpassword" required><br />
                <label><b>repeat new password</b></label><br />
                <input type="password" placeholder="repeat new password" name="repeatnew" required><br />
                <button style="width:200px" type="submit">change password</button>        
            </div>
            </form>

            <form method="post" action="php/delete_account.php">
            <input type="hidden" name="submitted" value="true" />
            <div class="container">
                <label><b>current password</b></label><br />
                <input type="password" placeholder="enter current password" name="currentpassword" required><br />
                <button onclick="confirmation()" style="width:200px" type="submit">delete account</button>        
            </div>
            </form>
        </div>
    </body>
</html>