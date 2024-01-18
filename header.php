<?php include ('connect-server.php');?>

<html>
  <head>
      <link rel="stylesheet" href="header.css">
      <meta charset="UTF-8">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  </head>
  <body>
    <div class="header">
      <div class="company-name">
        <div class="logo">
          <img src="img/logo.png" alt="Logo" >
        </div>
        <div class="name">  
          <a href="#default" class="logo">Voltex Engineering</a>
        </div>
      </div>  
      <div class="header-right">
        <div class="location-icon">
          <img src="img/location.png" alt="Location">
          <div class="address">Kuala Lumpur,<br> Malaysia</div>
        </div>
        <div class="contact">
          <img src="img/phone.png" alt="Contact" >
          <div class="call-us">Call Us Anytime</div>
          <div class="phone-no">+60 12-560 7626</div>
        </div>
        <div class="login-btn">
          <?php
            if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
                // User is logged in, display their username
                $username = $_SESSION['username'];
                echo "<span class='display-username'>$username</span>";
                
                // Fetch and display the user's profile picture
                $select_propic = mysqli_query($conn, "SELECT profile_pic FROM `user_record` WHERE user_id = $_SESSION[user_id]") or die('query failed');
                $row = mysqli_fetch_assoc($select_propic);
                $profile_pic = isset($row['profile_pic']) ? $row['profile_pic'] : 'default_profile_pic.jpg';
                echo "<img src='$profile_pic' alt='Profile Picture'>";
            } else {
                // User is not logged in, display the login button
                echo "<a class='request-service' href='log-in.php'>LOGIN</a>";
            }
          ?>
        </div>
        <div class="hidden-sidebar">
          <span class="sidebar-icon" onclick="openNav">
              <i class="fa-solid fa-bars"></i>
          </span>
          <div class="sidebar">
            <div><a href="index.php">Home</a></div>
            <div><a href="user-booking-list.php">My Booking</a></div>
            <div><a href="log-out.php">Log Out</a></div>
          </div>                 
        </div>
      </div>
    </div>
  </body>
  <script>
    const navi = document.querySelector(".hidden-sidebar")
        navi.addEventListener("click", () => {
            navi.classList.toggle("open");
        });
  </script>
</html>
