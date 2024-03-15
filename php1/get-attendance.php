<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
include_once "C:/xampp\htdocs\Single Project Power - backup\php1\config.php";


$date = date('Y-m-d');
$count = 0;
$sql = mysqli_query($conn, "SELECT * FROM attendance LEFT JOIN users ON users.unique_id = attendance.unique_id WHERE (attendance.email = '{$_SESSION['email']}' and attendance.present='IN')");

if(mysqli_num_rows($sql)>0){
    while($row = mysqli_fetch_assoc($sql)){
        if( $row['date'])
        {
            $count = $count + 1;
        }
    }
    echo $count;
}
echo $_SESSION['email'];

?>