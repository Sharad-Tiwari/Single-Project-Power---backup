<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"/>
    <link rel="stylesheet" href="profile.css"/>
    <script src="face-api.min.js"></script>
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
    <div class="container">
        <!-- Sidebar SEction -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <h2>Sharad<span class="danger">Project</span></h2>

                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="#" class="active">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Profile</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        message
                    </span>
                    <h3>Chat</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>New Meeting</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analytics</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Mail</h3>
                    <span class="message-count">27</span>
                </a>
                
                <a href="#">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Settings</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        add
                    </span>
                    <h3>New Login</h3>
                </a>
                <a href="php1/logout.php?logout_id=<?php echo $row['unique_id'] ?>">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>

            </div>
        </aside>
        <!-- END of sidebar section -->
        <div class="facedec">
            <video id="video" width="600" height="450" autoplay>
        </div>
        <main>
            <h1 class="chart">Analytical Chart</h1>
            <canvas id="chart"></canvas>

            <!-- Attendance Section -->
            <div class="attendance-sec">
                <h2>Attendance Section</h2>
                <div class="attendance">
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
                                <span class="material-icons-sharp">
                                    location_on
                                </span>
                                <span>Punch - In</span>
                            </div>
                            <div class="punch-out">
                                <span class="material-icons-sharp">
                                close
                            </span>
                                <span>Punch-Out</span>
                            </div>
                        </div>
                        <div class="finger-image">
                            <span class="material-icons-sharp finger">
                                fingerprint
                            </span>
                            <span class="material-icons-sharp face" onclick="faceRecog()">
                                photo_camera
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Section Ends -->

        </main>
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php echo $row['fname']?></b></p>
                        <small class="text-muted"><?php echo $row['role'] ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="php1/images/<?php echo $row['img'] ?>">
                    </div>
                </div>
            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="php1/images/<?php echo $row['img'] ?>">
                    <h2><?php echo $row['fname'] . " " . $row['lname'] ?></h2>
                    <p><?php echo $row['position'] ?></p>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <h2>Reminders</h2>
                    <span class="material-icons-sharp">
                        notifications_none
                    </span>
                </div>
                <div class="event-wrapper">
                
                    <div class="events">
                        <header>
                            <div class="heading">
                                <h2>Upcoming Events</h2>
                                <p class="current-date">
                                    <?php echo date("d F, Y") ?>
                                </p>
                            </div>
                            <button class="view">
                                <a href="Meetings.php" style="text-decoration:none; color:#fff;">View All</a>
                            </button>
                        </header>
                        <div class="events-list">
                            
                        </div>
                    </div>
                
                </div>
                

            </div>

            <!-- End of Reminder section -->
            
            <!-- meetings section -->

        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"
        integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="profile.js"></script>
    <script src="main.js"></script>
    <script src="Javascript\meetings.js"></script>
</body>

</html>