
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>loading animation</title>
	<style>
		body {
			background-color: aliceblue;
			margin:100px 0 0 100px;
		}

		.loading {
			width: 100px;
			height:100px;
			border-radius: 100px;
			border: 2px solid transparent;
			border-top: 2px solid green;
		}
	</style>

</head>
<body>
	<div class="loading"></div>
	$fname=$_POST['fname'];
$lname=$_POST['lname'];
$generator="1357902468";
$otp="";
for($i=0;$i<6;$i++)
{
	$otp .= substr($generator,rand()%strlen($generator),1);
}
$email=$_POST['email'];
$db=$_POST['c_code'];
$c=mysql_connect("localhost","root","");
mysql_select_db($db,$c);
mysql_query("Insert into clients values('$fname','lname','$email','$otp','')");
$set="Select * from clients";
$res=mysql_query($set,$c);
if(mysql_num_rows($res)>0)
{
	ini_set("sendmail_from","smsdegfybscit3039244sharad@smshettyinstitute.org");
	$sender="smsdegfybscit3039244sharad@smshettyinstitute.org \r\n";
	$message="The OTP for registration is \n".$otp."\n Thank You";
	$subject="Registration OTP";
	$header="From: $sender";
	$send = mail($email, $subject, $message, $header);
	
	echo($send==true ? "Mail is send" : "<h1 align=center>There was an Error</h1>");
	header("location:Otp.html");
}
else
{
	echo ("Error creating Id:<br>".mysql_error());
}

mysql_close($c);
?>
</body>
</html>
<?php
