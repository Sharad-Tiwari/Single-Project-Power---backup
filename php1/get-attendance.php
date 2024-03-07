<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
include_once "C:/xampp\htdocs\Single Project Power - backup\php1\config.php";
$date = date('Y-m-d');
$sql = mysqli_query($conn, "SELECT * FROM attendance LEFT JOIN users ON users.fname = attendance.emp_name");
$row = mysqli_fetch_assoc($sql);
if(mysqli_num_rows($sql)>0){
    echo $row;
}

?>