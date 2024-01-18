<?php

include ('connect-server.php');

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
  }

?>

<html>
    <head>
        <link rel="stylesheet" href="user-booking-list.css">
        <link rel="stylesheet" href="font.css">
        <meta charset="UTF-8">
        <?php include 'header.php'; ?>
    </head>
    <body>
        <div class="div-section">
            <div class="layer"></div>
            <div class="page-title">My Booking</div>
            <div class="booking-table">
                <table class="mybooking">
                    <thead>
                        <tr>
                            <th style="width : 10%">Building Type</th>
                            <th style="width : 20%">Service</th>
                            <th style="width : 10%">Request Date</th>
                            <th style="width : 5%">Time</th>
                            <th style="width : 15%">Location</th>
                            <th style="width : 15%">Assigned Electrician</th>
                            <th style="width : 15%">Status</th>
                            <th style="width : 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-content">
                        <?php
                        $select_service = mysqli_query($conn, "SELECT * FROM `services_record` WHERE user_id = '$user_id'") or die('query failed');
                        if (mysqli_num_rows($select_service) > 0) {
                            while ($fetch_row = mysqli_fetch_assoc($select_service)) {
                        ?>
                        <tr>
                            <td class="title"><?php echo $fetch_row['building_type']; ?></td>
                            <td class="author"><?php echo $fetch_row['service_type']; ?> </td>
                            <td class="author"><?php echo $fetch_row['request_date']; ?> </td>
                            <td class="genre"><?php echo $fetch_row['time']; ?></td>
                            <td class="status"><?php echo $fetch_row['addressLine2']; ?></td>
                            <td class="status">
                                <?php
                                // Assuming $fetch_row['assigned_electricianId'] contains the electrician ID
                                $assigned_electrician_id = mysqli_real_escape_string($conn, $fetch_row['assigned_electricianId']);
                                $find_query = "SELECT * FROM `electrician` WHERE electrician_id = '$assigned_electrician_id'";
                                $result = mysqli_query($conn, $find_query);

                                // Check if the query was successful
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $electrician_data = mysqli_fetch_assoc($result);
                                    // Output the assigned electrician's first name
                                    echo $electrician_data['fname'];
                                } else {
                                    // Handle the case where electrician data is not found
                                    echo 'Not found';
                                }
                                ?>
                            </td>
                            <td class="status"><?php echo $fetch_row['status']; ?></td>
                            <td>
                                <form action="view-details.php" method="post">
                                    <input type="hidden" name="service_id" value="<?php echo $fetch_row['service_id']; ?>">
                                    <input type="submit" name="view_details" value="View Details">
                                </form>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>