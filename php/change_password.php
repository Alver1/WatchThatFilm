<?php
session_start();
if(isset($_POST['submitted'])){
    include('connect_mysql.php');
    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];
    $repeatnew = $_POST['repeatnew'];
    $user = $_SESSION['user'];  
    $sqlselect = "SELECT * FROM users WHERE id_USERS = '$user[0]'";
    $query = mysqli_query($dbconnect, $sqlselect) or die(mysqli_error($dbconnect));
    $res = mysqli_fetch_row($query);
    if($res[4] !== $currentpassword){
        echo '<script language="javascript">';
        echo 'alert("Current password is incorrect.")';
        echo '</script>';
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
        header("Refresh: 0; '$url'"); 
    }
    else if ($newpassword !== $repeatnew){
        echo '<script language="javascript">';
        echo 'alert("New password entries did not match.")';
        echo '</script>';
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
        header("Refresh: 0; '$url'"); 
    }
    else {
        $sqlupdate = "UPDATE users SET password = '$newpassword' WHERE users.id_USERS = '$user[0]'";
        if (mysqli_query($dbconnect, $sqlupdate)) {
            echo '<script language="javascript">';
            echo 'alert("Your password has been changed.")';
            echo '</script>';
            header("Refresh: 0; url=../homepage.php");
        }
        else {
            echo "Couldn't change password: " . mysqli_error($dbconnect);
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
            header("Refresh: 0; '$url'");
        }
    }
}
?>