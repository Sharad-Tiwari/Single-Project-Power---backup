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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <?php
    include_once "../php1/config.php";

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
    }

    $name = $row['fname'];
    ?>

    <?php
    include_once "../php1/config.php";
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
                    <img src="images/logo.images.jpg" alt="">
                    <h2>Sharad<span class="danger">Project</span></h2>

                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="#">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">person_outline

                    </span>
                    <h3>Users</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>History</h3>
                </a>
                <a href="#" class="active">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analytics</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Tickets</h3>
                    <span class="message-count">27</span>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Sale List</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        report_gmailerrorred
                    </span>
                    <h3>Reports</h3>
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

        <!--  MAIN SECTION -->


        <main>
            <h1>Analytics</h1>
            <!-- ANalyses -->
            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Total Sales</h3>
                            <h1>$65,024</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+81%</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3>Site Visits</h3>
                            <h1>24,981</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>-48%</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>Searches</h3>
                            <h1>14,147</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+21%</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End of Analyses -->
            <h2 class="chart">Analytical Chart</h2>
            <canvas id="chart"></canvas>
            <!-- New Users Section -->
            <div class="new-users">
                <h2>New Users</h2>
                <div class="user-list">
                    <div class="user">
                        <img src="images/profile-img-1.jpeg" alt="">
                        <h2>Jack</h2>
                        <p>54 Min Ago</p>
                    </div>

                    <div class="user">
                        <img src="images/profile-img-2.jpeg" alt="">
                        <h2>Amir</h2>
                        <p>3 Hours Ago</p>
                    </div>

                    <div class="user">
                        <img src="images/profile-img-3.jpg" alt="">
                        <h2>Ember</h2>
                        <p>6 Hours Ago</p>
                    </div>

                    <div class="user" id="new-user">
                        <img src="images/plus-logo.jpg" alt="">
                        <h2>More</h2>
                        <p>New User</p>
                    </div>
                </div>
            </div>
            <!-- END of New User Sections -->

            <!-- Recent Orders Table -->
            <div class="recent-orders">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Course Number</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <a href="#">Show All</a>
            </div>
            <!-- END of Recent Orders -->


        </main>
        <!-- END of Main Content -->
        <!-- Right Section -->
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
                        <p>Hey, <b><?php echo $row['fname'] ?></b></p>
                        <small class="text-muted"><?php echo $row['role'] ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="../php1/images/<?php echo $row['img'] ?>">
                    </div>
                </div>
            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="../php1/images/<?php echo $row['img'] ?>">
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

                <div class="notification">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            volume_up
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>WorkShop</h3>
                            <small class="text_muted">
                                08:00 AM - 12:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div class="notification deactive">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            edit
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>WorkShop</h3>
                            <small class="text_muted">
                                08:00 AM - 12:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div class="notification add-reminder">
                    <div>
                        <span class="material-icons-sharp">
                            add
                        </span>
                        <h3>Add Reminder</h3>
                    </div>
                </div>

            </div>
            <!-- Events Section -->

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
                            <a href="../Meetings.php" style="text-decoration:none; color:#fff;">View All</a>
                        </button>
                    </header>
                    <div class="events-list">

                    </div>
                </div>

            </div>

        </div>

    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="admin.js"></script>
    <script src="index.js"></script>
    <script src="../Javascript/meetings.js"></script>
    <script src="../Javascript/new-user.js"></script>
</body>

</html>