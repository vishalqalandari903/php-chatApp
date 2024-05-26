<?php
    while($row = mysqli_fetch_assoc($sql)){
      $you = "";
      if($row['unique_id'] == $_SESSION['unique_id']){ 
        $you = "(You)";
      }
      if($you == ""){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
        OR outgoing_msg_id = {$row['unique_id']}) AND
        (outgoing_msg_id = {$outgoing_id}
        OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
      }else if($you = "(You)") {
        $sql2 = "SELECT * FROM messages WHERE (outgoing_msg_id = {$row['unique_id']}) AND
        (outgoing_msg_id = incoming_msg_id) ORDER BY msg_id DESC LIMIT 1";
      }
      

      $query2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($query2);
      if(mysqli_num_rows($query2) > 0) {
        $result = $row2['msg'];
      }else {
        $result = "No Message available";
      }
      $incoming_userName = "{$row['fname']} {$row['lname']} $you";
      // $incoming_userName = $row['fname']. ' '. $row['lname'] .' '. $you;
      
      $msg = $result;
      $youMessage = "";
      if($row2 !== NULL and $outgoing_id == $row2['outgoing_msg_id']){
        $youMessage = "You: ";
      }

      ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
      $last_msg = $youMessage . $msg;
      $status_qry = "SELECT * FROM users WHERE unique_id = {$row['unique_id']}";
      $status_query = mysqli_query($conn, $status_qry);
      $status = mysqli_fetch_assoc($status_query);
      if($status['status'] == "Typing..." && $status['typing_to_id'] == $_SESSION['unique_id']){
        $last_msg = "Typing...";
      }
      $output .= '
        <a href="users.php?user_id='.$row['unique_id'].'">
        <div class="content">
          <img src="php/users-images/'. $row['img'] .'" alt="" />
          <div class="details">
            <span>'. $incoming_userName .'</span>
            <p class="last-msg">'.$last_msg.'</p>
          </div>
        </div>
        <div class="status-dot '.$offline.'"><i class="fa-solid fa-circle"></i></div>
      </a>
      ';
    }
?>