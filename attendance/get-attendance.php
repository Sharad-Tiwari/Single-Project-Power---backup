<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
include_once "C:/xampp\htdocs\Single Project Power - backup\php1\config.php";

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$newDate = date('Y-m-d', strtotime('-7 days', strtotime($date)));
$time = date('H:i:s');
$day = date('l');
$timings = [];



$attendance = mysqli_query($conn, "SELECT * FROM attendance WHERE (email = '{$_SESSION['email']}' and present='IN') ORDER BY date ASC");


if ((mysqli_num_rows($attendance)) > 0) {
    while ($res = mysqli_fetch_assoc($attendance)) {
        if ($res['date'] == $newDate) {
            //echo $res['date'] . " " . date('H', strtotime($res['time'])) . "<br>";
            //$newDate = date('Y-m-d',strtotime($newDate.'+1day'));
            array_push($timings, (int)date('H', strtotime($res['time'])));
        }
        $newDate = date('Y-m-d', strtotime($newDate . '+1day'));
    }
} else {
    $timings= [
        "error" => "No Data Found"
    ];
}       

$arr = json_encode($timings);

echo $arr;
mysqli_close($conn);
?>