<?php
session_start();
if(isset($_POST['submitted'])){
    include('connect_mysql.php');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sqlselect = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
    $query=mysqli_query($dbconnect, $sqlselect) or die(mysqli_error($dbconnect));
    $res = mysqli_fetch_row($query);
    if($res){
        $_SESSION['user'] = $res;
        echo '<script language="javascript">';
        echo 'alert("Login successful.")';
        echo '</script>';
        header('Refresh: 0; url=../homepage.php');
    }
    else{
        echo '<script language="javascript">';
        echo 'alert("Email and password did not match.")';
        echo '</script>';
        header('Refresh: 0; url=../index.html');
    }
}
?>