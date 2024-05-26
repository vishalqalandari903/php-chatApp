<?php
    session_start();
    include_once "../includes/config.php";
    $outgoing_id = $_SESSION["unique_id"];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    

    $output = "";
    // $sql = mysqli_query($conn, "SELECT * FROM users WHERE fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%' OR CONCAT(fname, ' ', lname) LIKE '%{$searchTerm}%' OR ('you' LIKE '%{$searchTerm}%' AND unique_id = $outgoing_id) OR CONCAT(lname, ' ', 'you') LIKE '%{$searchTerm}%'");
    // echo mysqli_num_rows($sql);
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%' OR 
    CONCAT(fname, ' ', lname) LIKE '%{$searchTerm}%' OR ('you' LIKE '%{$searchTerm}%' 
    ) OR CONCAT(lname, ' ', 'you') LIKE '%{$searchTerm}%'");
    if(mysqli_num_rows($sql) > 0){
        require_once "data.php";
    }else {
        $output .= "No user found related to your search term";
    }
    echo $output;
?>