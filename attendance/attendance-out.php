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

$sql = mysqli_query($conn, "SELECT * FROM attendance WHERE (email = '{$_SESSION['email']}') and (present = 'OUT') ORDER BY date ASC" );
// if($sql){
//     $combinedarray = [
//         "error" => "Sucess",
//         "data"=> $res = mysqli_fetch_all($sql),
//         "newDate"=> $newDate
//     ];
// }
if((mysqli_num_rows($sql)) > 0) {
    
    while ($res = mysqli_fetch_assoc($sql)) {
        if ($res['date'] == $newDate) {
            //Getting timings.....
            array_push($timings, (int)date('H', strtotime($res['time'])));
            //Getting Day....
            array_push($day, $res['day']);
        }
        $newDate = date('Y-m-d', strtotime($newDate . '+1day'));
    }
 }  else {
    $combinedarray = [
        "error" => "No Data Found",
    ];
 }
  $combinedarray = [
      'time' => !empty($timings)?$timings:"No data",
      'day' => !empty($day)?$day: "No data"
     ];
$arr = json_encode($combinedarray);

echo $arr;

mysqli_close($conn);
?>
