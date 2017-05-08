<?php
session_start();
if(isset($_POST['submitted'])){
    include('connect_mysql.php');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sqlselect = "SELECT * FROM USERS WHERE email = '$email' and password = '$password'";
    $query=mysqli_query($dbconnect, $sqlselect) or die(mysqli_error());
    $res = mysqli_fetch_row($query);
    if($res){
        $_SESSION['name'] = $res;
        echo '<script language="javascript">';
        echo 'alert("Login successful.")';
        echo '</script>';
        header('Refresh: 0; url=../homepage.php');
    }
    else{
        echo '<script language="javascript">';
        echo 'alert("Username and password did not match.")';
        echo '</script>';
        header('Refresh: 0; url=../index.html');
    }
}
?>