<?php
session_start();
include('connect_mysql.php');
$user=$_SESSION['user']; 

// genre status
$genres = array('placeholder');
array_push($genres, $_POST['action']);
array_push($genres, $_POST['adventure']);
array_push($genres, $_POST['animation']);
array_push($genres, $_POST['biography']);
array_push($genres, $_POST['comedy']);
array_push($genres, $_POST['crime']);
array_push($genres, $_POST['documentary']);
array_push($genres, $_POST['drama']);
array_push($genres, $_POST['family']);
array_push($genres, $_POST['fantasy']);
array_push($genres, $_POST['film-noir']);
array_push($genres, $_POST['history']);
array_push($genres, $_POST['horror']);
array_push($genres, $_POST['music']);
array_push($genres, $_POST['musical']);
array_push($genres, $_POST['mystery']);
array_push($genres, $_POST['romance']);
array_push($genres, $_POST['sci-fi']);
array_push($genres, $_POST['sport']);
array_push($genres, $_POST['thriller']);
array_push($genres, $_POST['war']);
array_push($genres, $_POST['western']);

$size = sizeof($genres);

for ($i = 1; $i <= $size - 1; $i++)
{
    $query = "UPDATE genre_preferences SET status='$genres[$i]' WHERE genreID='$i' AND userID='$user[0]'";
    $update = mysqli_query($dbconnect, $query) or die(mysqli_error($dbconnect));
}

echo '<script language="javascript">';
echo 'alert("Your preferences have been updated.")';
echo '</script>';
$url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
header("Refresh: 0; '$url'");
?>