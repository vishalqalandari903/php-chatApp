<?php
  session_start();

  if(isset($_SESSION['unique_id'])){
      header("location: users.php");
      die();
  }

  require_once './includes/header.php';

  $logindefault = false;

  require "./php/v.php";
?>
  <body>
    <div class="form-wrapper">
      <section class="form signup">
        <header>Realtime Chat App</header>
        <form action="#" enctype="multipart/form-data" method="post">
          <div class="error-txt">This is an error message</div>
          <div class="name-details">
            <div class="field input">
              <label for="">First Name</label>
              <input type="text" name="fname" placeholder="First Name" <?php if($logindefault) {echo 'value="hel"';} ?>  required />
            </div>
            <div class="field input">
              <label for="">Last Name</label>
              <input type="text" name="lname" placeholder="Last Name" <?php if($logindefault) {echo 'value="lo"';} ?> required />
            </div>
          </div>
          <div class="field input">
            <label for="">Email Address</label>
            <input type="text" name="email" placeholder="Email Address" <?php if($logindefault) {echo 'value="hello@gmail.com"';} ?> required />
          </div>
          <div class="field input">
            <label for="">Password</label>
            <input
              type="password"
              class="password-field" name="password" <?php if($logindefault) {echo 'value="yellow"';} ?>
              placeholder="Enter new Password" required
            />
            <i class="fa-regular fa-eye"></i>
          </div>
          <div class="mb-3 field image">
            <label for="formFile" class="form-label">Select Image</label>
            <input class="form-control" type="file" name="image" id="formFile" accept="image/*" required />
          </div>
          <div class="field button">
            <input type="submit" value="Continue to Chat" />
          </div>
        </form>
        <div class="link">
          Already Signed Up? <a href="login.php">Login Now</a>
        </div>
      </section>
    </div>

    <?php require_once "php/v.php"; ?>
    <script src="javascript/pass-show-hide.js?v=<?= $v ?>"></script>
    <script src="javascript/signup.js?v=<?= $v ?>"></script>
    
  </body>
</html>