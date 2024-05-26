<?php 
session_start();
require_once './includes/header.php';

if(!isset($_SESSION['unique_id'])){
  header("location: login.php");
}

?>
  <body>
    <div class="outside-wrapper">
      <section class="users">
        <header>
          <?php
           include_once "./includes/config.php";
           $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
           if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
           }
          ?>
          <div class="content ms-3">
            <img src="php/users-images/<?= $row['img'] ?>" />
            <div class="details">
              <span><?= $row['fname'] ?> <?= $row['lname'] ?></span>
              <p><?= $row['status'] ?></p>
            </div>
          </div>
          <form method="POST" action="logout.php?logout_id=<?= $row['unique_id'] ?>">
            <input type="submit" value="Logout" class="logout text-decoration-none ">
          </form>
            
        </header>
        <div class="search">
          <span class="text ms-3">Select an user to start chat</span>
          <input type="text" placeholder="Enter name to search" />
          <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <div class="users-list">
        </div>
      </section>

      <div class="chat-wrapper">
        <section class="chat-area">
          <header>
            <?php
              include_once "./includes/config.php";
              $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
              $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$user_id}'");
              $you = "";
              if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
                if($row['unique_id'] === $_SESSION['unique_id']){
                  $you = "(You)";
                }
              }
            ?>
            <!-- <a href="users.php" class="back-icon"
              ><i class="fa-solid fa-arrow-left"></i
            ></a> -->

            <img src="php/users-images/<?= $row['img'] ?>" />
            <div class="details">
              <span><?= $row['fname'].' '.$row['lname'].$you ?></span>
              <p class="user-status" id="user-status"><?= $row['status'] ?></p>
            </div>
          </header>
          <div class="chat-box">
          </div>
          <form method="post" class="typing-area">
            <input type="text" name="outgoing_id" value="<?= $_SESSION['unique_id'] ?>" hidden>
            <input type="text" name="incoming_id" value="<?= $user_id ?>" hidden>
            <input type="text" name="message" class="input-field" placeholder="Type a message here..." />
            <button><i class="fa-regular fa-paper-plane"></i></button>
          </form>
        </section>
      </div>
    </div>
    
    <?php require_once "php/v.php"; ?>
    <script src="javascript/talk.js?v=<?= $v ?>"></script>
    <script src="javascript/users.js?v=<?= $v ?>"></script>
  </body>
</html>