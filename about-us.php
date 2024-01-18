<?php

include ('connect-server.php');

session_start();

?>

<html>
  <head>
      <link rel="stylesheet" href="about-us.css">
      <link rel="stylesheet" href="font.css">
      <meta charset="UTF-8">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <?php include 'header.php'; ?>
    </head>
  <body>
    <div class="div-section">
        <div class="top-heading">
            <div class="layer"></div>
            <div class="title">About Us</div>
        </div>
        <div class="section-1">
            <div class="sect-1-pic">
                <img src="img/sect-1-about-us-pic.jpg">
            </div>
            <div class="welcome-sect">
                <div class="welcome-voltex">Welcome to Voltex</div>
                <div class="welcome-text">Welcome to Voltex Engineer, where excellence in electrical services meets unmatched customer satisfaction.
                    With a commitment to delivering reliable, efficient, and safe electrical solutions, we are your go-to partner for all your electrical needs.<br><br> 
                    At Voltex Engineer, we are a team of highly skilled and licensed electricians dedicated to providing top-notch services to residential, commercial, 
                    and industrial clients. With 4 years of experience in the industry, we have established ourselves as a reliable name known for quality workmanship and unparalleled expertise.</div>
                <div class="join-us-button"><button class="join-us">Join Us Now</button></div>
            </div>
        </div> 
        <div class="section-2">
            <div class="title-2">CUSTOMER <span class="feedback-title">FEEDBACKS</span></div>
            <?php
                $select_feedback = mysqli_query($conn, "SELECT * FROM `feedback_record` INNER JOIN `user_record` ON user_record.user_id = feedback_record.user_id 
                    ORDER BY date DESC LIMIT 3") or die('query failed');
                if(mysqli_num_rows($select_feedback)> 0){
                    while($fetch_feedback = mysqli_fetch_assoc($select_feedback)){
            ?>
            <div class="feedback">
                <div class="feedback-text"><?php echo $fetch_feedback['feedback'];?></div>
                <div class="profile">
                    <?php $imageURL = isset($fetch_feedback['profile_pic']) ? $fetch_feedback['profile_pic'] : 'img/default-user-icon.png';?>
                    <img src="<?php echo $imageURL; ?>">
                    <div class="username"><?php echo $fetch_feedback['username'];?></div>
                    <div class="user-address"><?php echo $fetch_feedback['city'];?></div>
                </div>
            </div>
            <?php
                    }          
                }
            ?>
        </div>       
        <div class="section-3">
            <div class="free-estimation">
                <div class="sect3-icon1"><img src="img/free-estimation-icon.svg" alt="icon"></div>
                <h1 class="sect3-head1">Free Estimation</h1>
                <p class="sect3-desc1">We assess the scope of the work, materials, and other relevant factors to provide 
                    clients with an initial idea of the anticipated costs or timelines involved.</p>
            </div>
            <div class="available">
                <div class="sect3-icon2"><img src="img/available-icon.svg" alt="icon"></div>
                <h1 class="sect3-head2">24/7 Available</h1>
                <p class="sect3-desc2">Our booking application is working functionally everyday, everytime.</p>
            </div>
            <div class="afordable-price">
                <div class="sect3-icon3"><img src="img/affordable-icon.svg" alt="icon"></div>
                <h1 class="sect3-head3">Affordable Price</h1>
                <p class="sect3-desc3">We’ll provide to our customer the best electrician along with best price 
                                    (terms and conditions included).</p>
            </div>  
      </div>
      <div class="section-4">
        <div class="title-4">
            OUR TEAM LEADER
            <p class="desc-title">Meet our professional team members who are ever ready and up to the task of assisting you</p>
        </div>
        <div class="team-leader">
            <div class="leader-pro-pic"><img src="img/manager.jpeg" alt="icon"><div class="role">Manager</div></div>
            <h1 class="leader-name">Pep Guardiola</h1>
            <p class="leader-email"><img src="img/team-leader-email-icon.svg"> guar.pep@voltex.com</p>
            <p class="leader-phone"><img src="img/team-leader-phone-icon.svg"> 085 557 9980</p>
        </div>
        <div class="team-leader">
            <div class="leader-pro-pic"><img src="img/engineer.jpeg" alt="icon"><div class="role">Engineer</div></div>
            <h1 class="leader-name">Mikel Arteta</h1>
            <p class="leader-email"><img src="img/team-leader-email-icon.svg"> artetamikel@voltex.com</p>
            <p class="leader-phone"><img src="img/team-leader-phone-icon.svg"> 085 557 9970</p>
        </div>
        <div class="team-leader">
            <div class="leader-pro-pic"><img src="img/chargemen.jpg" alt="icon"><div class="role">Chargemen</div></div>
            <h1 class="leader-name">Erik Ten Hag</h1>
            <p class="leader-email"><img src="img/team-leader-email-icon.svg"> th.erik@voltex.com</p>
            <p class="leader-phone"><img src="img/team-leader-phone-icon.svg"> 085 557 9985</p>
        </div>
        <div class="team-leader">
            <div class="leader-pro-pic"><img src="img/admin.jpeg" alt="icon"><div class="role">Admin</div></div>
            <h1 class="leader-name">Ande Postecoglou</h1>
            <p class="leader-email"><img src="img/team-leader-email-icon.svg"> postecoglou.ande@voltex.com</p>
            <p class="leader-phone"><img src="img/team-leader-phone-icon.svg"> 085 557 9974</p>
        </div>  
      </div>
      <div class="bg-deco"><img src="img/about-us-bg-deco.svg"></div>
      <?php include 'footer.php'; ?>
    </div>
  </body>
</html>