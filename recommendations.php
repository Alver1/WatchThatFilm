<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/main.css">
        <script type="text/javascript" src="scripts/searchbar.js"></script>
        <script type="text/javascript" src="scripts/sorttable.js"></script>
        <script type="text/javascript" src="scripts/sidenav.js"></script>
    </head>

    <body>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="homepage.php">home</a>
            <a href="recommendations.php">recommendations</a>
            <a href="accountmanager.php">account</a>
            <a href="php/sign_out.php">logout</a>
        </div>
        <div id="main">
            <span style="font-size:30px;cursor:pointer;margin-bottom:50px" onclick="openNav()">&#9776; menu</span>
            <input type="text" id="searchInput" onkeyup="searchBar()" placeholder="mouseover, click, double click the table for different sorting options ..." title="Type in a name">
            <table onmouseenter="sortTableAsc(3)" onclick="sortTableAsc(2)" ondblclick="sortTableDesc(2)" id="filmTable">
                <tr>
                    <th>poster</th>
                    <th>title</th>
                    <th>release date</th>
                    <th>score</th>
                    <th><th>
                </tr>
            <?php
                include('php/connect_mysql.php');
                session_start();
                $user = $_SESSION['user'];
                $sqlselect = "SELECT id_FILMS, title, poster, release_date FROM films";
                $result = mysqli_query($dbconnect, $sqlselect) or die(mysqli_error($dbconnect));
                
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_row($result)) {
                        $query1 = "SELECT * FROM likes WHERE fk_FILMSid_FILMS='$row[0]' AND status='1'";
                        $query2 = "SELECT * FROM likes WHERE fk_FILMSid_FILMS='$row[0]' AND status='0'";
                        $watchcheck = "SELECT * FROM likes WHERE fk_FILMSid_FILMS='$row[0]' AND fk_USERSid_USERS='$user[0]'";
                        $positive = mysqli_query($dbconnect, $query1) or die(mysqli_error($dbconnect));
                        $negative = mysqli_query($dbconnect, $query2) or die(mysqli_error($dbconnect));
                        $score = mysqli_num_rows($positive) - mysqli_num_rows($negative);
                        $havewatched = mysqli_query($dbconnect, $watchcheck) or die(mysqli_error($dbconnect));
                        if ($score > 0 && mysqli_num_rows($havewatched) === 0) {
                            echo '<tr><td><img id="poster" src="'. $row[2] . '"></td><td>' . $row[1] . '</td><td>' . 
                            $row[3] . '</td><td>' . $score . '</td><td><a href="php/like.php?id=' . 
                            $row[0] . '">+1</a></td><td><a href="php/dislike.php?id=' . $row[0] . '">-1</a></td></tr>';
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