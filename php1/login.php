<?php
session_start();
$company =  $_POST['c_code'];
$email = $_POST['email'];

if ($company) {
    $_SESSION['cc'] = $company;
    $_SESSION['email'] = $email;
    
}
    include_once  "config.php";
    
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($email) && !empty($password)) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($password);
            $enc_pass = $row['password'];
            if ($user_pass === $enc_pass) {
                $status = "Active";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                if ($sql2) {
                $date = date('Y-m-d');
                $time = date('H:i:s');
                $day = date('l');
                $attendance = mysqli_query($conn, "SELECT * FROM attendance WHERE (email = '{$_SESSION['email']}' and present='IN' and date='{$date}' and day='{$day}')");
                if(mysqli_num_rows($attendance)>0){
                    $res = mysqli_fetch_assoc($attendance);
                    if($res['present']){
                        $_SESSION['present'] = $res['present'];
                    }
                } else {
                    $SESSION['present'] = "OUT";
                }
                    

                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success";
                } else {
                    echo "Something went wrong. Please try again!";
                }
            } else {
                echo "Email or Password is Incorrect!";
            }
        } else {
            echo "$email - This email does not Exist!";
        }
    } else {
        echo "All input fields are required!";
    }
?>