<?php
if(!empty($_POST['save']));
{
	$fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $db=$_POST['c_code'];
	$pass=$_POST['password'];
	$c=mysqli_connect("localhost","root","");
	mysqli_select_db($db,$c);
	$res=mysql_query("Select * from clients where EMail='$email' and password='$pass'");
	$con=(mysql_num_rows($res));
	if($con>0)
	{
		header("Location:Front page.html");
	}
	else
	{
		echo"<hr><h1 align=center style='color:red'>INVALID USERNAME OR PASSWORD<br></h1><hr>",mysql_error();
		echo"<H3 align=center> Wait for 5 secconds</H3>";
		header("refresh:2; url=login.html");
	}
}
mysql_close($c);
?>