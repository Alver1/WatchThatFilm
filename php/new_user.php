<?php
    if (isset($_POST['submitted'])){
        include('connect_mysql.php');
        $email = $_POST['email'];
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $password = $_POST['password'];
        $sqlinsert = "INSERT INTO USERS (email, first_name, last_name, password) VALUES ('$email', '$fname', '$lname', '$password')";

        if (!mysqli_query($dbconnect, $sqlinsert)) {
            die('Error inserting new user.');
        }
        echo '<script language="javascript">';
        echo 'alert("New user has been added to the database.")';
        echo '</script>';
        header('Refresh: 0; url=https://watchthatfilm.000webhostapp.com');
    }
?>