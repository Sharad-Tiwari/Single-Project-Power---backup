<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}

include_once "config.php";



$generator = "1357902468abcdefghijklmnopqrstuvwxyz";
$otp = "";
for ($i = 1; $i <= 6; $i++) {
    $otp .= substr($generator, rand() % strlen($generator), 1);
}

$to = $_POST['email'];

if($to){
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$to}'");
    if(mysqli_num_rows($sql)>0){
        $row = mysqli_fetch_assoc($sql);
        $subject = 'User Registration Details to Change password';
        $message = "<H3>Hi, This is a your Registration Profile For NXTDIGITAL. Kindly follow the below link to complete your profile.</H3>";
        $message .= '<a href="http://localhost/Single%20Project%20Power%20-%20backup/Signup page.php?unique_id='.$row['unique_id'].'&company='.$_SESSION['cc'].'"> COMPLETE PROFILE</a>';
        
        $message.="<h4>Please Contact for Further Queries</h4>";
        $headers = 'From: smsdegfybscit3039244sharad@smshettyinstitute.org' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" ;

            $headers.=
        'Content-type: text/html; charset=utf-8' . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo "mail Sent";
        } else {
            echo "email sending failed";
        }
    } else {
        echo "ERROR: No User Registered";
    }
}
else{
    echo "ERROR: No email Found!!";
}


