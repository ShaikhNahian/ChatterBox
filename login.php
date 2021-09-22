<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: master/users.php");
  }
?>

<?php include_once "master/header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>CHATTERBOX</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
         
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not signed up yet? <a href="master/index.php">Sign up now</a></div>
    </section>
  </div>
  
  <script src="master/javascript/login.js"></script>

</body>
</html>
