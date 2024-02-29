<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
include_once "php1/config.php";
$date = date('Y-m-d');
$sql = mysqli_query($conn, "SELECT * FROM attendance WHERE unique_id={$_SESSION['unique_id']}");
$row = mysqli_fetch_assoc($sql);
if(mysqli_num_rows($sql)>0){
    echo "sucess";
}


?>