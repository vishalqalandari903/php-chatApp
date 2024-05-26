<?php 
session_start();
require_once './includes/header.php';
include_once "./includes/config.php";

if(!isset($_SESSION['unique_id'])){
  header("location: login.php");
}

$user_id_isset = false;

if(isset($_GET['user_id'])){
  $user_id_isset = true;
  $typingtoid_qry = mysqli_query($conn, "UPDATE users SET typing_to_id = '{$_GET['user_id']}' WHERE unique_id = '{$_SESSION['unique_id']}'");
}

?>
  <body>
    <div class="outside-wrapper">
      <section class="users">
        <header>
          <?php
           $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
           if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
           }
          ?>
          <div class="content ms-3">
            <img src="php/users-images/<?= $row['img'] ?>" />
            <div class="details">
              <span><?= $row['fname'] ?> <?= $row['lname'] ?></span>
              <p>Meet with meetup</p>
            </div>
          </div>
          <form method="POST" action="logout.php?logout_id=<?= $row['unique_id'] ?>">
            <input type="submit" value="Logout" class="logout text-decoration-none ">
          </form>
            
        </header>
        <div class="search">
          <!-- <span class="text ms-3">Select an user to start chat</span> -->
          <input type="text" class="search-input" placeholder="Enter name to search" />
          <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <div class="users-list">
          <!-- <a href="#">
            <div class="content">
              <img src="php/users-images/1706448002profil.jpg" alt="" />
              <div class="details">
                <span>Vishal Kumar</span>
                <p>You: dsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsd</p>
              </div>
            </div>
            <div class="status-dot '.$offline.'"><i class="fa-solid fa-circle"></i></div>
          </a>
          <a href="#">
            <div class="content">
              <img src="php/users-images/1706448002profil.jpg" alt="" />
              <div class="details">
                <span>Vishal Kumar</span>
                <p>You: dsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsd</p>
              </div>
            </div>
            <div class="status-dot '.$offline.'"><i class="fa-solid fa-circle"></i></div>
          </a>
          <a href="#">
            <div class="content">
              <img src="php/users-images/1706448002profil.jpg" alt="" />
              <div class="details">
                <span>Vishal Kumar</span>
                <p>You: dsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsd</p>
              </div>
            </div>
            <div class="status-dot '.$offline.'"><i class="fa-solid fa-circle"></i></div>
          </a>
          <a href="#">
            <div class="content">
              <img src="php/users-images/1706448002profil.jpg" alt="" />
              <div class="details">
                <span>Vishal Kumar</span>
                <p>You: dsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsddsadsd</p>
              </div>
            </div>
            <div class="status-dot '.$offline.'"><i class="fa-solid fa-circle"></i></div>
          </a> -->
        </div>
      </section>

      <?php if($user_id_isset) : ?>
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
            <a href="users.php" class="back-icon"
              ><i class="fa-solid fa-arrow-left"></i
            ></a>

            <img src="php/users-images/<?= $row['img'] ?>" />
            <div class="details">
              <span><?= $row['fname'].' '.$row['lname'].$you ?></span>
              <p class="user-status" id="user-status">Online now</p>
            </div>
          </header>
          <div class="chat-box">
          </div>
          <form method="post" class="typing-area">
            <input type="text" name="outgoing_id" value="<?= $_SESSION['unique_id'] ?>" hidden>
            <input type="text" name="incoming_id" value="<?= $user_id ?>" hidden>
            <textarea type="text" name="message" class="input-field" style="height: 40px;" placeholder="Type a message here..." ></textarea>
            <button>
              <!-- <i class="fa-regular fa-paper-plane"></i> -->
              <ion-icon name="send-outline"></ion-icon>
          </button>
          </form>
        </section>
      </div>
      <?php endif; ?>
    </div>

    
    <?php require_once "php/v.php"; ?>
    <script src="javascript/talk.js?v=<?= $v ?>"></script> 
    <script src="javascript/users.js?v=<?= $v ?>"></script>
  </body>
</html>