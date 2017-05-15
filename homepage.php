<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/homepage.css">
        <script type="text/javascript" src="scripts/searchbar.js"></script>
        <script type="text/javascript" src="scripts/sorttable.js"></script>
    </head>

    <body>
        <div id="menudiv">
        <h1>Hello. This is my home page.</h1>
        <?php
         session_start();
         $user=$_SESSION['user'];    
         echo'Greetings '. $user[1].'<br>';
         ?>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="recommendations.php"</a>Recommendations</li>
                <li><a href="accountmanager.php">Account</a></li>
                <li><a href="php/sign_out.php">Signout</a></li>
            </ul>
        </div>
        <div id="filmdiv">
            <input type="text" id="searchInput" onkeyup="searchBar()" placeholder="Search for titles ..." title="Type in a name">
            <table onclick="sortTableAsc(2)" ondblclick="sortTableDesc(2)" id="filmTable">
                <tr>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Release date</th>
                    <th><th>
                </tr>
            <?php
                include('php/connect_mysql.php');
                $sqlselect = "SELECT id_FILMS, title, poster, release_date FROM films";
                $result = mysqli_query($dbconnect, $sqlselect) or die(mysqli_error($dbconnect));
                
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_row($result)) {
                        echo '<tr><td><img src="'. $row[2] . '"></td><td>' . $row[1] . '</td><td>' . 
                            $row[3] . '</td><td><a href="php/like.php?id=' . 
                            $row[0] . '">+1</a></td><td><a href="php/dislike.php?id=' . $row[0] . '">-1</a></td></tr>';
                    }
                } else {
                    echo '0 results';
                }
            ?>
            </table>
            
                

            
        </div>

    </body>
</html>