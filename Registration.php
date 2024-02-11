<?php
$user=$_POST['uname'];
$pass=$_POST['pass'];
$c=mysql_connect("localhost","root","");
if(!$c)
	die('Error connecting database'.mysql_error());
else
{
mysql_select_db("nxt",$c);
mysql_query("Insert into clients values(1,'$user','$pass')");
$set="Select * from clients";
$res=mysql_query($set,$c);
}
if(mysql_num_rows($res)>0)
{
	header("location:username&pass.html");
}
else
{
	echo ("Error creating Id:<br>".mysql_error());
}
mysql_close($c);
?>