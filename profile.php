<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile</title>
  <link rel="stylesheet" href="front.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/all.min.css" integrity="sha512-gRH0EcIcYBFkQTnbpO8k0WlsD20x5VzjhOA1Og8+ZUAhcMUCvd+APD35FJw3GzHAP3e+mP28YcDJxVr745loHw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/a9903cb47c.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

  <script defer src="face-api.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script src="chart.js"></script>

</head>

<body>
  <?php
  include_once "php1/config.php";

  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
  if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
  }

  $name = $row['fname'];
  ?>

  <?php
  include_once "php1/config.php";
  $date = "";
  $year = date("Y");
  $sql = mysqli_query($conn, "SELECT * FROM meetings WHERE members='{$name}'");
  if (mysqli_num_rows($sql) > 0) {
    $val = mysqli_fetch_assoc($sql);
  }
  ?>
  <header>
    <div class="menu">
      <span class="burger"></span>
    </div>
    <nav class="nav">
      <ul class="nav list">
        <li class="app_name">Pinterest</li>
        <li><a class="nav link" href="Front page.html">Home</a></li>
        <li><a class="nav link" href="#">Services</a></li>
        <li><a class="nav link" href="users.php">Chat</a></li>
        <li><a class="nav link" href="#">Contact</a></li>
        <li><a class="nav link" style="color:Red;" href="php1/logout.php?logout_id=<?php echo $row['unique_id'] ?>">Log Out</a></li>
      </ul>
    </nav>
  </header>
  <div class="facedec">
    <video id="video" width="600" height="450" autoplay>
  </div>

  <main class="profile-page">
    <!--------------------------------USER PROFILE------------------------------------>
    <section class="info">

      <!-- <div class="emp-info"> -->

      <div class="container-profile">
        <div class="profile">
          <div class="profile-img">
            <img src="php1/images/<?php echo $row['img'] ?>">
            <i class="fa-regular fa-pen-to-square"></i>
          </div>
          <div class="details">
            <div class="name-details">
              <h3><?php echo $row['fname'] . " " . $row['lname'] ?></h3>
              <button><?php echo $row['status'] ?></button>
            </div>
            <div class="role-pos">
              <div class="position">
                <label>Role:</label>
                <span><?php echo $row['role'] ?></span>
              </div>
              <div class="position">
                <label>Position:</label>
                <span><?php echo $row['position'] ?></span>
              </div>
            </div>

            <div class="email">
              <label>E-mail:</label>
              <span><?php echo $row['email'] ?></span>
            </div>
            <div class="phone">
              <label>Phone:</label>
              <span><?php echo $row['phone'] ?></span>
            </div>
            <div class="company">
              <label>Company:</label>
              <span><?php echo $row['company_name'] ?></span>
            </div>

            <div class="socials">
              <i class="fa-brands fa-facebook" id="facebook"></i>
              <i class="fa-brands fa-twitter" id="twitter"></i>
              <i class="fa-brands fa-instagram" id="instagram"></i>
              <i class="fa-brands fa-telegram" id="telegram"></i>
            </div>
          </div>
        </div>

        <!-------------------EVENT SECTION---------------------------->
        <div class="event-wrapper">

          <div class="events">
            <header>
              <div class="heading">
                <h3>Upcoming Events</h3>
                <p class="current-date"><?php echo date("d F, Y") ?></p>
              </div>
              <button class="view">
                <a href="Meetings.php" style="text-decoration:none; color:#fff;">View All</a>
              </button>
            </header>
            <div class="events-list">

            </div>
          </div>

        </div>

        <section class="profile-attendance">
          <form method="post">
            <label>Location:</label><br />
            <select name="branch" class="branch" id="branch" required>
              <option value="None" default>Select Option</option>
              <option value="Kurla">Kurla</option>
              <option value="Powai">Powai</option>
              <option value="Kanjurmarg">Kanjurmarg</option>
              <option value="Mulund">Mulund</option>
              <option value="Ghatkopar">Ghatkopar</option>
              <option value="Vasai">Vasai</option>
              <option value="Andheri">Andheri</option>
            </select>
          </form>
          <div class="wrapper">
            <div class="attendance-finger">
              <div class="punch-in">
                <i class="fa-sharp fa-solid fa-location-dot"></i>
                <span>Punch - In</span>
              </div>
              <div class="punch-out">
                <i class="fa-solid fa-xmark"></i>
                <span>Punch-Out</span>
              </div>
            </div>
            <div class="finger-image">
              <i class="fas fa-fingerprint finger"></i>
              <i class="fa-solid fa-camera-retro face" onclick="faceRecog()"></i>
            </div>
          </div>

        </section>

        <div id="chart_div"></div>
      </div>

      </div>
    </section>

    <!---------------------------ATTENDANCE SECTION------------------------------------->

  </main>

  <!---------------------------------FOOTER SECTION--------------------------------->
   <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h3>About Us</h3>
          <p>We are a team of experienced professionals who are passionate about helping businesses succeed. We offer a
            wide range of services, including web development, graphic design, and marketing.</p>
          <p>Contact us today to learn more about how we can help you grow your business.</p>
        </div>
        <div class="col-md-4">
          <h3>Contact Us</h3>
          <p>123 Main Street<br>
            Anytown, CA 12345<br>
            (123) 456-7890<br>
            info@example.com</p>
        </div>
        <div class="col-md-4">
          <h3>Stay Connected</h3>
          <ul class="list_inlbx ne">
            <li><a href="https://www.facebook.com/example" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/example" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.linkedin.com/company/example" target="_blank"><i class="fa fa-linkedin"></i></a>
            </li>
            <li><a href="https://www.instagram.com/example" target="_blank"><i class="fa fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="copyright">
        &copy; 2023 Example Company. All rights reserved.
      </div>
    </div>
  </footer>
  <!-------------------Import scripts------------------------>

  <script src="main.js"></script>
  <script src="Javascript\meetings.js"></script>
  <!-- <script src="Javascript/Geolocation.js"></script> -->
</body>

</html>