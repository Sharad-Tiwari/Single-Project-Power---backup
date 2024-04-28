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
$timings = [];
$day =[];
$combinedarray = [];

$sql = mysqli_query($conn, "SELECT * FROM attendance WHERE (email = '{$_SESSION['email']}' and present='OUT')");
// and date='{$date}' and day='{$day}
if (mysqli_num_rows($sql) > 0) {
    while ($res = mysqli_fetch_assoc($sql)) {
        if ($res['date'] == $newDate) {
            //echo $res['date'] . " " . date('H', strtotime($res['time'])) . "<br>";
            //$newDate = date('Y-m-d',strtotime($newDate.'+1day'));
            array_push($timings, (int)date('H', strtotime($res['time'])));
            array_push($day, $res['day']);
        }
        $newDate = date('Y-m-d', strtotime($newDate . '+1day'));
    }
} else {
    echo "No data Found"    ;
}
$combinedarray =[
    'time' => $timings,
    'day' => $day
];

$arr = json_encode($combinedarray);

echo $arr;
?>
