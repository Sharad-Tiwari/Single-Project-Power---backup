<?php
include 'Registration page.html';
$mail=$_POST['email'];
$c=mysql_connect("localhost","root","");
mysql_select_db("nxt",$c);
$otp=mysql_query("select otp from otp where email_id='$mail'")
$msg="The OTP for registration is \n".$otp."\n Thank You";
mail($mail,"Registration OTP",$msg);
header("location:OTP Page.html");
?>