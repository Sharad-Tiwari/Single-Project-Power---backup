<?php
$otp=$_POST['OTP'];
$email=$_POST['email'];
$c=mysql_connect("localhost","root","");
mysql_select_db("nxt",$c);
$res=mysql_query("Select * from otp where email_id='$email' and otp='$otp'");
$check=(mysql_num_rows($res));
if($check>0)
{
	header("location:Registration Page 2.html");
}
else
{
	echo ("<h1 align=Center >Entered OTP Does Not Match</h1>");
}
mysql_close($c);
?>