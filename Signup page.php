<?php
session_start();
$output = '';
if (isset($_GET['unique_id'])) {
    $unique_id = $_GET['unique_id'];
    $_SESSION["cc"] = $_GET['company'];
    include_once "php1\config.php";
    $sql = mysqli_query($conn, "Select * FROM users WHERE unique_id ='{$unique_id}'");
    if (mysqli_num_rows($sql) == 1) {
        $_SESSION['unique_id'] = $unique_id;
        $row = mysqli_fetch_assoc($sql);
        $_SESSION['email'] = $row['email'];
        $output .= '<html lang="en">

<head>
    <meta charset="" UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <title> Project SIGN-UP Page</title>
    <link rel="stylesheet" href="chat_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/brands.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Pinncale Attendance System</header>
            <form method="POST">
                <div class="error-txt">
                    This is an Error Message!
                </div>
                <div class="name-details">
                    <div class="field input">
                        <label> First Name:</label>
                        <input type="text" name="fname" placeholder="First Name" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label> Last Name:</label>
                        <input type="text" name="lname" placeholder="Last Name" autocomplete="off" required>
                    </div>
                </div>
                <div class="field input">
                    <label> Email Address:</label>
                    <input type="email" name="email" placeholder="Enter your Email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label> Phone Number:</label>
                    <input type="text" name="mobile" placeholder="Enter your phone Number...." pattern="[0-9]{10}" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label> Create Password:</label>
                    <input type="password" name="password" placeholder="Enter your new Password.... " autocomplete="off" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label> Select Image:</label>
                    <input type="file" name="image" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Continue">
                </div>
            </form>
            <div class="link"> Already Signed up?<a href="index.html">&nbsp;&nbsp;Login Now</a></div>
        </section>
    </div>
    <script src="Javascript/pass-show-hide.js"></script>
    <script src="Javascript/signup.js"></script>

</body>

</html>';
    } else {
        $output .= "<h1 style='text-align:center; background: red'>No user Found</h1>";
    }
} else {
    $output .= "<h1 style='text-align:center; background: red'>FORM EXPIRED!</h1>";
}

echo $output;
?>