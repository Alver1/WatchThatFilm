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
            <a href="recommendations.php">recommended</a>
            <a href="upcoming.php">upcoming</a>
            <a href="watchedfilms.php">seen</a>
            <a href="accountmanager.php">account</a>
            <a href="about.html">about</a>
            <a href="php/sign_out.php">logout</a>
        </div>
        <div id="main">
            <span style="font-size:30px;cursor:pointer;margin-bottom:50px" onclick="openNav()">&#9776; menu</span>
            <input type="text" id="searchInput" onkeyup="searchBar()" placeholder="search for titles ..." title="Type in a name">
            <table onclick="sortTableAsc(2)" ondblclick="sortTableDesc(2)" id="filmTable">
                <tr>
                    <th>poster</th>
                    <th>title</th>
                    <th>release date</th>
                </tr>
            <?php
                include('php/connect_mysql.php');
                $sqlselect = "SELECT id_FILMS, title, poster, release_date FROM films";
                $result = mysqli_query($dbconnect, $sqlselect) or die(mysqli_error($dbconnect));
                
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_row($result)) {
                        if (date("Y-m-d") < $row[3]) {
                            echo '<tr><td><img id="poster" src="'. $row[2] . '"></td><td><a href="filminfo.php?id=' . 
                            $row[0] . '">' . $row[1] . '</a></td><td>' . 
                            $row[3] . '</td></tr>';
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