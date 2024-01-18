<?php

include ('connect-server.php');

session_start();

if(isset($_POST['submit'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select_users = mysqli_query($conn, "SELECT * FROM `user_record` WHERE username = '$username' AND password = '$pass'") or die('query failed');
    $select_electrician = mysqli_query($conn, "SELECT * FROM `electrician` WHERE username = '$username' AND password = '$pass'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
      $row = mysqli_fetch_assoc($select_users);
        if($row['user_type'] == 'admin' ){
          $_SESSION['username'] = $row['username'];
          $_SESSION['user_email'] = $row['email'];
          $_SESSION['user_id'] = $row['user_id'];
          header('location:admin-dashboard.php');
          }elseif($row['user_type'] == 'customer'){ 
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['user_id'];
            header('location:index.php');
          }elseif($row['user_type'] == 'electrician'){ 
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['electrician_id'];
            header('location:admin-manage-booking.php');
          }          
        }elseif(mysqli_num_rows($select_electrician) > 0){
          $row = mysqli_fetch_assoc($select_electrician);
            if($row['user_type'] == 'admin' ){
              $_SESSION['username'] = $row['username'];
              $_SESSION['user_email'] = $row['email'];
              $_SESSION['user_id'] = $row['user_id'];
              header('location:admin-dashboard.php');
              }elseif($row['user_type'] == 'customer'){ 
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['user_id'];
                header('location:index.php');
              }elseif($row['user_type'] == 'electrician'){ 
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['electrician_id'];
                header('location:admin-manage-booking.php');
              }          
        }else{
          $mesgErr = "[Incorrect username or password!]";
        }
}
?>

<html>
  <head>
      <link rel="stylesheet" href="log-in.css">
      <meta charset="UTF-8">
  </head>
  <body>
    <div class="log-in-page">
        <div class="deco-bg"></div>
        <div class="company-name">Voltex Engineering</div>
        <div class="log-in-part">
          <div class="welcome-back">Welcome Back</div>
          <div class="your-progress">Log in to continue your progress</div>
          <form method="post" action="">
            <div class="log-in-form">
                <label for="username">Username/Email</label><br>
                <input type="text" id="username" name="username">
                <br><br>
                <label for="username">Password</label><br>
                <input type="password" id="password" name="password">
            </div>
            <a href="forget.php" class="forget-pw">Forgot Password?</a><br>
            <div class="btn"><button type="submit" name="submit" id="log-in-btn" class="log-in-btn">Log In</button></div>
            <p class="no-acc">Don't have account? <a href="register.php" class="go-register">Register Here</a></p><br>
          </form>
      </div>
    </div>
  </body>
</html>