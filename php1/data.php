<?php
while ($row = mysqli_fetch_assoc($sql)) {
    $data_outgoing_id ="";

    $sql2 = mysqli_query($conn, "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']} 
        OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id  DESC LIMIT 1");

    $result_set = mysqli_fetch_assoc($sql2);
    if (mysqli_num_rows($sql2) > 0) {
        $result = $result_set['msg'];
    } else {
        $result = "No message available";
    }
    if($result_set){
    $data_outgoing_id.= $result_set['outgoing_msg_id'];
    }
    (strlen($result) > 26) ? $msg = substr($result, 0, 26) . '...' : $msg = $result;
    
    ($outgoing_id == $data_outgoing_id) ? $you = "You: " : $you = "";

    ($row['status']== "Not Active")? $offline = "offline": $offline = "";
    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                        <div class="content">
                                <img src="php1/images/' . $row['img'] . '">
                                <div class="details">
                                    <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                                    <p>' . $you . $msg . '</p>
                                </div>
                            </div>
                            <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                        </a>';
}
