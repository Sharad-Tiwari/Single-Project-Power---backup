<?php
session_start();
$company =$_POST['c_code'];
$_SESSION['cc']=$company;

include_once  "config.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

/*Generating Otp */
$generator = "0246813579";
$otp = "";
for ($i = 1; $i <= 6; $i++) {
	$otp .= substr($generator, rand() % strlen($generator), 1);
}
/*Sending Otp mail*/


// ini_set("sendmail_from","smsdegfybscit3039244sharad@smshettyinstitute.org");
// $sender="smsdegfybscit3039244sharad@smshettyinstitute.org \r\n";
// $message="The OTP for registration is \n".$otp."\n Thank You";
// $subject="Registration OTP";
// $header="From: $sender";
// $send = mail($email, $subject, $message, $header);
// echo($send==true ? "Mail is send" : "<h1 align=center>There was an Error</h1>");
/*Connecting Database and entering form values*/


if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
		if (mysqli_num_rows($sql) > 0) {
			echo "$email - This email already exist!";
		} else {
			if (isset($_FILES['image'])) {
				$img_name = $_FILES['image']['name'];
				$img_type = $_FILES['image']['type'];
				$tmp_name = $_FILES['image']['tmp_name'];

				$img_explode = explode('.', $img_name);
				$img_ext = end($img_explode);

				$extensions = ["jpeg", "png", "jpg"];
				if (
					in_array($img_ext, $extensions) === true
				) {
					$types = ["image/jpeg", "image/jpg", "image/png"];
					if (
						in_array($img_type, $types) === true
					) {
						$time = time();
						$new_img_name = $time . $img_name;
						if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
							$ran_id = rand(time(), 100000000);
							$status = "Active";
							$encrypt_pass = ($password);
							$insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
							if ($insert_query) {
								$select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
								if (mysqli_num_rows($select_sql2) > 0) {
									$result = mysqli_fetch_assoc($select_sql2);
									$_SESSION['unique_id'] = $result['unique_id'];
									echo "success";
								} else {
									echo "This email address not Exist!";
								}
							} else {
								echo "Something went wrong. Please try again!";
							}
						}
					} else {
						echo "Please upload an image file - jpeg, png, jpg";
					}
				} else {
					echo "Please upload an image file - jpeg, png, jpg";
				}
			}
		}
	} else {
		echo "$email is not a valid email!";
	}
} else {
	echo "All input fields are required!";
}
