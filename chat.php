<?php 
  session_start();
  include_once "master/php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: master/login.php");
  }
?>
<?php include_once "master/header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: master/users.php");
          }
        ?>
        <a href="master/users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="master/php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <!-- <button classname="uploadButton"><i class="fab fa-telegram-plane"></i></button> -->
        
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
      <form action="#" class="media_form" id = "uploadMedia">
    Upload:
    <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <!-- <input type="file" name="fileToUpload" accept="image/x-png,image/gif,image/jpeg,image/jpg" > -->
    <!-- <button class="media_button" type="submit">Upload</button> -->
    <input type="submit" value="Upload" name="submit" class="media_button" id="media_button">
</form>
    </section>
  </div>

  <script src="master/javascript/chat.js"></script>

</body>
</html>
