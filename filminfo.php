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
            <a href="watchedfilms.php">watched</a>
            <a href="accountmanager.php">account</a>
            <a href="about.html">about</a>
            <a href="php/sign_out.php">logout</a>
        </div>
        <div id="main">
            <span style="font-size:30px;cursor:pointer;margin-bottom:50px" onclick="openNav()">&#9776; menu</span>
            <table id="filmTable">
                <?php
                include('php/connect_mysql.php');
                $film=$_GET['id'];
                $sqlselect= "SELECT poster, title, fk_DIRECTORSid_DIRECTORS, description, release_date,
                runtime, imdb_rating, metascore, budget, opening_weekend, gross FROM films WHERE id_FILMS = '$film'";  
                $result = mysqli_query($dbconnect, $sqlselect) or die(mysqli_error($dbconnect));
                $row = mysqli_fetch_row($result);
                $selectdirector= "SELECT first_name, last_name FROM directors WHERE id_DIRECTORS='$row[2]'";
                $result = mysqli_query($dbconnect, $selectdirector) or die(mysqli_error($dbconnect));
                $director = mysqli_fetch_row($result);
                $budget = number_format($row[8]);
                $opening_weekend = number_format($row[9]);
                $gross = number_format($row[10]);
                echo '<tr>
                    <td><img id="posterfull" src="'. $row[0] . '"></td></tr>
                <tr>
                    <td><b>'. $row[1] . '</b></td></tr>
                <tr>
                    <td>director:</td><td>' . $director[0] . ' ' . $director[1] . '</td></tr>
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