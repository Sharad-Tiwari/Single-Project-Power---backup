<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
include_once "C:/xampp\htdocs\Single Project Power - backup\php1\config.php";
$name = $_POST['name'];
$present = $_POST['present'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$branch = $_POST['branch'];
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$time = date('H:i:s');
$day = date('l');
if($_SESSION['present']=='OUT'){
    $present = "IN";
}
else {
    $present = "OUT";
}
$sql = mysqli_query($conn, "INSERT into attendance values('{$_SESSION['unique_id']}','{$_SESSION['email']}','{$name}','{$latitude}','{$longitude}','{$date}','{$time}','{$day}', '{$present}')");
if($sql){
    echo "success";
}
?>