<?php
session_start();
if(isset($_POST['submitted'])){
    include('connect_mysql.php');
    $currentpassword = $_POST['currentpassword'];
    $user = $_SESSION['user'];  
    $sqlselect = "SELECT * FROM users WHERE id_USERS = '$user[0]'";
    $query = mysqli_query($dbconnect, $sqlselect) or die(mysqli_error($dbconnect));
    $res = mysqli_fetch_row($query);
    if($res[4] !== $currentpassword){
        echo '<script language="javascript">';
        echo 'alert("Password is incorrect.")';
        echo '</script>';
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
        header("Refresh: 0; '$url'"); 
    }
    else {
        $sqldelete1 = "DELETE FROM likes WHERE likes.fk_USERSid_USERS='$user[0]'";
        $sqldelete2 = "DELETE FROM users WHERE users.id_USERS='$user[0]'";
        if (mysqli_query($dbconnect, $sqldelete1) && mysqli_query($dbconnect, $sqldelete2)) {
            session_destroy();
            echo '<script language="javascript">';
            echo 'alert("Account has been successfully deleted. Safe travels!")';
            echo '</script>';
            header("Refresh: 0; url=../index.html");
        }
        else {
            echo "Couldn't delete account: " . mysqli_error($dbconnect);
            echo '<script language="javascript">';
            echo 'alert("Account has been successfully deleted. Safe travels!")';
            echo '</script>';
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
            header("Refresh: 0; '$url'");
        }
    }
}
?>