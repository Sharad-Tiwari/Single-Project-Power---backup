<?php
$email=$_POST['email'];
$otp=$_POST['OTP'];
$db=$_POST['c_code'];
$pass=$_POST['password'];
$c=mysql_connect("localhost","root","");
mysql_select_db($db,$c);
$set=mysql_query("Select * from clients where EMail='$email' and OTP='$otp'");
if(mysql_num_rows($set)>0)
{
	mysql_query("Update clients set password='$pass' where EMail='$email' and OTP='$otp'");
	header("location:login.html");
}
else
{
	echo ("Error creating Id:<br>".mysql_error());
}

mysql_close($c);
?>