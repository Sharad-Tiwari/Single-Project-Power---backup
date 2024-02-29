<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
  header("location: index.php");
}
include_once "C:/xampp\htdocs\Single Project Power - backup\php1\config.php";
$i = 0;
$border;
$namerw = mysqli_query($conn, "SELECT * FROM users where unique_id={$_SESSION['unique_id']}");
$name = mysqli_fetch_assoc($namerw);
$sql = mysqli_query($conn, "Select * from meetings where status='ACTIVE'");
$output = "";
if (mysqli_num_rows($sql) < 1) {
    $output .= "No Meetings Scheduled";
} elseif (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
    if ($i % 2 == 0) {
      $border = 1;
    } else {
      $border = 2;
    }
    $members = explode(", ", $row['members']);
    foreach ($members as $member) {
      if($member==$name['fname']){
        $output .= '<div class="listbx l' . $border . '">
                  <div class="heading">
                    <h3>' . $row['Topic'] . '</h3>
                    <time>' . $row['Time'] . ' &nbsp;&nbsp; <i class="fa-solid fa-clock"></i>  ' . $row['duration'] . ' hrs</time>
                  </div>
                  <div class="list-icon"><i class="fa-solid fa-user"></i></div>
                </div>';
      }
      
    }
        
    $i = $i+1;
    }
}
echo $output;
?>
