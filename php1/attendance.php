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
$date = date('Y-m-d H:i:s');
$sql = mysqli_query($conn, "INSERT into attendance values('{$_SESSION['unique_id']}','{$name}','{$latitude}','{$longitude}','{$date}', '{$present}')");
if($sql){
    echo "success";
}
?>