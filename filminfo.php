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
            <span id="menuspan" onclick="openNav()">&#9776; menu&ensp;-&ensp;film information</span>
			<?php
				session_start();
				$user = $_SESSION['user'];
				echo "<div style='float:right;clear:right;font-size:17px'>Logged in as: $user[2] $user[3]</div>";
				echo "<div style='float:right;clear:right;font-size:17px'>$user[1]</div><br>";
				echo "<div style='float:right;clear:right;font-size:17px'><a href='php/sign_out.php'>logout</a></div>";
			?>
            <table id="filmTable">
                <?php
                include('php/connect_mysql.php');
                $film=$_GET['id'];
                $sqlselect= "SELECT poster, title, fk_DIRECTORSid_DIRECTORS, description, release_date,
                runtime, imdb_rating, metascore, budget, opening_weekend, gross, id_FILMS FROM films WHERE id_FILMS = '$film'";  
                $result = mysqli_query($dbconnect, $sqlselect) or die(mysqli_error($dbconnect));
                $row = mysqli_fetch_row($result);
                $selectdirector= "SELECT first_name, last_name FROM directors WHERE id_DIRECTORS='$row[2]'";
                $result = mysqli_query($dbconnect, $selectdirector) or die(mysqli_error($dbconnect));
                $director = mysqli_fetch_row($result);
                $budget = number_format($row[8]);
                $opening_weekend = number_format($row[9]);
                $gross = number_format($row[10]);
                $genres = '';
                $sqlgenres = "SELECT genre FROM genre_list, film_genres, films WHERE 
                    film_genres.filmID = '$row[11]' AND
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
                $genres = ucfirst($genres);
                echo '<tr>
                    <td><img id="posterfull" src="'. $row[0] . '"></td></tr>
                <tr>
                    <td><b>'. $row[1] . '</b></td></tr>
                <tr>
                    <td>director:</td><td>' . $director[0] . ' ' . $director[1] . '</td></tr>
                <tr>
                    <td>genre:</td><td>' . $genres . '</td></tr>
                <tr>
                    <td>description:</td><td>'. $row[3] . '</td></tr>
                <tr>
                    <td>release date:</td><td>'. $row[4] . '</td></tr>
                <tr>
                    <td>runtime:</td><td>'. $row[5] . ' minutes</td></tr>   
                <tr>
                    <td>imdb rating:</td><td>'. $row[6] . '</td></tr>
                <tr>
                    <td>metascore:</td><td>'. $row[7] . '</td></tr>
                <tr>
                    <td>budget:</td><td>'. $budget . ' $</td></tr>
                <tr>
                    <td>opening weekend:</td><td>'. $opening_weekend . ' $</td></tr>
                <tr>
                    <td>gross:</td><td>'. $gross . ' $</td></tr>'
                ?>
            </table>
            <button onclick="history.go(-1);">Back</button>
        </div>
    </body>
</html>