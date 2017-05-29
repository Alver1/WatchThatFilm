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
            <span id="menuspan" onclick="openNav()">&#9776; menu&ensp;-&ensp;all films</span>
			<?php
				session_start();
				$user = $_SESSION['user'];
				echo "<div style='float:right;clear:right;font-size:17px'>Logged in as: $user[2] $user[3]</div>";
				echo "<div style='float:right;clear:right;font-size:17px'>$user[1]</div><br>";
				echo "<div style='float:right;clear:right;font-size:17px'><a href='php/sign_out.php'>logout</a></div>";
			?>
            <input type="text" id="searchInput" onkeyup="searchBar()" placeholder="search for titles ..." title="Type in a name">
            <table onclick="sortTableAsc(3)" ondblclick="sortTableDesc(3)" id="filmTable">
                <tr>
                    <th>poster</th>
                    <th>title</th>
                    <th>genre</th>
                    <th>release date</th>
                    <th><th>
                </tr>
            <?php
                include('php/connect_mysql.php');
                $sqlselect = "SELECT id_FILMS, title, poster, release_date FROM films";
                $result = mysqli_query($dbconnect, $sqlselect) or die(mysqli_error($dbconnect));
                
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_row($result)) {
                        if (date("Y-m-d") > $row[3]){
                            $genres = '';
                            $sqlgenres = "SELECT genre FROM genre_list, film_genres, films WHERE 
                                film_genres.filmID = '$row[0]' AND
                                film_genres.genreID = genre_list.id
                                GROUP BY film_genres.genreID";
                            $getgenres = mysqli_query($dbconnect, $sqlgenres) or die(mysqli_error($dbconnect));
                            $count = mysqli_num_rows($getgenres);
                            for ($i = 0; $i < $count - 1; $i++)
                            {
                                $genre = mysqli_fetch_row($getgenres);
                                $genres = $genres.$genre[0].', ';
                            }
                            $genre = mysqli_fetch_row($getgenres);
                            $genres = $genres.$genre[0];
                            echo '<tr><td><img id="poster" src="'. $row[2] . '"></td><td><a href="filminfo.php?id=' . 
                            $row[0] . '">' . $row[1] . '</a></td><td>' . $genres . '</td><td>' .
                            $row[3] . '</td><td><a class="button" href="php/like.php?id=' . 
                            $row[0] . '">+1</a></td><td><a class="button" href="php/dislike.php?id=' . $row[0] . '">-1</a></td></tr>';
                        }           
                    }
                } 
                else {
                    echo '0 results';
                }
            ?>
            </table>
        </div>
    </body>
</html>