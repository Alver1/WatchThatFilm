<?php
session_start();
include('connect_mysql.php');
$user=$_SESSION['user']; 
$film=$_GET['id'];
$sqlcheck = "SELECT * FROM likes WHERE fk_FILMSid_FILMS = '$film' AND fk_USERSid_USERS = '$user[0]'";
$result = mysqli_query($dbconnect, $sqlcheck) or die(mysqli_error($dbconnect));

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_row($result);
    if ($row[3] == 0) {
        $sqlupdate = "UPDATE likes SET status = '1' WHERE likes.id_LIKES = '$row[0]'";
        if (mysqli_query($dbconnect, $sqlupdate)) {
            echo '<script language="javascript">';
            echo 'alert("Record updated successfully.")';
            echo '</script>';
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
            header("Refresh: 0; '$url'");      
        } 
        else {
            echo "Error updating record: " . mysqli_error($dbconnect);
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
            header("Refresh: 0; '$url'");
        }
    } 
    else {
        echo '<script language="javascript">';
        echo 'alert("You have already liked this film.")';
        echo '</script>';
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
        header("Refresh: 0; '$url'");
    }
}
else {
    $sqlinsert = "INSERT INTO likes SET fk_FILMSid_FILMS='$film', fk_USERSid_USERS='$user[0]', status=1";
    if (mysqli_query($dbconnect, $sqlinsert)) {
        echo '<script language="javascript">';
        echo 'alert("Record inserted successfully.")';
        echo '</script>';
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
        header("Refresh: 0; '$url'");
    } 
    else {
        echo "Error inserting record: " . mysqli_error($dbconnect);
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
        header("Refresh: 0; '$url'");
    }
}
?>