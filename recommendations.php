<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/homepage.css">
        <script type="text/javascript" src="scripts/searchbar.js"></script>
        <script type="text/javascript" src="scripts/sorttable.js"></script>
    </head>

    <body>
        <h1>Hello. This is my recommendations page.</h1>
        <?php
         session_start();
         $user=$_SESSION['user'];    
         echo'Greetings '. $user[1].'<br>';
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
        <div id="filmdiv">
            <input type="text" id="searchInput" onkeyup="searchBar()" placeholder="Mouseover, click, double click the table for different sorting options ..." title="Type in a name">
            <table onmouseenter="sortTableAsc(3)" onclick="sortTableAsc(2)" ondblclick="sortTableDesc(2)" id="filmTable">
                <tr>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Release date</th>
                    <th>Score</th>
                    <th><th>
                </tr>
            <?php
                include('php/connect_mysql.php');
                $sqlselect = "SELECT id_FILMS, title, poster, release_date FROM films";
                $result = mysqli_query($dbconnect, $sqlselect) or die(mysqli_error($dbconnect));
                
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_row($result)) {
                        $query1 = "SELECT * FROM likes WHERE fk_FILMSid_FILMS='$row[0]' AND status='1'";
                        $query2 = "SELECT * FROM likes WHERE fk_FILMSid_FILMS='$row[0]' AND status='0'";
                        $positive = mysqli_query($dbconnect, $query1) or die(mysqli_error($dbconnect));
                        $negative = mysqli_query($dbconnect, $query2) or die(mysqli_error($dbconnect));
                        $score = mysqli_num_rows($positive) - mysqli_num_rows($negative);
                        if ($score > 0) {
                            echo '<tr><td><img src="'. $row[2] . '"></td><td>' . $row[1] . '</td><td>' . 
                            $row[3] . '</td><td>' . $score . '</td><td><a href="php/like.php?id=' . 
                            $row[0] . '">+1</a></td><td><a href="php/dislike.php?id=' . $row[0] . '">-1</a></td></tr>';
                        }
                        
                    }
                } else {
                    echo '0 results';
                }
            ?>
            </table>
            
                

            
        </div>

    </body>
</html>