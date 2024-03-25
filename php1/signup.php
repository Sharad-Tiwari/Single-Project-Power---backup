<?php
session_start();
include_once  "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone =mysqli_real_escape_string($conn, $_POST['mobile']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password&& !empty($phone))) {
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
							$encrypt_pass = md5($password);
							$insert_query = mysqli_query($conn, "UPDATE users SET unique_id ='{$ran_id}', fname= '{$fname}', lname='{$lname}', password='{$encrypt_pass}', img= '{$new_img_name}', status='{$status}', phone='{$phone}' WHERE email='{$_SESSION['email']}'");
							if ($insert_query) {
								$select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$_SESSION['email']}'");
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
						echo "Please upload an image file - jpeg, png, jpg";
					}
				} else {
					echo "Please upload an image file - jpeg, png, jpg";
				}
			}
		
	} else {
		echo "$email is not a valid email!";
	}
} else {
	echo "All input fields are required!";
}
