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
    <title>Meetings Page</title>
    <link rel="stylesheet" href="meetings_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/all.min.css" integrity="sha512-gRH0EcIcYBFkQTnbpO8k0WlsD20x5VzjhOA1Og8+ZUAhcMUCvd+APD35FJw3GzHAP3e+mP28YcDJxVr745loHw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

</head>

<body>
    <main class="meet_container">
        <div class="event-wrapper">
            <div class="events">
                <header>
                    <div class="heading">
                        <h3>Today's Upcoming Events</h3>
                        <p class="current-date"><?php echo date("d F, Y") ?></p>
                    </div>
                    <button class="view"><i class="fa-fa-solid fa-add"></i>
                        CREATE</button>
                </header>
                <div class="events-list">
                    <section class="create-container">
                        <div class="listbx l1 create">
                            <div class="heading">
                                <form>
                                    <div class="members">
                                        <input type="text" placeholder="Enter Topic of Meeting" name="topic" size="12">
                                        <names>
                                            <i class="fa-solid fa-users"></i>
                                            &nbsp;&nbsp;
                                            <input type="text" placeholder="Enter members" name="mnames" size="10">
                                        </names>
                                    </div>
                                    <div class="details">
                                        <location>
                                            <i class="fa-solid fa-location-dot"></i>
                                            <Select name="location" size="1">
                                                <option value="Powai">Powai</option>
                                                <option value="Kanjurmarg">Kanjurmarg</option>
                                                <option value="Mulund">Mulund</option>
                                                <option value="Kurla">Kurla</option>
                                                <option value="Dadar">Dadar</option>
                                            </Select>
                                        </location>
                                        <time>
                                            <i class="fa-solid fa-clock"></i>
                                            <input type="datetime-local" name="time" placeholder="Enter Time" size="2"></time>
                                        Duration:
                                        <duration><input type="text" placeholder="Duration" name="duration" pattern="[0-9]{2}" maxlength="2" size="3">hrs</duration>
                                    </div>
                                </form>
                            </div>
                            <div class="list-icon submit"><i class="fa-solid fa-check"></i></div>
                        </div>
                    </section>
                    <section class="meet_list">

                    </section>
                </div>
            </div>
        </div>
    </main>


    <script src="Javascript/meet_update.js"></script>
    <script src="Javascript/meet_control.js"></script>
</body>

</html>