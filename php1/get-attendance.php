<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
include_once "C:/xampp\htdocs\Single Project Power - backup\php1\config.php";

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$time = date('H:i:s');
$day = date('l');
$dur = 0;
// $sql = mysqli_query($conn, "SELECT * FROM attendance LEFT JOIN users ON users.unique_id = attendance.unique_id WHERE (attendance.email = '{$_SESSION['email']}' and attendance.present='IN' and attendance.date='{$date}' and attendance.day='{$day}')");

// if(mysqli_num_rows($sql)>0){
//     while($row = mysqli_fetch_assoc($sql)){
//         if($row['date'])
//         {
//             $count = $count + 1;
//         }
//     }

// }

$attendance = mysqli_query($conn, "SELECT * FROM attendance WHERE (email = '{$_SESSION['email']}' and present='IN' and date='{$date}' and day='{$day}')");
if (mysqli_num_rows($attendance) > 0) {
    while($res = mysqli_fetch_assoc($attendance)){
        $dur = round((strtotime($time)-strtotime($res['time']))/3600, 2);
    }
} else {
    echo "NO data Found";
}

echo $_SESSION['email'], $dur, $_SESSION['present'];

?>