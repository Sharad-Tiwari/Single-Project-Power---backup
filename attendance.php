<?php

function dataentry() {
    $company = "nxt";
    $con = mysqli_connect("localhost", "root", "");
    if($con) {
        mysql_select_db($company, $con);
        $query = mysql_query("select * from clients where company= '$company' ");
        $query2 = mysql_num_rows($query);

        if($query2 > 0) {
            $data = "Insert into clients values('','punched In', '$latitude' , '$longitude')";
        }
        
    } else {
        echo "error connecting to the database";
    }
}
?>