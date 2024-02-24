<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
include_once "C:/xampp\htdocs\Single Project Power - backup\php1\config.php";
$i = 0;
$border;
$name = mysqli_query($conn, "SELECT * FROM users where unique_id={$_SESSION['unique_id']}");
$uname = mysqli_fetch_assoc($name);
$sql = mysqli_query($conn, "Select * from meetings where status='ACTIVE'");
$output = "";
if (mysqli_num_rows($sql) < 1) {
    $output .= "No Meetings Scheduled";
} elseif (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
        
        $members = explode(", ", $row['members']);

        foreach ($members as $member) {
            if ($member == 'Sharad') {
                $output .= '<div class="listbx l1">
                        <div class="heading">
                            <div class="members">
                                <h3 class="meet">' . $row['Topic'] . '</h3>
                                <names>
                                    <i class="fa-solid fa-users"></i>
                                    &nbsp;&nbsp;' . $row['members'] . '
                                </names>
                            </div>
                            <div class="details">
                                <location>
                                    <i class="fa-solid fa-location-dot"></i>
                                    ' . $row['location'] . ' Branch
                                </location>
                                <time>
                                    <i class="fa-solid fa-clock"></i>
                                    ' . $row['Time'] . '&nbsp;&nbsp;' . $row['duration'] . 'hrs</time>
                            </div>
                        </div>
                        <div class="list-icon cancel" value="'.$row['Topic']. '"><i class="fa-solid fa-xmark"></i></div>
                        <div class="list-icon complete" value="' . $row['Topic'] . '"><i class="fa-solid fa-check"></i></div>
                    </div>';
            }
        }
    }
}
echo $output;
