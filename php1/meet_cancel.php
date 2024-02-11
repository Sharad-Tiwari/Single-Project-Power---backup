<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
include_once "C:/xampp\htdocs\Single Project Power\php1\config.php";
$topic = $_POST['val'];

$name_sql = mysqli_query($conn, "SELECT * FROM users where unique_id={$_SESSION['unique_id']}");
$uname = mysqli_fetch_assoc($name_sql);
$client = $uname['fname'];
if ($client && $topic) {
    $sql = mysqli_query($conn, "SELECT members FROM meetings WHERE Topic='{$topic}'");

    if(mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);

        $members = explode(", ", $row['members']);

        foreach ($members as $member) {
            if ($member == $client) {
                if (mysqli_query($conn, "UPDATE meetings SET status ='CANCELED' WHERE Topic='{$topic}'")) {
                    echo "Sucessfully Canceled meet {$topic}";
                } else {
                    echo "falied";
                }
            }
        }
    }
    else {
        echo "no data found";
    }
}
?>