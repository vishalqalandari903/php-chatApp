<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "../includes/config.php";
        $user_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        if($_POST['status'] == "typing"){
            $status = "Typing...";
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$_POST['outgoing_id']}'");
        }else {
            $status = "Online now";
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$_POST['outgoing_id']}'");
        }

        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$user_id}'");
        $row = mysqli_fetch_assoc($sql);
        if($row['status'] == "Typing..." && $row['typing_to_id'] == $_SESSION['unique_id']){

            echo $row['status'];
        }else {
            echo "Online now";
        }
    }
?>
