<?php
    session_start();
    include_once "../includes/config.php";
    $sql = mysqli_query($conn, "SELECT * FROM users");
    $output = "";
    $outgoing_id = $_SESSION["unique_id"];
    if(mysqli_num_rows($sql) == 0){
        $output .= "No users available to chat";
    }else if (mysqli_num_rows($sql) > 0){
        require_once "data.php";
    }
    echo $output;
?>