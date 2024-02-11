<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
include_once "C:/xampp\htdocs\Single Project Power\php1\config.php";
$topic = mysqli_real_escape_string($conn, $_POST['topic']);
$names = mysqli_real_escape_string($conn,  $_POST['mnames']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$meet_date = mysqli_real_escape_string($conn, $_POST['time']);
$datetime = new DateTime($meet_date);
$date = $datetime->format('Y-m-d');
$time = $datetime->format('h:i:s');
$meet_duration_cal = date('d-m-Y h:i:s', strtotime("+{$duration} hours", strtotime($meet_date)));
$output = "";
$meet_duration = new DateTime($meet_duration_cal);
$final_duration = $meet_duration->format('h:i:s');

$sql = mysqli_query($conn, "INSERT into meetings values('{$date}','{$time}','{$topic}','{$names}','{$location}','{$duration}', 'ACTIVE')");

if ($sql) {
    $output .= '
                  <div class="heading">
                    <h3> Success </h3>
                </div>';
} else {
    $output .= '
                  <div class="heading">
                    <h3> Failed </h3>
                    
                </div>';
}


echo $output;
