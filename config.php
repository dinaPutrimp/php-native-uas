<?php
    $conn = new mysqli("localhost","root","","rental");
    if($conn->connect_error){
        die("Connection Failed!" .$conn->connect_error);
    }
?>