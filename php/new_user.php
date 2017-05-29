<?php
    if (isset($_POST['submitted'])){
        include('connect_mysql.php');
        $email = $_POST['email'];
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];
        $sqlcheck = "SELECT * FROM users WHERE email='$email'";
        $sqlinsert = "INSERT INTO users (email, first_name, last_name, password) VALUES ('$email', '$fname', '$lname', '$password')";
        $result = mysqli_query($dbconnect, $sqlcheck) or die(mysqli_error($dbconnect));
        if (mysqli_num_rows($result) > 0) {
            echo '<script language="javascript">';
            echo 'alert("Email already taken.")';
            echo '</script>';
            header('Refresh: 0; url=../signup.html');
        }
        else if ($password !== $repeat_password) {
            echo '<script language="javascript">';
            echo 'alert("Passwords do not match.")';
            echo '</script>';
            header('Refresh: 0; url=../signup.html');
        }
        else if (!mysqli_query($dbconnect, $sqlinsert)) {
            echo '<script language="javascript">';
            echo 'alert("Error in signing up.")';
            echo '</script>';
            header('Refresh: 0; url=../signup.html');
        }
        else { // successful registration
            $id = mysqli_insert_id($dbconnect);
            $getgenrecount = "SELECT COUNT(*) AS count FROM genre_list";
            $count = mysqli_query($dbconnect, $getgenrecount) or die(mysqli_error($dbconnect));
            $data = mysqli_fetch_assoc($count);
            for ($i = 1; $i <= $data['count']; $i++)
            {
                $insertpreference = "INSERT INTO genre_preferences (userID, genreID, status) VALUES('$id', '$i', '1')";
                $prefquery = mysqli_query($dbconnect, $insertpreference) or die(mysqli_error($dbconnect));
            }
            echo '<script language="javascript">';
            echo 'alert("Welcome to WatchThatFilm! You can now login.")';
            echo '</script>';
            header('Refresh: 0; url=../index.html');
        }
    }
?>