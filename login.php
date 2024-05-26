<?php
  session_start();

  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
    die();
  }

  require_once './includes/header.php';
?>
  <body>
    <div class="form-wrapper">
      <section class="form login">
        <header>Realtime Chat App</header>
        <form action="#" method="post">
          <div class="error-txt">This is an error message</div>
          <div class="field input">
            <label for="">Email Address</label>
            <input type="text" name="email" placeholder="Enter your email" />
          </div>
          <div class="field input">
            <label for="">Password</label>
            <input
              type="password"
              class="password-field" name="password"
              placeholder="Enter Your Password"
            />
            <i class="fa-regular fa-eye"></i>
          </div>
          <div class="field button">
            <input type="submit" value="Continue to Chat" />
          </div>
        </form>
        <div class="link">
          Not yet Signed Up? <a href="index.php">Signup Now</a>
        </div>
      </section>
    </div>

    <?php require_once "php/v.php"; ?>
    <script src="javascript/pass-show-hide.js?v=<?= $v ?>"></script>
    <script src="javascript/login.js?v=<?= $v ?>"></script>
    
  </body>
</html>