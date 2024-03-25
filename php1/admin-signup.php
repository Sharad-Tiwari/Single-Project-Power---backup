<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}

include_once  "config.php";
$role = mysqli_real_escape_string($conn, $_POST['role']);
$empId = mysqli_real_escape_string($conn, $_POST['e_code']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$position = mysqli_real_escape_string($conn, $_POST['position']);
$status = 'processing';

if (!empty($role) && !empty($empId) && !empty($email) && !empty($position)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - This email already exist!";
        } else {
            $ran_id = rand(time(), 100000000);
            $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, email, role, status, position)
                                VALUES ('{$ran_id}','{$email}', '{$role}','{$status}','{$position}')");
            if ($insert_query) {
                $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                if (mysqli_num_rows($select_sql2) > 0) {
                    $result = mysqli_fetch_assoc($select_sql2);
                    echo "success";
                } else {
                    echo "This email address not Exist!";
                }
            } else {
                echo "Something went wrong. Please try again!";
            }
        }
    } else {
        echo "$email is not a valid email!";
    }
} else {
    echo "All input fields are required!";
}
