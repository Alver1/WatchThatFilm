<html>
    <head>
        <title>WatchThatFilm</title>
        <link rel="stylesheet" type="text/css" href="style/main.css">
        <script type="text/javascript" src="scripts/searchbar.js"></script>
        <script type="text/javascript" src="scripts/sorttable.js"></script>
        <script type="text/javascript" src="scripts/sidenav.js"></script>
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
            <span id="menuspan" onclick="openNav()">&#9776; menu&ensp;-&ensp;about</span>
            <?php
				session_start();
				$user = $_SESSION['user'];
				echo "<div style='float:right;clear:right;font-size:17px'>Logged in as: $user[2] $user[3]</div>";
				echo "<div style='float:right;clear:right;font-size:17px'>$user[1]</div><br>";
				echo "<div style='float:right;clear:right;font-size:17px'><a href='php/sign_out.php'>logout</a></div>";
			?>
                <p><b>Welcome to WatchThatFilm</b></p>
                <p>This section contains a quick 'how to' on all the website's features.</p>
                <p>Every page with a film list includes sorting by date, that can be done by clicking anywhere
                on the table for descending sort and double clicking for ascending sort. Text bar above the tables
                of each section can be used to search the list by title. By pressing '+1' '-1' links next to each film
                you indicate that you have watched the film and leave either a positive or negative feedback that impacts the
                film's score for other users. You can click the title of any film to see detailed information about it.
                By clicking 'menu' on any section a side menu appears which you can use to access all sections of the website. These are:</p>
                <ul>
                    <li><b>all.</b> Here you can see the list of all the films in the database.</li>
                    <li><b>recommended.</b> This section displays the list of suggested films for the user. Each film is assigned a score based on other
                            users' feedback. In addition to default sort-by-date option you can also sort this page by score by mouseovering anywhere on the table</li>
                    <li><b>upcoming.</b> Here you can see the list of films in the database that aren't released yet.</li>
                    <li><b>seen.</b> Shows the list of all films that you have given feedback on.</li>
                    <li><b>account.</b> Here you can change your current password or delete your account entirely.</li>
                </ul>
        </div>
    </body>
</html>